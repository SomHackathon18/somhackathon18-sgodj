
<v-navigation-drawer fixed v-model="drawer" app>

    <v-list dense>
        <v-list-tile @click="">
            <v-list-tile-action>
                <v-icon>fa-user</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>Profile</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile @click="">
            <v-list-tile-action>
                <v-icon>fa-sign-out</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>Logout</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list>

</v-navigation-drawer>