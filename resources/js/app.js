/**
 * Load application dependencies
 */

import Vue from 'vue'
import vuetify from './vuetify'
import App from './components/App'
import router from './routes'
import store from './store'
import axios from 'axios'

// Turn off annoying messages
Vue.config.productionTip = false

/**
 * Set up application with dependencies
 * Load user data if stored
 * Ensure logout event is called if user tries to load an unauthenticated page
 */

Vue.component('App', require('./components/App').default);

const app = new Vue({
    vuetify,
    router,
    store,
    created () {
        const userInfo = localStorage.getItem('user')
        if (userInfo) {
            const userData = JSON.parse(userInfo)
            this.$store.commit('setUserData', userData)
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('logout')
                }
                return Promise.reject(error)
            }
        )
    },
    render: h => h(App)
}).$mount('#app')
