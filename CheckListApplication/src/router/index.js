import Vue from "vue";
import VueRouter from "vue-router";

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
  routes,
});


export default router;
