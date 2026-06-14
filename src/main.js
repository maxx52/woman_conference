import { createApp } from 'vue'
import { createVuetify } from 'vuetify'

import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import './styles/main.scss'

import App from './App.vue'

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
