// -------------------------
// Math 객체
// -------------------------
// 올림, 반올림, 버림
Math.ceil(0.1); // 1
Math.ceil(1.31); // 2

Math.round(0.5); // 1
Math.round(1.51); // 2

Math.floor(0.9); // 0
Math.floor(1.31); // 1

// 랜덤값
Math.random(); // 0 - 1 사이의 랜덤한 값을 획득
Math.floor(Math.random() * 10) + 1; // 1 - 10까지 랜덤한 숫자 뽑기

// 최댓값
Math.max(1, 2, 3, 4); // 4

let arr = [1, 2, 3, 4, 5];
Math.max(...arr); // 5

// 최솟값
Math.min(3, 5, 2, 1, 0); // 0
Math.min(...arr); // 1

// 절댓값
Math.abs(-1); // 1
Math.abs(1); // 1