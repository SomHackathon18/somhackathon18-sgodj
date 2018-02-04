@extends('layouts.app')
    
@section('content')
    
    <v-tabs v-model="active" grow class="fill">
        <v-tabs-bar class="cyan" dark>
            <v-tabs-slider class="yellow"></v-tabs-slider>
            <v-tabs-item :key="1" href="#tab-1" >
                MAP
            </v-tabs-item>
            <v-tabs-item :key="2" href="#tab-2" >
                ORDERS
            </v-tabs-item>
        </v-tabs-bar>

        <v-tabs-items class="fill">
            <v-tabs-content :key="1" id="tab-1" class="fill">
                <google-map
                    api-key="{{ config('services.google.maps.apikey') }}"
                    language="{{ config('app.locale') }}"
                    region="{{ config('app.region') }}"
                    style="height:550px" >
                    @foreach ($locations as $location)
                        <google-map-marker :latitude="{{ $location->lat }}" :longitude="{{ $location->lng }}" title="{{ $location->epigraph_desc }}" icon="/images/marker.png" :icon-size="20"></google-map-marker>
                    @endforeach
                    @foreach ($orders as $order)
                        <google-map-marker :latitude="{{ $order->location->lat }}" :longitude="{{ $order->location->lng }}" title="{{ $order->location->epigraph_desc }}" icon="/images/marker-order.png"></google-map-marker>
                    @endforeach
                </google-map>
            </v-tabs-content>

            <v-tabs-content :key="2" id="tab-2" class="fill">

                <v-list three-line>
                    <v-subheader>Available orders</v-subheader>
                    <v-divider></v-divider>
                    @foreach ($orders as $key => $order) 
                        <v-list-tile href="{{ route('show-order', $order->id) }}">
                            <v-list-tile-avatar>
                                <img src="http://www.designskilz.com/random-users/images/image{{ $key % 2 ? 'M' : 'F' }}{{ $key + 1 }}.jpg">
                            </v-list-tile-avatar>

                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{$order->title}}
                                </v-list-tile-title>
                                <v-list-tile-sub-title>
                                    Rewards {{$order->reward}} points
                                </v-list-tile-sub-title>
                            </v-list-tile-content>

                            <v-list-tile-action>
                                <v-btn icon ripple>
                                    <v-icon color="grey lighten-1">
                                        fa-chevron-right
                                    </v-icon>
                                </v-btn>
                            </v-list-tile-action>
                        </v-list-tile>
                    @endforeach
                </v-list>

            </v-tabs-content>
        </v-tabs-items>
    </v-tabs>

    
@endsection