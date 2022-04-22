<?php
error_reporting(0);
require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
$sqlmedicine ="SELECT * FROM medicine WHERE medicineid='$_GET[medicineid]'";
$qsqlmedicine = mysqli_query($conn,$sqlmedicine);
$rsmedicine = mysqli_fetch_array($qsqlmedicine);
echo $rsmedicine['medicinecost'];
?>


