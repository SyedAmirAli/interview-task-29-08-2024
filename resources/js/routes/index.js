import {
    createMemoryHistory,
    createRouter,
    createWebHistory,
} from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: () => import("@/pages/Home.vue"),
        },
        {
            path: "/category",
            component: () => import("@/pages/Category.vue"),
        },
        {
            path: "/products",
            component: () => import("@/pages/Product.vue"),
        },
    ],
});

export default router;
