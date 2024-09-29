<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;
$max_board_count = 0;
$max_page = 0;

try {
    $conn = my_db_conn();

    // ----------------------------------
    // MAX page 획득 처리
    // ----------------------------------
    $max_board_count = my_board_total_count($conn);
    $max_page = (int)ceil($max_board_count / MY_LIST_COUNT);

    // ----------------------------------
    // pagination 설정 처리
    // ----------------------------------
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // 현재 페이지 획득
    $offset = ($page - 1) * MY_LIST_COUNT; // 오프셋 설정

    $start_page_button_number = (int)(floor((($page - 1) / MY_PAGE_BUTTON_COUNT)) * MY_PAGE_BUTTON_COUNT) + 1 ; // 화면 표시 페이지 버튼 시작값
    $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_COUNT - 1); // 화면 표시 페이지 버튼 마지막값

    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;
    $prev_page_button_number = $page - 1 < 1? 1 : $page - 1; // 이전 버튼
    $next_page_button_number = $page + 1 > $max_page? $max_page : $page + 1; // 다음 버튼


    $arr_prepare = [
        "list_cnt" => MY_LIST_COUNT
        ,"offset" => $offset
    ];

    $result = my_board_select_pagination($conn, $arr_prepare);

} catch(Throwable$th) {
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
    <link rel="stylesheet" href="./css/main.css">
    <title>Travel board</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/123.php"><h1>Travels<span>_기록</span></h1></a>
        </div>
        <div class="btn-header">
            <a href="/index.php"><button class="btn-top">홈</button></a>
            <a href="/insert.php"><button class="btn-top">+</button></a>
        </div>
    </header>
    <main>
        <div class="main-board">
            <div class="main-board1">
                <div class="item main-title">
                    <div>게시글 번호</div>
                    <div>국가</div>
                    <div>게시글 제목</div>
                    <div>작성일자</div>
                </div>
            </div>
            <div class="main-board2">
                    <?php foreach($result as $item) { ?>
                    <div class="item main-content">
                        <div><?php echo $item["id"] ?></div>
                        <div><?php echo $item["country"] ?></div>
                        <div><a href="/detail.php?id=<?php echo $item["id"] ?>&page=<?php echo $page?>"><?php echo $item["title"] ?></a></div>
                        <div><?php echo $item["created_at"] ?></div>
                    </div>
                    <?php } ?> 
            </div>
        </div>
        <div class="main-footer">
        <?php if($page !== 1) {?>
                <a href="/main.php?page=<?php echo $prev_page_button_number ?>"><button class="btn-small"><</button></a>
            <?php }?>

            <?php for($i = $start_page_button_number; $i <= $end_page_button_number; $i++) {?>
            <a href="/main.php?page=<?php echo $i ?>"><button class="btn-small <?php echo $page ===  $i ? "btn-selected" : "" ?>"><?php echo $i ?></button></a>
            <?php }?>
            <?php if($page !== $max_page) {?>
                <a href="/main.php?page=<?php echo $next_page_button_number ?>"><button class="btn-small">></button></a>
                
            <?php }?>
        </div>
    </main>
    
</body>
</html>