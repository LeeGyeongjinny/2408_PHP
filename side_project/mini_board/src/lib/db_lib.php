<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");

function my_db_conn() {
    $option = [
        PDO::ATTR_EMULATE_PREPARES       => false
        ,PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION
        ,PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
    ];

    return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
}


/* 
    board select 페이지네이션
*/
function my_board_select_pagination(PDO $conn, array $arr_param) {
    // SQL
    $sql =
        " SELECT "
        ."    * "
        ." FROM "
        ."    board "
        ." ORDER BY "
        ."    created_at DESC " // 최신순 정렬
        ."    ,id DESC "
        ." LIMIT :list_cnt OFFSET :offset "
    ;

    // prepared setting은 index에 있어야 한다

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
    throw new Exception("쿼리 실행 실패");
    }
    // 여기서 오류나는거는 제일 처음 만나는 try,catch로 보내서 오류알려줌

    return $stmt->fetchAll();
}