<?php
require('includes/header.php');
?>

<form class="user" method = "post" action = "addproduct.php" enctype ="multipart/form-data">
    
        <div class="form-group">
            <input type="text" class="form-control form-control-user" name="nameproduct"
                placeholder="Tên sản phẩm">
        </div>
        <div class="form-group">
            <textarea type="text" class="form-control form-control-user" name="summary"
                placeholder="Tóm tắt sản phẩm"></textarea>
        </div>

        <div class="form-group">
            <textarea type="text" class="form-control form-control-user" name="description"
            placeholder="Mô tả chi tiết"></textarea>
        </div>
        <div class="form-group row">
            <div class="col-sm-4 mb-sm-0">
                <input type="text" class="form-control form-control-user"
                    name="stock" placeholder="Số lượng">
            </div>
            <div class="col-sm-4 mb-sm-0">
                <input type="text" class="form-control form-control-user"
                    name="price" placeholder="Giá gốc">
            </div>
            <div class="col-sm-4 mb-sm-0">
                <input type="text" class="form-control form-control-user"
                    name="discount" placeholder="Giảm bán">
            </div>
        </div>
        
        <div class="form-group">
            <select class ="form-control" name="category_id" placeholder = "Chọn danh mục">
                <option>Chọn danh mục</option>
            <?php require('../ketnoi/connect.php');
                $sql_str = "select * from categories order by name";
                $result = mysqli_query($conn,$sql_str);
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
            <?php }?>
               
            </select>
        </div>
        <div class="form-group">
            <select class ="form-control" name="brand_id" placeholder = "Chọn thương hiệu">
                <option >Chọn Thương Hiệu</option>
                <?php require('../ketnoi/connect.php');
                $sql_str = "select * from brands order by name";
                $result = mysqli_query($conn,$sql_str);
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
            <?php }?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Thêm hình ảnh sản phẩm</label>
            <input type="file" class="form-control form-control-user" name="imageproduct[]" id = "imageproduct"
            multiple >
        </div>

    <button class="btn btn-primary btn-user btn-block"> Thêm mới</button>
</form>

<?php
require('includes/footer.php')
?>