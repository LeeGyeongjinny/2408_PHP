const BTN_TOP = document.querySelector('#btn');
BTN_TOP.addEventListener('click', () => {
  alert('안녕하세요. 숨어있는 div를 찾아주세요.');
});

const HEARTBEAT = document.querySelector('.heartbeat');
HEARTBEAT.addEventListener('mouseenter',heartBeat);



function heartBeat() {
  alert('두근두근');
};

const WOW = document.querySelector('.wow');

WOW.addEventListener('click', uhmeo);

function uhmeo() {
  alert('들켰다');
  WOW.removeEventListener('click',uhmeo);
  WOW.addEventListener('click',hide);
  
  HEARTBEAT.classList.toggle('heartbeat_1');
  HEARTBEAT.removeEventListener('mouseenter',heartBeat);
};

function hide() {
  alert('숨는다');
  WOW.removeEventListener('click',hide);
  WOW.addEventListener('click', uhmeo);
  
  
  HEARTBEAT.classList.toggle('heartbeat_1');
  HEARTBEAT.addEventListener('mouseenter',heartBeat);

};





// const heartbeat = document.getElementById("heartbeat");

window.addEventListener("load", function randomize(){
  let r;
  let list = document.getElementsByClassName("listing-item")
  for(let i = 0;i < 36;i++){
      r = Math.floor(Math.random()*200);
      list[i].style.margin = r + "px";
  }
});

window.addEventListener("load", function randomize(){
  let r;
  let heart = document.getElementById('heartbeat')
  for(let i = 0;i < 36;i++){
      r = Math.floor(Math.random()*200);
      heart[i].style.margin = r + "px";
  }
});


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

  let test = Math.ceil(Math.random() * 10);

// const field = document.querySelector('.field');
// const fieldRect = field.getBoundingClientRect();


// HEARTBEAT.setAttribute('top','randomNumber');
// HEARTBEAT.setAttribute('left','randomNumber');

// // 최솟값, 최댓값을 가진 랜덤함수
// function getRandomNumber (min, max) {
//   let randomNumber = (Math.random()*(max-min))+min;
//   return randomNumber;
// }

