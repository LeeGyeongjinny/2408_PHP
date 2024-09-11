<?php
// foreach문 : 배열을 편하게 루프하기 위한 반복문
$arr = [1, 2, 3];
foreach($arr as $key => $val) {
    echo "key : ".$key.", value : ".$val."\n";
}
echo "-------------------\n";
// // for를 사용하여 배열을 반복하는 경우
$manIndex = count($arr) - 1;
for($i = 0; $i <= $manIndex; $i++) {
    echo "key : ".$i.", value : ".$arr[$i]."\n";
}

echo "-------------------\n";
for($i = 0; $i < count($arr); $i++) {
    echo "key : ".$i.", value : ".$arr[$i]."\n";
}
echo "-------------------\n";
// // 아래 arr2를 이용해서 구구단 2단을 찍어주세요.
$arr2 = [1, 2, 3, 4 ,5 ,6 ,7, 8, 9];
foreach($arr2 as $key => $val) {
    echo "2 X ".$val." = ".(2*$val)."\n";
}

// 연관배열의 경우
$arr3  = [
    "name" => "meerkat"
    ,"age" => 20
    ,"gender" => "M"
];

foreach($arr3 as $key => $val) {
    echo $key." : ".$val."\n";
}

$arr5 = [4, 2, 5, 6];
foreach($arr5 as $key => $val) {
    echo $val."\n";
}

$result = [
    ["id" => 1, "name" => "미어캣", "gender" => "M"]
    ,["id" => 2, "name" => "홍길동", "gender" => "M"]
    ,["id" => 3, "name" => "갑순이", "gender" => "F"]
];

foreach($result as $key => $item) {
    // $item = ["id" => 1, "name" => "미어캣", "gender" => "M"];
    echo $item["id"]."\n"; 
    echo $item["name"]."\n"; // 회원들의 이름만 가져옴
    if ($item["name"] === "갑순이" ) {
        echo $item["name"]."\n";
    }
}