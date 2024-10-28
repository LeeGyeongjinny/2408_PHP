// ----------------------
// 배열
// ----------------------
const ARR1 = [1, 2, 3, 4, 5]; // 이게 일반적
const ARR2 = new Array(1, 2, 3, 4, 5); // 이게 정석이지만 길어서 잘 안씀
// 이거 두개 같다
// ARR1이 이미 Array라는 객체이다
// Array.ARR1.isArray(); // 이건 안됨

// push() -> 이거 밑에 다시
// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length
// ARR1.push(10);

// Array.ARR1.push(10); // 이건 이미 push를 갖고 있기 때문에 부모의 Array까지 갈 필요가 없다


// length

// 배열의 길이 획득
console.log(ARR1.length);


// isArray()

// 배열인지 아닌지 체크
console.log(Array.isArray(ARR1)); // true
console.log(Array.isArray(1)); // false


// indexOf()

// 배열에서 특정 요소를 검색하고, 해당 인덱스를 반환
// let i = ARR1.indexOf(4); // 3 출력
let i = ARR1.indexOf(20); // -1 출력, 해당 요소가 없으면 -1
console.log(i);


// includes()

// 배열의 특정 요소의 존재 여부를 체크, boolean 리턴
let arr1 = ['홍길동', '갑순이', '갑돌이'];
let boo = arr1.includes('갑순이');
console.log(boo);


// push()

// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length
ARR1.push(10);
ARR1.push(20, 30, 50);
// 성능 이슈 발생시, length를 이용해서 직접 요소를 추가할 것
ARR1[ARR1.length] = 100;


// 배열 복사

// 객체는 기본적으로 얕은 복사가 되므로 딥카피를 하기 위해서는 Spread Opeartor를 이용

// 얕은 복사
const COPY_ARR1 = ARR1;
COPY_ARR1.push(9999);

// 깊은 복사
const COPY_ARR2 = [...ARR1];
COPY_ARR2.push(8888);


// pop()

// 원본 배열의 마지막 요소를 제거, 제거된 요소를 반환, 원본 변경
// 제거할 요소가 없으면 undefined를 반환
const ARR_POP = [1, 2, 3, 4, 5];
let result_pop = ARR_POP.pop();
console.log(result_pop);


// unshift()

// 원본 배열의 첫번째 요소를 추가, 변경된 length를 반환, 원본 변경
const ARR_UNSHIFT = [1, 2, 3];
let resultUnshift = ARR_UNSHIFT.unshift(100);
console.log(resultUnshift);
ARR_UNSHIFT.unshift(200, 300, 400); // 여러개도 추가 가능


// shift()

// 원본 배열의 첫번째 요소를 제거, 제거된 요소를 반환, 원본 변경
// 제거할 요소가 없으면 undefined 반환
const ARR_SHIFT = [1, 2, 3, 4];
let resultShift = ARR_SHIFT.shift();
console.log(resultShift);


// splice()

// 요소를 잘라서 자른 배열을 반환, 원본 변경
let arrSplice = [1, 2, 3, 4, 5];
let resultSplice = arrSplice.splice(2);
console.log(resultSplice); // [3, 4, 5] 잘랐다고 보여줌
console.log(arrSplice); // 원본 [1, 2] 남음

// 시작을 음수로 할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(-2);
console.log(resultSplice); // [4, 5] 잘랐다고 보여줌
console.log(arrSplice); // 원본 [1, 2, 3] 남음

// start, count를 모두 셋팅할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(1, 2);
console.log(resultSplice); // [2, 3] 잘랐다고 보여줌
console.log(arrSplice); // 원본 [1, 4, 5] 남음

// 배열의 특정 위치에 새로운 요소를 추가
arrSplice = [1, 2, 3, 4, 5];
// resultSplice = arrSplice.splice(2, 0, 999); // 값 2와 3 사이에 새로운 요소(999)를 추가하고 싶다
resultSplice = arrSplice.splice(2, 0, 999,888); // 값 2와 3 사이에 새로운 요소(999, 888)를 추가하고 싶다
console.log(resultSplice); // [] 잘린게 없음
// console.log(arrSplice); // 원본 [1, 2, 999, 3, 4, 5] 바뀜
console.log(arrSplice); // 원본 [1, 2, 999, 888, 3, 4, 5] 바뀜

// 배열에서 특정 요소를 새로운 요소로 변경
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(2, 1, 999); // 3을 999로 변경
console.log(resultSplice); // [] 잘린게 없음
console.log(arrSplice); // 원본 [1, 2, 999, 4, 5] 바뀜


// join()

// 배열의 요소들을 특정 구분자로 연결한 문자열을 반환
let arrJoin = [1, 2, 3, 4];
let resultJoin = arrJoin.join(', ');
console.log(resultJoin); // 1, 2, 3, 4 반환
console.log(arrJoin); // 원본 그대로


// sort()

// 배열의 요소를 오름차순 정렬
// 파라미터를 전달하지 않을 경우에 문자열로 변환 후 정렬
// let arrSort = [5, 6, 7, 3, 2];
// let resultSort = arrSort.sort();
// console.log(resultSort); // [2, 3, 5, 6, 7] 반환
// console.log(arrSort); // 원본도 정렬됨

let arrSort = [5, 6, 7, 3, 2, 20];
// let resultSort = arrSort.sort();
// console.log(resultSort); // [2, 20, 3, 5, 6, 7] 반환 -> 문자열로 비교하기 때문에 a, ab, b 순으로 정렬
// console.log(arrSort); // 원본도 정렬됨
let resultSort = arrSort.sort((a, b) => a - b); // 오름차순, 숫자를 정렬할 때 콜백함수를 넣어줘야한다
// let resultSort = arrSort.sort((a, b) => b - a); // 내림차순
console.log(resultSort); // [2, 3, 5, 6, 7] 반환
console.log(arrSort); // 원본도 정렬됨


// map()

// 배열의 모든 요소에 대해서 콜백 함수를 반복 실행한 후, 그 결과를 새로운 배열로 반환
let arrMap = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let resultMap = arrMap.map(num => {
  if(num % 3 === 0) {
    return '짝';
  } else {
    return num;
  }
});
console.log(resultMap); // [1, 2, '짝', 4, 5, '짝', 7, 8, '짝', 10]
console.log(arrMap); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]


// -------------------------------------------------------------------- 여기부터
// map의 콜백 로직
const TEST = {
  entity: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
  ,length: 10
  ,map: function (callback) {
    let resultArr = [];

    for(let i = 0; i < this.entity.length; i++){
      resultArr[resultArr.length] = callback(this.entity[i]);
      // resultArr.push(callback(this.entity[i])); // 이건 같은 말
    }
    // 처음 resultArr의 length = 0
    // this.entity[1] : entity 의 첫번쨰
    // 0번째 방에 1번 요소를 넣겠다
    // this.entitiy.length 이 길이(10)까지 돌겠다 = 1 - 9까지 돈다
    return resultArr;
  }
} // 이때 map은 method (key는 아니다?)

// let resultTest = TEST.map(num => {
//   if(num % 3 === 0) {
//     return '짝';
//   } else{
//     return num;
//   }
// });

// 위에랑 같은거 함수 따로 빼서 쓰기
let resultTest = TEST.map(testCallback);

function testCallback(num) {
  if(num % 3 === 0) {
    return '짝';
  } else{
    return num;
  }
}

// console.log(resultTest); // [1, 2, '짝', 4, 5, '짝', 7, 8, '짝', 10]
// -------------------------------------------------------------------- 이까지 한묶음


// ------------------------------------------
// 콜백함수 다시 보자
function myCallback(){
  return 'myCallback';
}

function myCallback2(){
  return 'myCallback2';
}

function test(callback, flg){
  if(flg){
    console.log(callback()); // myCallback 아니고 callback인건 파라미터명이라서
  } else{
    console.log('콜백 실행 안됨');
  }
}
// ------------------------------------------


// filter()

// 배열의 모든 요소에 대해 콜백 함수를 반복하여 실행한 후, 조건에 만족한 요소만 모아 배열로 반환
// 3의 배수만 반환
let arrFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let resultFilter = arrFilter.filter(num => num % 3 === 0);
console.log(resultFilter);

// 3 또는 4의 배수 동시에 반환
let resultFilter2 = arrFilter.filter(num => {
  if(num % 3 === 0 || num % 4 === 0){
    return true;
  } else {
    return false;
  }
});

// 3의 배수, 4의 배수 각각 반환
let resultFilter_3 = arrFilter.filter(num => num % 3 === 0);
let resultFilter_4 = arrFilter.filter(num => num % 4 === 0);


// some()

// 배열의 모든 요소에 대해 콜백함수를 반복 실행하고,
// 조건에 만족하는 결과가 하나라도 있으면 true
// 만족하는 결과가 하나도 없으면 false를 반환
let arrSome = [1, 2, 3, 4, 5];
let resultSome = arrSome.some(num => num === 6);
console.log(resultSome);

// 화살표함수 대신에 일반 함수로 표현하려면 밖에 함수선언을 해줘야한다
// function someTest(num){
//   return num === 6;
// }


// every()

// 배열의 모든 요소에 대해 콜백 함수를 반복 실행하고,
// 조건의 모든 결과가 만족하면 true,
// 하나라도 만족하지 않으면 false
let arrEvery = [1, 2, 3, 4, 5];
let resultEvery = arrEvery.every(num => num > 0);
console.log(resultEvery);


// forEach()

// 배열의 모든 요소에 대해 콜백 함수를 반복 실행
let arrForeach = [1, 2, 3, 4, 5];
arrForeach.forEach((val, idx) => {
  // console.log(idx + ' : ' + val);
  console.log(`${idx} : ${val}`); // 위에 거랑 같은거
});