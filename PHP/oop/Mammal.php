<?php
namespace PHP\oop;
// 얘의 주소는 이거

// 추상 메소드
abstract class Mammal{
  private $name;
  private $residence;

  // 생성자
  public function __construct($name, $residence){
    $this->name = $name;
    $this->residence = $residence;    
  }
  // 이까지는 abstract 키워드가 없어서(일반 메소드) 자식쪽에서 재정의하지않아도 아무 문제 없음

  // 추상 메소드
  abstract public function printInfo();
  // 이건 자식쪽에서 오버라이딩 반드시 해줘야한다
}





// class Mammal{
//   private $name;
//   private $residence;
  
//   // 생성자
//   public function __construct($name, $residence){
//     $this->name = $name;
//     $this->residence = $residence;    
//   }
  
//   // 정보 출력
//   // final public function printInfo(){
//   public function printInfo(){
//     return $this->name.'가 '.$this->residence.'에 삽니다.';
//   }
// }