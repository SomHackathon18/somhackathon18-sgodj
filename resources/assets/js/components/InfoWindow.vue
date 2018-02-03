
<template>
    <div id="iw-template" class="hidden">

        <div class="info-window-header">
            <h5>
                <i class="icon-marker"></i>
                {{ location.name }}
            </h5>
        </div>

        <div class="info-window-content">
            <p>
                <span v-for="tag in location.tags">{{ tag.name }} </span>
                <span v-if="!location.tags">Sin etiquetas</span>
            </p>

            <div class="info-window-options">
                <button 
                    class="attach-button centered-items" 
                    v-if="location.hasOwnProperty('inLesson') && !location.inLesson && $parent.editMode" 
                    @click="attachLocation(location)">
                    <i class="icon-plus"></i>
                </button>
                <button 
                    class="detach-button centered-items" 
                    v-if="location.hasOwnProperty('inLesson') && location.inLesson && $parent.editMode" 
                    @click="detachLocation(location)">
                    <i class="icon-minus"></i>
                </button>
                <button class="show-street-view-button centered-items" :title="__('maps.info-window.show-street-view')">
                    <i v-if="$parent.editMode" class="icon-street-view"></i>
                    <i v-else class="icon-vr-glasses-filled"></i>
                </button>
            </div>

        </div>

        <div class="info-window-close centered-items">
            <i class="icon-cross"></i>
        </div>

        <div class="bg">
            <div class="tail"></div>
        </div>

    </div>
</template>


<script>
    export default {

        data() {
            return{
                infoWindow: {},
                location: {}
            }
        },

        mounted() {
            this.initializeBus();
            
            // Event delegation
            $('#map').on('click', '.info-window .show-street-view-button', () => {
                if (this.$parent.editMode) {
                    bus.$emit('show-street-view', this.location);
                }else{
                    window.location = window.location.href + '/location/' + this.location.id;
                }
            }).on('click', '.info-window-close', () => {
                this.close();
            }).on('click', '.attach-button', () => {
                bus.$emit('attach-location', this.location);
                this.close();
            }).on('click', '.detach-button', () => {
                bus.$emit('detach-location', this.location);
                this.close();
            });
        },

        methods: {

            initializeBus: function () {

                bus.$on('map-initialized', (google) => {
                    this.initializeInfoWindow(google);
                });

                bus.$on('marker-click', (marker, location) => {
                    this.open(marker, location);
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

            open: function (marker, location) {
                this.location = location;

                Vue.nextTick( () => {
                    this.infoWindow.setContent('<div class="info-window">'+$('#iw-template').html()+'</div>');
                    this.infoWindow.open(this.$parent.map, marker);
                });
            },

            close: function () {
                this.infoWindow.close();
            },
        }
    }

</script>