<template>

    <div class="card">
        <div class="card-header">Two-Factor Authentication (2FA)</div>
        <div class="card-body">
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

            <!-- ถ้า Two-Factor Authentication ยังไม่ถูกเปิดใช้งาน -->
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

</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
    data() {
        return {
            user: {
                two_factor_secret: null,
                two_factor_qr_code: null,
                two_factor_recovery_codes: []
            },
            isTwoFactorEnabled: false,
        };
    },
    created() {
        this.getUserData();
    },
    methods: {
        async getUserData() {
            try {
                // ดึงข้อมูลผู้ใช้ที่มีการตั้งค่า Two-Factor Authentication
                const response = await axios.get('/user');
                this.user = response.data;
                this.isTwoFactorEnabled = this.user.two_factor_secret !== null;
            } catch (error) {
                console.error(error);
            }
        },

        async enableTwoFactor() {
            try {
                // ส่งคำขอเปิดการใช้งาน Two-Factor Authentication
                const response = await axios.post('/two-factor/enable');
                this.user.two_factor_secret = response.data.two_factor_secret;
                this.user.two_factor_qr_code = response.data.qr_code;
                this.user.two_factor_recovery_codes = response.data.recovery_codes;
                this.isTwoFactorEnabled = true;
            } catch (error) {
                console.error(error);
            }
        },

        async disableTwoFactor() {
            try {
                // ส่งคำขอปิดการใช้งาน Two-Factor Authentication
                const response = await axios.delete('/two-factor/disable');
                this.user.two_factor_secret = null;
                this.user.two_factor_qr_code = null;
                this.user.two_factor_recovery_codes = [];
                this.isTwoFactorEnabled = false;
            } catch (error) {
                console.error(error);
            }
        },

        toggleTwoFactor() {
            if (this.isTwoFactorEnabled) {
                this.enableTwoFactor();
            } else {
                this.disableTwoFactor();
            }
        },
    }
};
</script>
