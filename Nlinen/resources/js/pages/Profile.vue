<template>
    <div>
        <!-- Profile Update Section -->
        <div class="card">
            <div class="card-header">Edit Profile</div>
            <div class="card-body">
                <div v-if="status === 'profile-information-updated'" class="alert alert-success" role="alert">
                    Your Profile has been Updated.
                </div>

                <form @submit.prevent="updateProfile">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" :class="{ 'is-invalid': errors.name }"
                                v-model="form.name" required autofocus />
                            <span v-if="errors.name" class="invalid-feedback" role="alert">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }"
                                v-model="form.email" required />
                            <span v-if="errors.email" class="invalid-feedback" role="alert">
                                <strong>{{ errors.email[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reset Password Section -->
        <div class="card mt-4">
            <div class="card-header">Reset Password</div>

            <div class="card-body">
                <form @submit.prevent="resetPassword">
                    <div class="row mb-3">
                        <label for="current_password" class="col-md-4 col-form-label text-md-end">Current
                            Password</label>
                        <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control"
                                v-model="passwordForm.current_password" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">New Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" v-model="passwordForm.password"
                                required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm New
                            Password</label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control"
                                v-model="passwordForm.password_confirmation" required />
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Two-Factor Authentication Section -->
        <div class="card mt-4">
            <div class="card-header">Two-Factor Authentication (2FA)</div>
            <div class="card-body">
                <div class="text-center">



                    <!-- ถ้า Two-Factor Authentication ถูกเปิดใช้งาน -->
                    <div v-if="user.two_factor_secret">
                        <!-- ฟอร์มสำหรับปิด Two-Factor Authentication -->
                        <form @submit.prevent="disableTwoFactor">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" v-model="isTwoFactorEnabled"
                                    @change="toggleTwoFactor" checked>
                                <label class="form-check-label">Two-Factor Authentication Available</label>
                            </div>
                        </form>
                        <hr>

                        <h4 class="my-2">QR Code:</h4>
                        <div class="my-2" v-html="user.two_factor_qr_code"></div>

                        <h4>Recovery Codes:</h4>
                        <ul>
                            <li v-for="(code, index) in user.two_factor_recovery_codes" :key="index">{{ code }}</li>
                        </ul>
                    </div>

                    <div v-else>
                        <!-- ฟอร์มสำหรับเปิด Two-Factor Authentication -->
                        <form @submit.prevent="enableTwoFactor">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" v-model="isTwoFactorEnabled"
                                    @change="toggleTwoFactor">
                                <label class="form-check-label">Two-Factor Authentication Not Available</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { useUserStore } from "../store";  // นำเข้า useUserStore จาก Pinia หรือ Vuex store
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        // ใช้งาน store เพื่อดึงข้อมูลผู้ใช้
        const userStore = useUserStore();

        // State Variables
        const form = ref({
            name: userStore.user.name,
            email: userStore.user.email
        });
        const passwordForm = ref({
            current_password: '',
            password: '',
            password_confirmation: ''
        });
        const errors = ref({});
        const status = ref(null);
        const isTwoFactorEnabled = ref(false);

        // Get User Data
        const getUserData = async () => {
            try {
                const response = await axios.get('/user');
                userStore.setUser(response.data); // update user in store
                isTwoFactorEnabled.value = response.data.two_factor_secret !== null;
            } catch (error) {
                console.error(error);
            }
        };

        // Update Profile
        const updateProfile = async () => {
            try {
                const response = await axios.put('/user/profile-information', form.value);
                status.value = 'profile-information-updated';
                errors.value = {};
                userStore.setUser(response.data); // update user in store
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            }
        };

        // Reset Password
        const resetPassword = async () => {
            try {
                await axios.put('/user/password', passwordForm.value);
                alert('Password has been reset successfully.');
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    console.error(error.response.data.errors);
                }
            }
        };

        // Enable Two-Factor Authentication
        const enableTwoFactor = async () => {
            try {
                const response = await axios.post('/two-factor/enable');
                userStore.setUser(response.data); // update user in store
                isTwoFactorEnabled.value = true;
            } catch (error) {
                console.error(error);
            }
        };

        // Disable Two-Factor Authentication
        const disableTwoFactor = async () => {
            try {
                await axios.delete('/two-factor/disable');
                userStore.setUser({ ...userStore.user, two_factor_secret: null }); // update user in store
                isTwoFactorEnabled.value = false;
            } catch (error) {
                console.error(error);
            }
        };

        // Toggle Two-Factor Authentication
        const toggleTwoFactor = () => {
            if (isTwoFactorEnabled.value) {
                enableTwoFactor();
            } else {
                disableTwoFactor();
            }
        };

        // Fetch User Data on Mount
        onMounted(() => {
            getUserData();
        });

        return {
            user: userStore.user,
            form,
            passwordForm,
            errors,
            status,
            isTwoFactorEnabled,
            updateProfile,
            resetPassword,
            enableTwoFactor,
            disableTwoFactor,
            toggleTwoFactor
        };
    }
};
</script>
