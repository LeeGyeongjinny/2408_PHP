<?php

// 나의 급여를 2500만원으로 변경해주세요

// 내꺼
// require_once("../Ex/my_db.php");
// $conn = null;

// try {
//     $conn = my_db_conn();

//     $conn->beginTransaction();

//     // 현재 급여 update
//     $sql = " UPDATE salaries "
//             ." SET "
//             ."      updated_at = NOW() "
//             ."      ,end_at = DATE(NOW()) "
//             ." WHERE "
//             ."      sal_id = :sal_id";
    
//     $arr_prepare = [
//         "sal_id" => 990343
//     ];

//     $stmt = $conn->prepare($sql);
//     $result_flg = $stmt->execute($arr_prepare);
//     $result_cnt = $stmt->rowCount();

//     if(!$result_flg) {
//         echo new Exception("Update Query Error");
//     }
    
//     if($result_cnt !== 1) {
//         echo new Exception("Update Count Error");
//     }

//     // ----------------------------------------------------
//     // 2500만원으로 변경
//     $sql = " INSERT INTO salaries( "
//             ."          emp_id "
//             ."          ,salary "
//             ."          ,start_at "
//             ." ) "
//             ." VALUE( "
//             ."          :emp_id "
//             ."          ,:salary "
//             ."          ,DATE(NOW()) "
//             ." ) "
//     ;
//     $arr_prepare = [
//         "emp_id" => 100016
//         ,"salary" => 25000000
//     ];

//     $stmt = $conn->prepare($sql);
//     $result_flg = $stmt->execute($arr_prepare);
//     $result_cnt = $stmt->rowCount();

//     if(!$result_flg) {
//         echo new Exception("Insert Query Error");
//     }

//     if($result_cnt !== 1) {
//         echo new Exception("Insert Count Error");
//     }


//     $conn->commit();
// } catch (Throwable $th) {
//     if(!is_null($conn)) {
//         $conn->rollBack();
//     }

//     echo $th->getMessage();
// }

// --------------------------------------------------------
// 수업
require_once("../Ex/my_db.php");

$conn = null;

try {
    $conn = my_db_conn();

    // transaction 시작
    $conn->beginTransaction();

    // ---------------------------
    // 기존 급여 수정
    $sql =
        " UPDATE salaries "
        ." SET "
        ."      end_at = DATE(NOW()) "
        ."      ,updated_at = NOW() "
        ." WHERE "
        ."      emp_id = :emp_id "
        ."  AND end_at is NULL "
    ;
    // :emp_id -> :은 prepared statement로 세팅하겠다는소리

    $arr_prepare = [
        "emp_id" => 100016
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    // $result_cnt = $stmt->rowCount(); // 이거 한번밖에 안쓰기 때문에 보통은 변수로 안하고 바로 if문에 작성

    if(!$result_flg) {
        throw new Throwable("Update exec Error : salaries");
    }

    if($stmt->rowCount() !== 1) {
        throw new Throwable("Update Row Count Error : salaries");
    } // $result_cnt 변수안주고 바로 쓰기

    // ---------------------------
    // 새로운 급여 이력 추가
    $sql =
        " INSERT INTO salaries( "
        ."          emp_id "
        ."          ,salary "
        ."          ,start_at "
        ." ) "
        ." VALUES( "
        ."        :emp_id "
        ."        ,:salary "
        ."        ,DATE(NOW()) "
        ." ) "
    ;
    $arr_prepare = [
        "emp_id" => 100016
        ,"salary" => 25000000
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);

    if(!$result_flg) {
        throw new Throwable("Insert exec Error : salaries");
    }

    if($stmt->rowCount() !== 1) {
        throw new Throwable("Insert Row Count Error : salaries");
    }

    // commit
    $conn->commit();
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();

        echo $th->getMessage();
    }
}
