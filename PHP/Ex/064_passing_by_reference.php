<?php
// 책에 없음

// 값 복사(Value of Copy)
// $num1 = 100;
// $num2 = $num1;
// $num2 -= 50;

// echo $num1, $num2; // num1 = 100, num2 = 50

// // 참조전달(Passing By Reference)
// $num3 = 100;
// $num4 = &$num3;
// $num4 -= 50;

// echo $num3, $num4; // num3 = 50, num4 = 50

// echo "\n------------\n";

// function my_test($num) {
//     $num--;
//     echo "my_test() : ".$num."\n";
// }

// $num5 = 5;
// my_test($num5);
// echo $num5;

// --------------------------
// 스코프 : 변수나 함수의 유효 범위
// --------------------------

// 전역 스코프
$str = "전역 스코프"; // <?php 바로 밑에?

function my_scope1() {
    global $str;
    echo $str;
}

// my_scope1();
// echo "\n";

// 지역 스코프
function my_scope2() {
    $str2 = "my_scope2 영역";
    echo $str2;
}
// echo $str2;
// my_scope2();

for($i = 1; $i < 6; $i++) {
    $str3 = "for문";
}
echo $str3;
