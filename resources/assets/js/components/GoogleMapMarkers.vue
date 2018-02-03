
<template>
    <div class="google-map-marker"></div>
</template>


<script>
    export default {

        props: {
            latitude: { required: true, type: Number },
            longitude: { required: true, type: Number },
            iconPath: { required: true, type: String },
        },

        data() {
            return{
                location: {},
            }
        },

        mounted() {
            //
        },

        methods: {
            newMarker: function (position, icon) {
                return new google.maps.Marker({
                    map: this.$parent.map,
                    icon: icon,
                    title: position.name,
                    position: {lat: this.latitude, lng: this.longitude}
                });
            },

            updateLocationMarkers: function () {
               
                [...this.locations].forEach(function (location) {
                    var marker = this.newMarker(location, this.iconPath);

                    if(isDefined(marker)){
                        marker.addListener('click', function () {
                            bus.$emit('marker-click', marker, location);
                        });
                        
                        location.marker = marker;
                    }
                }, this);
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
        }
    }

</script>