<?php


// if($food === "떡복이") {
//     echo "한식";
// } else if ($food === "짜장면") {
//     echo "중식";
// } else if ($food === "햄버거") {
//     echo "양식";
// }

// switch문
$food = "짬뽕";
switch($food) {
    case "떡볶이":
        echo "한식";
        break; // break 생략시 다음 처리도 계속 이어간다.
    case "짜장면":
    case "짬뽕":
        echo "중식";
        break;
    case "햄버거":
        echo "양식";
        break;
    default:
        echo "맛있음";
        break;
}
echo "\n";

// switch를 이용하여 작성
// 1등이면 금상, 2등이면 은상, 3등이면 동상, 4등이면 장려상, 그 외는 노력상
// 을 출력해주세요.

$rank = 2;
$subject = "수학";
switch($subject) {
    case "수학":
        switch($rank) {
            case 1:
                echo "금상\n";
                break;
            case 2:
                echo "은상\n";
                break;
            case 3:
                echo "동상\n";
                break;
            case 4:
                echo "장려상\n";
                break;
            default:
                echo "노력상\n";
                break;
        }
        break;
    case "과학";
        break;
}