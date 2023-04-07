
<?php
include '../backend/db/dbhelper.php';
$id = $_POST['district'];
$sql = "SELECT * FROM `ward` WHERE `_district_id` = ".$id;
$ward = executeResult($sql);
echo "<option value='null'> -- Ward --</option>";
foreach ($ward as $item) {
    echo '<option value="' . $item['id'] . '">' . $item['_name'] . '</option>';
}
?>