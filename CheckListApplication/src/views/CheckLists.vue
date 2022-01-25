<template>
  <div class="container">
    <div class="check-lists li-without-points" v-if="CheckLists">
      
        <li v-for="checkList in CheckLists" :key="checkList.id">
          <div id="check-list">
          <ul class="li-without-points p-l-0">
            <li>
              <div class="check-list_title element-margin"><b>{{ checkList[1] }}</b></div>
              <div class="check-list_discription element-margin" v-html="checkList[2]"></div>
            </li>
            <li class="detail-button-container">
              <button
                class="detail-button"
                @click.prevent ="showDetail(checkList[0])">
                +
              </button>
            </li>
          </ul>
            
            
            <transition name="fade">
              <div v-if="checkListDetailsShow[checkList[0]]">
                <div v-for="detail in checkListDetails[checkList[0]]"  v-bind:key="detail[0]">
                  <div class="point_title detail-element element-margin"><b>{{ detail[1] }}</b></div>
                  <div class="point_description detail-element element-margin" v-html="detail[2]"></div>
                </div>
              </div>
            </transition>
          </div>
        </li>
      
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

.li-without-points {
  list-style: none;
}

.element-margin {
  margin-top: 5px;
  margin-bottom: 5px;
}

.p-l-0 {
  padding-left: 0px;
}

#check-list {
  width: 50%;
  min-width: 300px;
  margin: auto;
  margin-bottom: 5px;
  border-radius: 30px;
  background-color: #0e0a0e29;
  padding: 5px;
}

.detail-button-container {
  text-align: right;
  width: 50px;
  margin-left: auto;
  margin-right: 5px;
}

.detail-button {
  margin-left: 5px;
  margin-right: 5px;
}

.detail-element {
  text-align: left;
  padding-left: 10px;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
  opacity: 0;
}
</style>
