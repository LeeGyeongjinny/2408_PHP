<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php"); // config.php파일을 가리킴
require_once(MY_PATH_DB_LIB); // MY_PATH_DB_LIB = C:\Apache24\htdocs\lib\db_lib.php 이 경로를 가짐

// post 처리
if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    try{
        // PDO Instance
        $conn = my_db_conn();

        // insert 처리
        $arr_prepare = [
            "title" => $_POST["title"]
            ,"content" => $_POST["content"]
        ];

        // begin transaction
        $conn->beginTransaction();
        my_board_insert($conn, $arr_prepare);

        $conn->commit();      

        // 처리끝나면 index로 넘어가게
        header("Location: /"); // /루트로 가면 index.php
        exit;

    } catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        require_once(MY_PATH_ERROR); // config에 작성한 에러페이지 상수
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/insert.css">
    <title>작성 페이지</title>
</head>
<body>
    <?php 
    require_once(MY_PATH_ROOT."/header.php");
    ?>
    <main>
        <form action="/insert.php" method="post">
            <div class="box title-box">
                <div class="box-title ">제목</div>
                <div class="box-content">
                    <input type="text" name="title" id="title">
                </div>
            </div>
            <div class="box content-box">
                <div class="box-title">내용</div>
                <div class="box-content">
                    <textarea name="content" id="content"></textarea>
                </div>
            </div>
            <div class="main-footer">
                <button type="submit" class="btn-small">작성</button>
                <a href="/"><button type="button" class="btn-small">취소</button></a>
            <!-- 취소버튼 type을 button으로 안하면 취소했음에도 php에서 정보제출한다 -->
            </div>
        </form>
    </main>
</body>
</html>