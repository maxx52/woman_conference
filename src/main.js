import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { createVuetify } from 'vuetify'

import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import './styles/main.scss'

const vuetify = createVuetify({
    theme: {
        defaultTheme: 'conferenceTheme',
        themes: {
            conferenceTheme: {
                dark: false,
                colors: {
                    primary: '#080938',
                    secondary: '#042e5e',
                },
            },
        },
    },
})

createApp(App).use(store).use(router).use(vuetify).mount('#app')