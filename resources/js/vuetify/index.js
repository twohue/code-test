// /resources/js/vuetify/index.js

import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import Vue from 'vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

const opts = {}

export default new Vuetify(opts)
