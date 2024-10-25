<?php
// ----------------------------
// class 상속, 추상화
// ----------------------------
namespace PHP\oop;
require_once('./Mammal.php');
require_once('./Pet.php');

use PHP\oop\Mammal;
// 경로와 파일을 특정해서 정확히 이 파일을 쓰겠다!
use PHP\oop\Pet;

class FlygingSquirrel extends Mammal implements Pet{
  // private $name;
  // private $residence;

  // // 생성자
  // public function __construct($name, $residence){
  //   $this->name = $name;
  //   $this->residence = $residence;    
  // }

  // // 정보 출력
  // public function printInfo(){
  //   return $this->name.'가 '.$this->residence.'에 삽니다.';
  // }

  // 비행 메소드
  public function flying(){
    return "날아갑니다.";
  }

  // 오버라이딩
  public function printInfo(){
    return "룰루랄라";
    // return parent::printInfo()."룰루랄라";
  }

  public function printPet(){
    return '펫입니다 찍찍';
  }
}