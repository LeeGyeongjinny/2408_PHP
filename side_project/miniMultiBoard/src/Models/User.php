<?php

namespace Models;

use Models\Model;
use Throwable;

class User extends Model {
  public function getUserInfo($paramArr){
    try {
      $sql = 
        ' SELECT * ' // 원래 필요한 컬럼만 적어야한다잉
        .' FROM users '
        .' WHERE u_email = :u_email '
      ;

      $stmt = $this->conn->prepare($sql); // conn -> 부모모델에 있는 conn
      $stmt->execute($paramArr);
      return $stmt->fetch(); // 1개만 올거니깐 fetchAll말고 그냥 fetch
    } catch(Throwable $th) {
      echo 'User->getUserInfo(), '.$th->getMessage();
      exit;
    }
  }
}