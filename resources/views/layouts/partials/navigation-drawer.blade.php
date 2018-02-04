
<v-navigation-drawer fixed v-model="drawer" app>
    
    <v-toolbar>
        <v-list class="pa-0">
            <v-list-tile avatar>
                <v-list-tile-avatar>
                    <img src="https://randomuser.me/api/portraits/men/85.jpg" />
                </v-list-tile-avatar>

                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ Auth::user()->name }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

        </v-list>

    </v-toolbar>

    <v-list dense>
        <v-subheader>Wallet</v-subheader>

        <v-list-tile>
            <v-list-tile-action>
                <v-icon>fa-bitcoin</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>000</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <br>
        <v-divider></v-divider>
        <br>
        <v-list-tile>
            <v-list-tile-action>
                <v-icon>fa-user</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>Profile</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile>
            <v-list-tile-action>
                <v-icon>fa-plus</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>New order</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile @click="" href="/logout">
            <v-list-tile-action>
                <v-icon>fa-sign-out</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title >Logout</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list>

</v-navigation-drawer>