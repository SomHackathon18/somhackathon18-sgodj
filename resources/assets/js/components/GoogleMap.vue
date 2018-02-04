<template>
    <div id="google-map">

        <div id="map" class="fill"></div>

        <slot v-if="google"></slot>

        <google-map-marker v-if="currentLat != 0" :latitude="currentLat" :longitude="currentLng" title="You are currently here" icon="/images/marker-user.png" :icon-size="50"></google-map-marker>
        
    </div>
</template>


<script>
    export default {

        props: {
            apiKey: {type: String, required: true},
            region: String,
            language: String,
            streetView: Boolean,
            zoom: { required: false, type: Number, default: 16},
        },

        data() {
            return{
                map: {},
                google: null,
                currentLat: 0,
                currentLng: 0,
            }
        },

        mounted() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.showPosition);
            }

            GoogleMapsLoader.KEY = this.apiKey;
            GoogleMapsLoader.LIBRARIES = ['places'];
            GoogleMapsLoader.LANGUAGE = this.language;
            GoogleMapsLoader.REGION = this.region;

            GoogleMapsLoader.load( (google) => {
                this.initializeMap(google);
                this.google = google;
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
                    zoom: this.zoom,
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
            },

            showPosition(position) {
                this.currentLat = position.coords.latitude;
                this.currentLng = position.coords.longitude;

                this.map.setCenter({
                    lat: this.currentLat,
                    lng: this.currentLng,
                });
                this.map.setZoom(this.zoom);
            },

            initializeBus: function (google) {
                bus.$emit('map-initialized', google);
            },
        }
    }
</script>