import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import Notifications  from '@kyvg/vue3-notification'
import router from './router/router'

const app = createApp(App)

app.use(createPinia())
app.use(Notifications)
app.use(router);
app.mount('#app')
