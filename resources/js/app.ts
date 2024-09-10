import './bootstrap';
import 'primeicons/primeicons.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';

import App from '@/app.vue'
import router from '@/router/'

const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);
app.use(PrimeVue, {
    ripple: true,
    theme: {
        preset: Aura
    },
    order: 'tailwind-base, primevue, tailwind-utilities'
});


app.mount('#app')