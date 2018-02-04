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
                    class="fill" >
                    @foreach ($locations as $location)
                        <google-map-marker :latitude="{{ $location->lat }}" :longitude="{{ $location->lng }}" title="{{ $location->epigraph_desc }}" icon="images/marker.png"></google-map-marker>
                    @endforeach
                </google-map>
            </v-tabs-content>

            <v-tabs-content :key="2" id="tab-2" class="fill">

                @foreach ($orders as $order) 
                    <v-list three-line>
                      <div>
                        <v-list-tile @click="">
                          <v-list-tile-avatar>
                            <img />
                          </v-list-tile-avatar>
                          <v-list-tile-content>
                            <v-list-tile-title > {{$order->title}} </v-list-tile-title>
                            <v-list-tile-sub-title > {{$order->description}} </v-list-tile-sub-title>
                          </v-list-tile-content>
                        </v-list-tile>
                      </div>
                    </v-list>
                  @endforeach

            </v-tabs-content>
        </v-tabs-items>
    </v-tabs>

    
@endsection