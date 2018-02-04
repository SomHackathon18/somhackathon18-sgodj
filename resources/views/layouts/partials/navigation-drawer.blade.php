
<v-navigation-drawer fixed v-model="drawer" app>
    
    <v-toolbar color="grey lighten-4">
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
                <v-icon>fa-handshake</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>{{ Auth::user()->wallet }} points</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <br>
        <v-divider></v-divider>
        <br>
        <v-list-tile href="{{ route('home') }}">
            <v-list-tile-action>
                <v-icon>fa-map</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>Home</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile href="{{ route('create-order') }}">
            <v-list-tile-action>
                <v-icon>fa-plus</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>New order</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile href="{{ route('index-order') }}">
            <v-list-tile-action>
                <v-icon>fa-tasks</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>Orders history</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile href="{{ route('home') }}">
            <v-list-tile-action>
                <v-icon>fa-tags</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>My discounts</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        
        <v-list-tile href="{{ route('home') }}">
            <v-list-tile-action>
                <v-icon>fa-user</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>My profile</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile href="{{ route('logout') }}">
            <v-list-tile-action>
                <v-icon>fa-sign-out-alt</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title >Logout</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list>

</v-navigation-drawer>