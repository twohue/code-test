<template>
    <v-row>
        <v-col lg="4" offset-lg="4">
            <v-card class="elevation-12">
                <form action="#" @submit.prevent="login">
                    <v-toolbar
                        color="blue-grey darken-2"
                        dark
                        flat
                    >
                        <v-toolbar-title>Furthered Account Login</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form lazy-validation>
                            <v-text-field
                                label="Email"
                                name="email"
                                prepend-icon="mdi-account"
                                type="text"
                                v-model="email"
                            ></v-text-field>

                            <v-text-field
                                id="password"
                                label="Password"
                                name="password"
                                prepend-icon="mdi-lock"
                                type="password"
                                v-model="password"
                            ></v-text-field>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" type="submit">Login</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login () {
            this.$store
                .dispatch('login', {
                    email: this.email,
                    password: this.password
                })
                .then(() => {
                    this.$router.push({ path: '/home' })
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>
