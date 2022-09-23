import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue'
import ForgetPassword from './components/auth/ForgetPassword.vue'
import ResetPassword from './components/auth/ResetPassword.vue'
import Home from './components/Dashboard/Home.vue'

// category 
import CategoryList from './components/category/CategoryList.vue';
import AddCategory from './components/category/AddCategory.vue';
import EditCategory from './components/category/EditCategory.vue';

Vue.use(VueRouter)


const routes = [
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/forget-password', component: ForgetPassword, name:'forget-password' },
    { path: '/reset-password/:token', component: ResetPassword, name: 'reset-password' },
    { path: '/', component: Home, name: 'home' },

    // category route
    { path: '/categories', component: CategoryList, name: 'categories' },
    { path: '/categories/create', component: AddCategory, name: 'category_add' },
    { path: '/categories/:id/edit', component: EditCategory, name: 'category_edit' },


];
  

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

export default router;
