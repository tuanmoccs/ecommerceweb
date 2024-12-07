<?php
session_start();
$is_homepage = false;
require_once('thanhphan/header.php');

//lay từ khóa tìm kiếm
$tukhoa = $_GET['tukhoa'];  
?>

    <!-- Breadcrumb Section Begin -->
    <!-- <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-7">
                   <h3>Kết quả tìm kiếm</h3>
                    <div class="filter__item">
                    <div class="row">
                    <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from products where name like '%$tukhoa%' order by name";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="quantri/<?=$arr_img[0]?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="chitietsanpham.php?id=<?=$row['id']?>"><?=$row['name']?></a></h6>
                                    <h5><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></h5>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <?php

require_once('thanhphan/footer.php');
?>