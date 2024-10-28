// 1. 원본은 보존하면서 오름차순 정렬해주세요.
const ARR1 = [6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40];

const COPY_ARR1 = [...ARR1];
let resultCopy = COPY_ARR1.sort((a, b) => a - b);
console.log(resultCopy);
console.log(ARR1);

// 1-1 중복 제거

let resultArr = [];

ARR1.forEach(val => {
  if(!resultArr.includes(val)){
    resultArr.push(val);
  }
});

// -------------------------------
// 수업
// -------------------------------

// 1. 오름차순 정렬
let copyArr1 = [...ARR1]; // deep copy -> 원본 유지
copyArr1.sort((a, b) => a - b);
// [3, 3, 5, 5, 6, 7, 8, 40, 80, 92, 100]

// 1-1. 중복 제거
// [3, 5, 6, 7, 8, 40, 80, 92, 100]

// a) forEach(), includes() 이용

let duplicationArr = [];
copyArr1.forEach(val => {
  if(!duplicationArr.includes(val)){
    duplicationArr.push(val);
  }
});

// b) filter(), indexOf() 이용
// copyArr1 = [3, 3, 5, 5, 6, 7, 8, 40, 80, 92, 100] 

let duplicationArr2 = copyArr1.filter((val, idx) => {
  return copyArr1.indexOf(val) === idx;
});

// 3 -> idx = 0 -> indexOf(3) = 0 === 0 -> true -> 들어감
// 3 -> idx = 1 -> indexOf(3) = 0(앞에있는 3이 이미 있기때문에) !== 1 -> false -> 안들어감
// 5 -> idx = 2 -> indexOf(5) = 2 === 2 -> true -> 들어감
// 5 -> idx = 3 -> indexOf(5) = 2(앞에있는 5가 이미 있기때문에) !== 3 -> false -> 안들어감
// 6 -> idx = 4 -> indexOf(6) = 4 === 4 -> true -> 들어감
// ...


// c) set 객체
// set은 중복을 허용하지 않는다

let duplicationArr3 = Array.from(new Set(copyArr1));
// 삽입 순서대로 요소를 순회. Set 내의 값은 모두 unique하다







// 2. 짝수와 홀수를 분리해서 각각 새로운 배열을 만들어주세요.
const ARR2 = [5, 7, 3, 4, 5, 1, 2];

let resultFilter_1 = ARR2.filter(num => num % 2 !== 0);
let resultFilter_2 = ARR2.filter(num => num % 2 === 0);
console.log(resultFilter_1);
console.log(resultFilter_2);

// 2-1 오름차순 정렬
// const COPY_ARR2 = [...resultFilter_1];

// let resultCopy_arr2 = COPY_ARR2.sort((a, b) => b - a);
// console.log(resultCopy_arr2);
// let resultSplice_arr2 = COPY_ARR2.splice(2, 1);
// console.log(COPY_ARR2);

let duplicationArr_1 = [];
resultFilter_1.forEach(val => {
  if(!duplicationArr_1.includes(val)){
    duplicationArr_1.push(val);
  }
});



// -------------------------------
// 수업
// -------------------------------

// filter

const ODD = ARR2.filter(num => num % 2 !== 0);
const EVEN = ARR2.filter(num => num % 2 === 0);

// forEach

copyArr2 =  [...ARR2];
let odd = [];
let even = [];

copyArr2.forEach(val => {
  if(val % 2 === 0){
    if(!even.includes(val)){
      even.push(val);
    }
  } else{
    if(!odd.includes(val)){
      odd.push(val);
    }
  }
});


copyArr2.forEach(val => {
  let shallowCopy =  null;
  if(val % 2 === 0){
    shallowCopy = even;
  } else {
    shallowCopy = odd;
  }

  if(!shallowCopy.includes(val)){
    shallowCopy.push(val);
  }
})


//
function myPush(val){
  if(!shallowCopy.includes(val)){
    shallowCopy.push(val);
  }
}


// map
// ?????

// Spread Operator
const NUMBER = [...odd, ...even];