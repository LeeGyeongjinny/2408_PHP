<?php

$data = [
    "name" => "둘리"
    // ,"gender" => "M"
    ,"birth" => "1986-01-01"
];

$sql =
    " SELECT * "
    ." FROM employees "
;

$where = "";
$arr_prepare = [];

foreach($data as $key => $val) {
    // where절 작성
    if(empty($where)) {
        $where .= " WHERE ";
    } else {
        $where .= " AND ";
    }
    $where .= " ".$key." = :".$key;

    // prepared statement 작성
    $arr_prepare[$key] = $val;
}
$sql .= $where;
// $sql = $sql.$where; 문자열 합친거라 이거 축약한 버전
// echo $sql."\n";

// print_r($arr_prepare);

// 이 정도는 에러날 상황이 딱히 없어서 try, catch 안 넣어줘도 된다
//
require_once("./my_db.php");
$conn = my_db_conn();

$stmt = $conn->prepare($sql);
$stmt->execute($arr_prepare);

print_r($stmt->fetchAll());