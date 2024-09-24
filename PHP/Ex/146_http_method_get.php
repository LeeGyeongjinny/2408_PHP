<?php

    // HTTP Method GET 요청 데이터를 받는 방법
    // echo isset($_GET["id"]) ? $_GET["id"] : 1;
    // $_GET에 유저가 id로 보내서 받을 수 있음
    
    // 삼항연산자
    // echo 조건식 ? 참일 경우 : 거짓일 경우(내가 정한 임의의 값);
    // echo isset($_GET["id"]) ? $_GET["id"] : 1;
    // $_GET["id"]이 있는지 없는지 어떻게 확인?
    // -> 배열인 경우 isset으로 확인

    var_dump($_GET);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="id" id="id">
        <br>
        <button type="submit">버튼</button>
    </form>
</body>
</html>