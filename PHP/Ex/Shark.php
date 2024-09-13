<?php

class Shark {
    public $name;

    // 생성자 (Construct)
    // 객체를 인스턴스화 할 때, 딱 한 번만 실행되는 메소드
    public function __construct($name) {
        $this->name = $name;
        $this->info();
    } 

    private function info() {
        return "안녕";
    } // ???????????????
}