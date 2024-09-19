<?php
// 나의 사원 정보를 입력(급여, 직급, 부서 정보 포함)

require_once("./my_db.php");

$conn = null;

try {
    $conn = my_db_conn();

    // Transaction
    $conn->beginTransaction();

    // 사원테이블 insert
    $sql = "INSERT INTO employees( "
            ."      name "
            ."      ,birth "
            ."      ,gender "
            ."      ,hire_at "
            ." ) "
            ." VALUES( "
            ."      :name "
            ."      ,:birth "
            ."      ,:gender "
            ."      ,DATE(NOW()) "
            ." ) "
    ;
    $arr_prepare = [
        "name"      => "이경진"
        ,"birth"    => "1995-10-21"
        ,"gender"   => "F"
    ];

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : employees");
    }

    // 영향받은 레코드 수 체크
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error : employees");
    }

    // insert한 pk 획득
    $emp_id = $conn->lastInsertId();

    // ----------------------------------------------------------
    // 급여테이블 insert
    $sql = "INSERT INTO salaries( "
            ."      emp_id "
            ."      ,salary "
            ."      ,start_at "
            ." ) "
            ." VALUES( "
            ."      :emp_id "
            ."      ,:salary "
            ."      ,DATE(NOW()) "
            ." ) "
    ;
    $arr_prepare = [
        "emp_id"     => $emp_id
        ,"salary"    => 520000000
    ];

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : salaries");
    }

    // 영향받은 레코드 수 예외 처리
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error : salaries");
    }

    // $emp_id = $conn->lastInsertId(); -> 이거 하면 방금 넣은 salaries의 pk를 가져오기 때문에 갱신하면 안됨

    // ----------------------------------------------------------
    // 사원직급테이블 insert
    $sql = "INSERT INTO title_emps( "
            ."      emp_id "
            ."      ,title_code "
            ."      ,start_at "
            ." ) "
            ." VALUES( "
            ."      :emp_id "
            ."      ,:title_code "
            ."      ,DATE(NOW()) "
            ." ) "
    ;
    $arr_prepare = [
        "emp_id"         => $emp_id
        ,"title_code"    => "T001"
    ];

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : title_emps");
    }

    // 영향받은 레코드 수 예외 처리
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error : title_emps");
    }

    // ----------------------------------------------------------
    // 소속부서테이블 insert
    $sql = "INSERT INTO department_emps( "
            ."      emp_id "
            ."      ,dept_code "
            ."      ,start_at "
            ." ) "
            ." VALUES( "
            ."      :emp_id "
            ."      ,:dept_code "
            ."      ,DATE(NOW()) "
            ." ) "
    ;
    $arr_prepare = [
        "emp_id"        => $emp_id
        ,"dept_code"    => "D001"
    ];

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : department_emps");
    }

    // 영향받은 레코드 수 예외 처리
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error : department_emps");
    }

    
    
    // commit
    $conn->commit();
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getMessage();
}