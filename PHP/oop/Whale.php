<?php
// ----------------------------
// class 상속, 추상화
// ----------------------------
namespace PHP\oop;
require_once('./Mammal.php');
require_once('./Swim.php');

use PHP\oop\Mammal;
use PHP\oop\Swim;


class Whale extends Mammal implements Swim{
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
  
  // 수영 메소드
  public function swimming(){
    return '수영합니다.';
  }

  public function printInfo(){
    return '고래고래고래';
  }
}


















// --------------------------------------------------------
// class 기초
// --------------------------------------------------------


// class Whale {
//   // 프로퍼티
//   public $name;
//   private $age;

//   // 생성자
//   public function __construct($name, $age){
//     $this->name = $name;
//     $this->age = $age;
//   }

//   // 메소드
//   public function breath(){
//     echo "숨을 쉽니다.";
//   }

//   public function printInfo(){
//     // 고래는 20살입니다. 출력
//     return $this->name."는 ".$this->age."살 입니다.";
//   }

//   // getter / setter 메소드
//   public function getAge(){
//     return $this->age;
//   }
//   public function setAge($age){
//     $this->age = $age;
//   }

//   // static method
//   public static function dance(){
//     return '고래가 춤을 춥니다.';
//     // return $this->name;
//   }
// }

// echo Whale::dance();

// Whale Instance (객체를 인스턴스화)
// $whale = new Whale('핑크 고래', 40);
// echo $whale->printInfo();

// $whale2 = new Whale(); // 또다른 객체를 만들자

// echo $whale->name;
// echo $whale->age; // 이건 Whale{}이 안에서만 실행 가능
// echo $whale->printInfo();
// echo $whale->getAge();
// $whale->setAge(30); // 이때 $age는 30으로 세팅됨
// echo $whale->getAge();

// $whale->setAge(30); // 이때 $whale의 $age는 30으로 세팅됨
// echo $whale2->getAge(); // 20 출력 / whale2와 whale은 다른 객체라서 서로 영향주지 않는다