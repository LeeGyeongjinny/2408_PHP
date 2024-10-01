<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {

    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;


    if($id < 1) {
        throw new Exception("파라미터 오류");
    }

    // PDO Instance
    $conn = my_db_conn();

    $arr_prepare = [
        "id" => $id
    ];

    $result = my_board_select_id($conn, $arr_prepare);

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
    <link rel="stylesheet" href="./css/detail.css">
    <title>Travel Detail</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/main.php"><h1>Travels<span>_상세</span></h1></a>
        </div>
        <div class="btn-header">
            <a href="/update.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-top">수정</button></a>
            <a href="/main.php"><button class="btn-top">취소</button></a>
            <a href="/delete.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-top">삭제</button></a>
        </div>
    </header>
    <main>
        <div class="main-board">
            <div class="main-board1">
                <div class="detail-title">
                    <p><?php echo $result["title"] ?></p>
                </div>
            </div>
            <div class="main-board2">
                <div class="main-board-grid">
                    <div class="detail-left">
                        <div class="detail-info">
                            <div class="detail-info1">게시번호</div>
                            <div class="detail-info2"><?php echo $result["id"] ?></div>
                        </div>
                        <div class="detail-info">
                            <div class="detail-info1">국가</div>
                            <div class="detail-info2"><?php echo $result["country"] ?></div>
                        </div>
                        <div class="detail-info">
                            <div class="detail-info1">도시</div>
                            <div class="detail-info2"><?php echo $result["city"] ?></div>
                        </div>
                        <div class="detail-info">
                            <div class="detail-info1">출발</div>
                            <div class="detail-info2"><?php echo $result["departure"] ?></div>
                        </div>
                        <div class="detail-info">
                            <div class="detail-info1">도착</div>
                            <div class="detail-info2"><?php echo $result["arrival"] ?></div>
                        </div>
                        <div class="detail-info">
                            <div class="detail-info1">동행</div>
                            <div class="detail-info2"><?php echo $result["companion"] ?></div>
                        </div>
                        <div class="detail-info">
                            <div class="detail-info1 detail-date">작성일</div>
                            <div class="detail-info2 detail-date"><?php echo $result["created_at"] ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="detail-content-title">내용</div>
                        <div>
                            <textarea readonly class="detail-content"><?php echo $result["content"] ?></textarea>
                        </div>
                    </div>
                    <div class="detail-right">
                        <div>
                            <div class="detail-photo-title">사진</div>
                            <div class="detail-photo"><img src="<?php echo $result["img_1"] ?>" alt="" class="top-info-image"></div>
                        </div>
                        <div>
                            <div class="detail-photo-title">사진</div>
                            <div class="detail-photo"><img src="<?php echo $result["img_2"] ?>" alt="" class="bottom-info-image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>