// ----------------------
// 배열
// ----------------------
const ARR1 = [1, 2, 3, 4, 5];

// push()
// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length
ARR1.push(10);

Array.ARR1.push(10); // 이건 이미 push를 갖고 있기 때문에 부모의 Array까지 갈 필요가 없다

// length
// 배열의 길이 획득
console.log(ARR1.length);

// isArray()
// 배열인지 아닌지 체크
console.log(Array.isArray(ARR1)); // true
console.log(Array.isArray(1)); // false