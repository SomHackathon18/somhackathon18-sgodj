
<v-navigation-drawer
  fixed
  v-model="drawer"
  app
>
 <v-list dense>
        <v-list-tile @click="">
          <v-list-tile-action>
            <v-icon>home</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Profile</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click="">
          <v-list-tile-action>
            <v-icon>contact_mail</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Logout</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
</v-list>

</v-navigation-drawer>

<v-toolbar dark color="primary">
    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>

    <v-toolbar-title class="white--text">{{ config('app.name') }}</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn icon>
        <v-icon>search</v-icon>
    </v-btn>
    <v-btn icon>
        <v-icon>refresh</v-icon>
    </v-btn>
</v-toolbar>
