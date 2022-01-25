<template>
  <div class="container">
    <div class="checkLists" v-if="CheckLists">
      <ul>
        <li v-for="checkList in CheckLists" :key="checkList.id">
          <div id="checkList-div">
            <p><b>{{ checkList[1] }}</b></p>
            <button @click ="showDetail(checkList[0])">+</button>
            <p>{{ checkList[2] }}</p>

            <transition name="fade">
              <div v-if="checkListDetailsShow[checkList[0]]">
                <div v-for="detail in checkListDetails[checkList[0]]"  v-bind:key="detail[0]">
                  <p><b>{{ detail[1] }}</b></p>
                  <p>{{ detail[2] }}</p>
                </div>
              </div>
            </transition>
          </div>
        </li>
      </ul>
    </div>
    <div v-else>No check lists</div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "CheckLists",
  components: {},
  created: function() {
    this.resetCheckLists();
    this.loadCheckLists();
  },
  computed: {
    ...mapGetters({ 
      CheckLists: "StateCheckLists", 
      User: "StateUser",
      checkListDetails: "checkListDetails",
      checkListDetailsShow: "checkListDetailsShow", 
    }),
  },
  methods: {
    ...mapActions([
      "resetCheckLists", 
      "loadCheckLists",
      "setCheckListDetail",
      "closeCheckListPoints",
     ]),
     async showDetail(checkListId) {
      try {
        const showList = this.$store.state.auth.checkListDetailsShow;
        
        if (showList === {}) {
          await this.closeCheckListPoints(checkListId);
        } else {
          if (showList[checkListId]) {
            await this.closeCheckListPoints(checkListId);
          }
          await this.setCheckListDetail(checkListId);
        }
         
        await this.$forceUpdate();
      } catch (error) {
        console.log(error);
      }
    },
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

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
  opacity: 0;
}
</style>
