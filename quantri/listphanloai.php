<?php
require('includes/header.php');
?>
<div>
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách phân loại sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Loại sản phẩm</th>
                                            <th>SLUG</th>
                                        
                                            <th>STATUS</th>
                                            <th>OPTION</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Loại sản phẩm</th>
                                            <th>SLUG</th>
                                            
                                            <th>STATUS</th>
                                            <th>OPTION</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php require('../ketnoi/connect.php');
                                        $sql_str = "select * from categories order by name";
                                        $result = mysqli_query($conn,$sql_str);
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
       
                                        <tr>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['slug']?></td>
                                            <td><?=$row['status']?></td>
                                            <td><a href="editcate.php?id=<?=$row['id']?>" class="btn btn-info">EDIT</a></td>
                                        </td>
                                        </tr>
                                        <?php }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>

<?php
require('includes/footer.php')
?>