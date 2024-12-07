<?php 
require('../ketnoi/connect.php');
$name = $_POST['namecategory'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
//xu ly hinh anh
$countfiles = count($_FILES['imagecategory']['name']);
$img = '';
for($i = 0;$i<$countfiles;$i++){
    $filename = $_FILES['imagecategory']['name'][$i];

    ##Location
    $location = "uploads/".$filename;

    $extension = pathinfo($location,PATHINFO_EXTENSION);
    $extension = strtolower($extension);

    $valid_extensions = array("jpg","jpeg","png");
    $response = 0;
    ## Check file extension
    if(array(strtolower($extension),$valid_extensions)){
        if(move_uploaded_file($_FILES['imagecategory']['tmp_name'][$i],$location)){

            echo "filename: ".$filename."<br/>";
            $img .= $location .";";
            
        }
    }
}
$img = substr($img,0,-1);

$sql_str = "INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`,`anh`)  
VALUES (NULL,'$name','$slug','ACTIVE',NULL,NULL,'$img') ";
mysqli_query($conn,$sql_str);
header("location : themphanloai.php");
?>