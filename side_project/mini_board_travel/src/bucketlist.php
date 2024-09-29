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
    <link rel="stylesheet" href="./css/bucketlist.css">
    <title>Travel Bucket List</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트</span></h1></a>
        </div>
        <div class="btn-header">
            <a href="/index.php"><button class="btn-top">홈</button></a>
            <a href="/bucket_insert.php"><button class="btn-top">+</button></a>
        </div>
    </header>
    <div class="main-bucket">
        <div class="bucket-board">
            <a href="/bucket_detail.php" class="bucket-mini">
                <div class="bucket_board1">
                    <div>올랜도 디즈니랜드</div>
                </div>
                <div class="bucket_board2">
                    <div class="sort-inline">
                        <span>미국</span>
                        <span>관광</span>
                    </div>
                    <div>올랜도 디즈니랜드 가기</div>
                </div>
            </a>
            <a href="./bucket_detail.html" class="bucket-mini">
                <div class="bucket_board1">
                    <div>제목</div>
                </div>
                <div class="bucket_board2">
                    <div class="sort-inline">
                        <span>국가</span>
                    </div>
                    <div>내용</div>
                </div>
            </a>
            <a href="./bucket_detail.html" class="bucket-mini">
                <div class="bucket_board1">
                    <div>제목</div>
                </div>
                <div class="bucket_board2">
                    <div class="sort-inline">
                        <span>국가</span>
                    </div>
                    <div>내용</div>
                </div>
            </a>
        </div>
        <div class="bucket-board">           
            <a href="./bucket_detail.html" class="bucket-mini">
                <div class="bucket_board1">
                    <div>제목</div>
                </div>
                <div class="bucket_board2">
                    <div class="sort-inline">
                        <span>국가</span>
                    </div>
                    <div>내용</div>
                </div>
            </a>
            <a href="./bucket_detail.html" class="bucket-mini">
                <div class="bucket_board1">
                    <div>제목</div>
                </div>
                <div class="bucket_board2">
                    <div class="sort-inline">
                        <span>국가</span>
                    </div>
                    <div>내용</div>
                </div>
            </a>
            <a href="./bucket_detail.html" class="bucket-mini">
                <div class="bucket_board1">
                    <div>제목</div>
                </div>
                <div class="bucket_board2">
                    <div class="sort-inline">
                        <span>국가</span>
                    </div>
                    <div>내용</div>
                </div>
            </a>

        </div>
        <div class="main-footer">
        <?php if($page !== 1) {?>
                <a href="/bucketlist.php?page=<?php echo $prev_page_button_number ?>"><button class="btn-small"><</button></a>
            <?php }?>

            <?php for($i = $start_page_button_number; $i <= $end_page_button_number; $i++) {?>
            <a href="/bucketlist.php?page=<?php echo $i ?>"><button class="btn-small <?php echo $page ===  $i ? "btn-selected" : "" ?>"><?php echo $i ?></button></a>
            <?php }?>
            <?php if($page !== $max_page) {?>
                <a href="/bucketlist.php?page=<?php echo $next_page_button_number ?>"><button class="btn-small">></button></a>
                
            <?php }?>
        </div>
    </div>
</body>
</html>