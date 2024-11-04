<?php

namespace Controllers;

class Controller{
  // 생성자
  public function __construct(string $action){
    // 모든 controller에서 공통적으로 처리해야 하는 것 
    
    // 세션 시작

    // 유저 로그인 및 권한 체크

    // 해당 Action 호출
    $resultAction = $this->$action();
    // echo $resultAction;

    // view 호출
    $this->callView($resultAction);

    exit; // php 처리 종료
  }


  /**
   * 뷰 OR 로케이션 처리용 메소드
   */
  private function callView($path){
    if(strpos($path, 'Location:') === 0) {
      header($path); // $path로 보내줌
    } else {
      require_once(_PATH_VIEW.'/'.$path); // view파일 호출하고 exit으로 처리 종료
    }
  }
}
// $action 현재 goLogin() -> 그래서 UserController에서 function goLogin()가 실행됨