<?php

// // ------------
// // PDO Class : DB 엑세스 방법 중 하나

// // DB 접속 정보
// $my_host = "localhost"; // DB host // 접속하려는 서버의 IP주소 (127.0.0.1 적어도 됨)
// $my_user = "root"; // DB 계정명
// $my_password = "php504"; // DB 계정 비밀번호
// $my_db_name = "dbsample"; // 접속할 DB명
// $my_charset = "utf8mb4"; // DB Charset
// $my_dsn = "mysql:host=".$my_host.";dbname=".$my_db_name.";charset=".$my_charset; // DSN

// // PDO 옵션 설정
// $my_otp = [
//     // Prepared Statement로 쿼리를 준비할 때, PHP와 DB 어디에서 에뮬레이션 할지 여부를 결정
//     PDO::ATTR_EMULATE_PREPARES       => false // DB에서 에뮬레이션 하도록 설정
//     // PDO에서 예외를 처리하는 방식을 지정
//     ,PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION
//     // DB의 결과를 fetch하는 방식을 지정
//     ,PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC // 연관배열로 fetch
// ];

// // DB 접속
// $conn = new PDO($my_dsn, $my_user, $my_password, $my_otp); // 이렇게하면 DB 접속됨

// // select
// $sql = "SELECT *
//         FROM employees
//         ORDER BY emp_id ASC
//         LIMIT 5";

// $stmt = $conn->query($sql); // PDO::query() : 쿼리 준비 + 실행
// $result = $stmt->fetchAll(); // 질의 결과를 패치
// print_r($result);

// // 사번과 이름만 출력
// foreach($result as $item) {
//     echo $item["emp_id"]." ".$item["name"]."\n";
// }

// // public function query($sql) {
// //     // db에 질의 처리

// //     return new PDOStatement();

// DB 정보
$my_host = "localhost"; //host
$my_port = "3306"; // port
$my_user = "root"; // user
$my_password = "php504"; // password
$my_db_name = "dbsample"; // DB name
$my_charset = "utf8mb4"; // charset // 컴퓨터가 어떻게 글자를 인식할 것인가

// DSN
// $my_dsn = "mysql:host=".$my_host.";port=".$my_port.";dbname=".$my_db_name.";charset=".$my_charset; // del v001(이 버전때 삭제)
$my_dsn = "mysql:host=".$my_host.";port=".$my_port.";dbname=".$my_db_name.";charset=".$my_charset; // add v002 (이 버전때 추가)
// 소스코드 수정할 때 이전 코드를 삭제하는 것이 아니라 코멘트아웃해서 이전 소스를 남겨둬야 한다

// PDO option
$my_option = [
    // Prepared Statement의 에뮬레이션 설정
    PDO::ATTR_EMULATE_PREPARES          => false // false : php가 아니라 데이터베이스에서 에뮬레이션 할거다
    // 예외 발생시, 예외 처리 방법 설정
    ,PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION
    // Fetch할 때 데이터 타입 설정
    ,PDO::ATTR_DEFAULT_FETCH_MODE       => PDO::FETCH_ASSOC // 연관배열(pure php) 또는 class(객체지향)
];

// PDO Class 인스턴스
$conn = new PDO($my_dsn, $my_user, $my_password, $my_option); // option은 넣어도되고 안넣어도되고지만 우리는 미리 넣어둔다
// PDO가 하나의 class라서 인스턴스 해야한다.


// select
// $sql = "SELECT"
//         ." * "
//         ." FROM "
//         ."      employees "
//         ." LIMIT 3 "
//         ; // 앞 뒤에 공백 필수

// $stmt = $conn->query($sql); // 쿼리 실행
// $result = $stmt->fetchAll(); // 결과 result // 연관배열로 배열 바꿈

// print_r($result);

// select 예제
// prepared statement 사용 emp_id = 100001, 100002 출력하기
$sql = " SELECT "
        ." * "
        ." FROM "
        ."      employees "
        ." WHERE "
        ."      emp_id = :emp_id1 " // 보통 :컬럼명인데 2개 이상 불러올때는 숫자를 붙여 이름을 지어줄 수 있다
        ."   OR emp_id = :emp_id2 " // 여러개 뽑을 거면 개수만큼 숫자 달아주고 $prepare에도 차례대로 적으면 된다
;
$prepare = [
    "emp_id1" => 10001
    ,"emp_id2" => 10002
];

$stmt = $conn->prepare($sql); // 쿼리 준비
$stmt->execute($prepare); // 쿼리 진행
$result = $stmt->fetchAll(); // 결과 fetch


print_r($result);