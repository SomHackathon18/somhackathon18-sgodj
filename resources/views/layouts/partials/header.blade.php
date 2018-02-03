@include('layouts.partials.navigation-drawer')

<v-toolbar dark color="primary">
    
    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>

    <v-toolbar-title class="white--text">{{ config('app.name') }}</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn icon>
        <v-icon>search</v-icon>
    </v-btn>

</v-toolbar>
