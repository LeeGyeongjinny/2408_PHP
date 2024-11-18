<template>
  <!-- 조건부 랜더링 -->
  <!-- v-if -->
  <h1 v-if="cnt === 7">럭키비키쟈나★</h1>
  <h1 v-else-if="cnt >= 5">5이상입니다.</h1>
  <h1 v-else-if="cnt < 0 ">음수입니다.</h1>
  <h1 v-else>나머지</h1>  

  <!-- v-show -->
  <h1 v-show="flgShow">브이 쇼</h1>
  <button @click="flgShow = !flgShow">브이쇼 토글</button>
  <!-- <h1 v-show="flgShow" :class="ageBlue">브이 쇼</h1> -->
  <!-- <button @click="flgShow = !flgShow">브이쇼 토글</button> -->

  <h1>{{ cnt }}</h1>
  <button @click="addCnt">증가</button>
  <button @click="disCnt">감소</button>
  <hr>
  <h2>이름 : {{ userInfo.name }}</h2>
  <h2 :class="ageBlue">나이 : {{ userInfo.age }}</h2>
  <h2>성별 : {{ userInfo.gender }}</h2>
  <button @click="changeName">이름 변경</button>
  <button @click="changeAgeBlue">나이를 파란색으로</button>
  <hr>
  <input type="text" v-model="transgender">
  <button @click="userInfo.gender = transgender">성별 변경</button>
  <p>{{ transgender }}</p>

  <!-- 리스트 랜더링 -->
  <!-- v-for -->
  <!-- 단순 반복 -->
  <div v-for="val in 5" :key="val">
    <p>{{ val }}</p>
  </div>

  <!-- 구구단 (실습) -->
  <!-- <div v-for="val in 8" :key="val">
    <h2>*****⚡ {{ val+1 }}단 ⚡*****</h2>
    <div v-for="num in 9" :key="num">
      <p>{{ (val + 1) + 'x' + num + '=' + ((val + 1) * num) }}</p>
    </div>
  </div> -->
  <!-- 수업 (백틱 활용) -->
  <!-- <div v-for="dan in 9" :key="dan">
    <span>***** {{ `${dan} 단` }} *****</span>
    <div v-for="val in 9" :key="val">
      <p>{{ `${dan} * ${val} = ${(dan * val)}` }}</p>
    </div>
  </div> -->

  <!-- 배열 루프 -->
  <!-- <div v-for="item in data" :key="item">
    <p>{{ `${item.name} - ${item.age} - ${item.gender}` }}</p>
  </div> -->

  <!-- key, val 둘 다 사용할 경우 -->
  <div v-for="(item, key) in data" :key="item">
    <p>{{ `${key}번째 ${item.name} - ${item.age} - ${item.gender}` }}</p>
  </div>
  <!-- <button @click="data.pop">둘리 삭제</button> -->
  <hr>

  <!-- 자식 컴포넌트 호출 -->
  <BoardComponent />
</template>

<!-- -------------------------------------------------------- -->

<script setup>
import BoardComponent from './components/BoardComponent.vue';
import { reactive, ref } from 'vue';

// ------- ref -------
const cnt = ref(0);

function addCnt() {
  cnt.value++;
}

function disCnt() {
  cnt.value--;
}

// ------- reactive -------
// const name = ref('홍길동');
const userInfo = reactive({
  name: '홍길동'
  ,age: 20
  ,gender: 'undefined'
});

function changeName() {
  userInfo.name = '갑순이';
}

// ------- 태그의 속성값 데이터바인딩 -------
const ageBlue = ref('');

function changeAgeBlue() {
  ageBlue.value = 'blue';
}

// ------- 양방향 데이터바인딩 -------
const transgender = ref('');

// ------- v-show -------
const flgShow = ref(true);

// ------- 불법사이트 setInterval -------
// (() => {
//     setInterval(() => {
//         flgShow.value = !flgShow.value;
//     }, 500);
// })();

// (() => {
//     setInterval(() => {
//         if(!flgShow.value){
//           ageBlue.value = 'red';
//         } else {
//           ageBlue.value = 'blue';
//         }
//     }, 500);
// })();

// ------- data loop -------
const data = reactive([
  {name: '홍길동', age: 20, gender: '남자'}
  ,{name: '김영희', age: 12, gender: '여자'}
  ,{name: '둘리', age: 41, gender: '수컷'}
]);

</script>

<!-- -------------------------------------------------------- -->

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.blue {
  color: #0000ff;
}
.red {
  color: #ff0000;
}
</style>
