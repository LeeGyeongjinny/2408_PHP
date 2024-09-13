<?php

require_once("./my_dp.php");


try {
    $conn =  my_db_conn(); // db설정 함수 연결하고 호출해주면 끝
    $id = 1;
    // Prepared Statement   // Prepared Statement 사용 -> sql injection 대응
    $sql = " SELECT "
            ."    * "
            ." FROM employees "
            ." WHERE  "
            ."    emp_id = :emp_id "
            ."    AND name = :name " // 추가
    ;
    $arr_prepare = [
        "emp_id" => $id
        ,"name" => "원성현"
    ]; // 이거 placeholder

    $stmt = $conn->prepare($sql); // DB 질의 준비
    $stmt->execute($arr_prepare); // 질의 실행
    $result = $stmt->fetchAll(); // 질의 결과 패치
} catch(Throwable $th) {
    echo $th->getMessage(); // 에러메시지 출력
}


print_r($result);