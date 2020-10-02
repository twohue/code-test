<template>
    <v-list-group
        :value="false"
        no-action
        sub-group
        v-if="isAdmin"
    >
        <template v-slot:activator>
            <v-list-item-content>
                <v-list-item-title>Admin</v-list-item-title>
            </v-list-item-content>
        </template>

        <v-list-item
            v-for="([title, icon, link], i) in admins"
            :key="i"
            link
            :to="link"
        >
            <v-list-item-title v-text="title"></v-list-item-title>
            <v-list-item-icon>
                <v-icon v-text="icon"></v-icon>
            </v-list-item-icon>
        </v-list-item>
    </v-list-group>

</template>

<script>
import store from '../../store';

export default {
    name: "AdminMenu",
    data() {
        return {
            admins: [
                ['Product Management', 'mdi-package-variant', '/admin/products']
            ]
        }
    },
    methods: {},
    computed: {
        isLogged() {
            return (typeof(this.$store.state.user.user) === 'object');
        },
        isAdmin() {
            if(this.isLogged) {
                return this.$store.state.user.user.role_names.includes('Admin');
            }
        }
    },
    filters: {},
    watch: {},
    created() {
    }
}
</script>

<style scoped>

</style>
