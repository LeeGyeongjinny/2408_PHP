<?php

namespace Controllers;

use Controllers\Controller;

// autoload 했기 때문에 require_once 안해도 자동으로 불러옴

class UserController extends Controller {
  protected function goLogin() {
    return 'login.php';
  }
}

// php에서 나의 construct가 없으면 부모의 construct를 찾아서 실행한다