<?php
// ---------------------
// 다른 파일의 소스코드를 사용하기 위해 불러오는 방법
// ---------------------

// include : 해당 파일을 불러온다. (중복 작성할 경우 여러번 불러온다.)
// include_once : 해당 파일을 불러온다. (중복 작성할 경우 딱 한 번만 불러온다.)
// include 공통점: 오류 발생 시 프로그램을 정지하지 않고 처리 진행

// include_once("./070_include2.php");
// include_once("./070_include2.php");

// require : 해당 파일을 불러온다. (중복 작성할 경우 여러번 불러온다.) 
// require_once : 해당 파일을 불러온다. (중복 작성할 경우 딱 한 번만 불러온다.) 
// require 공통점: 오류 발생 시 프로그램을 정지

require_once("./070_include2.php");
// require_once("./070_include2.php");

echo "include 1111\n";
echo my_sum(1, 2);

