<!-- resources/js/components/Login.vue -->
<template>
    <div class="container mt-5">
        <h1 class="mb-4">Login</h1>
        <form @submit.prevent="login" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input v-model="email" type="email" class="form-control" id="email" placeholder="Enter your email" required>
                <div class="invalid-feedback">
                    Please enter a valid email.
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input v-model="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                <div class="invalid-feedback">
                    Please enter your password.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

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
            email: '',
            password: '',
            errorMessage: ''
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post('/api/authenticate', {
                    email: this.email,
                    password: this.password
                });
                localStorage.setItem('token', response.data.access_token);
                this.$router.push('/admin');
            } catch (error) {
                this.errorMessage = 'Invalid credentials';
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
