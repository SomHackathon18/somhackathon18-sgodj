<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
    <head>
        @include('layouts.partials.head')
        @stack('styles')
    </head>

    <body>
        <v-app id="app">

            @yield('main')

        </v-app>
    </body>
        
    <script src="{{ asset('js/app.js') }}" async></script>
    
    <!-- Scripts -->
    @stack('scripts')

</html>