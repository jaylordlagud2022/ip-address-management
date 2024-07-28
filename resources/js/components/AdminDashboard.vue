<!-- resources/js/components/AdminDashboard.vue -->
<template>
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>
        <div class="d-flex justify-content-between mb-4">
            <router-link to="/insert-ip" class="btn btn-primary">Insert IP Address</router-link>
            <button @click="logout" class="btn btn-danger">Logout</button>
        </div>

        <h2>IP Addresses</h2>
        <div v-if="loading" class="spinner-border text-primary" role="status">
        </div>
        <table v-else class="table table-striped">
            <thead>
                <tr>
                    <th>Label</th>
                    <th>IP Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ip in ipAddresses" :key="ip.id">
                    <td>{{ ip.label }}</td>
                    <td>{{ ip.ip_address }}</td>
                    <td>
                        <router-link :to="{ name: 'edit-ip', params: { id: ip.id } }" class="btn btn-sm btn-warning">Edit</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            ipAddresses: [],
            loading: true
        };
    },
    methods: {
        async fetchIpAddresses() {
            try {
                const response = await axios.get('/api/ip-addresses/list', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                });
                this.ipAddresses = response.data.data;
                this.loading = false;
            } catch (error) {
                console.error('Failed to fetch IP addresses:', error);
                this.loading = false;
            }
        },
        async logout() {
            await axios.post('/api/logout', {}, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            localStorage.removeItem('token');
            this.$router.push('/login');
        }
    },
    created() {
        this.fetchIpAddresses();
    }
};
</script>

<style>
.container {
    max-width: 900px;
}
</style>
