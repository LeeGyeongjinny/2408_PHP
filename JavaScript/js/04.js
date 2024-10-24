console.log('외부 파일');

// --------------- 변수 ---------------
// var : 중복 선언 가능, 재할당 가능, 함수 레벨 스코프
var num1 = 1; // 최초 선언
var num1 = 2; // 중복 선언
num1 = 3; // 재할당

// let : 중복 선언 불가능, 재할당 가능, 블록 레벨 스코프
let num2 = 2; // 최초 선언
// let num2 = 3; // 중복 선언, 불가능
num2 = 4; // 재할당

// const : 중복 선언 불가능, 재할당 불가능, 블록 레벨 스코프, 상수
const NUM3 = 3;
// NUM3 = 4; // 재할당, 불가능

// ------------------------
// 스코프
// ------------------------
// 변수나 함수가 유효한 범위
// 전역, 지역, 블록 3가지의 스코프

// 전역 레벨 스코프
let globalScope = '전역이다.';

function myPrint() {
  console.log(globalScope);
}

// 지역 레벨 스코프
function myLocalPrint() {
  let localScope = "마이로컬프린트 지역";
  console.log(localScope);
}

// 블록 레벨 스코프 : {}로 둘러싸인 범위
function myBlock() {
  if(true) {
    var test1 = 'var';
    let test2 = 'let';
    const TEST3 = 'const';
  }
  console.log(test1);
  console.log(test2);
  console.log(TEST3);
}

// ------------------------
// 호이스팅 : 인터프리터가 변수와 함수의 메모리 공간을 선언 전에 미리 할당하는 것
// ------------------------
// console.log(test);
// test = 'aaa';
// console.log(test);
// let test;

// ------------------------
// 데이터 타입
// ------------------------
// number : 숫자
let num = 1;

// string : 문자열
let str = 'test';

// boolean : 논리
let bool = true;

// NULL : 존재하지 않는 값
let letNull = null;

// undefined : 값이 할당되지 않은 상태
let letUndefined;

// symbol : 고유하고 변경이 불가능한 값
let symbol1 = Symbol('aaa');
let symbol2 = Symbol('aaa');

// object : 객체, 키-값 쌍으로 이루어진 복합 데이터 타입
let obj = {
  key1: 'val1'
  ,key2: 'val2'
}

