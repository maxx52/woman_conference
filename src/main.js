import { createApp } from 'vue'
import App from './App.vue'
import { createVuetify } from 'vuetify'

import 'vuetify/styles'
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

createApp(App).use(vuetify).mount('#app')
