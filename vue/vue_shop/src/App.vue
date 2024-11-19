<template>
  <img alt="Vue logo" src="./assets/logo.png">
  <!-- <h1>{{ count }}</h1> -->
  <!-- <button @click="store.commit('board/addCount')">증가</button> -->

  <BoardListComponent />

</template>

<script setup>
import BoardListComponent from './components/BoardListComponent.vue';
// import { computed } from 'vue';
// import { useStore } from 'vuex';

// const store = useStore();

// 반응형 데이터로 다루기 위해 computed 이용
// const count = computed(() => store.state.board.count);

</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.red {
  color: #f00;
}
</style>
