<?php
function my_db_conn() {
    // DB 접속 정보
    $my_host = "localhost"; // DB host // 접속하려는 서버의 IP주소 (127.0.0.1 적어도 됨)
    $my_port = "3306";
    $my_user = "root"; // DB 계정명
    $my_password = "php504"; // DB 계정 비밀번호
    $my_db_name = "dbsample"; // 접속할 DB명
    $my_charset = "utf8mb4"; // DB Charset
    $my_dsn = "mysql:host=".$my_host.";port=".$my_port.";dbname=".$my_db_name.";charset=".$my_charset; // DSN
    
    // PDO 옵션 설정
    $my_otp = [
        // Prepared Statement로 쿼리를 준비할 때, PHP와 DB 어디에서 에뮬레이션 할지 여부를 결정
        PDO::ATTR_EMULATE_PREPARES       => false // DB에서 에뮬레이션 하도록 설정
        // PDO에서 예외를 처리하는 방식을 지정
        ,PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION
        // DB의 결과를 fetch하는 방식을 지정
        ,PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC // 연관배열로 fetch
    ];
    
    // DB 접속
    return new PDO($my_dsn, $my_user, $my_password, $my_otp);
    // 인스턴스화해서 객체로 리턴, $conn = my_db_conn 해서 리턴값을 담는 것
    // 처리한 결과를 return new PDO해서 PDO형태로 반환
}

// pdo를 생성해서 단지 전달만 해줌 어딘가에 담는게 아님
// 다른 파일에서 require_once해서 이 파일을 불러오고, $conn = 파라미터? 아니면 아규먼트? 해서 담는거
