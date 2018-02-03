<template>
    <div id="google-map">

        <info-window></info-window>

        <google-map-markers></google-map-markers>

        <div id="map" class="fill"></div>
        
    </div>
</template>


<script>
    export default {

        props: {
            apiKey: {type: String, required: true},
            region: String,
            language: String,
            streetView: Boolean,
        },

        data() {
            return{
                map: {},
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
                    zoom: 16,
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
            },

            initializeBus: function (google) {

                bus.$emit('map-initialized', google);

            },

        }
    }
</script>