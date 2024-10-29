// -------------------------
// 요소 선택
// -------------------------

// 고유한 ID로 요소를 선택
const TITLE = document.getElementById('title'); // h1 태그에 접근해서 가져올 수 있음
TITLE.style.color = 'blue';

// 태그명으로 요소를 선택하는 방법
const H1 = document.getElementsByTagName('h1');
H1[1].style.color = 'green';

// 클래스명으로 요소를 선택
const CLASS_NONE_LI = document.getElementsByClassName('none-li');

// CSS 선택자를 이용해서 요소를 선택
const SICK = document.querySelector('#sick');
const NONE_LI = document.querySelector('.none-li');
const ALL_NONE_LI = document.querySelectorAll('.none-li');
const ALL_NONE_LI_2 = document.querySelectorAll('.none-li, #title');

const LI = document.querySelectorAll('li');
LI.forEach((element, idx) => {
  if(idx % 2 === 0){
    element.style.color = 'red';
  } else{
    element.style.color = 'blue';
  }
});

// -------------------------
// 요소 조작
// -------------------------

// textContent

// 컨텐츠를 획득 또는 변경
// 순수한 텍스트 데이터를 전달
TITLE.textContent = '<a>링크</a>';


// innerHTML

// 컨텐츠를 획득 또는 변경, 태그는 태그로 인식해서 전달
TITLE.innerHTML = '<a>링크크크</a>';
// TITLE.innerHTML = '<a href="https://www.naver.com">링크크크</a>';


// setAttribute(속성명, 값) : 해당 속성과 값을 요소에 추가

const A_LINK = document.querySelector('#title > a'); 
A_LINK.setAttribute('href', 'https://www.naver.com');

const INPUT_1 = document.querySelector('#input-1');
// const INPUT_1 = document.getElementById('input-1'); // 이렇게 id로 접근하는 것도 가능
INPUT_1.setAttribute('placeholder', '하하하하하');


// removeAttribute(속성명)

// 해당 속성 제거
A_LINK.removeAttribute('href');


// -------------------------
// 요소의 스타일링
// -------------------------

// style

// 인라인으로 스타일 추가
TITLE.style.color = 'black'; // 인라인스타일로 들어감 -> 우선순위 높아짐
TITLE.removeAttribute('style');


// classList

// 클래스로 스타일 추가 및 삭제
// (class를  setAttribute로 줄 수 있긴함)

// classList.add() : 해당 클래스 추가
TITLE.classList.add('class-1');
TITLE.classList.add('class-2', 'class-3', 'class-4'); // 한번에 여러개

// classList.remove() : 해당 클래스 제거
TITLE.classList.remove('class-3');

// classList.toggle() : 해당 클래스를
TITLE.classList.remove('toggle');
// setInterval(()=>{TITLE.classList.toggle('toggle')}, 10); 깜빡깜빡 숫자로 속도 조절가능


// -------------------------
// 새로운 요소 생성
// -------------------------

// createElement(태그명) : 새로운 요소 생성
const NEW_LI = document.createElement('li');
NEW_LI.textContent = '떡볶이'; // innerHTML보다는 textcontent가 더 낫다 (미연에 에러 방지)
// ul의 자식으로 들어가야한다

const FOODS = document.querySelector('#foods'); // 보통 최상위? 몇개만 id지정

// appendChild(노드) : 해당 부모 노드에 마지막 자식으로 노드를 추가
FOODS.appendChild(NEW_LI); // 맨 끝에 떡볶이 추가


// removeChild(노드) : 해당 부모 노드의 자식 노드를 삭제
FOODS.removeChild(NEW_LI); // 맨 끝에 떡볶이 삭제

// document.body; // body는 querySelector안하고 바로 불러올 수 있다

// insertBefore(새로운노드, 기준노드) : 해당 부모 노드의 자식인 기준 노드의 앞에 새로운 노드를 추가
// 지금 유산균 앞에 떡볶이 넣을거야
FOODS.insertBefore(NEW_LI, SICK);
// 그럼 뒤에 기준노드는 id를 줘야하는건가?

// const ME = document.querySelector('ul li:nth-child(7)');
// FOODS.insertBefore(NEW_LI, ME); 
// 이렇게하면 객체가 이동하는 것
// 새로 추가되는 것이 아니라 참조하는 것과 비슷