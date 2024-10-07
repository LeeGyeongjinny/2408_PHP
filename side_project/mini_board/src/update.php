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

        // file 획득
        $file = $_FILES["file"]; // [안에는 name]


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

        // file 저장 처리

        if($file["name"] !== ""){
            // 기존 파일 삭제

            $arr_prepare_select = [
                "id" => $id
            ];

            $result = my_board_select_id($conn, $arr_prepare_select);
            if(!is_null($result["img"])) {
                unlink(MY_PATH_ROOT.$result["img"]);
            }

            
            
            // 새 파일 저장
            $type = explode("/", $file["type"]);
            $extension = $type[1];
            $file_name= uniqid().".".$extension;
            // 중복없는 랜덤 파일명 만듦
            $file_path = "/img/".$file_name;
            // 파일 경로

            move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path); // 파일 저장

            $arr_prepare["img"] = $file_path;
        }
        // 파일 네임이 비어있지 않을 때만 if문 돌림



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
    <title>수정 페이지</title>
</head>
<body>
    <?php 
    require_once(MY_PATH_HEADER);
    ?>
    <main>
        <form action="/update.php" method="post" enctype="multipart/form-data">
            <!-- action update.php인 이유
                버튼을 눌렀을 때 이동해야하는 곳이 update
                update이동 후 post타입으로 전송해서 처리하고 header로 detail로 간다
            -->
            <!-- file을 넣을 때는 enctype="multipart/form-data"를 추가해야한다 -->
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <div class="box title-box">
                <div class="box-title ">글 번호</div>
                <div class="box-content"><?php echo $result["id"]?></div>
            </div>
            <div class="box">
                <div class="box-title ">제목</div>
                <div class="box-content">
                    <input type="text" name="title" id="title" value="<?php echo $result["title"] ?>">
                </div>
            </div>
            <div class="box content-box">
                <div class="box-title">내용</div>
                <div class="box-content">
                    <textarea name="content" id="content"><?php echo $result["content"] ?></textarea>
                </div>
            </div>
            <div class="box">
                <div class="box-title">이미지</div>
                <div class="box-content">
                    <input type="file" name="file" id="file">
                </div>
            </div>
            <div class="main-footer">
                <button type="submit" class="btn-small">완료</button>
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-small">취소</button></a>
            </div>
        </form>
    </main>
</body>
</html>