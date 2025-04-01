<template>
  <div>
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link v-if="isAdmin" to="/admin/home">Admin</router-link>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
import { useUserStore } from "./store";
import { computed, onMounted } from "vue";

export default {
  setup() {
    const userStore = useUserStore();

    // คำนวณว่า user เป็น admin หรือไม่
    const isAdmin = computed(() => {
      return userStore.user && [1, 6].includes(userStore.user.permission_id);
    });

    // โหลดข้อมูล user ตอนเริ่มต้น
    onMounted(async () => {
      if (!userStore.user) {
        await userStore.fetchUser();
      }
    });

    return { isAdmin };
  },
};
</script>
