<?php
require('includes/header.php');
?>
<form class="user" method = "post" action = "addphanloai.php" enctype ="multipart/form-data">
    
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="namecategory"
            placeholder="Tên phân loại">
    </div>
    <div class="form-group">
            <label class="form-label">Thêm hình ảnh</label>
            <input type="file" class="form-control form-control-user" name="imagecategory[]" id = "imagecategory"
            multiple >
        </div>
    <button class="btn btn-primary btn-user btn-block"> Thêm mới</button>
</form>

<?php
require('includes/footer.php')
?>
    