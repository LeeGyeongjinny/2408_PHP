<?php

namespace Controllers;

use Controllers\Controller;
use Lib\UserValidator;
use Models\User;

// autoload 했기 때문에 require_once 안해도 자동으로 불러옴

class UserController extends Controller {
  protected function goLogin() {
    return 'login.php';
  }

  protected function login() {
    // 유저 입력 정보를 획득
    $requestData = [
      'u_email' => $_POST['u_email']
      ,'u_password' => $_POST['u_password']
    ];

    // 유효성 체크
    $resultValidator = UserValidator::chkValidator($requestData);
    if(count($resultValidator) > 0){
      $this->arrErrorMsg = $resultValidator;
      return 'login.php';
    }
    
    // 유저 정보를 획득
    $userModel = new User();
    $prepare = [
      'u_email' => $requestData['u_email']
    ];
    $resultUserInfo = $userModel->getUserInfo($prepare);

    // var_dump($resultUserInfo); // 잘 출력되는지 확인용
    // var_dump(password_hash($requestData['u_password'], PASSWORD_DEFAULT)); // 비번 암호화 꼼수
    // exit;

    // 유저 존재 유무 체크
    if(!$resultUserInfo){
      $this->arrErrorMsg[] = '존재하지 않는 유저입니다.';
    } else if(!password_verify($requestData['u_password'], $resultUserInfo['u_password'])){
      // 패스워드 체크
      $this->arrErrorMsg[] = '패스워드가 일치하지 않습니다.';
      return 'login.php';
    } // 이까지하면 유저 확인
    
    // 세션에 u_id 저장
    $_SESSION['u_email'] = $resultUserInfo['u_email'];

    // 로케이션 처리
    return 'Location: /boards';
  }
}

// php에서 나의 construct가 없으면 부모의 construct를 찾아서 실행한다