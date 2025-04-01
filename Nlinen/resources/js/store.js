import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null, // เก็บข้อมูล user
    }),
    actions: {
        async fetchUser() {
            try {
                const response = await fetch('/api/user'); // ดึงข้อมูล user จาก Laravel API
                this.user = await response.json();
            } catch (error) {
                console.error('Failed to fetch user:', error);
            }
        }
    }
});
