<?php
// 로또 번호 생성기
// 1. 1 - 45 번호가 있다.
// 2. 랜덤한 번호 6개를 출력한다.
//  2-1. 단, 번호는 중복되지 않는다.


$ran_num = range(1, 45);

for ($i = 1; $i <= 6; $i++) {
    
    $ran = array_rand($ran_num);
    echo $ran_num[$ran]." ";
    
    array_splice($ran_num,$ran,1);
}

// print_r(array_splice($ran_num, 0, 1));
// print_r($ran_num); 
// array_rand -- 배열안에서 하나 
// 이상의 임의 원소를 뽑아낸다 
// array_splice -- (배열명,제거할배열시작번호번호,제거할배열갯수); 시작번호는0번부터시작.
// array_flip -- 배열안의 모든 키를 각 키의 연관값으로 바꾼다.
// unset -- 해당 키의 요소를 삭제

echo "\n------------------------\n";

// array_flip 사용

$lotto = range(1, 45);
$random = array_rand(array_flip($lotto), 6);

echo implode("  ",$random);

echo "\n------------------------\n";

// unset 사용
$lotto = range(1, 45);

for ($i = 1; $i <= 6; $i++) {
    $ran = array_rand($lotto);
    echo $lotto[$ran]." ";

    unset($lotto[$ran]);
}

// 수업 - 내장함수 최대한 안 쓰고
$arr = []; // 숫자 1 - 45를 가지는 배열
$get_numbers = []; //  뽑은 숫자 저장용 배열

// 1 - 45의 값을 가지는 배열 생성
for($i = 1; $i <= 45; $i++) {
    $arr[$i -1 ] = $i;
}

// 숫자 6개 뽑는 자리
for($i = 0; $i < 6; $i++) {
    $random_num = random_int(0,44); // 랜덤 index 생성(배열의 index)
    $random_pick = $arr[$random_num]; // 랜덤 index의 해당 값을 획득

    // 이미 뽑은 숫자인지 체크 처리
    $is_set_flg = false; // 분기용 플래그 초기화
    // 이미 뽑은 숫자 배열 루프
    foreach($get_numbers as $val) {
        // 이미 뽑은 숫자이면 분기용 플래그 true
        if($val === $random_pick) {
            $is_set_flg = true;
        }
    }
}

// 수업 - 내장함수
$arr = range(1, 45); // 숫자 1 -45를 가지는 배열
$get_numbers = []; //  뽑은 숫자 저장용 배열

$random_key = array_rand($arr, 6); // 배열에서 랜덤한 키(6개) 획득

// 랜덤한 키를 루프
foreach($random_key as $val) {
    $get_numbers[] = $arr[$val]; // 키를 이용해서 값 삽입
}

echo implode(" ", $get_numbers); // 공백을 구분자로 배열을 스트링으로 출력