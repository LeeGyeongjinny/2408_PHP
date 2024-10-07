
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./css/common.css"> -->
    <link rel="stylesheet" href="./css/insert button_test.css">
    <title>Travel Insert</title>
</head>
<body>
        <header>
            <div class="head-title">
                <a href=""><h1>Travels<span>_작성</span></h1></a>
            </div>
            <div class="btn-header">
                <button class="btn-css">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            width="30"
                            height="30"
                            class="icon"
                        >
                            <path
                            d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z"
                            ></path>
                        </svg>
                        </div>
                    </div>
                    <span>작성</span>
                </button>
                    <!-- <button type="button" class="btn-top">작성</button> -->
                    <!-- <button type="submit" class="btn-top" value="upload" name="upload">작성</button> -->
                <a href="">
                    <button type="button" class="btn-css">
                        <div class="svg-wrapper-1">
                            <div class="svg-wrapper">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="30"
                                height="30"
                                class="icon"
                            >
                                <path
                                d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z"
                                ></path>
                            </svg>
                            </div>
                        </div>
                        <span>취소</span>
                    </button>
                </a>
            </div>
        </header>
        <main>
            <div class="main-board">
                <div class="main-board1">
                    <div class="insert-title">
                        <input type="text" placeholder="제목" name="title" maxlength="20" required>
                    </div>
                </div>
                <div class="main-board2">
                    <div class="main-board-grid">
                        <div class="insert-left">
                            <div class="insert-info">
                                <label for="country" class="insert-info1">국가</label>
                                <input type="text" name="country" id="country" maxlength="10" class="insert-info2" required>
                            </div>
                            <div class="insert-info">
                                <label for="city" class="insert-info1">도시</label>
                                <input type="text" name="city" id="city" maxlength="10" class="insert-info2" required>
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
                                <input name="companion" id="companion" maxlength="10" class="insert-info2" name="companion">
                            </div>
                            <div class="insert-info">
                                <label for="photo1" class="insert-info1">사진</label>
                                <input type="file" id="photo1" name="upload_file1" class="insert-info2">
                            </div>
                            <div  class="insert-info">
                                <label for="photo2" class="insert-info1">사진</label>
                                <input type="file" id="photo2" name="upload_file2" class="insert-info2">
                            </div>
                        </div>
                        <div class="insert-content-box">
                            <div class="insert-content-title">내용</div>
                            <div>
                                <textarea  class="insert-content" placeholder="내용" name="content" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</body>
</html>