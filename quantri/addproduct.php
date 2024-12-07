<?php 
require('../ketnoi/connect.php');
//Lấy thông tin
$name = $_POST['nameproduct'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
$description = $_POST['description'];
$summary = $_POST['summary'];
$stock= $_POST['stock'];
$price = $_POST['price'];
$discount = $_POST['discount'];
$category_id = $_POST['category_id'];
$brand_id = $_POST['brand_id'];


//xu ly hinh anh
$countfiles = count($_FILES['imageproduct']['name']);
$img = '';
for($i = 0;$i<$countfiles;$i++){
    $filename = $_FILES['imageproduct']['name'][$i];

    ##Location
    $location = "uploads/".$filename;

    $extension = pathinfo($location,PATHINFO_EXTENSION);
    $extension = strtolower($extension);

    $valid_extensions = array("jpg","jpeg","png");
    $response = 0;
    ## Check file extension
    if(array(strtolower($extension),$valid_extensions)){
        if(move_uploaded_file($_FILES['imageproduct']['tmp_name'][$i],$location)){

            echo "filename: ".$filename."<br/>";
            $img .= $location .";";
            
        }
    }
}
$img = substr($img,0,-1);
// echo substr($img,0,-1); exit;



// câu lệnh thêm 
$sql_str = "INSERT INTO `products` 
(`id`, `name`, `slug`, `description`, `summary`, 
`stock`, `price`, `disscounted_price`, `images`, `category_id`, 
`brand_id`, `status`, `created_at`, `updated_at`) VALUES
(NULL,'$name','$slug','$description','$summary','$stock','$price','$discount','$img','$category_id','$brand_id','Active',NULL,NULL);";


//thuc thi cau lenh
mysqli_query($conn , $sql_str);

//tro ve trang
header("location: themsanpham.php")

?>
