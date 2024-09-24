<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php"); // config.php파일을 가리킴
require_once(MY_PATH_DB_LIB); // MY_PATH_DB_LIB = C:\Apache24\htdocs\lib\db_lib.php 이 경로를 가짐

$conn = null;


try {
  // PDO Instance
  $conn = my_db_conn();
  
  
  // ----------------------------------
  // pagination 설정 처리
  // ----------------------------------

  $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; 
  $offset = ($page - 1) * MY_LIST_COUNT;
  // 페이지 누르면 값(page=1같은거)이 $_GET로 온다 (php 146_http_method_get,post 참고)
  // 삼항연산자 이용해서 있으면 $_GET["page"]값을 받아오고 아니면 1을 출력
  // 조건식 ? 참일 경우 : 거짓일 경우(내가 정한 임의의 값);
  // $_GET은 다 string타입
  // offset도 예외발생가능성 높음 try안에 넣자



  // ----------------------------------
  // pagination select 처리
  // ----------------------------------

  // prepared statement 셋팅
  $arr_prepare = [
    "list_cnt" => MY_LIST_COUNT
    ,"offset" => $offset
  ]; 

  // pagination
  $result = my_board_select_pagination($conn, $arr_prepare); // $arr_prepare : 요청받은값, $conn과 $arr_prepare를 아규먼트로써 전달해줌
  // db_lib.php에서 $conn에 담긴 pdo return값 가져옴

} catch(Throwable $th) {
  echo $th->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>리스트 페이지</title>
</head>
<body>
  <header>
    <h1>Mini Board</h1>
  </header>
  <main>
    <div class="main-top">
      <a href="./insert.html"><button class="btn-middle">글 작성</button></a>
    </div>
    <div class="main-list">
      <div class="item list-head">
        <div>게시글 번호</div>
        <div>게시글 제목</div>
        <div>작성일자</div>
      </div>
      <?php foreach($result as $item) { ?>
        <div class="item list-content">
          <div><?php echo $item["id"] ?></div>
          <div><a href="./detail.html"><?php echo $item["title"] ?></a></div>
          <div><?php echo $item["created_at"] ?></div>
        </div>
      <?php } // $reseult의 개수만큼 loop반복 ?> 
    </div>
    <div class="main-footer">
      <a href="/index.php?page=1"><button class="btn-small">이전</button></a>
      <a href="/index.php?page=1"><button class="btn-small">1</button></a>
      <a href="/index.php?page=2"><button class="btn-small">2</button></a>
      <a href="/index.php?page=3"><button class="btn-small">3</button></a>
      <a href="/index.php?page=4"><button class="btn-small">4</button></a>
      <a href="/index.php?page=5"><button class="btn-small">5</button></a>
      <a href="/index.php?page=6"><button class="btn-small">다음</button></a>
    </div>
  </main>
</body>
</html>