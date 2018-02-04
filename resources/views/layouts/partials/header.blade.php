
@auth
    @include('layouts.partials.navigation-drawer')
@endauth

<v-toolbar dark color="primary">
    
    @auth
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    @endauth

    <v-toolbar-title class="white--text">
        {{ config('app.name') }}
    </v-toolbar-title>

    <v-spacer></v-spacer>
    
    @auth
        <v-btn icon>
            <v-icon>search</v-icon>
        </v-btn>
    @endauth

</v-toolbar>
