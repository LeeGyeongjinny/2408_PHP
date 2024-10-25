<?php
require_once('./Whale.php');
require_once('./FlyingSquirrel.php');
require_once('./GoldFish.php');

use PHP\OOP\Whale;
use PHP\OOP\FlygingSquirrel;
use PHP\OOP\GoldFish;

$whale = new Whale('고래', '바다');
// Whale의 construct실행되어야하는데 없음
// Whale은 Mammal의 상속을 받고있음
// Mammal은 construct있음
// 이게 실행된다

echo $whale->printInfo();
// whale에 printInfo가 없지만 부모인 mammal이 있어서 사용가능

$flyingsquirrel = new FlygingSquirrel('날다람쥐', '산');

echo $flyingsquirrel->printInfo();

$goldfish = new GoldFish();
echo $goldfish->printPet();
echo $goldfish->swimming();