@extends('layouts.app')

@section('content')
    
    <div class="">
        <v-btn color="light-blue" href="{{ url('/auth/twitter') }}" dark>
            <v-icon dark left>fa-twitter</v-icon>
            Twitter
        </v-btn>

        <v-btn color="indigo" href="{{ url('/auth/facebook') }}" dark>
            <v-icon dark left>fa-facebook</v-icon>
            Facebook
        </v-btn>

        <v-btn color="red" href="{{ url('/auth/google') }}" dark>
            <v-icon dark left>fa-google</v-icon>
            Google
        </v-btn>
    </div>

@endsection
