// ----------------------
// 함수 선언식
// 호이스팅에 영향받는다.
// 재할당 가능하므로 함수명 중복 안되게 조심해야함
// ----------------------
console.log(mySum(4,5));

function mySum(a, b){
  return a + b;
}

// function mySum(a, b, c){
//   return a + b + c;
// }

// ----------------------
// 함수 표현식
// 호이스팅에 영향을 받지 않는다.
// 재할당을 방지할 수 있다.
// ----------------------

// console.log(myPlus(4,5));

const myPlus = function(a, b){
  return a + b;
}

// ----------------------
// 화살표 함수
// ----------------------
// 파라미터 2개 이상일 경우 (소괄호 생략 불가)
const arrowFnc = (a, b) => a + b;
function test1(a, b) {
  return a + b;
}

// 파라미터 1개일 경우 (소괄호 생략 가능)
const arrowFnc2 = a => a;
function test2(a) {
  return a;
}

// 파라미터가 없는 경우 (소괄호 생략 불가)
const arrowFnc3 = () => 'test';
function test3() {
  return 'test';
}

// 처리가 여러 줄일 경우
const arrowFnc4 = (a, b) => {
  if(a < b){
    return 'b가 더 큼';
  } else {
    return 'a가 더 큼';
  }
}
function test4(a, b){
  // function test6() {
  //   console.log(1);
  // }
  // test6();
  // 자바스크립트의 함수는 객체라서 함수 안에 함수 정의 가능
  if(a < b){
    return 'b가 더 큼';
  } else {
    return 'a가 더 큼';
  }
}