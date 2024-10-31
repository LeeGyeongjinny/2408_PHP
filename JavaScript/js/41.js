// ---------------------------------------
// 타이머 함수
// ---------------------------------------

// setTimeout(callback, ms)

// 일정 시간이 흐른 후에 콜백 함수를 실행
// setTimeout(() => {
//   console.log('시간초과');
// }, 5000); // 5초 뒤에 실행되어 '시간초과' 출력

// 동기, 비동기 
// 콜백 지옥

// C > B > A 순으로 출력, 총 3초 소요
// setTimeout(() => console.log('A'), 3000);
// setTimeout(() => console.log('B'), 2000);
// setTimeout(() => console.log('C'), 1000);

// A > B > C 순으로 출력, 총 6초 소요
// setTimeout(() => {
//   console.log('A')
//   setTimeout(() => {
//     console.log('B');
//     setTimeout(() => {
//       console.log('C')
//     }, 1000);
//   }, 2000);
// }, 3000);
// A찍히고 2초 뒤에 B찍히고 1초 뒤에 C찍힘 -> 동기처리는 아니고 동기처럼 작동시킴


// clearTimeout(타이머ID)

// 해당 타이머ID의 처리를 제거
// const TIMER_ID = setTimeout(() => console.log('타이머'), 10000);
// console.log(TIMER_ID);
// clearTimeout(TIMER_ID);


// setInterval(callback, ms)

// 일정 시간마다 콜백함수를 실행
// const INTERVAL_ID = setInterval(() => {
//   console.log('인터벌');
// }, 1000);


// clearInterval(id)

// 해당 id의 인터벌을 제거
// clearInterval(INTERVAL_ID);
// setTimeout(() => clearInterval(INTERVAL_ID), 10000); // 10초뒤에 인터벌 종료


// -----------------------------------
// HTML 건드리지 않는다
// 화면에 두둥 등장 나오게
// 1초마다 빨간색 파란색 반복

// const HAHA = document.querySelector('h1');
// HAHA.classList.add('red');

// const INTERVAL_COLOR = setInterval(() => {
  //   HAHA.classList.toggle('blue');
  // });
  
  
// (() => {
//   const JJAN = document.write('<h1>하하하하</h1>');
//   const HAHA = document.querySelector('h1');
//   HAHA.classList.add('red');
// })();

//   const INTERVAL_COLOR = setInterval(() => {
//     HAHA.classList.toggle('blue');
//   });

(() => {
  const H1 = document.createElement('h1');
  H1.textContent = '두둥등장';
  H1.classList.add('blue');
  H1.style.fontSize = '5rem';

  document.body.appendChild(H1);

})();

setInterval(() => {
  const H1 = document.querySelector('h1');
  H1.classList.toggle('blue');
  H1.classList.toggle('red');
}, 200);



const EMOJI1 = '( ✋˙࿁˙ )';
const EMOJI2 = '<span style="color:red;">凸</span>(｀0´)<span style="color:red;">凸</span>';

(() => {
  const P = document.createElement('P');
  P.innerHTML = EMOJI1;
  P.style.fontSize = '5rem';
  document.body.appendChild(P);
})();

setInterval(() => {
  const P = document.querySelector('P');
  if(P.innerHTML === EMOJI1) {
    P.innerHTML = EMOJI1;
  } else {
    P.innerHTML = EMOJI2;
  }
}, 500);



// -----------------------------------