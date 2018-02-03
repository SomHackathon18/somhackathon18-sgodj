@extends('layouts.app')

@section('content')

    <v-tabs v-model="active" grow>
        <v-tabs-bar class="cyan" dark>
            <v-tabs-item v-for="tab in tabs" :key="tab" :href="'#' + tab" ripple >
                Item @{{ tab.slice(-1) }}
            </v-tabs-item>
            <v-tabs-slider color="yellow"></v-tabs-slider>
        </v-tabs-bar>
        <v-tabs-items>
            <v-tabs-content v-for="tab in tabs" :key="tab" :id="tab" >
                <v-card flat>
                    <v-card-text>@{{ text }}</v-card-text>
                </v-card>
            </v-tabs-content>
        </v-tabs-items>
    </v-tabs>

@endsection