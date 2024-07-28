<!-- resources/js/components/InsertIpAddress.vue -->
<template>
    <div class="container mt-5">
        <h1 class="mb-4">Insert IP Address</h1>
        <form @submit.prevent="insertIp" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="ip_address" class="form-label">IP Address</label>
                <input v-model="ip_address" type="text" class="form-control" id="ip_address" placeholder="Enter IP Address" required>
                <div class="invalid-feedback">
                    Please provide a valid IP address.
                </div>
            </div>
            <div class="mb-3">
                <label for="label" class="form-label">Label</label>
                <input v-model="label" type="text" class="form-control" id="label" placeholder="Enter Label" required>
                <div class="invalid-feedback">
                    Please provide a label.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Insert</button>
        </form>

        <div v-if="successMessage" class="alert alert-success mt-3" role="alert">
            {{ successMessage }}
        </div>
        <div v-if="errorMessage" class="alert alert-danger mt-3" role="alert">
            {{ errorMessage }}
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            ip_address: '',
            label: '',
            successMessage: '',
            errorMessage: ''
        };
    },
    methods: {
        async insertIp() {
            try {
                await axios.post('/api/ip-addresses', {
                    ip_address: this.ip_address,
                    label: this.label
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                });
                this.successMessage = 'IP Address inserted successfully';
                this.errorMessage = '';
                this.ip_address = '';
                this.label = '';
            } catch (error) {
                this.successMessage = '';
                this.errorMessage = 'Failed to insert IP address';
            }
        }
    }
};
</script>

<style>
.container {
    max-width: 600px;
}
</style>
