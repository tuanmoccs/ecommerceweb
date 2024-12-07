<?php 
require('../ketnoi/connect.php');
$name = $_POST['nameproduct'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

$sql_str = "INSERT INTO `brands` (`name`, `slug`,  `status`) VALUES 
( '$name', 
'$slug', 
'Active');";

mysqli_query($conn,$sql_str);
header("location : themthuonghieu.php");
?>