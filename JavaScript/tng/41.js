// 현재 시간 흐르게 만들기
// 멈추면 시간 멈추고, 재시작누르면 다시 시작

const P = document.querySelector('p');
const TIME = document.createElement('span');
P.style.fontSize = '2rem';
TIME.style.fontSize = '2rem';

function clock() {
  const NOW = new Date();
  const addLPadZero = (num, length) => {
    return String(num).padStart(length,'0');
  }
  
  const HOUR = addLPadZero(NOW.getHours(), 2);
  const MINUTES = addLPadZero(NOW.getMinutes(), 2);
  const SECONDS = addLPadZero(NOW.getSeconds(), 2);
  const ampm = () => {
    const hour = addLPadZero(NOW.getHours(), 2);
    if(hour < 12){
      return '오전 '+hour;
    } else if(hour == 12){
      return '오후 '+hour;
    } else {
      return '오후 '+(addLPadZero((NOW.getHours()-12), 2));
    }
  }

  TIME.innerHTML = `${ampm(HOUR)}:${MINUTES}:${SECONDS}`;
  P.appendChild(TIME);

  // const TIME =  document.querySelector('#clock');
  // TIME.innerHTML = `${ampm(HOUR)}:${MINUTES}:${SECONDS}`;
  // TIME.style.fontSize = '2rem';
}
clock();

// let TIME_INTERVAL = setInterval(clock, 1000);
let TIME_INTERVAL = [];
if(TIME_INTERVAL !== null){
  TIME_INTERVAL.push(setInterval(clock, 1000));
}


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


// 멈추기 버튼

const BTN_STOP = document.querySelector('#stop');
BTN_STOP.addEventListener('click', () => {
  clearInterval(TIME_INTERVAL);
});

// 재시작 버튼

const BTN_START = document.querySelector('#restart');
BTN_START.addEventListener('click', () => {
  if(TIME_INTERVAL.inlcudes(TIME_INTERVAL)){
    TIME_INTERVAL.push(setInterval(clock, 1000));
  }
});




// 기록 버튼

// const BTN_LAP = document.querySelector('#lap');
// BTN_LAP.addEventListener('click', () => {
  
//   LAP = document.createElement('LI');
//   LAP.innerHTML
  

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

