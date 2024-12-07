<?php
$delid = $_GET['id'];
require('../ketnoi/connect.php');

//tim cac hinh anh sp va xoa
$sql1  = "select images from products where id = $delid";
$rs = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($rs);

$arr_img = explode(";",$row['images']);
// xoa cac anh
foreach($arr_img as $imgs){
    unlink($imgs);
}
// xoa du lieu trong mysql
$sql_str = "delete from products where id = $delid";
mysqli_query($conn,$sql_str);
header("location: listsanpham.php");