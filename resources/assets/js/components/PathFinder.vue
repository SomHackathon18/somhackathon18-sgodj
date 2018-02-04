
<template>
    <div>
        <v-subheader class="grey--text">The distance is:
        <v-subheader class="black--text">{{distance}}</v-subheader>  
        </v-subheader>  

        <v-subheader class="grey--text">The duration of the travel is:
        <v-subheader class="black--text">{{duration}}</v-subheader>  
        </v-subheader>  

    </div>
</template>

<script>


export default {
    props : {
        lat : { required: true, type: Number },
        lng : { required: true, type: Number },
    },
    data () {
        return {
            google: {},
            distance: null,
            duration: null,
        }
    },

    mounted() {
        bus.$on('map-initialized', (google) => {
            if (navigator.geolocation) {
                this.google = google;
                navigator.geolocation.getCurrentPosition(this.showPosition);
            }
        });
    },

    methods : {
        showPosition: function (position) {
            let origin = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            let destination = new google.maps.LatLng(this.lat, this.lng);
            let service = new google.maps.DistanceMatrixService();

            service.getDistanceMatrix({
                origins: [origin],
                destinations: [destination],
                travelMode: 'WALKING',
                avoidHighways: false,
                avoidTolls: false,
            }, this.getDistance);
        },

        getDistance : function (response, status) {
            if (status == 'OK') {
                let origins = response.originAddresses;
                let destinations = response.destinationAddresses;

                for (let i = 0; i < origins.length; i++) {
                    let results = response.rows[i].elements;
                    for (let j = 0; j < results.length; j++) {
                        let element = results[j];
                        this.distance = element.distance.text;
                        this.duration = element.duration.text;
                        let from = origins[i];
                        let to = destinations[j];
                    }
                }
            }
        },
    }
}

</script>