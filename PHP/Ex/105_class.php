<?php
require_once("./Whale.php");

// //  인스턴스화
$whale = new Whale(); // ()소괄호 : 어떤 메소드를 실행하겠다는 의미

// // Class의 메소드 사용
// $whale->breath();  // -> 숨을 쉽니다

// // 프로퍼티 접근
// echo $whale->name; // public이므로 접근 가능 // -> 고래
// // echo $whale->age; // private이므로 접근 불가
// echo $whale->info(); // -> 나이는 30숨을 쉽니다나이는

// 스테틱 멤버에 접근
// Whale::myStatic(); // 인스턴스화 안해도 접근 가능 // -> 스테틱 메소드

require_once("./Shark.php");
// 상어 클래스
$shark = new Shark("상어");
echo $shark->name;