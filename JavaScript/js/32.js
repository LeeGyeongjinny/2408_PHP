// -------------------------
// String 객체
// -------------------------
let str = '문자열입니다.문자열입니다.';
let str2 = new String('문자열입니다.');

// 백틱 (`) 사용
let str3 = '문자' + '테스트' + str + '이었다.';
let str4 = `문자테스트${str}이었다.`;

// length
console.log(str.length); // 7


// charAt(idx)

// 해당 인덱스의 문자를 반환
console.log(str.charAt(2)); // 열
// console.log(str.charAt(100)); // idx 없는 값 넣어주면 ''
// console.log(str.charAt(-2)); // 음수 넣어주면 ''
// console.log(str.charAt()); // 아무 것도 안 넣어주면 첫번째 글자 나옴 -> 왜?


// indexOf()

// 문자열에서 해당 문자열을 찾아 최초의 인덱스를 반환
// 해당 문자열이 없으면 -1 리턴
console.log(str.indexOf('자열')); // 1 (검색된 문자열이 '첫번째'로 나타나는 위치)
console.log(str.indexOf('자열', 5)); // 8 (인덱스값 5인 위치부터 검색시작)


// includes()

// 문자열에서 해당 문자열의 존재 여부 체크
console.log(str.includes('문자')); // true
console.log(str.includes('php')); // false

let test = 'i am ironman';
console.log(test.includes('ir')); // true 단어로 찾는게 아니라 글자 하나하나 찾는다


// replace()

// 특정 문자열을 찾아서 첫번째 문자열만 지정한 문자열로 치환한 문자열을 반환
str = '문자열입니다.문자열입니다.';
console.log(str.replace('문자열', 'PHP')); // PHP입니다.문자열입니다.
console.log(str.replace('test', 'PHP')); // 없는 문자열일 경우 -> 원본


// replaceAll()

// 특정 문자열을 찾아서 모두 지정한 문자열로 치환한 문자열을 반환
console.log(str.replaceAll('문자열', 'PHP')); // PHP입니다.PHP입니다.
console.log(str.replaceAll('문자열', '')); // 입니다.입니다.


// substring(start, end)

// 시작 인덱스부터 종료 인덱스까지 자른 문자열을 반환
// endIndex는 생략시 startIndex부터 끝까지의 문자열을 반환

// ** 주의 : 비슷한 기능으로 String.substr()이 있으나 비표준이므로 사용을 지양할 것 **

str = '문자열입니다.문자열입니다.';
console.log(str.substring(1, 3)); // 자열

str = 'bearer: 34jkadfja;dkf3k23lkdlfa'; // bearer만 자르고 나머지 다 가져오고싶다
console.log(str.substring(8)); // 3의 index = 8


// split(separator, limit)

// 문자열을 separator 기준으로 잘라서 배열을 만들어 반환
// limit 생략가능
str = '짜장면,탕수육,라조기,짬뽕,볶음밥';
let arrSplit = str.split(','); // ['짜장면', '탕수육', '라조기', '짬뽕', '볶음밥']
// let arrSplit = str.split(',', 2); // ['짜장면', '탕수육']
// 뒤에 숫자 적어서 제한을 할 수도 있지만 일반적으로는 잘 사용하지 않음
// str = '짜장면, 탕수육, 라조기, 짬뽕, 볶음밥';
// let arrSplit = str.split(', '); // 띄어쓰기 되어있다면 ,뒤에 띄어쓰기해야한다
console.log(arrSplit);


// trim()

// 좌우 공백 제거해서 반환
str = '         아아아 배고프다.    ';
console.log(str.trim()); // 아아아 배고프다.


// toUpperCase(), toLowerCase()

// 알파벳을 대/소문자로 변환해서 반환
str = 'aBcDeFg';
console.log(str.toUpperCase()); // ABCDEFG
console.log(str.toLowerCase()); // abcdefg