<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

try {

    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

    
    exit;
    if($id < 1) {
        throw new Exception("파라미터 오류");
    }

    // PDO Instance
    $conn = my_db_conn();

    $arr_prepare = [
        "bkl_id" => $id
    ];

    $result = my_bucket_board_delete_id($conn, $arr_prepare);

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
    <link rel="stylesheet" href="./css/bucket_delete.css">
    <title>Bucket List Delete</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트 삭제</span></h1></a>
        </div>
        <div class="btn-header">
            <form action="/bucket_delete.php" method="post">
                <input type="hidden" name="bkl_id" value="<?php echo $result["bkl_id"]?>">
                <button type="submit" class="btn-top  btn-top-chk">확인</button>
                <a href="/bucket_detail.php?bkl_id=<?php echo $result["bkl_id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-top">취소</button></a>
            </form>
        </div>
    </header>
    <div class="bucket-delete">
        <div class="delete-board">
            <div class="delete-left">
                <div>
                    <div class="delete-title">
                        <div><?php echo $result["title"] ?></div>
                    </div>
                    <div>
                        <textarea readonly name="bucketlist" id="bucketlist"  class="delete-content"><?php echo $result["bucket_content"] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="delete-right">
                <div class="right-top">
                    <div class="right-top-align">
                        <label for="country" class="top-left">국가</label>
                        <div name="country" id="country" class="top-right"><?php echo $result["country"] ?><</div>
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
                        <img src="<?php echo $result["info_img"] ?>" alt="" class="bottom-info-image">
                        <textarea readonly name="botton-content-info" id="botton-content-info" class="bottom-content2"  value="<?php echo $result["info_content"] ?>"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>