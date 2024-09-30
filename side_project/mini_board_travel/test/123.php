<?php
$list1 = "값1";
?>
<select name="sel">
<option value="값1" <?php if($list1== "값1") echo "SELECTED";?> > hello </option>
<option value="값2" <?php if($list2 == "값2") echo "SELECTED";?> > hi </option>
</select>