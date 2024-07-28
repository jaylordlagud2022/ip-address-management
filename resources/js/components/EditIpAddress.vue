<!-- resources/js/components/EditIpAddress.vue -->
<template>
    <div class="container mt-5">
        <h1 class="mb-4">Edit IP Address</h1>
        <form @submit.prevent="updateIp" class="needs-validation" novalidate>
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
            <button type="submit" class="btn btn-primary" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Update
            </button>
            <router-link to="/admin" class="btn btn-secondary ml-2">Back</router-link>
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
            errorMessage: '',
            loading: false
        };
    },
    methods: {
        async fetchIpDetails() {
            this.loading = true;
            try {
                const response = await axios.get(`/api/ip-addresses/get/${this.$route.params.id}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                });
                this.ip_address = response.data.ip_address;
                this.label = response.data.label;
            } catch (error) {
                this.errorMessage = 'Failed to fetch IP address details';
            } finally {
                this.loading = false;
            }
        },
        async updateIp() {
            this.loading = true;
            this.successMessage = '';
            this.errorMessage = '';
            try {
                await axios.put(`/api/ip-addresses/get/${this.$route.params.id}`, {
                    ip_address: this.ip_address,
                    label: this.label
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                });
                this.successMessage = 'IP Address updated successfully';
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errorMessage = error.response.data.ip_address[0];
                } else {
                    this.errorMessage = 'Failed to update IP address';
                }
            } finally {
                this.loading = false;
            }
        }
    },
    created() {
        this.fetchIpDetails();
    }
};
</script>

<style>
.container {
    max-width: 600px;
}
.spinner-border {
    margin-right: 0.5em;
}
.ml-2 {
    margin-left: 0.5rem;
}
</style>
