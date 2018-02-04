
<template>
    <div class="google-map-marker">
        <!--
            <info-window></info-window>
        -->
    </div>
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
                marker: null,
            }
        },

        mounted() {
            this.marker = this.addMarker();
        },

        beforeDestroy() {
            if (this.marker) {
                this.marker.setMap(null);
            }
        },

        methods: {
            addMarker: function () {
                let icon = {
                    url: this.icon,
                    scaledSize: new google.maps.Size(30,30), 
                    origin: new google.maps.Point(0,0),
                    anchor: new google.maps.Point(0, 0)
                };
                return new google.maps.Marker({
                    map: this.$parent.map,
                    icon: icon,
                    title: this.title,
                    position: {lat: this.latitude, lng: this.longitude}
                });
            },
        }
    }

</script>