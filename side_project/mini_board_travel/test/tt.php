<?php
$arr_prepare = [
    "id" => 1
    ,"title" => 1
    ,"content" => 1
    ,"country" => 1
    ,"city" => 1
    ,"departure" => 1
    ,"arrival" => 1
    ,"companion" => 1
];
        
$set = 
" SET "
."      updated_at = NOW() "
;
foreach($arr_prepare as $key => $val) {
    $set .= " ,".$key." = :".$key;
}

$where =
" WHERE "
."      id = :id "
;

$sql = 
" UPDATE "
."      travel_boards "
.$set
.$where
;

echo $sql;


// -> detail, update 