// Promise 객체
// --------------------

function iAmSleep(flg) {
  return new Promise((resolve, reject) => {
    if(flg) {
      resolve('성공');
    } else {
      reject('실패');
    }
  });
}

iAmSleep(true)
.then(data => console.log(data))
.catch(error => console.error(error))
.finally(() => console.log('finally'));

// setTimeout(() => {
//   console.log('A')
//   setTimeout(() => {
//     console.log('B');
//     setTimeout(() => {
//       console.log('C')
//     }, 1000);
//   }, 2000);
// }, 3000);

// 프로미스 객체 생성
function iAmSleepy(str, ms){
  return new Promise((resolve) => {
    setTimeout(() => {
      console.log(str);
      resolve(); // reject 필요없어서 지웠음
    }, ms);
  })
}

iAmSleepy('A', 3000)
.then(() => iAmSleepy('B', 2000)) // resolve로 왔기 때문에 then에서 처리
.then(() => iAmSleepy('C',1000)); // 이어서 하고 싶은 처리는 계속 then연결해주면 된다 
// 동기처럼 보이게 제어하는 것이지 비동기처리를 동기처리로 바꾸는 것이 아니다

// A > C > B 출력
// iAmSleepy('A', 3000)
// .then(() => {
//   iAmSleepy('B', 2000);
//   iAmSleepy('C', 1000);
// });

// iAmSleepy('A', 3000)
// .then(
//   () => iAmSleepy('B', 2000)
//   .then(() => iAmSleepy('C',1000))
// ); // 이렇게해도 동작하지만 가독성이 너무 안좋아