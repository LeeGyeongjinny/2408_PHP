<?php
    $file=$_FILES['img'];
    var_dump($file);
    // 파일 업로드시 임시저장위치
    echo $file['image'];
    // 실제 저장하고 싶은 위치 C:Apache24/htdocs/php/
    // 업로드된 파일을 내가 지정한 위치에 지정한 파일명으로 파일을 이동
    // move_uploaded_file(현재위치, 이동할위치)
    $result = move_uploaded_file($file['img'],'C:Apache24/htdocs/'.$file['image']);
    if($result) {
?>
    <img src="../<?=$file['name']?>">
<?php        
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- 
        파일 전송시 form태그에 밑 속성 추가하기
        enctype="multipart/form-data" 
    -->
    <form action="img_test3.php" method="post" 
    enctype="multipart/form-data">
    이미지업로드: <input type="file" name="img"><button type="submit">확인</button>
    </form>
</body>
</html>