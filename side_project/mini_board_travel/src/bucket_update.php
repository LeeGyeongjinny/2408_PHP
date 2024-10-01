<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        
        $id = isset($_GET["bkl_id"]) ? (int)$_GET["bkl_id"] : 0;
        
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
            "bkl_id" => $id
        ];

        $result = my_bucket_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리
        
        // --------------------
        // parameter 획득
        // --------------------

        $id = isset($_POST["bkl_id"]) ? (int)$_POST["bkl_id"] : 0;
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
        $title = isset($_POST["title"]) ? (string)$_POST["title"] : "";
        $bucket_content = isset($_POST["bucket_content"]) ? (string)$_POST["bucket_content"] : "";
        
        $country = isset($_POST["country"]) ? (string)$_POST["country"] : "";
        $sort = isset($_POST["sort"]) ? (string)$_POST["sort"] : "";
        $info_content = isset($_POST["info_content"]) ? (string)$_POST["info_content"] : "";
        $info_img = $_FILES["info_img_upload"];

        // var_dump($id);
        // var_dump($title);
        // var_dump($info_img);
        // exit;

        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류임");
        }

        // PDO Instance
        $conn = my_db_conn();

        // Transaction Start
        $conn->beginTransaction();

        $arr_prepare = [
            "bkl_id" => $id
            ,"title" => $title
            ,"bucket_content" => $bucket_content
            ,"country" => $country
            ,"sort" => $sort
            ,"info_content" => $info_content
        ];


        if($info_img["name"] !== "") {
            $arr_prepare["info_img"] =  my_save_img($_FILES["info_img"]);
        }
        
        my_bucket_board_update($conn, $arr_prepare);


        // commit
        $conn->commit();
        
        header("Location: /bucket_detail.php?bkl_id=".$id."&page=".$page);
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
    <link rel="stylesheet" href="./css/bucket_update.css">
    <title>Bucket List Update</title>
</head>
<body>
    <form action="/bucket_update.php" method="post" enctype="multipart/form-data">
        <header>
            <div class="head-title">
                <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트 수정</span></h1></a>
            </div>
            <div class="btn-header">
                <button type="submit" class="btn-top">확인</button>
                <a href="/bucket_detail.php?bkl_id=<?php echo $result["bkl_id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-top">취소</button></a>
            </div>
        </header>
        <input type="hidden" name="bkl_id" value="<?php echo $result["bkl_id"] ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <div class="bucket-update">
            <div class="update-board">
                <div class="update-left">
                    <div>
                        <div>
                            <input type="text" name="title" required class="update-title" value="<?php echo $result["title"] ?>">
                        </div>
                        <div>
                            <textarea name="bucketlist" id="bucketlist" class="update-content"><?php echo $result["bucket_content"] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="update-right">
                    <div class="right-top">
                        <div class="right-top-align">
                            <label for="country" class="top-left">국가</label>
                            <input  name="country" id="country" class="top-right" value="<?php echo $result["country"] ?>" required>
                        </div>
                        <div class="right-top-align">
                            <div class="top-left">분류</div>
                            <div class="top-right">
                                <div name="sort" id="sort" class="top-right">
                                    <?php echo $result["sort"] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-bottom">
                        <div class="bottom-info">
                            <div>정보</div>
                        </div>
                        <div class="bottom-content">
                            <img src="<?php echo $result["info_img"] ?>" alt="" class="bottom-info-image" name="info_img">
                            <input type="file" id="photo" name="info_img_upload" >
                            <textarea name="botton-content-info" id="botton-content-info" class="bottom-content2" value="<?php echo $result["info_content"] ?>"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>