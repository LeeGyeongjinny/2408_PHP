<?php
require_once("./my_db.php");

$conn = null; // conn 초기화
// conn에 담길 데이터타입은 object -> 초기화는 null로 한다

try {
    $conn = my_db_conn(); // ctrl + 좌클릭 : 해당 파일로 넘어감

    // sql
    $sql = " INSERT INTO employees("
            ."      name "
            ."      ,birth "
            ."      ,gender "
            ."      ,hire_at "
            ." ) "
            ." VALUES( "
            ."      :name " // :뒤에 띄어쓰기 안됨
            ."      ,:birth "
            ."      ,:gender "
            ."      ,DATE(now()) " // 그냥 현재시간 바로 넣음
            ." ) "
    ;
    $arr_prepare = [
        "name"       => "강아지" // "name " 이렇게 하면 컬럼명을 name뒤에 스페이스까지 인식함
        ,"birth"     => "2000-01-01"
        ,"gender"    => "M"
    ];

    // transaction 시작
    $conn->beginTransaction();  // 얘는 반드시 필요하다... 예외처리...

    $stmt = $conn->prepare($sql); // 쿼리 준비
    // $stmt->execute($arr_prepare);
    $exec_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    // $exec_flg 값 : 실행 성공하면 true, 실패하면 false
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수를 반환


    // 쿼리 실행 예외 처리
    if(!$exec_flg) {
        throw new Exception("execute 예외 발생", "1"); // 강제로 예외 발생
    } // !exec_flg = 쿼리 실패 

    // $result_cnt=0;
    // 영향받은 레코드 수 이상
    if($result_cnt !== 1) {
        throw new Exception("레코드 수 이상", "2"); // 강제로 예외 발생
    }

    // commit 처리
    $conn->commit();
} catch(Throwable $th) {
    // PDO 인스턴스화 됐는지 확인
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getCode()." ".$th->getMessage();
}



// transaction이 뭐냐 - 면접단골문제
// 처리할 작업을 하나의 단위로 묶어서 하나라도 오류가 있으면 rollback, 오류가 없으면 commit
// db에만 국한되는 것이 아님