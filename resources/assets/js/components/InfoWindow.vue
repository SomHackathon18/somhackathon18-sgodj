
<template>
    <div id="iw-template" class="hidden">

        <div class="info-window-header">
            <h5>
                <i class="icon-marker"></i>
                Title
            </h5>
        </div>

        <div class="info-window-content">

            <div class="info-window-options">
                <!-- CODE HERE -->
            </div>

        </div>

        <div class="info-window-close centered-items">
            <i class="icon-cross"></i>
        </div>

    </div>
</template>


<script>
    export default {

        data() {
            return{
                infoWindow: {}
            }
        },

        mounted() {
            this.initializeBus();
            
            // Event delegation
            $('#map').on('click', '.info-window-close', () => {
                this.close();
            });
        },

        methods: {

            initializeBus: function () {

                bus.$on('marker-click', (marker) => {
                    this.open(marker);
                });
            },

            initializeInfoWindow: function (google) {
                this.infoWindow = new google.maps.InfoWindow();

                google.maps.event.addListener(this.infoWindow, 'domready', function () {
                    $('.gm-style-iw').prev().css({ 'display' : 'none' });
                    $('.gm-style-iw').next().css({ 'display' : 'none' });
                    $('.gm-style-iw').parent().css({
                        'width' : '400px'
                    }).parent().css({
                        'left' : '25px'
                    });
                });
            },

            open: function (marker) {
                Vue.nextTick( () => {
                    this.infoWindow.setContent('<div class="info-window">'+$('#iw-template').html()+'</div>');
                    this.infoWindow.open(this.$parent.$parent.map, marker);
                });
            },

            close: function () {
                this.infoWindow.close();
            },
        }
    }

</script>