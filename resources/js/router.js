import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "./views/DashboardLayout.vue";
import CategoryTable from "./components/Dashboard/Categories/CategoryTable.vue";
import ProductTable from "./components/Dashboard/Products/ProductTable.vue";
import ProductDetail from "./components/User/Products/ProductDetails.vue";
import Cart from "./components/User/Products/Cart.vue";
import AuthLayout from "./views/AuthLayout.vue";
import AppLayout from "./views/AppLayout.vue";
import LandingPage from "./views/User/LandingPage.vue";
import LoginForm from "./components/Auth/LoginForm.vue";
import RegisterForm from "./components/Auth/RegisterForm.vue";
const router = createRouter({
    history: createWebHistory(),
    routes: [


        {
            path: "/",
            component: AuthLayout,
            meta:{Auth:false},
            children: [
                {
                    name: "login",
                    path: "/login",
                    component: LoginForm,
                    alias: "/",
                },
                {
                    name: "register",
                    path: "/register",
                    component: RegisterForm,
                },
            ],
        },

        {
            name: "app",
            path: "/user",
            meta: { Auth: true },
            component: AppLayout,
            children: [
                { name: "landingPage", path: "app", component: LandingPage },
                {
                    name: "productDetail",
                    path: "product/:id",
                    component: ProductDetail,
                },
                { name: "cart", path: "cart", component: Cart },
            ],
        },

        {
            name: "dashboard",
            path: "/dashboard",
            meta:{Auth:true},
            component: Dashboard,
            children: [
                {
                    name: "categories",
                    path: "categories",
                    component: CategoryTable,
                },
                {
                    name: "products",
                    path: "products",
                    component: ProductTable,
                },
            ],
        },
        {
            path:"/:notFound(.*)",
            redirect:'/login'
        },
    ],
});


router.beforeEach(function(to,from,next){
    const requiresAuth = to.matched.some(record => record.meta.Auth);
    const isAuth = localStorage.getItem('isAuth') === 'true';
    if(requiresAuth && !isAuth)
    {
        next({name:'login'})
    }else
    {
        next()
    }
});

export default router;
