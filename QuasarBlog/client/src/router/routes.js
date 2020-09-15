
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: 'login', component: () => import('pages/Login.vue'), name: 'login' },
      { path: 'register', component: () => import('pages/Register.vue'), name: 'register' },
      { path: 'logout', component: () => import('pages/Logout.vue'), name: 'logout' }
    ]
  },
  {
    path: '/admin/',
    component: () => import('layouts/AdminLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Dashboard.vue'), name: 'dashboard' },
      { path: 'add', component: () => import('pages/AddPost.vue'), name: 'add' },
      { path: 'users', component: () => import('pages/Users.vue'), name: 'users' },
      { path: 'posts/:id/edit/:userId', component: () => import('pages/EditPost.vue'), name: 'editPost' },
      { path: 'user/:id', component: () => import('pages/EditProfile.vue'), name: 'editProfile' },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
