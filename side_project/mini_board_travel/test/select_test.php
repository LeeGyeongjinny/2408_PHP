<?php

echo "<div data-role='fieldcontain'>";
echo "\n";

echo "<label>&nbsp;개인정보&nbsp;: </label>";
$personInfo=array('비공개','공개동의');
foreach($personInfo as $k=>$v){
    if($row['smart']==$k){
        echo "<label>".$v."</label>";
    }
}
echo "</div>";


echo "<div data-role='fieldcontain'>";
echo "<table>";
echo "<tr>";
echo "<td><label>개인정보&nbsp;: </label></td>";
echo "<td><select class='modistaff' name='smart'>";
$personInfo=array('비공개','공개동의');
foreach($personInfo as $k=>$v){
    if($row['smart']==$k){
        echo "<option value='".$k."' selected>".$v."</option>";
    } else {
        echo "<option value='".$k."'>".$v."</option>";
    }
}
echo "</select></td>";
echo "</tr>";
echo "</table>";
echo "</div>";
