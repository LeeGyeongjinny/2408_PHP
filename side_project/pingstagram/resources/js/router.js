import { createWebHistory, createRouter } from 'vue-router';
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';
import NotFoundComponent from '../views/components/NotFoundComponent.vue';

const routes = [
    {
        path: '/',
        redirect: 'login'
    },
    {
        path: '/login',
        component: LoginComponent,
    },
    {
        path: '/registration',
        component: UserRegistrationComponent,
    },
    {
        path: '/boards',
        component: BoardListComponent,
    },
    {
        path: '/boards/create',
        component: BoardCreateComponent,
    },
    {
        path: '/:catchAll(.*)',
        component: NotFoundComponent,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;