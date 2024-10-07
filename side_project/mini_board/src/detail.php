<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php"); // config.php파일을 가리킴
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    // id 획득
    // 유저가 get method로 이미 데이터 보내놓음 -> 슈퍼글로별변수 $_GET에 들어가있음
    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

    // page 획득
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
    <title>상세 페이지</title>
</head>
<body>
    <?php 
    require_once(MY_PATH_HEADER);
    ?>
    <main>
        <div class="main-content">
            <div class="box">
                <div class="box-title ">게시글 번호</div>
                <div class="box-content"><?php echo $result["id"] ?></div>
            </div>
            <div class="box">
                <div class="box-title">제목</div>
                <div class="box-content"><?php echo $result["title"] ?></div>
            </div>
            <div class="box">
                <div class="box-title">내용</div>
                <div class="box-content"><?php echo $result["content"] ?></div>
            </div>
            <div class="box">
                <div class="box-title">작성일자</div>
                <div class="box-content"><?php echo $result["created_at"] ?></div>
            </div>
            <?php if(!is_null($result["img"])){ ?>
            <div class="box">
                <div class="box-title">이미지</div>
                <img src="<?php echo $result["img"] ?>" alt="">
            </div>
            <?php } ?>
            <div class="main-footer">
                <a href="/update.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-small">수정</button></a>
                <a href="/index.php?page=<?php echo $page ?>"><button type="button" class="btn-small">취소</button></a>
                <a href="/delete.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-small">삭제</button></a>
        </div>

    </main>
</body>
</html>