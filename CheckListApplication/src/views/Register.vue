<template>
  <div class="register">
    <div>
      <form @submit.prevent="submit">
        <p v-if="showError" id="error">Username already exists</p>
        <div class="field-container to-center m-tb-5">
          <div class="field-name inline-block on-left-side m-r-0" for="email">
              Email:
            </div>
            <div class="inline-block on-right-side">
              <input 
                type="text" 
                name="email"
                v-model="form.email" 
               />
            </div>
        </div>
        <div class="field-container to-center m-tb-5">
           <div class="field-name inline-block on-left-side m-r-0" for="password">
              Password:
            </div>
            <div class="inline-block on-right-side">
              <input 
                 type="password" 
                 name="password"
                 v-model="form.password"
               />
            </div>
          </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "Register",
  components: {},
  data() {
    return {
      form: {
        username: "",
        password: "",
      },
      showError: false
    };
  },
  methods: {
    ...mapActions(["Register"]),
    async submit() {
      try {
        await this.Register(this.form);
        this.$router.push("/main");
        this.showError = false
      } catch (error) {
        this.showError = true
      }
    },
  },
};
</script>
<style scoped>
* {
  box-sizing: border-box;
}

.field-container {
  width: 400px;
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
