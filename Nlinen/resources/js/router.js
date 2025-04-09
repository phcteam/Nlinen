import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from './store';
import Home from './pages/Home.vue';
import AboutHome from './pages/About.vue';
import AdminHome from './pages/AdminHome.vue';
import NotFound from './pages/NotFound.vue';
import Profile from './pages/Profile.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: AboutHome },
    { path: '/home', component: Home },
    { path: '/profile', component: Profile },

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
