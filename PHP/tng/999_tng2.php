<?php

// 가위바위보 게임
// 게임 실행시, "가위", "바위", "보" 중 하나를 입력
// 컴퓨터는 랜덤으로 "가위", "바위", "보" 중 하나를 출력
// 결과를 출력
// 유저 : 가위
// 컴퓨터 : 바위
// 졌습니다. or 이겼습니다.



fscanf(STDIN, "%s\n", $input);

// echo $input*20;
$rsp = ["scissor", "rock", "paper"];
$randomKey = array_rand($rsp);
// $user = $input;
$com = $rsp[$randomKey];

// $input = "가위";
echo "유저 : ".$input."\n";
echo "컴퓨터 : ".$com."\n";

if ($input === "scissor") {
    if($com === "paper") {
        echo "이겼습니다.\n";
    } else if ($com === "rock") {
        echo "졌습니다.\n";
    } else {
        echo "비겼습니다.\n";
    }
}

if ($input === "rock") {
    if($com === "scissor") {
        echo "이겼습니다.\n";
    } else if ($com === "paper") {
        echo "졌습니다.\n";
    } else {
        echo "비겼습니다.\n";
    }
}

if ($input === "paper") {
    if($com === "rock") {
        echo "이겼습니다.\n";
    } else if ($com === "scissor") {
        echo "졌습니다.\n";
    } else {
        echo "비겼습니다.\n";
    }
}
