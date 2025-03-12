import Login from '@/pages/Login.vue'
import Register from '@/pages/Register.vue'
import ListUsers from '@/pages/ListUsers.vue'
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    { path:'/login', component: Login },
    { path:'/register', component: Register },
    { path: '/listar', component: ListUsers}
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;