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
    $max_board_count = my_bucket_board_total_count($conn);
    $max_page = (int)ceil($max_board_count / MY_LIST_COUNT_BUCKET);

    // ----------------------------------
    // pagination 설정 처리
    // ----------------------------------
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // 현재 페이지 획득
    $offset = ($page - 1) * MY_LIST_COUNT_BUCKET; // 오프셋 설정

    $start_page_button_number = (int)(floor((($page - 1) / MY_PAGE_BUTTON_COUNT)) * MY_PAGE_BUTTON_COUNT) + 1 ; // 화면 표시 페이지 버튼 시작값
    $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_COUNT - 1); // 화면 표시 페이지 버튼 마지막값

    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;
    $prev_page_button_number = $start_page_button_number - 1 < 1? 1 : $start_page_button_number - 1; // 이전 버튼
    $next_page_button_number = $start_page_button_number + 5 > $max_page? $max_page : $start_page_button_number + 5; // 다음 버튼


    $arr_prepare = [
        "list_cnt" => MY_LIST_COUNT_BUCKET
        ,"offset" => $offset
    ];

    $result = my_bucket_board_select_pagination($conn, $arr_prepare);


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
    <link rel="stylesheet" href="./css/bucketlist.css">
    <title>Travel Bucket List</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/"><h1>Travels<span>_버킷리스트</span></h1></a>
        </div>
        <div class="btn-header">
            <a href="/index.php"><button class="btn-top">홈</button></a>
            <a href="/bucket_insert.php"><button class="btn-top">+</button></a>
        </div>
    </header>
    <div class="main-bucket">
        <div class="bucket-board">
            
            <?php foreach($result as $item) { ?>
            <a href="/bucket_detail.php?bkl_id=<?php echo $item["bkl_id"] ?>" class="bucket-mini">
                <div class="bucket_board1">
                    <div><?php echo $item["title"] ?></div>
                </div>
                <div class="bucket_board2">
                    <div class="sort-inline">
                        <span><?php echo $item["country"] ?></span>
                        <span><?php echo $item["sort"] ?></span>
                    </div>
                    <div><?php echo $item["bucket_content"] ?></div>
                </div>
            </a>
            <?php } ?>
        </div>
        <div class="main-footer">
            <?php if($page > 5) {?>
                <a href="/bucketlist.php?page=<?php echo $prev_page_button_number ?>"><button class="btn-small"><</button></a>
            <?php }?>

            <?php for($i = $start_page_button_number; $i <= $end_page_button_number; $i++) {?>
            <a href="/bucketlist.php?page=<?php echo $i ?>"><button class="btn-small <?php echo $page ===  $i ? "btn-selected" : "" ?>"><?php echo $i ?></button></a>
            <?php }?>
            <?php if($start_page_button_number + 5 < $max_page) {?>
                <a href="/bucketlist.php?page=<?php echo $next_page_button_number ?>"><button class="btn-small">></button></a>
            <?php }?>
        </div>
    </div>
</body>
</html>