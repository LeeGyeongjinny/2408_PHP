<?php

require_once("./my_db.php");

$conn = null;
// null값을 안주면 my_db_conn에서 에러있을때 $conn변수자체가 생성안됨 -> 바로 catch로 가서 null 체크-> $conn undefinced variable로 뜬다
// 여기까진 $conn = null (unintialized 상태)

try {
    // PDO Cass 인스턴스화
    $conn = my_db_conn();
    // my_db_conn이 먼저 실행되고 return하면 $conn에 PDO가 담긴다.

    $conn->beginTransaction(); // 트랜잭션 시작 (여기서 트랜잭션 시작해도 상관없다)

    $sql = " UPDATE employees "
            ." SET "
            ."      name = :name "
            ."      ,updated_at = NOW() "
            ." WHERE "
            ."      emp_id = :emp_id "
    ;

    $arr_prepare = [
        "name" => "갑순이"
        ,"emp_id" => 100001
    ];

    // $conn->beginTransaction(); // 트랜잭션 시작

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 반환

    if(!$result_flg) {
        throw new Exception("쿼리 실행 예외 발생");
    }

    if($result_cnt !== 1) {
        throw new Exception("수정 레코드 수 이상");
    }

    $conn->commit(); // 커밋 처리
    
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollback();
    } // null이 아니면 롤백
    // 이까지 왔으면 이미 에러났기 때문에 초기화상태로 돌려야한다는 말인감
    echo $th->getMessage();
}
