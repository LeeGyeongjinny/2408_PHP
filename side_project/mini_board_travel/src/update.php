<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        
        // id 획득
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        
        // page 획득
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

        if($id < 1) {
            throw new Exception("파라미터 오류인가");
        }
        
        
        // PDO Instance
        $conn = my_db_conn();
        
         // ------------------------
        // 데이터 조회
        // ------------------------
        $arr_prepare = [
            "id" => $id
        ];

        $result = my_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리
        
        // --------------------
        // parameter 획득
        // --------------------
        // id 획득
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        // page 획득
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
        // title 획득
        $title = isset($_POST["title"]) ? (string)$_POST["title"] : "";
        // content 획득
        $content = isset($_POST["content"]) ? (string)$_POST["content"] : "";

        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류임");
        }

        // PDO Instance
        $conn = my_db_conn();

        // Transaction Start
        $conn->beginTransaction();

        $arr_prepare = [
            "id" => $id
            ,"title" => $title
            ,"content" => $content
        ];

        my_board_update($conn, $arr_prepare);
        // $result = my_board_update($conn, $arr_prepare); 리턴값이 딱히 필요없다?

        // commit
        $conn->commit();
        
        // detail page로 이동
        header("Location: /detail.php?id=".$id."&page=".$page);
        exit; // 안써도 되지만 불필요한 리소스 실행방지를 위해 씀
    }
    

} catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    // transaction이 시작되어야 rollback가능
    // transaction전 에러는 rollback 어떻게 하나
    // inTransaction transaction이 시작됐을때 rollback
    // if문 안에 순서 바뀌면 안됨 (앞에 있는거 체크하고 뒤에 있는거 체크하는 순서라)

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
    <link rel="stylesheet" href="./css/update.css">
    <title>Travel Update</title>
</head>
<body>
    <form action="/detail.php" method="post">
        <header>
            <div class="head-title">
                <a href="/main.php"><h1>Travels<span>_수정</span></h1></a>
            </div>
            <div class="btn-header">
                <a href="/detail.php"><button class="btn-top">확인</button></a>
                <a href="/detail.php"><button class="btn-top">취소</button></a>
            </div>
        </header>
        <main>
            <div class="main-board">
                <div class="main-board1">
                    <div class="update-title">
                        <input type="text" value="<?php echo $result["title"] ?>">
                    </div>
                </div>
                <div class="main-board2">
                    <div class="main-board-grid">
                        <div class="update-left">
                            <div class="update-info">
                                <div class="update-info1">게시번호</div>
                                <div class="update-info2"><?php echo $result["id"] ?></div>
                            </div>
                            <div class="update-info">
                                <label for="country" class="update-info1">국가</label>
                                <input name="country" id="country" class="update-info2" value="<?php echo $result["country"] ?>" required>
                            </div>
                            <div class="update-info">
                                <label for="city" class="update-info1">도시</label>
                                <input name="city" id="city" class="update-info2" required value="<?php echo $result["city"] ?>" required>
                            </div>
                            <div class="update-info">
                                <label for="departure" class="update-info1">출발</label>
                                <input type="date" id="departure" max="2077-06-20" min="1995-10-21" value="<?php echo $result["departure"] ?>" class="update-info2">
                            </div>
                            <div class="update-info">
                                <label for="arrival" class="update-info1">도착</label>
                                <input type="date" id="arrival" max="2077-06-20" min="1995-10-21" value="<?php echo $result["arrival"] ?>" class="update-info2">
                            </div>
                            <div class="update-info">
                                <div class="update-info1">동행</div>
                                <div class="update-info2"><?php echo $result["companion"] ?></div>
                            </div>
                            <div class="update-info">
                                <div class="update-info1">작성일</div>
                                <div class="update-info2"><?php echo $result["created_at"] ?></div>
                            </div>
                        </div>
                        <div>
                            <div class="update-content-title">내용</div>
                            <div>
                                <textarea class="update-content"><?php echo $result["content"] ?></textarea>
                            </div>
                        </div>
                        <div class="update-right">
                            <div>
                                <div class="update-photo-title">사진</div>
                                <div class="update-photo"><img src="<?php echo $result["img_1"] ?>" alt="" class="top-info-image"></div>
                            </div>
                            <div>
                                <div class="update-photo-title">사진</div>
                                <div class="update-photo">
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
</html>