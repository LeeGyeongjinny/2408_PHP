// 현재 시간 흐르게 만들기
// 멈추면 시간 멈추고, 재시작누르면 다시 시작

// -------------------------------------------
// const P = document.querySelector('p');
// const TIME = document.createElement('span');
// P.style.fontSize = '2rem';
// TIME.style.fontSize = '2rem';

// function clock() {
//   const NOW = new Date();
//   const addLPadZero = (num, length) => {
//     return String(num).padStart(length,'0');
//   }
  
//   const HOUR = addLPadZero(NOW.getHours(), 2);
//   const MINUTES = addLPadZero(NOW.getMinutes(), 2);
//   const SECONDS = addLPadZero(NOW.getSeconds(), 2);
//   const ampm = () => {
//     const hour = addLPadZero(NOW.getHours(), 2);
//     if(hour < 12){
//       return '오전 '+hour;
//     } else if(hour == 12){
//       return '오후 '+hour;
//     } else {
//       return '오후 '+(addLPadZero((NOW.getHours()-12), 2));
//     }
//   }

//   TIME.innerHTML = `${ampm(HOUR)}:${MINUTES}:${SECONDS}`;
//   P.appendChild(TIME);

  // const TIME =  document.querySelector('#clock');
  // TIME.innerHTML = `${ampm(HOUR)}:${MINUTES}:${SECONDS}`;
  // TIME.style.fontSize = '2rem';
// }
// clock();

// let TIME_INTERVAL = setInterval(clock, 1000);

// // 멈추기 버튼

// const BTN_STOP = document.querySelector('#stop');
// BTN_STOP.addEventListener('click', () => {
//   clearInterval(TIME_INTERVAL);
//   TIME_INTERVAL = null;
// });

// // 재시작 버튼



// const BTN_START = document.querySelector('#restart');
// BTN_START.addEventListener('click', () => {
//   if(TIME_INTERVAL === null) {
//     TIME_INTERVAL = setInterval(clock, 1000);
//   }
// });


// ------------------------------------------- 이까지


// 기록 버튼

// const BTN_LAP = document.querySelector('#lap');
// BTN_LAP.addEventListener('click', () => {
  
//   LAP = document.createElement('LI');
//   LAP.innerHTML.(NOW);
  

// });


// let toggle = true;
// function stopclock() {
//   if (toggle){
//     const BTN_STOP = document.querySelector('#stop');
//     BTN_STOP.addEventListener('click', () => {
//       clearInterval(TIME_INTERVAL);
//     });
//     toggle = false;
//   }
// }  
// function restartclock() {
//     const BTN_START = document.querySelector('#restart');
//     BTN_START.addEventListener('click', () => {
//       TIME_INTERVAL = setInterval(clock, 1000);
//     });
//     toggle = true;
//   }


// ------------------------------------------- 이까지는 그냥 끄적


// 수업 --------------------------------------

// 현재시간 함수 만들어서 출력하기

// l-pad
function leftPadZero(target, length) {
  return String(target).padStart(length, '0');
}

function getDate() {
  const NOW = new Date();
  let hour = NOW.getHours(); // 시간 획득 (24시간제)
  let minutes = NOW.getMinutes(); // 분 획득
  let seconds = NOW.getSeconds(); // 초 획득
  let ampm = hour < 12 ? '오전' : '오후'; // 오전, 오후
  let hour12 = hour < 13 ? hour : hour - 12; // 시간 (12시간제)

  let timeFormat = 
    `${ampm} ${leftPadZero(hour12, 2)}:${leftPadZero(minutes, 2)}:${leftPadZero(seconds, 2)}`;
  document.querySelector('#time').textContent = timeFormat;
}

(() => {
  getDate();
  let intervalId = null;
  intervalId = setInterval(getDate, 500);
  // 여기서 const안쓰고 let 쓴 이유는 재시작에서 재할당해야 하기 때문에
  
  // 멈춰 버튼
  
  // const BTN_STOP = document.querySelector('#stop');
  document.querySelector('#stop').addEventListener('click', () => {
    clearInterval(intervalId);
    intervalId = null;
  });
  
  // 재시작 버튼
  
  // const BTN_START = document.querySelector('#restart');
  document.querySelector('#restart').addEventListener('click', () => {
    if(intervalId === null){
      getDate();
      intervalId = setInterval(getDate, 500);
    }
  });
})();