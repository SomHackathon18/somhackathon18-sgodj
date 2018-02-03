<template>
    <div id="google-map">

        <info-window></info-window>

        <google-map-markers></google-map-markers>

        <div id="map"></div>

        <div id="live-in-vr" v-if="!editMode && onStreetView">
            <i class="icon-vr-glasses-filled"></i>
        </div>
        
    </div>
</template>


<script>
    export default {

        props: {
            apiKey: {type: String, required: true},
            region: String,
            language: String,
            teaching: Object,
            editMode: Boolean,
            streetView: Boolean,
            userCenter: {type: Object, required: true},
            withCenters: Boolean,
            withLocations: Boolean,
            withDrawingTools: Boolean,
            withLocationManager: Boolean,
        },

        data() {
            return{
                map: {},
                onStreetView: false,
                firstExploredLocationSent: false,
            }
        },

        mounted() {
            GoogleMapsLoader.KEY = this.apiKey;
            GoogleMapsLoader.LIBRARIES = ['places','drawing'];
            GoogleMapsLoader.LANGUAGE = this.language;
            GoogleMapsLoader.REGION = this.region;

            GoogleMapsLoader.load( (google) => {
                this.initializeMap(google);
            });
        },

        methods: {

            initializeMap: function (google) {

                let customStyles = [{
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [{visibility: 'off'}]
                }];
                
                this.map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: _.isNull(this.userCenter.latitude) ? 41.3911056 : this.userCenter.latitude,
                        lng: _.isNull(this.userCenter.longitude) ? 2.1548483 : this.userCenter.longitude,
                    },
                    zoom: 14,
                    minZoom: 5,
                    tilt: 0,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: customStyles,
                    clickableIcons: false,
                    streetViewControl: this.streetView,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        mapTypeIds: [
                            google.maps.MapTypeId.ROADMAP,
                            google.maps.MapTypeId.SATELLITE
                        ]
                    }
                });

                this.initializeBus(google);

                if (this.streetView) this.explore(google);

            },

            initializeBus: function (google) {

                bus.$emit('map-initialized', google);

                bus.$on('location-selected', (location) => {
                    this.map.setCenter(location);
                    this.map.setZoom(20);
                });

                bus.$on('show-street-view', (location) => {
                    this.showStreetView(location);
                });

                bus.$on('hide-street-view', () => {
                    this.map.getStreetView().setVisible(false);
                });

                bus.$on('street-view-enter', (streetViewPanorama) => {
                    if (!this.firstExploredLocationSent) {
                        this.sendLocation(streetViewPanorama);
                        this.firstExploredLocationSent = true;
                    }
                });

                bus.$on('street-view-moved', (streetViewPanorama) => {
                    this.sendLocation(streetViewPanorama);
                });
            },

            showStreetView: function (location) {
                console.log(location.name);
                this.map.getStreetView().setPosition({lat: location.latitude, lng: location.longitude});
                this.map.getStreetView().setVisible(true);
            },

            explore: function (google) {

                let streetViewPanorama = this.map.getStreetView();

                google.maps.event.addListener(streetViewPanorama, 'visible_changed', () => {

                    if (streetViewPanorama.getVisible() && !this.onStreetView) {
                        bus.$emit('street-view-enter', streetViewPanorama);
                        this.onStreetView = true;
                    } else if (!streetViewPanorama.getVisible() && this.onStreetView) {
                        bus.$emit('street-view-exit', streetViewPanorama);
                        this.onStreetView = false;
                    }

                });

                google.maps.event.addListener(streetViewPanorama, 'position_changed', () => {
                    if (streetViewPanorama.getVisible() && this.onStreetView) {
                        console.log("moved");
                        bus.$emit('street-view-moved', streetViewPanorama);
                        this.onStreetView = true;
                    }
                });
            },

            sendLocation: function (streetViewPanorama) {
                if (this.teaching){
                    if (_.startsWith(streetViewPanorama.pano, 'F:')) {
                        console.log("INDOOR location, not sent to VR");
                    }else{
                        console.log("Sending to VR: " + streetViewPanorama.pano);
                        this.$http.get('/api/teaching/' + this.teaching.id + '/send/' + streetViewPanorama.pano);
                    }
                }
            }
        }
    }

</script>