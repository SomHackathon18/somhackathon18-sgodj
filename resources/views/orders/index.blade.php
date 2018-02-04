@extends('layouts.app')
    
@section('content')

    <v-list two-line subheader id="dialog-orders">
        <v-subheader>Orders History</v-subheader>
        <v-divider></v-divider>
        @foreach ($orders as $key => $order)
            <v-list-tile avatar>
                <v-list-tile-avatar>
                    @if ( $order->completed )
                        <img src="http://www.designskilz.com/random-users/images/image{{ $key % 2 ? 'M' : 'F' }}{{ $key + 1 }}.jpg">
                    @else
                        <v-icon>fa-clock</v-icon>
                    @endif
                </v-list-tile-avatar>

                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ $order->title }}
                    </v-list-tile-title>

                    <v-list-tile-sub-title>
                        {{ $order->description }}
                    </v-list-tile-sub-title>
                </v-list-tile-content>

                <v-list-tile-action>
                    <v-btn icon ripple>
                        <v-icon color="grey lighten-1">
                            {{ $order->completed ? 'fa-check-circle' : 'info' }}
                        </v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
        @endforeach
    </v-list>

@endsection