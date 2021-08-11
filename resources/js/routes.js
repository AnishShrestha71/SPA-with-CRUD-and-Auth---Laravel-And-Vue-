import Home from "./components/Home.vue";
import About from "./components/About.vue";
import Notfound from "./components/Notfound.vue";
import Register from "./components/register.vue";
import Login from "./components/login.vue";
import Dashboard from "./components/dashboard.vue";

export default {
    mode: "history",
    linkActiveClass: "text-blue-400",
    routes: [
        {
            path: "/",
            component: Home,
            name: "home"
        },
        {
            path: "/about",
            component: About
        },
        {
            path: "*",
            component: Notfound
        },
        {
            path: "/register",
            component: Register
        },
        {
            path: "/login",
            component: Login,
            name: "Login"
        },
        {
            path: "/dashboard",
            component: Dashboard,
            name: 'Dashboard',
            beforeEnter: (to, form, next) =>{
                axios.get('/api/athenticated').then(()=>{
                    next()
                }).catch(()=>{
                    return next({ name: 'Login'})
                })
            }
        }
    ]
};
