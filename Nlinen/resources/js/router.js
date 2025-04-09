import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from './store';
import Home from './pages/Home.vue';
import AboutHome from './pages/About.vue';
import AdminHome from './pages/AdminHome.vue';
import NotFound from './pages/NotFound.vue';
import LaundryCreate from './pages/LaundryCreate.vue';
import LaundryGetDirty from './pages/LaundryGetDirty.vue';
import LaundryGetClean from './pages/LaundryGetClean.vue';
import LaundryGetStock from './pages/LaundryGetStock.vue';
import LaundryClaimLaundry from './pages/LaundryClaimLaundry.vue';
import LaundryClaimHospital from './pages/LaundryClaimHospital.vue';

const routes = [
    { path: '/', component: Home, meta: { title: 'หน้าแรก' } },
    { path: '/about', component: AboutHome },
    { path: '/home', component: Home },

    // ============= General =============
    { path: '/general/laundry-create', component: LaundryCreate, meta: { title: 'บันทึกผ้าใหม่ส่งซัก' } },
    { path: '/general/laundry-get-dirty', component: LaundryGetDirty, meta: { title: 'บันทึกรับผ้าสกปก' } },
    { path: '/general/laundry-get-clean', component: LaundryGetClean, meta: { title: 'บันทึกรับผ้าสะอาด' } },
    { path: '/general/laundry-get-stock', component: LaundryGetStock, meta: { title: 'บันทึกรับเข้าสต๊อก' } },
    { path: '/general/laundry-claim-laundry', component: LaundryClaimLaundry, meta: { title: 'บันทึกส่งเครมโรงซัก (โรงซัก)' } },
    { path: '/general/laundry-claim-hospital', component: LaundryClaimHospital, meta: { title: 'บันทึกส่งเครมโรงพยาบาล (โรงพยาบาล)' } },

    {
        path: '/admin/home',
        component: AdminHome,
        meta: { requiresAuth: true, allowedRoles: [1, 6] }
    },
    { path: '/:pathMatch(.*)*', component: NotFound }
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
    let pageTitle = to.meta.title || 'หน้าเว็บของเรา';

    document.title = `${pageTitle}`;

    next();
});

export default router;
