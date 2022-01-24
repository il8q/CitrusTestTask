import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/';
axios.defaults.headers.common['Content-Type'] ='application/json;charset=utf-8';
axios.defaults.headers.common['Access-Control-Allow-Headers'] = 'Access-Control-Allow-Headers, access-control-allow-origin';
axios.defaults.withCredentials = false;
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
};

axios.interceptors.response.use(undefined, function(error) {
  if (error) {
    const originalRequest = error.config;
     if ((error.response.status === 401) && (!originalRequest._retry)) {
      originalRequest._retry = true;
      store.dispatch("LogOut");
      return router.push("/");
     }
  }
});


new Vue({
  store,
  router,
  render: (h) => h(App),
}).$mount("#app");
