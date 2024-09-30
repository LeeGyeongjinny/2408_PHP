<?

function my_board_file_upload(PDO $conn, array $arr_param) {
    $sql = 
        " INSERT INTO travel_boards( "
        ."      img_1 "
        ."      ,img_2 "
        ." ) "
        ." VALUES( "
        ."      :img_1 "
        ."      :img_2 "
        ." ) "
    ;

    $stmt = $conn->prepare($sql);
$result_flg = $stmt->execute($arr_param);

if(!$result_flg) {
    throw new Exception("쿼리 실행 실패");
}

$result_cnt = $stmt->rowCount();

if($result_cnt !== 1) {
    throw new Exception("Insert Count 이상");
}

return true;
}

