<?php

namespace Controllers;

use Controllers\Controller;
use Models\Board;
use Models\BoardsCategory;

class BoardController extends Controller{
  private $arrBoardList = []; // 게시글 정보 리스트
  // 외부에서 이 데이터를 함부로 조작하거나 변경하는 것을 막기 위함
  // 객체지향의 캡슐화
  private $boardName = ''; // 게시판 이름

  // getter
  public function getArrBoardList(){
    return $this->arrBoardList;
  }

  public function getBoardName(){
    return $this->boardName;
  }

  // setter
  public function setArrBoardList($arrBoardList){
    $this->arrBoardList = $arrBoardList;
  }

  public function setBoardName($boardName){
    $this->boardName = $boardName;
  }

  // getter, setter 쓰는 이유 : 캡슐화
  // public, protected : 이거 두개는 캡슐화 안됨, 외부접근가능 (자식도 외부라서 상속도 안되게 해야한다 -> private사용해야함)

  public function index(){
    // 보드타입 획득
    $requestData = [
      'bc_type' => isset($_GET['bc_type']) ? $_GET['bc_type'] : '0'
    ];

    // 게시글 정보 획득
    $boardModel = new Board(); // use Models\Board; 빠뜨리는거 조심하자! -> 자동완성 하는 습관
    $this->setArrBoardList($boardModel->getArrBoardList($requestData)); // return값이 배열로 옴 -> setArrBoardList 여기서 프로퍼티로 저장

    // 보드 이름 획득
    $boardCategoryModel = new BoardsCategory();
    $resultBoardCategory = $boardCategoryModel->getBoardName($requestData);
    $this->setBoardName($resultBoardCategory['bc_name']);

    return 'board.php';
  }
}