import 'bootstrap/dist/css/bootstrap.css';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import Login from './components/Login.vue';
import AdminDashboard from './components/AdminDashboard.vue';
import InsertIpAddress from './components/InsertIpAddress.vue';

const routes = [
    { path: '/login', component: Login },
    { path: '/admin', component: AdminDashboard },
    { path: '/insert-ip', component: InsertIpAddress },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount('#app');
