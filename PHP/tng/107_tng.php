<?php

// 나의 급여를 2500만원으로 변경해주세요

require_once("../Ex/my_db.php");
$conn = null;

try {
    $conn = my_db_conn();

    $conn->beginTransaction();
 
    // 현재 급여 update
    $sql = " UPDATE salaries "
            ." SET "
            ."      updated_at = NOW() "
            ."      ,end_at = DATE(NOW()) "
            ." WHERE "
            ."      sal_id = :sal_id";
    
    $arr_prepare = [
        "sal_id" => 990343
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    $result_cnt = $stmt->rowCount();

    if(!$result_flg) {
        echo new Exception("Update Query Error");
    }
    
    if($result_cnt !== 1) {
        echo new Exception("Update Count Error");
    }

    // ----------------------------------------------------
    // 2500만원으로 변경
    $sql = " INSERT INTO salaries( "
            ."          emp_id "
            ."          ,salary "
            ."          ,start_at "
            ." ) "
            ." VALUE( "
            ."          :emp_id "
            ."          ,:salary "
            ."          ,DATE(NOW()) "
            ." ) "
    ;
    $arr_prepare = [
        "emp_id" => 100016
        ,"salary" => 25000000
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    $result_cnt = $stmt->rowCount();

    if(!$result_flg) {
        echo new Exception("Insert Query Error");
    }

    if($result_cnt !== 1) {
        echo new Exception("Insert Count Error");
    }


    $conn->commit();
} catch (Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }

    echo $th->getMessage();
}