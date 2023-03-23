

import './bootstrap';
import { createApp } from 'vue';
import router from './router.js'
import store from './store/index.js';

import PrimeVue from 'primevue/config';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast';
import ProgressSpinner from 'primevue/progressspinner';
import InputNumber from 'primevue/inputnumber';

import 'primevue/resources/themes/tailwind-light/theme.css'
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'
import 'primeflex/primeflex.scss'



const app = createApp({});


app.component('InputNumber', InputNumber)
app.component('ProgressSpinner',ProgressSpinner)
app.component('Button', Button);
app.component('InputText', InputText);
app.component('Toast',Toast)


app.use(ToastService);
app.use(router)
app.use(store)
app.use(PrimeVue);
app.mount('#app');
