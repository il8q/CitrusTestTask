import Vue from "vue";
import VueRouter from "vue-router";
import store from "../store";

import Register from "../views/Register";
import Login from "../views/Login";
import CheckLists from "../views/CheckLists";

Vue.use(VueRouter);

const routes = [
  {
    path: "/register",
    name: "Register",
    component: Register,
    meta: { guest: true },
  },
  {
    path: "/",
    name: "Login",
    component: Login,
    meta: { guest: true },
  },
  {
    path: "/main",
    name: "Main page",
    component: CheckLists,
    meta: { requiresAuth: true },
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

// TODO вынести в отдельный класс
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (store.getters.isAuthenticated) {
      next();
      return;
    }
    next("/");
  } else {
    next();
  }
});
// TODO вынести в отдельный класс
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.guest)) {
    if (store.getters.isAuthenticated) {
      next("/main");
      return;
    }
    next();
  } else {
    next();
  }
});

export default router;
