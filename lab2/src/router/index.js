import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/order/:categoryId?',
    name: 'order',
    component: () => import('../views/OrderPage.vue'),
  },
  {
    path: '/customer/:categoryId?',
    name: 'customer',
    component: () => import('../views/CustomerPage.vue'),
  },
  {
    path: '/customer-edit/:id?',
    name: 'CustomerEdit',
    props: route => ({ id: route.params.id }),
    component: () => import('../views/CustomerEdit.vue'),
  },
  {
    path: '/order-edit/:id?',
    name: 'OrderEdit',
    props: route => ({ id: route.params.id }),
    component: () => import('../views/OrderEdit.vue'),
  },

  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: () => import('../views/OrderPage.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
