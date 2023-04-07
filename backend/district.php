<?php
include '../backend/db/dbhelper.php';
$id = $_POST['provinceId'];
$sql = "SELECT * FROM `district` WHERE `_province_id` = '".$id."'";
$district = executeResult($sql);
echo "<option value='null'>-- District --</option>";
foreach ($district as $item) {
    echo '<option value="' . $item['id'] . '">' . $item['_name'] . '</option>';
}
?>