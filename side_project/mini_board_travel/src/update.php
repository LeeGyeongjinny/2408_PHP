<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        
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

        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
        $title = isset($_POST["title"]) ? (string)$_POST["title"] : "";
        $content = isset($_POST["content"]) ? (string)$_POST["content"] : "";
        $country = isset($_POST["country"]) ? (string)$_POST["country"] : "";
        $city = isset($_POST["city"]) ? (string)$_POST["city"] : "";
        $departure = isset($_POST["departure"]) ? $_POST["departure"] : "";
        $arrival = isset($_POST["arrival"]) ? $_POST["arrival"] : "";
        $companion = isset($_POST["companion"]) ? (string)$_POST["companion"] : "";
        $img_1 = $_FILES["upload_file1"];
        $img_2 = $_FILES["upload_file2"];


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
            ,"country" => $country
            ,"city" => $city
            ,"departure" => $departure
            ,"arrival" => $arrival
            ,"companion" => $companion
        ];

        if($img_1["name"] !== "" ) {
            $arr_prepare["img_1"] = my_save_img($_FILES["upload_file1"]);
        }
        
        if($img_2["name"] !== "" ) {
            $arr_prepare["img_2"] = my_save_img($_FILES["upload_file2"]);
        }
        
        my_board_update($conn, $arr_prepare);

        // commit
        $conn->commit();
        
        header("Location: /detail.php?id=".$id."&page=".$page);
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
    <link rel="stylesheet" href="./css/update.css">
    <title>Travel Update</title>
</head>
<body>
    <form action="/update.php" method="post" enctype="multipart/form-data">
        <header>
            <div class="head-title">
                <a href="/main.php"><h1>Travels<span>_수정</span></h1></a>
            </div>
            <div class="btn-header">
                <button type="submit" class="btn-top">확인</button>
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-top">취소</button></a>
            </div>
        </header>
        <main>
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <div class="main-board">
                <div class="main-board1">
                    <div >
                        <input type="text" name="title" value="<?php echo $result["title"] ?>" class="update-title">
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
                                <input type="date" name="departure" id="departure" max="2077-06-20" min="1995-10-21" value="<?php echo $result["departure"] ?>" class="update-info2">
                            </div>
                            <div class="update-info">
                                <label for="arrival" class="update-info1">도착</label>
                                <input type="date" name="arrival" id="arrival" max="2077-06-20" min="1995-10-21" value="<?php echo $result["arrival"] ?>" class="update-info2">
                            </div>
                            <div class="update-info">
                                <div class="update-info1">동행</div>
                                <input class="update-info2" name="companion" value="<?php echo $result["companion"] ?>">
                            </div>
                            <div class="update-info">
                                <div class="update-info1 update-date">작성일</div>
                                <div class="update-info2 update-date" name="created_at"><?php echo $result["created_at"] ?></div>
                            </div>
                        </div>
                        <div>
                            <div class="update-content-title">내용</div>
                            <div>
                                <textarea class="update-content" name="content"><?php echo $result["content"] ?></textarea>
                            </div>
                        </div>
                        <div class="update-right">
                            <div>
                                <div class="update-photo-title">사진</div>
                                <div class="update-photo">
                                    <img src="<?php echo $result["img_1"] ?>" alt="" class="info-image"  name="img_1">
                                    <input type="file" id="photo1" name="upload_file1">
                                </div>
                            </div>
                            <div>
                                <div class="update-photo-title">사진</div>
                                <div class="update-photo">
                                    <img src="<?php echo $result["img_2"] ?>" alt="" class="info-image"  name="img_2">
                                    <input type="file" id="photo2" name="upload_file2">
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