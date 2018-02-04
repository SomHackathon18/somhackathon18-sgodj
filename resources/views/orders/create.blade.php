@extends('layouts.app')
    
@section('content')

    <form method="post" action="{{ action('OrdersController@store') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <v-container fluid>
            <v-layout row wrap>
                <v-flex xs12>
                    <v-text-field label="Order title" name="title" required></v-text-field>
                    <v-text-field name="description" label="Order description" multi-line></v-text-field>
                    <v-select
                    v-bind:items="{{ $locations }}"
                    name="location_id"
                    label="Place" 
                    item-text="epigraph_desc" 
                    item-value="id" 
                    prepend-icon="fa-briefcase"
                    autocomplete></v-select>
                    <v-text-field label="Reward" name="reward" :value="0"></v-text-field>
                    <v-btn block color="info" type="submit">
                        Send
                    </v-btn>
                </v-flex>
            </v-layout>
        </v-container>
    </form>

@endsection