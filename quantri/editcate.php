<?php 


//lay id goi edit
$id = $_GET['id'];

//tim trong CSDL brand co id trung
//ket noi csdl
require('../ketnoi/connect.php');

$sql_str = "select * from categories where id=$id";
$res = mysqli_query($conn, $sql_str);

$category = mysqli_fetch_assoc($res);
if (isset($_POST['btnUpdate'])){
    //neu nut Cap nhat duoc nhan
    //lay name
    $name = $_POST['name'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
       //xu ly hinh anh
   $countfiles = count($_FILES['anhs']['name']);
   //    print_r( $_FILES['anhs']['name']);
   //    echo str_length($_FILES['anhs']['name'][0]); exit;
   
      if (!empty($_FILES['anhs']['name'][0])){//có chọn hình ảnh mới - xóa các ảnh cũ
       //xoa anh cu
       $images_arr = explode(';', $category['anh']);
       foreach($images_arr as $img){
           unlink($img);
       }
       
       //them anh moi 
       $imgs = '';
       for($i=0;$i<$countfiles;$i++){
           $filename = $_FILES['anhs']['name'][$i];
   
           ## Location
           $location = "uploads/".uniqid().$filename;
                       //pathinfo ( string $path [, int $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ] ) : mixed
           $extension = pathinfo($location,PATHINFO_EXTENSION);
           $extension = strtolower($extension);
   
           ## File upload allowed extensions
           $valid_extensions = array("jpg","jpeg","png");
   
           $response = 0;
           ## Check file extension
           if(in_array(strtolower($extension), $valid_extensions)) {
   
               // them vao CSDL - them thah cong moi upload anh len
               ## Upload file
                                   //$_FILES['file']['tmp_name']: $_FILES['file']['tmp_name'] - The temporary filename of the file in which the uploaded file was stored on the server.
               if(move_uploaded_file($_FILES['anhs']['tmp_name'][$i],$location)){
   
                   $imgs .= $location . ";";
               }
           }
   
       }
       $imgs = substr($imgs, 0, -1);
   
       // echo substr($imgs, 0, -1); exit;
       
       // cau lenh them vao bang
       $sql_str = "UPDATE `categories` 
           SET `name`='$name', 
           `slug`='$slug', 
           `anh`='$imgs'
           WHERE `id`=$id
           ";
      } else {
       $sql_str = "UPDATE `products` 
           SET `name`='$name', 
           `slug`='$slug'
           WHERE `id`=$id
           ";
      }
      
   
    //thuc hien viec cap nhat
    
    mysqli_query($conn, $sql_str);
    
    //chuyen qua trang listbrands
    header("location: listphanloai.php");
} else {
    require('includes/header.php');
?>

<div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Cập nhật thương hiệu (brand)</h1>
                    </div>
                    <form class="user" method="post" action="#" enctype="multipart/form-data">                                               
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user"
                            id="name" name="name" aria-describedby="emailHelp"
                            placeholder="Tên thương hiệu"
                            value=<?php echo $category['name']?>>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hình ảnh phân loại</label>
                        <input type="file" class="form-control form-control-user"
                            id="anhs" name="anhs[]" 
                            multiple>
                        <br>
                        Các ảnh hiện tại:
                        <?php
                        //hien thi cac anh hien tai
                        $arr = explode(';', $category['anh']);
                        foreach($arr as $img)
                            echo "<img src='$img' height='100px' />";
                        ?>
                    </div>
                    <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                    </form>
                    <hr>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</div>

      
<?php
require('includes/footer.php');
}
?>