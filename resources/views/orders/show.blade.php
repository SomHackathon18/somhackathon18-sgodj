@extends('layouts.master')
    
@section('main')

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
        style="height: 350px" >

        <google-map-marker :latitude="{{ $order->location->lat }}" :longitude="{{ $order->location->lng }}" title="{{ $order->location->epigraph_desc }}" icon="/images/marker-order.png"></google-map-marker>

    </google-map>
    
    <v-list two-line>
        <path-finder :zoom="2" :lat="{{$order->location->lat}}" :lng="{{$order->location->lng}}"></path-finder>

        <v-list-tile avatar>
            <v-list-tile-avatar>
                <v-icon>fa-handshake</v-icon>
            </v-list-tile-avatar>

            <v-list-tile-content>
                <v-list-tile-title>This order rewards <strong>{{ $order->reward }} points</strong></v-list-tile-title>
                <v-list-tile-sub-title>You currently have {{ Auth::user()->wallet }} points</v-list-tile-sub-title>
            </v-list-tile-content>

        </v-list-tile>
    </v-list>
    
    @if( is_null( $order->attendant_id ) )
        <v-flex class="px-2">
            <v-btn block color="info" href="{{ route('update-order', $order->id) }}">
                Join the order
            </v-btn>
        </v-flex>
    @endif
@endsection