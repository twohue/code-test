<template>
    <v-app id="inspire" v-if="this.user">
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
            :color="themeColor"
        >
            <v-list dense>
                <v-list-item ripple link v-for="item in items" :key="item.title" :to="item.link" v-if="!item.gate || isLogged">
                    <v-list-item-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <admin-menu></admin-menu>
                <v-list-item ripple link v-if="isLogged">
                    <v-list-item-action>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-dialog v-model="logOutDialog" persistent max-width="290">
                            <template v-slot:activator="{ on, attrs }">
                                <v-list-item-title
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    Logout
                                </v-list-item-title>
                            </template>
                            <v-card>
                                <v-card-title class="headline">Log Out?</v-card-title>
                                <v-card-text>Are you sure you want to log out?</v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="red darken-1 white--text" text @click="logOutDialog = false">No</v-btn>
                                    <v-btn color="green darken-1 white--text" text @click="logout">Yes</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>

                    </v-list-item-content>
                </v-list-item>
                <v-list-item ripple link v-else to="/login">
                    <v-list-item-action>
                        <v-icon>mdi-login</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Login</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

        </v-navigation-drawer>

        <v-app-bar
            app
            clipped-left
            :color="themeColor"
            class="elevation-19"
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Furthered</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn ripple link v-if="isLogged" to="/my/account">{{ user.user.name }}</v-btn>
            <v-btn v-else ripple link to="/login">Login</v-btn>
        </v-app-bar>

        <v-main>
            <v-container
            >
                <v-row align="start" dense
                >
                    <v-col class="mx-lg-6 my-lg-6 mx-sm-0 mx-sm-0">
                        <keep-alive>
                            <v-scroll-x-transition mode="out-in">
                                <router-view></router-view>
                            </v-scroll-x-transition>
                        </keep-alive>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import { mapGetters } from 'vuex'
import store from '../store'
import AdminMenu from "./Admin/AdminMenu";

export default {
    name: "Vapp",
    components: {
      AdminMenu
    },
    data: () => ({
        drawer: true,
        items: [
            { title: 'Home', icon: 'mdi-home', link: { path: '/home' }, gate: false },
            { title: 'My Products', icon: 'mdi-format-list-text', link: { path: '/my/products' }, gate: true },
        ],
        mini: true,
        themeColor: 'blue-grey text-light darken-2',
        logOutDialog: false
    }),
    computed: {
        ...mapGetters([
            'isLogged'
        ]),
        user() {
            return this.$store.state.user || {};
        }
    },
    watch: {
    },
    methods: {
        logout () {
            this.$store.dispatch('logout')
        },
    },
    mounted() {
        this.$vuetify.theme.dark = true;

    },
};
</script>
