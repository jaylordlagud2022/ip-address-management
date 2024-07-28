import 'bootstrap/dist/css/bootstrap.css';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import Login from './components/Login.vue';
import AdminDashboard from './components/AdminDashboard.vue';
import InsertIpAddress from './components/InsertIpAddress.vue';
import EditIpAddress from './components/EditIpAddress.vue'; // Import the new component

const routes = [
    { path: '/login', component: Login },
    { path: '/admin', component: AdminDashboard },
    { path: '/insert-ip', component: InsertIpAddress },
    { path: '/edit-ip/:id', component: EditIpAddress, name: 'edit-ip' }, // Add the new route
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount('#app');
