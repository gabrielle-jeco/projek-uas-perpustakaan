import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import MyHome from '@/views/MyHome.vue'
import BukuView from '@/views/BukuView.vue'
import CariBukuView from '@/views/CariBukuView.vue'
import DeleteBukuView from '@/views/DeleteBukuView.vue'
import StoreBuku from '@/views/StoreBuku.vue'
import EditBuku from '@/views/EditBuku.vue'
import TestView from '@/views/TestView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/home',
      name: 'home',
      component: MyHome
    },
    {
      path: '/viewall',
      name: 'viewall',
      component: BukuView
    },
    {
      path: '/caribuku',
      name: 'caribuku',
      component: CariBukuView
    },
    {
      path: '/hapusbuku',
      name: 'hapusbuku',
      component: DeleteBukuView
    },
    {
      path: '/storebuku',
      name: 'storebuku',
      component: StoreBuku
    },
    {
      path: '/editbuku',
      name: 'editbuku',
      component: EditBuku
    },
    {
      path: '/test',
      name: 'test',
      component: TestView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    }
  ]
})

export default router
