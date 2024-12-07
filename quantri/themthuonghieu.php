<?php
require('includes/header.php');
?>
<form class="user" method = "post" action = "addbrand.php" >
    
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="nameproduct"
            placeholder="Tên Thương Hiệu">
    </div>
    <button class="btn btn-primary btn-user btn-block"> Thêm mới</button>
</form>

<?php
require('includes/footer.php')
?>
    