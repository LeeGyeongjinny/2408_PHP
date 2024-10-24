// if문
let num = 1;

if(num === 1) {
  console.log('1등');
} else if(num === 2) {
  console.log('2등');
} else if(num === 3) {
  console.log('3등');
} else {
  console.log('등수 외');
}

// switch문
switch(num){
  case 1:
    console.log('1등');
    break;
  case 2:
    console.log('2등');
    break;
  default:
    console.log('순위 외');
    break;
}


// for문
// 구구단 2 ~ 9단
// for(let i = 2; i <= 9; i++){
//   console.log('***** '+ i + "단 *****")
//   for(let k = 1; k <= 9; k++){
//     console.log(i + 'x' + k +'=' +i*k);
//     // console.log(i) + 'x' + console.log(k) +'=' +console.log(i*k);
//   }
// }

// --------------------------

for(let dan = 2; dan <= 9; dan++) {
  console.log('----- ' + dan +'단 -----');
  for(let gu = 1; gu <= 9; gu++) {
    console.log(dan + 'X' + gu + '=' + (dan*gu));
  }
}


// -------------------------

// 별

for(let s = 1; s <6; s++){
  for(let t = 1; t <= s; t++){
    console.log('*');
  }
  console.log('\n');
}

let str = '';
for(let i = 0; i < 5; i++){
  for(let z = 5; z > 0; z--) {
    if(z - i > 1) {
      str += ' ';
    }else {
      str += '*';
    }
  }
  str += '\n';
}
console.log(str);

// for...in : 모든 객체를 반복하는 문법, key에 접근
const OBJ2 = {
  key1: 'val1'
  ,key2: 'val2'
}

for(let key in OBJ2){
  console.log(OBJ2[key]);
}

// for...of : 이터러블(iterable -> 순서가 정해져있는) 객체를 반복하는 문법
const STR1 = '안녕하세요';

for(let val of STR1){
  console.log(val);
}

const ARR1 = [1, 2, 3];