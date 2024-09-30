<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

function my_save_img($file) {
    if($file["name"] === "") {
        $result_path = null;
    } else {
        $file_type = $file["type"];
        // type "image/webp" 가져옴
        $file_type_arr = explode("/", $file_type);
        // type을 explode써서 배열로 가져옴 (/기준으로 방 나뉨)
        $extension = $file_type_arr[1];
        // 배열중에 1번방 -> 확장자명
        $file_name = uniqid().".".$extension;
        // unique한 배열 랜덤으로 가져옴.확장자명
        $file_path = "img/".$file_name;
        
        move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);

        $result_path = "/".$file_path;
    }

    return $result_path;
}

// post 처리
if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    try{
        // PDO Instance
        $conn = my_db_conn();

        // $file = $_FILES["upload_file1"];
        // // $file2 = $_FILES["upload_file2"];
        
        // $file_type = $file["type"];
        // $file_type_arr = explode("/", $file_type);
        // $extension = $file_type_arr[1];
        // $file_name = uniqid().".".$extension;
        // $file_path = "img/".$file_name;
        
        // move_uploaded_file($_FILES["tmp_name"], MY_PATH_ROOT.$file_path);

        $file_path_1 = my_save_img($_FILES["upload_file1"]);
        $file_path_2 = my_save_img($_FILES["upload_file2"]);


        // insert 처리
        $arr_prepare = [
            "country" => $_POST["country"]
            ,"city" => $_POST["city"]
            ,"departure" => $_POST["departure"]
            ,"arrival" => $_POST["arrival"]
            ,"title" => $_POST["title"]
            ,"content" => $_POST["content"]
            ,"img_1" => $file_path_1
            ,"img_2" => $file_path_2
        ];

        // for($i = 1;$i <= 2; $i++) {

   
        //     if($_POST['upload']=="upload"){
        //         if(move_uploaded_file($file['tmp_name'],$path.$file['name'])){
        //         echo "Upload success!";
        //         }
        //         else {
        //         echo "Upload fail..";
        //         }
        //     }
        // }

        // $upload_file1 = $_FILES['upload_file1']['name'];
        // $target='images/'.$upload_file1;
        // $upload_file1_type = $_FILES['upload_file1']['name'];
        // $upload_file1_size = $_FILES['upload_file1']['tmp_name'];
        // $tmp_name = $_FILES['upload_file1']['error'];

        // move_uploaded_file($tmp_name, $target);


        // begin transaction
        $conn->beginTransaction();
        my_board_insert($conn, $arr_prepare);
        
        $conn->commit();      

        // 처리끝나면 index로 넘어가게
        header("Location: /main.php"); // /루트로 가면 index.php
        exit;

    }catch(Throwable $th) {
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
    <title>Travel Insert</title>
</head>
<body>
    <form action="/insert.php" method="post" enctype="multipart/form-data" name="fileUpload">
        <header>
            <div class="head-title">
                <a href="/main.php"><h1>Travels<span>_작성</span></h1></a>
            </div>
            <div class="btn-header">
                <button type="submit" class="btn-top" value="upload" name="upload">작성</button>
                <a href="/main.php"><button type="button" class="btn-top">취소</button></a>
            </div>
        </header>
        <main>
            <div class="main-board">
                <div class="main-board1">
                    <div class="insert-title">
                    <input type="text" placeholder="제목" name="title" required></input>
                    </div>
                </div>
                <div class="main-board2">
                    <div class="main-board-grid">
                        <div class="insert-left">
                            <div class="insert-info">
                                <label for="country" class="insert-info1">국가</label>
                                <input type="text" name="country" id="country" class="insert-info2" required>
                            </div>
                            <div class="insert-info">
                                <label for="city" class="insert-info1">도시</label>
                                <input type="text" name="city" id="city" class="insert-info2" required>
                            </div>
                            <div class="insert-info">
                                <label for="departure" class="insert-info1">출발</label>
                                <input  type="date" id="departure" max="2077-06-20" min="1995-10-21" class="insert-info2" name="departure" >
                            </div>
                            <div class="insert-info">
                                <label for="arrival" class="insert-info1">도착</label>
                                <input  type="date" id="arrival" max="2077-06-20" min="1995-10-21" class="insert-info2" name="arrival">
                            </div>
                            <div class="insert-info">
                                <label for="companion" class="insert-info1">동행</label>
                                <input name="companion" id="companion" class="insert-info2" name="companion">
                            </div>
                            <div class="insert-info">
                                <label for="photo1" class="insert-info1">사진</label>
                                <input type="file" id="photo1" name="upload_file1" class="insert-info2" />
                            </div>
                            <div  class="insert-info">
                                <label for="photo2" class="insert-info1">사진</label>
                                <input type="file" id="photo2" name="upload_file2" class="insert-info2" />
                            </div>
                        </div>
                        <div class="insert-content-box">
                            <div class="insert-content-title">내용</div>
                            <div>
                                <textarea  class="insert-content" placeholder="여기엔 내용" name="content" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</body>
</html>