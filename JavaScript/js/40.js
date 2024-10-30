// inline
function inlineEventBtn() {
  alert('무한루프');
} // 함수 선언식

function changeTitle(){
  // const H1 = document.getElementById('title');
  // 이거 되긴 하는데 id값은 고유한 몇개?만 쓰니깐 잘 안쓰긴해
  // 하지만 태그, 클래스로 하는거는 쓰지마라
  const H1 = document.querySelector('h1');
  H1.style.color = 'blue'; // 이건 css파일만들고 하는 방법
}

// 이건 css파일만들고 하는 방법
// const H1 = document.querySelector('h1');
// function changeTitle(){
//   H1.classList.add('title-click');
// }


// const H1 = document.querySelector('h1');
// function changeTitle(){
//   H1.style.color = 'blue';
// }
// 이렇게 변수를 먼저 선언하고 함수 만들면 변수는 전역 스코프라 계속 메모리 먹는다 -> 쌓이면 느려져


// addEventListner()
const BTN_LISTNER = document.querySelector('#btn1');
// BTN_LISTNER.addEventListener('click',() => {
//   alert('이벤트 리스너 실행');
// });
// BTN_LISTNER.addEventListener('click',() => {
//   alert('또 나오지롱');
// }); // addEventListner 중복 가능

BTN_LISTNER.addEventListener('click', callAlert);
// 콜백함수는 절대 소괄호 붙이면 안된다
// 지금 실행할 것이 아니기 때문

function callAlert (){
  alert('이벤트 리스너 실행');
};
// 코드 만들 때 보통 이렇게 콜백함수를 미리 만들어놓고 한다
// 안에 콜백함수를 직접 적을 때는 일회성일때만
// 이건 함수 선언식으로 적어서 호이스팅되기 때문에 사용한 코드보다 밑에 적어도 사용 가능

// h1 빨강->검정->빨강
const BTN_TOGGLE = document.querySelector('#btn_toggle');
BTN_TOGGLE.addEventListener('click',() => {
  const TITLE = document.querySelector('h1');
  TITLE.classList.toggle('title-click');
});

// removeEventListner()
BTN_LISTNER.removeEventListener('click', callAlert);
// 삭제하고 싶은 이벤트 유형이랑 그때 실행했던 함수도 동일하게 적어야한다


// addEventListner이랑 똑같이 만들면 사라지지않을까?
// BTN_LISTNER.addEventListener('click',() => {
//   alert('이벤트 리스너 실행');
// });
// -> 안사라짐


// 일회성 이벤트
// h2 클릭시 alert 뜨게 -> 한번 누르고나면 다시 alert안뜨게
// 딱 한번만 실행되게 하기 위해서 함수 따로 빼는 것
const H2 = document.querySelector('h2');
H2.addEventListener('click', callAlertTest);

function callAlertTest(){
    alert('테스트용');
    // H2.removeEventListener('click',callAlertTest);
};

// '타이틀'이라는 글자에 한번이라도 마우스가 진입하면 '테스트용'alert 안뜨게?
// const H1 = document.querySelector('h1');
// H1.addEventListener('mouseenter', callAlertTest_2);
// function callAlertTest_2(){
//   H2.removeEventListener('click',callAlertTest);
// };

// 수업
// const TITLE = document.querySelector('h1');
// TITLE.addEventListener('mouseenter', () => {
//   H2.removeEventListener('click',callAlertTest);
// });

const TITLE = document.querySelector('h1');
TITLE.addEventListener(
  'mouseenter'
  , () => {
    H2.removeEventListener('click',callAlertTest);
    console.log('tt');
  }
  , {once : true} // option : once가 true일 경우 한 번만 실행
);


// 이벤트 객체

const H3 = document.querySelector('h3');
// mouseup : 클릭했다가 뗄 때
H3.addEventListener('mouseup', (e) => {
  // console.log(e);
  e.target.style.color = 'red';
});
// mousedown : 클릭하는 순간
H3.addEventListener('mousedown', (e) => {
  e.target.style.color = 'green';
});
// mouseenter : 마우스 진입했을 때 
H3.addEventListener('mouseenter', e => {
  e.target.style.color = 'blue';
});
// mouseleave : 마우스 떠났을 때
H3.addEventListener('mouseleave', e => {
  e.target.style.color = 'orange';
});

// 모달
// 모달 오픈
const BTN_MODAL = document.querySelector('#btn_modal');
BTN_MODAL.addEventListener('click', () => {
  const MODAL = document.querySelector('.modal-container');
  MODAL.classList.remove('display-none');
});

// 취소 버튼
const MODAL_CLOSE = document.querySelector('#modal_close');
MODAL_CLOSE.addEventListener('click', () => {
  const MODAL = document.querySelector('.modal-container');
  MODAL.classList.add('display-none');
});

// 팝업
const NAVER = document.querySelector('#naver');
NAVER.addEventListener('click', () => {
  // open('https://www.naver.com', '', 'width=500 height=500');
  // w,h 단위는 안적어도됨(어차피 px단위만 들어감)
  // 사이즈 안줘도 됨
  
  // open('https://www.naver.com', '_blank', 'width=750,height=650,top=100');
  open('https://www.naver.com', '_blank', 'width=750,height=650, top=100, left=100');
  open('https://www.google.com', '_blank', 'width=750,height=650, top=200, left=200');
  open('https://www.daum.net', '_blank', 'width=750,height=650, top=300, left=300');
});