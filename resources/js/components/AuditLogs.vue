<!-- resources/js/components/AuditLogs.vue -->
<template>
    <div class="container mt-5">
        <h1 class="mb-4">Audit Logs</h1>
        <div v-if="loading" class="spinner-border text-primary" role="status"></div>
        <table v-else class="table table-striped">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="log in auditLogs" :key="log.id">
                    <td>{{ log.description }}</td>
                    <td>{{ log.created_at }}</td>
                </tr>
            </tbody>
        </table>
        <router-link to="/admin" class="btn btn-secondary mt-3">Back to Dashboard</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            auditLogs: [],
            loading: true
        };
    },
    methods: {
        async fetchAuditLogs() {
            try {
                const response = await axios.get('/api/audit-logs', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                });
                this.auditLogs = response.data.data;
                this.loading = false;
            } catch (error) {
                console.error('Failed to fetch audit logs:', error);
                this.loading = false;
            }
        }
    },
    created() {
        this.fetchAuditLogs();
    }
};
</script>

<style>
.container {
    max-width: 900px;
}
.spinner-border {
    margin-right: 0.5em;
}
</style>
