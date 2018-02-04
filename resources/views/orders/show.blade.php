@extends('layouts.master')
    
@section('main')

<!--
	detalls ordre
	mapa
	acceptar ordre
 -->
 <v-toolbar dark color="primary">
    
 <v-btn icon href="{{route('home')}}">
    <v-icon>arrow_back</v-icon>
  </v-btn>

    <v-toolbar-title class="white--text">
        {{ $order->title }}
    </v-toolbar-title>

    <v-spacer></v-spacer>
    



</v-toolbar>
  <google-map
    api-key="{{ config('services.google.maps.apikey') }}"
    language="{{ config('app.locale') }}"
    region="{{ config('app.region') }}"
    class="fill" >
        <google-map-marker :latitude="{{ $order->location->lat }}" :longitude="{{ $order->location->lng }}" title="{{ $order->location->epigraph_desc }}" icon="images/marker.png"></google-map-marker>
</google-map>

    <path-finder :lat="{{$order->location->lat}}" :lng="{{$order->location->lng}}"> </path-finder>
  <v-flex>
        <v-subheader class="black--text">{{$order->description}}</v-subheader>	
			<v-checkbox 
			label="Join to the event"
            v-model="ex4"
            color="info"
            value="info"
            hide-details>
        </v-checkbox>
       </v-flex>
@endsection