<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php"); // config.php파일을 가리킴
require_once(MY_PATH_DB_LIB); // MY_PATH_DB_LIB = C:\Apache24\htdocs\lib\db_lib.php 이 경로를 가짐

$conn = null;
$max_board_count = 0;
$max_page = 0;

try {
    // PDO Instance
    $conn = my_db_conn();
    
    // ----------------------------------
    // MAX page 획득 처리
    // ----------------------------------
    $max_board_count = my_board_total_count($conn); // 게시글 총 개수 획득
    $max_page = (int)ceil($max_board_count / MY_LIST_COUNT); // 올림처리해야 나머지값도 페이지에 보임 // ceil의 return타입이 float타입!!


    // ----------------------------------
    // pagination 설정 처리
    // ----------------------------------

    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // 현재 페이지 획득
    $offset = ($page - 1) * MY_LIST_COUNT; // 오프셋 설정
    // 페이지 누르면 값(page=1같은거)이 $_GET로 온다 (php 146_http_method_get,post 참고)
    // 삼항연산자 이용해서 있으면 $_GET["page"]값을 받아오고 아니면 1을 출력
    // 조건식 ? 참일 경우 : 거짓일 경우(내가 정한 임의의 값);
    // $_GET은 다 string타입
    // offset도 예외발생가능성 높음 try안에 넣자
    $start_page_button_number = (int)(floor((($page - 1) / MY_PAGE_BUTTON_COUNT)) * MY_PAGE_BUTTON_COUNT) + 1 ; // 화면 표시 페이지 버튼 시작값
    $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_COUNT - 1); // 화면 표시 페이지 버튼 마지막값
    // 삼항연산자 이용
    // max page 초과시 페이지 버튼 마지막값 조절 
    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;
    $prev_page_button_number = $page - 1 < 1? 1 : $page - 1; // 이전 버튼
    $next_page_button_number = $page + 1 > $max_page? $max_page : $page + 1; // 다음 버튼



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
    require_once(MY_PATH_ROOT."error.php");
    exit;
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
    <?php 
    require_once(MY_PATH_ROOT."/header.php");
    ?>
    <main>
        <div class="main-top">
        <a href="/insert.php"><button class="btn-middle">글 작성</button></a>
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
            <div><a href="/detail.php?id=<?php echo $item["id"] ?>&page=<?php echo $page?>"><?php echo $item["title"] ?></a></div>
            <div><?php echo $item["created_at"] ?></div>
            </div>
        <?php } // $reseult의 개수만큼 loop반복 ?> 
        </div>
        <div class="main-footer">
            <?php if($page !== 1) {?>
                <a href="/index.php?page=<?php echo $prev_page_button_number ?>"><button class="btn-small">이전</button></a>
            <?php }?>
            <!-- <?php // if($page !== 1) {
                // echo '<a href="/index.php?page='.$prev_page_button_number. '"><button class="btn-small">이전</button></a>';
                // } 이렇게 적을 수도 있다...
            ?> -->
            <?php for($i = $start_page_button_number; $i <= $end_page_button_number; $i++) {?>
            <a href="/index.php?page=<?php echo $i ?>"><button class="btn-small <?php echo $page ===  $i ? "btn-selected" : "" ?>"><?php echo $i ?></button></a>
            <?php }?>
            <?php if($page !== $max_page) {?>
                <a href="/index.php?page=<?php echo $next_page_button_number ?>"><button class="btn-small">다음</button></a>
                <!-- <a href="/index.php?page=<?php // echo $end_page_button_number + 1 ?>"><button class="btn-small">다음</button></a> -->
                <!-- 이렇게 끝페이지 +1 하면 되는데 마지막페이지가 없기때문에 다음버튼을 따로 조절해줘야한다. -->
            <?php }?>
                <!-- 보통은 페이지네이션도 따로 함수파일 만들어서 한다 -->
        </div>
    </main>
</body>
</html>