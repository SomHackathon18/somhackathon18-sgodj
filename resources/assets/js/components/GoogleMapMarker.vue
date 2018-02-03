
<template>
    <div class="google-map-marker"></div>
</template>

<script>
    export default {

        props: {
            title: { required: false, type: String },
            latitude: { required: true, type: Number },
            longitude: { required: true, type: Number },
            icon: { required: true, type: String },
        },

        data() {
            return{
                marker: {},
            }
        },

        mounted() {
            this.addMarker();
        },

        methods: {
            addMarker: function () {
                return new google.maps.Marker({
                    map: this.$parent.map,
                    icon: this.iconPath,
                    title: this.title,
                    position: {lat: this.latitude, lng: this.longitude}
                });
            },

            removeMarker: function (entities) {
                if (this.marker) {
                    this.marker.setMap(null);
                }
            },
        }
    }

</script>