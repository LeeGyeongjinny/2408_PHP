// 1.`버튼` 클릭시 아래 문구 알러트로 출력
// 안녕하세요.
// 숨어있는 div를 찾아주세요.
// 2. 숨어있는 div에 마우스가 진입하면 아래 문구 알러트 출력
// - 두근두근
// 3. 숨어있는 div를 마우스로 클릭하면 아래 문구 알러트 출력 및 나타나기
// - 들켰다
// 4. 들킨 div에는 마우스가 진입해도 두근두근이 뜨지 않습니다.
// 5. 나타난 div를 다시 클릭하면 아래 문구 알러트 출력 및 사라지기
// - 숨는다
// 6. 다시 숨은 div에 마우스가 진입하면 아래 문구 알러트 출력
// - 두근두근
// -- 보너스 문제 --
// 다시 숨을 때 랜덤한 위치로 이동

// const BTN_TOP = document.querySelector('#btn');
// BTN_TOP.addEventListener('click', () => {
//   alert('안녕하세요. 숨어있는 div를 찾아주세요.');
// });

// const HEARTBEAT = document.querySelector('.heartbeat');
// HEARTBEAT.addEventListener('mouseenter',heartBeat);



// function heartBeat() {
//   alert('두근두근');
// };

// const WOW = document.querySelector('.wow');

// WOW.addEventListener('click', uhmeo);

// function uhmeo() {
//   alert('들켰다');
//   WOW.removeEventListener('click',uhmeo);
//   WOW.addEventListener('click',hide);
  
//   HEARTBEAT.classList.toggle('heartbeat_1');
//   HEARTBEAT.removeEventListener('mouseenter',heartBeat);
// };

// function hide() {
//   alert('숨는다');
//   WOW.removeEventListener('click',hide);
//   WOW.addEventListener('click', uhmeo);
  
  
//   HEARTBEAT.classList.toggle('heartbeat_1');
//   HEARTBEAT.addEventListener('mouseenter',heartBeat);

// };



// 위치 랜덤하게 도전

// // const heartbeat = document.getElementById("heartbeat");

// window.addEventListener("load", function randomize(){
//   let r;
//   let list = document.getElementsByClassName("listing-item")
//   for(let i = 0;i < 36;i++){
//       r = Math.floor(Math.random()*200);
//       list[i].style.margin = r + "px";
//   }
// });

// window.addEventListener("load", function randomize(){
//   let r;
//   let heart = document.getElementById('heartbeat')
//   for(let i = 0;i < 36;i++){
//       r = Math.floor(Math.random()*200);
//       heart[i].style.margin = r + "px";
//   }
// });

// --------------------------------- 살려

// let min=0;
// let max=1000;

// function getRandomNumber (min, max) {
//   let randomNumber = (Math.random()*(max-min))+min;
//   let randomNumber2 = (Math.random()*(max-min))+min;
//   return randomNumber;
//   return randomNumber2;
// }

// heartbeat.setAttribute('top','randomNumber');
// heartbeat.setAttribute('left','randomNumber2');


// let str1 = Math.round(Math.random()*1000);
// let str2 = Math.round(Math.random()*1000);

// document.getElementById("heartbeat").style.top = str1;
// document.getElementById("heartbeat").style.left = str2;


// ------------------------------------------------------
// const WOW = document.querySelector('.wow');
// let SHOW = true;

// WOW.addEventListener('click', () => {
//   if(SHOW){
//     alert('들켰다');
//     HEARTBEAT.classList.toggle('heartbeat_1');
//     HEARTBEAT.removeEventListener('mouseenter',heartBeat);
//     SHOW = false;
//   } else {
//     alert('숨는다');
//     HEARTBEAT.classList.toggle('heartbeat_1');
//     SHOW = true;
//     HEARTBEAT.removeEventListener('mouseenter',heartBeat);
//   }
// });
// ------------------------------------------------------


// 랜덤

  // let test = Math.ceil(Math.random() * 10);

// const field = document.querySelector('.field');
// const fieldRect = field.getBoundingClientRect();


// HEARTBEAT.setAttribute('top','randomNumber');
// HEARTBEAT.setAttribute('left','randomNumber');

// // 최솟값, 최댓값을 가진 랜덤함수
// function getRandomNumber (min, max) {
//   let randomNumber = (Math.random()*(max-min))+min;
//   return randomNumber;
// }


// ---------------------------------------------------
// 수업
// ---------------------------------------------------



// 즉시실행함수 -> 그떄 딱 한번만 실행됨
// (() => {

// })() 


// 1.`버튼` 클릭시 아래 문구 알러트로 출력 -> 클릭E btn
// 안녕하세요.
// 숨어있는 div를 찾아주세요.
(() => {
  const BTN_INFO = document.querySelector('#btn-info');
  BTN_INFO.addEventListener('click', () => {
    alert('안녕하세요.\n숨어있는 div를 찾아주세요.');
  });

  // 2. 숨어있는 div에 마우스가 진입하면 아래 문구 알러트 출력 -> 진입E con
  // - 두근두근
  const CONTAINER = document.querySelector('.container');
  CONTAINER.addEventListener('mouseenter', dokidoki);


  // 3. 숨어있는 div를 마우스로 클릭하면 아래 문구 알러트 출력 및 나타나기 -> 클릭E box1
  // - 들켰다
  const BOX = document.querySelector('.box');
  BOX.addEventListener('click', busted);


  // 여기 넣으면 처음 시작할 때부터 위치 랜덤
  // const RANDOM_X = Math.round(Math.random() * (window.innerWidth - CONTAINER.offsetWidth));
  // const RANDOM_Y = Math.round(Math.random() * (window.innerHeight - CONTAINER.offsetHeight));

  // CONTAINER.style.top = RANDOM_Y + 'px';
  // CONTAINER.style.left = RANDOM_X + 'px';

  random_position() // 위치 랜덤 함수
})();

// 두근두근 함수
function dokidoki(){
  alert('두근두근');
}

// 들켰다 함수
function busted(){
  alert('들켰다');
  const CONTAINER = document.querySelector('.container');
  const BOX = document.querySelector('.box');

  BOX.removeEventListener('click', busted); // 기존 들켰다 이벤트 제거
  BOX.classList.add('busted'); // 배경색 부여

  // 5. 나타난 div를 다시 클릭하면 아래 문구 알러트 출력 및 사라지기 -> 클릭E box2
  // - 숨는다
  BOX.addEventListener('click', hide); // 숨는다 이벤트 추가

  // 4. 들킨 div에는 마우스가 진입해도 두근두근이 뜨지 않습니다. -> 진입E con
  CONTAINER.removeEventListener('mouseenter', dokidoki); // 기존 두근두근 이벤트 제거
}

// 숨는다 함수
function hide(){
  alert('숨는다');
  const CONTAINER = document.querySelector('.container');
  const BOX = document.querySelector('.box');


  BOX.classList.remove('busted'); // 들켰다 배경색 제거
  BOX.addEventListener('click', busted); // 들켰다 이벤트 추가
  BOX.removeEventListener('click', hide); // 숨는다 이벤트 제거

  // 6. 다시 숨은 div에 마우스가 진입하면 아래 문구 알러트 출력 -> 진입E con
  // - 두근두근 
  CONTAINER.addEventListener('mouseenter', dokidoki); // 두근두근 이벤트 추가

  // -- 보너스 문제 --
  // 다시 숨을 때 랜덤한 위치로 이동
  
  // const RANDOM_X = Math.round(Math.random() * (window.innerWidth - CONTAINER.offsetWidth));
  // const RANDOM_Y = Math.round(Math.random() * (window.innerHeight - CONTAINER.offsetHeight));
  
  // CONTAINER.style.top = RANDOM_Y + 'px';
  // CONTAINER.style.left = RANDOM_X + 'px';
  random_position() // 위치 랜덤
}

// 위치 랜덤하는거 두 번 쓰게되면 함수로 만들어서 쓰는 것이 좋다

  // 위치 랜덤 함수
function random_position() {
  const CONTAINER = document.querySelector('.container');

  const RANDOM_X = Math.round(Math.random() * (window.innerWidth - CONTAINER.offsetWidth));
  const RANDOM_Y = Math.round(Math.random() * (window.innerHeight - CONTAINER.offsetHeight));

  CONTAINER.style.top = RANDOM_Y + 'px';
  CONTAINER.style.left = RANDOM_X + 'px';
}
