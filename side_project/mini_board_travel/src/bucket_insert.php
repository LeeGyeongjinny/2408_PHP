<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

// function my_save_img($file) {
//     if($file["name"] === "") {
//         $result_path = null;
//     } else {
//         $file_type = $file["type"];
//         $file_type_arr = explode("/", $file_type);
//         $extension = $file_type_arr[1];
//         $file_name = uniqid().".".$extension;
//         $file_path = "img/".$file_name;
        
//         move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);

//         $result_path = "/".$file_path;
//     }

//     return $result_path;
// }



if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    
    try {
        $conn = my_db_conn();
        
        // my_save_img($conn, $file);

        $file_path_ = my_save_img($_FILES["info_img"]);

        $arr_prepare = [
            "title" => $_POST["title"]
            ,"bucket_content" => $_POST["bucket_content"]
            ,"country" => $_POST["country"]
            ,"sort" => $_POST["select"]
            ,"info_content" => $_POST["info_content"]
            ,"info_img" => $file_path
        ];

        // if($_FILES["info_content"] === "") {
        //     $arr_prepare["info_content"] = null;
        // }

        // if($_FILES["info_img"] === "") {
        //     $arr_prepare["info_img"] = null;
        // }

        $conn->beginTransaction();
        my_bucket_board_insert($conn, $arr_prepare);
        
        $conn->commit();

        header("Location: /bucketlist.php");
        exit;

    } catch(Throwable$th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        require_once(MY_PATH_ROOT."error.php");
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
    <link rel="stylesheet" href="./css/bucket_insert.css">
    <title>Bucket List Insert</title>
</head>
<body>
    <form action="/bucket_insert.php"  method="post" enctype="multipart/form-data" name="fileUpload">
        <header>
            <div class="head-title">
                <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트 작성</span></h1></a>
            </div>
            <div class="btn-header">
                <button type="submit" class="btn-top">저장</button>
                <a href="/bucketlist.php"><button type="button" class="btn-top">취소</button></a>
            </div>
        </header>
        <div class="bucket-insert">
            <div class="insert-board">
                <div class="insert-left">
                    <div>
                        <div class="insert-title">
                            <input type="text" placeholder="제목" name="title" required>
                        </div>
                        <div>
                            <textarea id="bucket_content" placeholder="내용" class="insert-content"  placeholder="내용"  name="bucket_content" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="insert-right">
                    <div class="right-top">
                        <div class="right-top-align">
                            <label for="country" class="top-left">국가</label>
                            <input  name="country" id="country" class="top-right" required>
                        </div>
                        <div class="right-top-align">
                            <label for="sort" class="top-left">분류</label>
                            <select name="select" id="sort" class="top-right">
                                <option value="관광">관광</option>
                                <option value="먹방">먹방</option>
                                <option value="쇼핑">쇼핑</option>
                                <option value="체험">체험</option>
                                <option value="기타">기타</option>
                            </select>
                        </div>
                    </div>
                    <div class="right-bottom">
                        <div class="bottom-info">
                            <div>정보</div>
                        </div>
                        <div class="right-bottom-info">
                            <input type="file" id="info_img" name="info_img" class="bottom-info-image">
                            <div>
                                <textarea name="info-content" id="botton-content-info" class="bottom-content"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>