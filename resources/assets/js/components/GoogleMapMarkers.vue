
<template>
    <div id="google-map-markers"></div>
</template>


<script>
    export default {

        data() {
            return{
                lesson: null,

                centers: [],
                centerMarkerImagePath: '/images/marcador_autoescuela.png',

                locations: [],
                locationMarkerImagePath: '/images/marcador_localizacion.png',
                addedLocationMarkerImagePath: '/images/marcador_añadida.png',

                markerCluster: {},
            }
        },

        mounted() {
            this.initializeBus();
        },

        methods: {

            initializeBus: function () {

                bus.$on('map-initialized', (google) => {
                    this.initializeMarkers();
                });

                bus.$on('centers-received', (centers) => {
                    this.centers = centers;
                    this.updateCenterMarkers();
                });

                bus.$on('locations-received', (locations) => {
                    this.setLocations(locations);
                });

                bus.$on('lesson-received', (lesson) => {
                    this.lesson = lesson;
                    this.getLocations();
                });
            },

            initializeMarkers: function () {
                if (this.$parent.withCenters) this.getCenters();
                if (this.$parent.withLocations) this.getLocations();
            },

            getCenters: function () {
                this.$http.get('/api/centers').then( (response) => {
                    bus.$emit('centers-received', response.data);
                });
            },

            getLocations: function () {
                this.$http.get('/api/locations').then( (response) => {
                    bus.$emit('locations-received', response.data);
                });
            },

            setLocations: function (locations) {
                // Limpiar marcadores del mapa antes de sobreescribir las localizaciones.
                this.clearMarkers(this.locations);
                this.locations = locations;
                this.checkLocationsInLesson();
                this.updateLocationMarkers();
            },

            checkLocationsInLesson: function () {
                if (this.lesson !== null){
                    [...this.locations].forEach(function (location) {
                        let foundInLesson = _.find(location.lessons, ['id', this.lesson.id]);
                        location.inLesson = isDefined(foundInLesson);
                    }, this);
                    bus.$emit('parsed-locations-for-lesson', this.locations);
                }
            },

            updateLocationMarkers: function () {
               
                [...this.locations].forEach(function (location) {
                    if (location.inLesson) {
                        var marker = this.newMarker(location, this.addedLocationMarkerImagePath);
                    }else{
                        if(this.$parent.editMode){
                            var marker = this.newMarker(location, this.locationMarkerImagePath);
                        }
                    }

                    if(isDefined(marker)){
                        marker.addListener('click', function () {
                            bus.$emit('marker-click', marker, location);
                        });
                        
                        location.marker = marker;
                    }
                    //this.markerCluster.addMarker(marker);
                }, this);
            },

            updateCenterMarkers: function () {
                this.deleteMarkers(this.centers);

                [...this.centers].forEach(function (center) {
                    let marker = this.newMarker(center, this.centerMarkerImagePath);

                    center.marker = marker;
                    //this.markerCluster.addMarker(marker);
                }, this);
            },

            newMarker: function (position, icon) {
                return new google.maps.Marker({
                    map: this.$parent.map,
                    icon: icon,
                    title: position.name,
                    position: {lat: parseFloat(position.latitude), lng: parseFloat(position.longitude)}
                });
            },

            clearMarkers: function (entities) {
                [...entities].forEach(function (entity) {
                    if (entity.marker) {
                        entity.marker.setMap(null);
                    }
                });
            },

            deleteMarkers: function (entities) {
                this.clearMarkers(entities);
                [...entities].forEach(function (entity) {
                   if (entity.marker) {
                        entity.marker = undefined;
                    }
                });
            },

            
            
            /*
            markerClustering: function () {
                var self = this;
                $.ajax({
                    type: "GET",
                    url: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js",
                    success: function () {
                        self.markerCluster = new MarkerClusterer(
                            self.map,
                            self.markers,
                            {
                                imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
                            }
                        );
                    },
                    dataType: "script",
                    cache: true
                });
            },
            */

        }
    }

</script>