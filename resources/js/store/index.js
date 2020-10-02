import Vue from 'vue'
import Vuex, { Store } from 'vuex';
import axios from 'axios'


Vue.use(Vuex)

axios.defaults.baseURL = 'http://furthered-code-test.test/api'

export default new Store({
    state: {
        user: null,
        snackbar: {
            state: true,
            text: 'Oh shit'
        },
        theme: {
            baseColor: '#263238FF'
        },
        userProfile: {},
    },

    mutations: {
        setUserData (state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },

        clearUserData () {
            localStorage.removeItem('user')
            location.reload()
        },
    },

    actions: {
        login ({ commit }, credentials) {
            return axios
                .post('/login', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                })
        },

        logout ({ commit }) {
            commit('clearUserData')
        },
    },

    getters : {
        isLogged: state => !!state.user
    }
})
