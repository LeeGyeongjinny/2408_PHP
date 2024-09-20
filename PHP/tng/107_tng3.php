<?php
require_once("../Ex/my_db.php");

// 3명의 신규 사원 정보를 employees에 추가해야한다.
// 성공한건 삽입되고, 실패한 것만 안들어가게

$data = [
    ["name" => "둘리", "birth" => "1986-01-01", "gender" => "M"]
    ,["name" => "희동이", "birth" => "희동이생일", "gender" => "M"]
    ,["name" => "고길동", "birth" => "1968-01-01", "gender" => "M"]
];

$conn = null;

try {
    $conn = my_db_conn();

    foreach($data as $item) {
        try {
            // transaction
            $conn->beginTransaction();

            // --------------------------
            // 새로운 사원 정보 삽입

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

            // commit
            $conn->commit();
        } catch(Throwable $th) {
            if(!is_null($conn)) {
                $conn->rollBack();
            } // 이까지오면 null이 아닐텐데 혹시 모르니깐 그냥 넣음
            echo "안쪽 try문 : ".$th->getMessage();

        }
    }

} catch(Throwable $th) {
    echo "바깥쪽 try문 : ".$th->getMessage();
}