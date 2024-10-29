// -------------------------
// Date 객체
// -------------------------

const dayToKorean = day => {
  // 배열 사용하기
  const ARR_DAY = ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'];
  return ARR_DAY[day];


  // switch(day){
  //   case 0:
  //     return '일요일';
  //     // break; 이건 return을 하니까 필요없다 
  //   case 1:
  //     return '월요일';
  //   case 2:
  //     return '화요일';
  //   case 3:
  //     return '수요일';
  //   case 4:
  //     return '목요일';
  //   case 5:
  //     return '금요일';
  //   default:
  //     return '토요일';
  // }
}

const addLPadZero = (num, length) => {
  return String(num).padStart(length,'0');
}



// 현재 날짜 및 시간 획득
const NOW = new Date();
// const NOW = new Date('2024-01-01 01:01:01.001');
// 2024-1-1 1:1:1.1,월요일 앞에 0이 안붙어

// getFllYear()

// 연도만 가져오는 메소드 (YYYY)
const YEAR = NOW.getFullYear(); // 2024
// NOW.getYear() // 124 -> 이전 버전이라 지금 쓰면 버그생김 연도 뒷자리 2개만 가져오는 방식

// getMonth()

// 월을 가져오는 메소드, 0 - 11 반환
// const MONTH = NOW.getMonth() + 1; // 10
// const MONTH = String(NOW.getMonth() + 1).padStart(2, '0'); 
// 함수안쓰고 직접 입력 -> 이러면 하나하나 다입력해줘야하니깐 함수 만들자 (addLpadZero)
const MONTH = addLPadZero(NOW.getMonth() + 1, 2); // 이렇게 하면 1(숫자)월 같은 경우 '01'월로 문자열로 반환

// getDate()

// 일을 가져오는 메소드
// const DATE = NOW.getDate(); // 29
const DATE = addLPadZero(NOW.getDate(), 2);

// getHours()

// 시를 가져오는 메소드
// const HOUR = NOW.getHours(); // 12
const HOUR = addLPadZero(NOW.getHours(), 2);

// getMinutes()

// 분을 가져오는 메소드
// const MINUTES = NOW.getMinutes(); // 32
const MINUTES = addLPadZero(NOW.getMinutes(), 2);

// getSeconds()

// 초를 가져오는 메소드
// const SECONDS = NOW.getSeconds(); // 31
const SECONDS = addLPadZero(NOW.getSeconds(), 2);

// getMilliseconds()

// 미리초를 가져오는 메소드
// const MILLLISECONDS = NOW.getMilliseconds(); // 181
const MILLLISECONDS = addLPadZero(NOW.getMilliseconds(), 3);

// getDay()

// 요일을 가져오는 메소드, 0(일) - 6(토) 리턴
const DAY = NOW.getDay(); // 2 = 화요일

// TOTAL DATE
const FORMAT_DATE = `${YEAR}-${MONTH}-${DATE} ${HOUR}:${MINUTES}:${SECONDS}.${MILLLISECONDS},${dayToKorean(DAY)}`; // '2024-10-29 12:32:31.181,화요일'
console.log(FORMAT_DATE);

// getTime()

// UNIX Timestamp를 반환 (미리초 단위)

console.log(NOW.getTime());

// 두 날짜의 차를 구하는 방법
const TARGET_DATE = new Date('2025-03-13 18:10:00');
const DIFF_DATE = Math.floor(Math.abs(NOW - TARGET_DATE) / 86400000); // 135

// Math.abs() : 절댓값
// 1000 * 60 * 60 * 24 = 86400000
// 올림 -> 오늘 포함, 버림 -> 오늘 미포함



// 2024-01-01 13:00:00 과 2025-05-30 00:00:00은 몇개월 후 입니까?

const TARGET_DATE2 = new Date('2024-01-01 13:00:00');
const TARGET_DATE3 = new Date('2025-05-30 00:00:00');

const DIFF_DATE2 = Math.floor(Math.abs(TARGET_DATE2 - TARGET_DATE3) / 2592000000); // 17
// 86400000 * 30일 = 2592000000


// const DIFF_DATE3 = Math.floor(Math.abs(TARGET_DATE2 - TARGET_DATE3) / 86400000); // 514



// 디데이 설정

const TARGET_DATE4 = new Date('2024-11-01 00:00:00');

const D_DAY = Math.floor(Math.floor(Math.abs(NOW - TARGET_DATE4)) / 86400000);
console.log(D_DAY);

if(D_DAY < 10){
  console.log('기한 임박');
}else{
  console.log('널널쓰');
}


// if(contains(format(dateBetween(prop("종료일"), now(), "days")), "-"), "기한 경과", if(equal(formatDate(prop("종료일"), "YYMMDD"), formatDate(now(), "YYMMDD")), "D-day", "D-" + format(abs(dateBetween(prop("종료일"), now(), "days")) + 1)))

const dayToKor = day => {
  if (day === 0){
    return '일요일';
  } else if(day === 1){
    return '월요일';
  } else if(day === 2){
    return '화요일';
  }  else if(day === 3){
    return '수요일';
  }  else if(day === 4){
    return '목요일';
  }  else if(day === 5){
    return '금요일';
  } else{
    return '토요일';
  }
}

const addZero = (num, length) => {
  return String(num).padStart(lenghth, '0');
}


const NOW1 = new Date();

const YEARR = NOW1.getFullYear();
// const MONTHH = NOW1.getMonth() + 1;
// const DATEE = NOW1.getDate();

// const HOURR = NOW1.getHours();
// const MINUTESS = NOW1.getMinutes();
// const SECONDSS = NOW1.getSeconds();
// const MILLISECONDSS = NOW1.getMilliseconds();

const MONTHH = addZero(NOW1.getMonth() + 1, 2);
const DATEE = addZero(NOW1.getDate() + 1, 2);
const HOURR = addZero(NOW1.getHours() + 1, 2);
const MINUTESS = addZero(NOW1.getMinutes() + 1, 2);
const SECONDSS = addZero(NOW1.getSeconds() + 1, 2);
const MILLISECONDSS = addZero(NOW1.getMilliseconds() + 1, 2);


const DAYY = NOW.getDay();

const MY_DATE = `${YEARR}-${MONTHH}-${DATEE} & ${HOURR}:${MINUTESS}:${SECONDSS}.${MILLISECONDSS} ${dayToKor(DAY)}`;

console.log(MY_DATE);

