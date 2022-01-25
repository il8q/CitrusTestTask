import axios from "axios";

const state = {
  user: null,
  checkLists: null,
  checkListDetails: {},
  checkListDetailsShow: {},
};

const getters = {
  isAuthenticated: (state) => !!state.user,
  StateCheckLists: (state) => state.checkLists,
  StateUser: (state) => state.user,
  checkListDetails: (state) => state.checkListDetails,
  checkListDetailsShow: (state) => state.checkListDetailsShow,
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
  async loadCheckLists({ commit }) {
    let response = await axios.get("get-check-lists");
    commit("setCheckLists", response.data);
  },
  async resetCheckLists({ commit }) {
    commit("resetCheckLists");
  },
  async closeCheckListPoints({ commit }, id) {
    commit("closeCheckListPoints", id);
  },
  async setCheckListDetail({ commit }, id) {
    let response = await axios.get("get-points?check-list-id=" + id);
    commit("setCheckListDetail", {id: id, details: response.data});
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
  resetCheckLists(state) {
    state.checkLists = null;
    state.checkListDetails = {};
    state.checkListDetailsShow = {};
  },
  setCheckListDetail(state, data) {
    state.checkListDetails[data.id]=  data.details;
    state.checkListDetailsShow[data.id] = true;
  },
  closeCheckListPoints(state, checkListId) {
    state.checkListDetailsShow[checkListId] = false;
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
