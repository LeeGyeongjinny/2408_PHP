<?php
// 구구단 만들기
// ***** 2단 *****
// 2 X 1 = 2
// ...

// for($i = 2; $i < 10; $i++) {
//     echo "***** ".$i."단 *****\n";
//     for ($z = 1; $z < 10; $z++) {
//         echo $i." X ".$z." = ".($i*$z)."\n";
//     }
//     echo "------------------\n";
// }

// // 수업
// $dan = 9;
// for($i = 2; $i <= $dan; $i++) {
//     echo "***** ".$i."단 *****\n";
//     for($z = 1; $z <= $dan; $z++) {
//         echo $i." X ".$z." = ".($i*$z)."\n";
//     }
// }

// ----------------혼자
// foreach 이용
// if문 쓰거나, 특정숫자 나오면 break, continue 이런거 넣을 수도 있음

// 별찍기

// $concat = "";
// for($i = 1; $i <= 5; $i++) {
//     for($z = 1; $z <= $i; $z++) {
//         $concat .= "*";
//         // break;
//     }
//     echo $concat."\n";
// }

// break 코멘트아웃 안하면
// *
// ***
// ******
// **********
// ***************
// -> i = 2일 때, z는 1, 2 까지 두번도니깐 이미 $concat = "*"인 상황에서 ** 두개 추가


// 수업때
// $concat = "";
// for($i = 1; $i <= 5; $i++) {
//     for($z = 1; $z <= $i; $z++) {
//         $concat .= "*";
//     }
//     $concat .= "\n";
// }
// echo $concat;

// 별 반대로 찍기

for($i = 1; $i <= 5; $i++) {
    for($z= 5 - $i; $z > 0; $z--) {
        echo " ";
    }
    for($k = 1; $k <= $i; $k++) {
        echo "*";
    }
    echo "\n";
}

$concat = "";
for($i = 1; $i <= 5; $i++) {
    for($z=  5 - $i; $z >0; $z--) {
        $concat .= " ";
    }
    for($k = 1; $k <= 5; $z++) {
        $concat .= "*";
    }
    $concat .= "\n";
}
echo $concat;

// 다이아몬드 해보자




// 백준 달팽이는 올라가고 싶다
// 지렁이가 나무에 낮에 +3cm, 밤에 -2cm되는데 총 10cm 올라가는데 걸리는 일수는?
// for문 이용
// 총 걸리는 날짜 x
// 높이 h

// h += 3
// h -= 2
// h = 10


// 1번
// $h = 0;
// $x = 1;
// for ($x = 1; $x < 10; $x++) {
//     if($h < 10) {
//         $h +=3;
//     }
//     if($h === 10) {
//         break;
//     } else {
//         $h -= 2;
//     }
// }

// 2번
// $h = 0;
// $x = 1;
// while ($h < 10) {
//     if($h < 10) {
//         $h +=3;
//     }
//     if($h === 10) {
//         break; // break만나면 루프 바로 종료
//     } else {
//         $h -= 2;
//     }
//     $x++;
// } 

// echo $x."일 걸림\n";
// echo $h."cm\n";

// 배열로 뻘짓 ----------------------------------------
// 3*$x -2*$y = 10;
// $x - $y = 1;

// $arr1 = [3, -2, 10];
// $arr2 = [1, -1, 1];
// $arr2_1 = [3*$arr2[0], 3*$arr2[1], 3*$arr2[2]];
// $arr_x = [$arr1[0]-$arr2_1[0], $arr1[1]-$arr2_1[1], $arr1[2]-$arr2_1[2]];
// $arr2_2 = [2*$arr_x[0], 2*$arr_x[1], 2*$arr_x[2]];
// $arr_y = [$arr1[0]+$arr2_2[0], $arr1[1]+$arr2_2[1], $arr1[2]+$arr2_2[2]];
// $arr1_1 = [$arr_y[0]/3, $arr_y[1]/3, $arr_y[2]/3];

// echo "X = ".$arr1_1[2].", Y = ".$arr_x[2]."\n";
// echo $arr1_1[2]."일 걸려 ".$arr1[2]."cm 도착!\n";

// 배열로 뻘짓 ----------------------------------------

// 가위바위보 만들기
// -> 999_tng2.php


// ----------------혼자

// ----------------------------------
// function
// 특정 기능을 담아 모듈화 한 다음에 코드중복을 줄이기 위해서 사용

// 두 수를 더해서 반환하는 함수
// function my_sum(int $num1, int $num2): int {
//     return $num1 + $num2;
// }
// // : int는 return에 대한 타입힌트 ⇒ 리턴타입
// // function 파라미터 int ⇒ 타입힌트

// echo my_sum(2, 3);
// echo "\n";

// time();

// // 파라미터의 디폴트 설정
// function my_sum2(int $num1, int $num2= 10): int {
//     return $num1 + $num2;
// }
// echo my_sum2(1, 3);
// echo "\n";
// echo my_sum2(1);

// ----------------------------------
// 예외처리
// 예외 또는 에러가 일어나면 프로그램 멈춤 -> 유저화면이 흰 화면 or 보여주면 안되는 것까지 보여질 수 있음
// try, catch문 이용

// Throwable $th -> 7버전 이상
// Exception $e -> 5버전 이하

// try {
//     // 처리하고자 하는 로직
//     // 5 / 0;
// } catch(Throwable $th) {
//     // 예외 발생시 할 처리
//     echo $th->getMessage();
// } finally {
//     // 예외의 발생 여부와 상관없이 항상 실행할 처리
//     echo "파이널리";
// }

// echo "처리 끝";

// try, catch 중복사용
// try {
//     echo "바깥쪽 try\n";
//     5 / 0;
    
//     try {
//         5 / 0 ;
//         echo "안쪽 try\n";
//     } catch(Throwable $th) {
//         echo "안쪽 catch\n";
//     }
// } catch(Throwable $th) {
//     echo "바깥쪽 catch\n";
// }

// ------------------------------
// 강제 예외 발생
// try {
//     throw new Exception("강제 예외 발생");

//     echo "try";
// } catch(Throwable $th) {
//     echo $th->getMessage();
// }

// ----------------------------
// casting 형변환
// $num = 1;
// var_dump((string)$num); // 형변환 -> 앞에 괄호하고 데이터타입 적어주면됨

