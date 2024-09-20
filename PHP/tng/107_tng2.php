<?php
require_once("../Ex/my_db.php");

// 3명의 신규 사원 정보를 employees에 추가해야한다.
// 하나라도 실패하면 전부 롤백

$data = [
    ["name" => "둘리", "birth" => "1986-01-01", "gender" => "M"]
    ,["name" => "희동이", "birth" => "1990-01-01", "gender" => "M"]
    ,["name" => "고길동", "birth" => "1968-01-01", "gender" => "M"]
];

$conn = null;

try {
    $conn = my_db_conn(); // 인스턴스화는 한번만 하면 됨
    
    $conn->beginTransaction(); // foreach 밖에 transaction하면 실패시 전부다 롤백한다
    // 실패한 사람 다른 곳에 저장하거나 빼려면 foreach안에도 try, catch 써줘야한다.
    // 복수의 데이터 루프
    foreach($data as $item) {
        $sql =
            " INSERT INTO employees( "
            ."      name "
            ."      ,birth "
            ."      ,gender "
            ."      ,hire_at "
            ." ) "
            ." VALUE( "
            ."      :name "
            ."      ,:birth "
            ."      ,:gender "
            ."      ,DATE(NOW()) "
            ." ) "
        ;
        $arr_prepare = [
            "name" => $item["name"]
            ,"birth" => $item["birth"]
            ,"gender" => $item["gender"]
        ];

        $stmt = $conn->prepare($sql);
        $result_flg = $stmt->execute($arr_prepare);

        if(!$result_flg) {
            throw new Throwable("Insert exec Error : salaries");
        }

        if($stmt->rowCount() !== 1) {
            throw new Throwable("Insert Row Count Error : salaries");
        }
    }
    
    // commit 
    $conn->commit();
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getMessage();
}