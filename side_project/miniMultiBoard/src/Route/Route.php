<?php

namespace Route;

use Controllers\BoardController;
use Controllers\UserController;

// 라우트 : 유저의 요청을 분석해서 해당 Controller로 연결해주는 클래스
class Route {
  // 생성자
  public function __construct() {

    $url = $_GET['url']; // 요청 경로 획득
    $httpMethod = $_SERVER['REQUEST_METHOD']; // HTTP 메소드 획득
    // 대문자로 GET, POST가져

    // 요청 경로를 체크
    if($url === 'login'){
      // 회원 로그인 관련
      // 각각 controller 불러오면 된다?
      if($httpMethod === 'GET') {
        // localhost/login GET(단순 페이지 이동) : GET
        new UserController('goLogin');
      } else if($httpMethod === 'POST') {
        // localhost/login POST(실제로 로그인 처리) : POST
        new UserController('login');
      }
      // else안하고 else if 하는 이유는 다른 메소드도 쓸 예정이기 때문
    } else if($url === 'boards'){
      if($httpMethod === 'GET'){
        new BoardController('index');
      }
    }
  }
} // 파일명과 이름 동일하게