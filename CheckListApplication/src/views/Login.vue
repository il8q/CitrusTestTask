<template>
  <div class="login">
    <div>
      <form @submit.prevent="submit">
        <div class="field-container to-center">
          <div class="field-container m-tb-5">
            <div class="field-name inline-block on-left-side m-r-0" for="email">
              Email:
            </div>
            <li class="inline-block on-right-side">
              <input 
                type="text" 
                name="email"
                v-model="form.email" 
               />
            </li>

          </div>
          <div class="field-container m-tb-5">
            <div class="field-name inline-block on-left-side m-r-0" for="password">Password:</div>
            <div class="inline-block on-right-side">
              <input 
                 type="password" 
                 name="password"
                 v-model="form.password"
               />
            </div>
            
          </div>
        </div>
        
        <button 
          class="m-lr-5" 
          type="submit" 
          @click.prevent="submit"
        >LogIn</button>
        <button 
          class="m-lr-5"
          type="submit"
          @click.prevent="register"
         >Register</button>
      </form>
      <p v-if="showError" id="error">{{ }}</p>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "Login",
  components: {},
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      showError: ""
    };
  },
  methods: {
    ...mapActions(["LogIn"]),
    async submit() {
      const User = new FormData();
      User.append("email", this.form.email);
      User.append("password", this.form.password);
      try {
          await this.LogIn(User);
          this.$router.push("/main");
          this.showError = "";
      } catch (error) {
        this.showError = error.response;
      }
    },
    async register () {
      this.$router.push("/register");
    },
  },
};
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.field-container {
  width: 350px;
}

.field-name {
  padding: 12px 12px 12px 0;
  width: 20%;
}

button[type="submit"] {
  background-color: #bfbfbf;
  color: #0e0e0e;
  padding: 6px 20px;
  cursor: pointer;
  border-radius: 30px;
  font-weight : bold ;
}

button[type="submit"]:hover {
  background-color: #45a049;
}

.on-left-side {
  text-align: left;
}

.on-right-side {
  text-align: right;
}

.to-center {
    margin-left: auto;
    margin-right: auto;
}

.m-lr-5 {
  margin-left: 5px;
  margin-right: 5px;
}

.m-tb-5 {
  margin-top: 5px;
  margin-bottom: 5px;
}

.m-r-0 {
  margin-right: 0px;
}

input {
  margin: 5px;
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
  padding: 10px;
  border-radius: 5px;
}

.inline-block{
  display: inline-block;
}
#error {
  color: red;
}
</style>
