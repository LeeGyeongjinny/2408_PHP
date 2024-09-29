<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php"); // config.php파일을 가리킴
require_once(MY_PATH_DB_LIB); // MY_PATH_DB_LIB = C:\Apache24\htdocs\lib\db_lib.php 이 경로를 가짐

$conn = null;

// post 처리
if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    try{
        // PDO Instance
        $conn = my_db_conn();

        // insert 처리
        $arr_prepare = [
            "title" => $_POST["title"]
            ,"content" => $_POST["content"]
        ];

        // begin transaction
        $conn->beginTransaction();
        my_board_insert($conn, $arr_prepare);

        $conn->commit();      

        // 처리끝나면 index로 넘어가게
        header("Location: /"); // /루트로 가면 index.php
        exit;

    } catch(Throwable $th) {
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
    <header>
        <div class="head-title">
            <a href="/main.php"><h1>Travels<span>_작성</span></h1></a>
        </div>
        <div class="btn-header">
            <a href="/main.php"><button type="submit" class="btn-top">작성</button></a>
            <a href="/main.php"><button type="button" class="btn-top">취소</button></a>
        </div>
    </header>
    <main>
        <form action="/main.php" method="post">
            <div class="main-board">
                <div class="main-board1">
                    <div class="insert-title">
                        <p>제목</p>
                    </div>
                </div>
                <div class="main-board2">
                    <div class="main-board-grid">
                        <div class="insert-left">
                            <div class="insert-info">
                                <label for="country" class="insert-info1">국가</label>
                                <select name="country" id="country" class="insert-info2">
                                    <option value="미국">미국</option>
                                    <option value="한국">한국</option>
                                    <option value="대만">대만</option>
                                    <option value="영국">영국</option>
                                    <option value="프랑스">프랑스</option>
                                    <option value="벨기에">벨기에</option>
                                    <option value="체코">체코</option>
                                    <option value="이탈리아">이탈리아</option>
                                    <option value="일본">일본</option>
                                    <option value="중국">중국</option>
                                    <option value="태국">태국</option>
                                    <option value="호주">호주</option>
                                    <option value="스페인">스페인</option>
                                    <option value="포르투갈">포르투갈</option>
                                    <option value="캐나다">캐나다</option>
                                    <option value="스위스">스위스</option>
                                    <option value="헝가리">헝가리</option>
                                    <option value="오스트리아">오스트리아</option>
                                    <option value="아이슬란드">아이슬란드</option>
                                </select>
                            </div>
                            <div class="insert-info">
                                <label for="city" class="insert-info1">도시</label>
                                <select name="city" id="city" class="insert-info2">
                                    <option value="올랜도">올랜도</option>
                                    <option value="서울">서울</option>
                                    <option value="대구">대구</option>
                                    <option value="부산">부산</option>
                                    <option value="속초">속초</option>
                                    <option value="타이베이">타이베이</option>
                                    <option value="타이중">타이중</option>
                                    <option value="타이난">타이난</option>
                                    <option value="까오슝">까오슝</option>
                                    <option value="런던">런던</option>
                                    <option value="카디프">카디프</option>
                                    <option value="브리스톨">브리스톨</option>
                                    <option value="파리">파리</option>
                                    <option value="니스">니스</option>
                                    <option value="브뤼셀">브뤼셀</option>
                                    <option value="프라하">프라하</option>
                                    <option value="베니치아">베니치아</option>
                                    <option value="피렌체">피렌체</option>
                                    <option value="로마">로마</option>
                                    <option value="나폴리">나폴리</option>
                                    <option value="도쿄">도쿄</option>
                                    <option value="오사카">오사카</option>
                                    <option value="교토">교토</option>
                                    <option value="고베">고베</option>
                                    <option value="후쿠오카">후쿠오카</option>
                                    <option value="오키나와">오키나와</option>
                                    <option value="상하이">상하이</option>
                                    <option value="베이징">베이징</option>
                                    <option value="청도">청도</option>
                                    <option value="방콕">방콕</option>
                                    <option value="시드니">시드니</option>
                                    <option value="브리즈번">브리즈번</option>
                                    <option value="퍼스">퍼스</option>
                                    <option value="뉴욕">뉴욕</option>
                                    <option value="시애틀">시애틀</option>
                                    <option value="로스앤젤러스">로스앤젤러스</option>
                                    <option value="플로리다">플로리다</option>
                                    <option value="시카고">시카고</option>
                                    <option value="마드리드">마드리드</option>
                                    <option value="바르셀로나">바르셀로나</option>
                                    <option value="포르투">포르투</option>
                                    <option value="벤쿠버">벤쿠버</option>
                                    <option value="토론토">토론토</option>
                                    <option value="퀘벡">퀘벡</option>
                                    <option value="취리히">취리히</option>
                                    <option value="잘츠부르크">잘츠부르크</option>
                                    <option value="레이캬비크">레이캬비크</option>
                                </select>
                            </div>
                            <div class="insert-info">
                                <label for="departure" class="insert-info1">출발</label>
                                <input  type="date" id="departure" max="2077-06-20" min="1995-10-21" value="2024-09-26" class="insert-info2"></input>
                            </div>

                            <div class="insert-info">
                                <label for="arrive" class="insert-info1">도착</label>
                                <input  type="date" id="arrive" max="2077-06-20" min="1995-10-21" value="2024-09-27" class="insert-info2"></input>
                            </div>
                            <div class="insert-info">
                                <label for="companion" class="insert-info1">동행</label>
                                <input name="companion" id="companion" class="insert-info2"></input>
                            </div>
                            <div class="insert-info">
                                <label class="insert-info1">사진</label>
                                <input type="file" id="photo1" accept="image/png, image/jpeg" class="insert-info2"></input>
                            </div>
                            <div class="insert-info">
                                <label class="insert-info1">사진</label>
                                <input type="file" id="photo1" accept="image/png, image/jpeg" class="insert-info2"></input>

                            </div>

                        </div>
                        <div class="insert-content-box">
                            <div class="insert-content-title">내용</div>
                            <div>
                                <textarea  class="insert-content" placeholder="여기엔 내용"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </main>
</body>
</html>