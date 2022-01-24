<template>
  <div class="container">
    <div class="check-lists" v-if="CheckLists">
      <ul>
        <li v-for="checkList in CheckLists" :key="checkList.id">
          <div id="check-list">
            <p><b>{{ checkList.title }}</b></p>
            <p>{{ checkList.description }}</p>
          </div>
        </li>
      </ul>
    </div>
    <div v-else>No check lists</div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "CheckList",
  components: {},
  data() {
    return {
      checkList: {
        title: "",
        description: "",
      },
    };
  },
  created: function() {
    // a function to call getposts action
    this.GetCheckLists()
  },
  computed: {
    ...mapGetters({ Posts: "StatePosts", User: "StateUser" }),
  },
};
</script>
<style scoped>
* {
  box-sizing: border-box;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

button[type="submit"] {
  background-color: #4caf50;
  color: white;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 30px;
  margin: 10px;
}

button[type="submit"]:hover {
  background-color: #45a049;
}

input {
  width: 60%;
  margin: 15px;
  border: 0;
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
  padding: 10px;
  border-radius: 30px;
}
ul {
  list-style: none;
}

#check-list {
  border: 3px solid #000;
  width: 500px;
  margin: auto;
  margin-bottom: 5px;
}
</style>
