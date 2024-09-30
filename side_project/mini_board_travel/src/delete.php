<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리

        // --------------------
        // parameter 획득
        // --------------------

        // id 획득
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        // page 획득
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        // 단순 조회만 해서 변화 없음 -> transaction 안해도됨
        // ------------------------
        // 데이터 조회
        // ------------------------
        $arr_prepare = [
            "id" => $id
        ];

        // 데이터 조회
        $result = my_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리
        
        // --------------------
        // parameter 획득
        // --------------------
        // id 획득
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        // page는 어차피 1페이지로 갈거라 필요없음

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        // Transaction Start
        $conn->beginTransaction();
        
        $arr_prepare = [
            "id" => $id
        ];

        // 삭제 처리
        my_board_delete_id($conn, $arr_prepare);
        // $result = my_board_delete_id($conn, $arr_prepare);

        $conn->commit();
        

        // 리스트 페이지로 이동
        header("Location: /"); // / 루트로 가면 / 또는 /index.php 둘다 가능
        exit;
    }
    
} catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    require_once(MY_PATH_ERROR);
    exit;
}


?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/delete.css">
    <title>Travel Delete</title>
</head>
<body>
    <form action="/main.php" method="post">
        <header>
            <div class="head-title">
                <a href="/main.php"><h1>Travels<span>_삭제</span></h1></a>
            </div>
            <div class="btn-header">
                <a href="/main.php"><button class="btn-top btn-top-chk">확인</button></a>
                <a href="/detail.php"><button class="btn-top">취소</button></a>
            </div>
        </header>
        <main>
            <div class="main-board">
                <div class="main-board1">
                    <div class="delete-title">
                        <p><?php echo $result["title"] ?></p>
                    </div>
                </div>
                <div class="main-board2">
                    <div class="main-board-grid">
                        <div class="delete-left">
                            <div class="delete-info">
                                <div class="delete-info1">게시번호</div>
                                <div class="delete-info2"><?php echo $result["id"] ?></div>
                            </div>
                            <div class="delete-info">
                                <div class="delete-info1">국가</div>
                                <div class="delete-info2"><?php echo $result["country"] ?></div>
                            </div>
                            <div class="delete-info">
                                <div class="delete-info1">도시</div>
                                <div class="delete-info2"><?php echo $result["city"] ?></div>
                            </div>
                            <div class="delete-info">
                                <div class="delete-info1">출발</div>
                                <div class="delete-info2"><?php echo $result["departure"] ?></div>
                            </div>
                            <div class="delete-info">
                                <div class="delete-info1">도착</div>
                                <div class="delete-info2"><?php echo $result["arrival"] ?></div>
                            </div>
                            <div class="delete-info">
                                <div class="delete-info1">동행</div>
                                <div class="delete-info2"><?php echo $result["companion"] ?></div>
                            </div>
                            <div class="delete-info">
                                <div class="delete-info1">작성일</div>
                                <div class="delete-info2"><?php echo $result["created_at"] ?></div>
                            </div>
                            
                        </div>
                        <div>
                            <div class="delete-content-title">내용</div>
                            <div>
                                <textarea readonly class="delete-content"><?php echo $result["content"] ?></textarea>
                            </div>
                        </div>
                        <div class="delete-right">
                            <div>
                                <div class="delete-photo-title">사진</div>
                                <div class="delete-photo"><img src="<?php echo $result["img_1"] ?>" alt="" class="top-info-image"></div>
                            </div>
                            <div>
                                <div class="delete-photo-title">사진</div>
                                <div class="delete-photo">
                                    <img src="<?php echo $result["img_2"] ?>" alt="" class="bottom-info-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</body>