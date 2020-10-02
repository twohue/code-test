import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        meta: {
            auth: false
        },
        redirect: '/home'
    },
    {
        path: '/home',
        meta: {
            auth: false
        },
        component: () => import(/* webpackChunkName: "home" */ '../components/Pages/Home')
    },
    {
        path: '/my/products',
        meta: {
            auth: true
        },
        component: () => import(/* webpackChunkName: "products" */ '../components/Pages/MyProducts')
    },
    {
        path: '/product/:id/:slug',
        meta: {
            auth: true
        },
        component: () => import(/* webpackChunkName: "products" */ '../components/Pages/Product')
    },
    {
        path: '/admin/products',
        meta: {
            auth: true
        },
        component: () => import(/* webpackChunkName: "admin" */ '../components/Admin/ProductListings')
    },
    {
        path: '/admin/product/edit/:id/:slug',
        meta: {
            auth: true
        },
        component: () => import(/* webpackChunkName: "admin" */ '../components/Admin/EditProduct')
    },
    {
        path: '/login',
        meta: {
            auth: false
        },
        name: 'Login',
        component: () => import(/* webpackChunkName: "login" */ '../components/auth/LoginForm')
    },
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})


router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/login')
        return
    }
    next()
})
export default router
