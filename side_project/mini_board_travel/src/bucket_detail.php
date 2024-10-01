<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);



$conn = null;

try {

    $id = isset($_GET["bkl_id"]) ? (int)$_GET["bkl_id"] : 0;

    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

    
    if($id < 1) {
        throw new Exception("파라미터 오류인가");
    }

    // PDO Instance
    $conn = my_db_conn();

    $arr_prepare = [
        "bkl_id" => $id
    ];

    $result = my_bucket_board_select_id($conn, $arr_prepare);

} catch(Throwable $th) {
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
    <link rel="stylesheet" href="./css/bucket_detail.css">
    <title>Bucket List Detail</title>
</head>
<body>

        <header>
            <div class="head-title">
                <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트 상세</span></h1></a>
            </div>
            <div class="btn-header">
                <a href="/bucket_update.php?bkl_id=<?php echo $result["bkl_id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-top">수정</button></a>
                <a href="/bucketlist.php"><button class="btn-top">취소</button></a>
                <a href="/bucket_delete.php?bkl_id=<?php echo $result["bkl_id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-top">삭제</button></a>
            </div>
        </header>
        <div class="bucket-detail">
            <div class="detail-board">
                <div class="detail-left">
                    <div>
                        <div class="detail-title">
                            <div><?php echo $result["title"] ?></div>
                        </div>
                        <div>
                            <textarea readonly name="bucketlist" id="bucketlist"  class="detail-content"><?php echo $result["bucket_content"] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="detail-right">
                    <div class="right-top">
                        <div class="right-top-align">
                            <label for="country" class="top-left">국가</label>
                            <div name="country" id="country" class="top-right"><?php echo $result["country"] ?></div>
                        </div>
                        <div class="right-top-align">
                            <label for="sort" class="top-left">분류</label>
                            <div name="sort" id="sort" class="top-right">
                                <?php echo $result["sort"] ?>
                            </div>
                        </div>
                    </div>
                    <div class="right-bottom">
                        <div class="bottom-info">
                            <div>정보</div>
                        </div>
                        <div class="right-bottom-info">
                            <div ><img src="<?php echo $result["info_img"] ?>" alt="" name="info_img" class="bottom-info-image"></div>
                            <textarea readonly name="botton-content-info" id="botton-content-info" class="bottom-content" value="<?php echo $result["info_content"] ?>"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>