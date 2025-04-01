import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import AboutHome from './components/About.vue';
import AdminHome from './components/AdminHome.vue';
import NotFound from './components/NotFound.vue';
import { useUserStore } from './store';

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: AboutHome },

    {
        path: '/admin/home',
        component: AdminHome,
        meta: { requiresAuth: true, allowedRoles: [1, 6] }
    },
    { path: '/:pathMatch(.*)*', component: NotFound } // จับเส้นทางที่ไม่มี
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const userStore = useUserStore();

    if (!userStore.user) {
        await userStore.fetchUser();
    }

    if (to.meta.requiresAuth && (!userStore.user || !to.meta.allowedRoles.includes(userStore.user.permission_id))) {
        return next('/'); // Redirect ถ้าไม่มีสิทธิ์
    }

    next();
});

export default router;
