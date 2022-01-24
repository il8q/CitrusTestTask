import axios from "axios";
//import sprintf from "sprintf-js";

const state = {
  user: null,
  checkLists: null,
};

const getters = {
  isAuthenticated: (state) => !!state.user,
  StatePosts: (state) => state.posts,
  StateUser: (state) => state.user,
};

const actions = {
  async Register({dispatch}, form) {
    await axios.post('register', form)
    let UserForm = new FormData()
    UserForm.append('email', form.email)
    UserForm.append('password', form.password)
    await dispatch('LogIn', UserForm)
  },

  async LogIn({commit}, user) {
    let response = await axios.post('autorizate', 
      {
        email: user.get("email"),
        password: user.get("password")
      });
    if (response.data['command'] === "transfer to main page")
    {
      await commit("autorizate", user.get("email"));
    }
  },

  async GetCheckLists({ commit }) {
    let response = await axios.get("get-check-lists");
    commit("setCheckLists", response.data);
  },

  async LogOut({ commit }) {
    let user = null;
    commit("logout", user);
  },
};

const mutations = {
  autorizate(state, email) {
    state.user = email;
  },
  setCheckLists(state, lists) {
    state.checkLists = lists;
  },
  logout(state, user) {
    state.user = user;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
