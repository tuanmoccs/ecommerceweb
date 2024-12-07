<?php 
session_start();
require_once('thanhphan/header.php');
?>
 <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from categories order by name";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['anh'])
                            ?>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="quantri/<?=$arr_img[0]?>">
                            <h5><a href=><?=$row['name']?></a></h5>
                        </div>
                    </div>
                    <?php
                            }
                            ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from categories order by name";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                            ?>
                            <li data-filter=".<?=$row['slug']?>"><?=$row['name']?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select products.id as pid, products.name as pname, images,disscounted_price,categories.slug as cateslug from products,categories where products.category_id = categories.id LIMIT 20;";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix <?=$row['cateslug']?>">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="quantri/<?=$arr_img[0]?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="chitietsanpham.php?id=<?=$row['pid']?>"><?=$row['pname']?></a></h6>
                            <h5><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></h5>
                        </div>
                    </div>
                </div>
                <?php } ?>
               
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <!-- <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Sản phẩm mới</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from products LIMIT 3 OFFSET 0;";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                                <a href="chitietsanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="quantri/<?=$arr_img[0]?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?=$row['name']?></h6>
                                        <span><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></span>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from products LIMIT 3 OFFSET 3;";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                                <a href="chitietsanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="quantri/<?=$arr_img[0]?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?=$row['name']?></h6>
                                        <span><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></span>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from products LIMIT 3 OFFSET 0;";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                                <a href="chitietsanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="quantri/<?=$arr_img[0]?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?=$row['name']?></h6>
                                        <span><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></span>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from products LIMIT 3 OFFSET 0;";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                                <a href="chitietsanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="quantri/<?=$arr_img[0]?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?=$row['name']?></h6>
                                        <span><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></span>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from products LIMIT 3 OFFSET 0;";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                                <a href="chitietsanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="quantri/<?=$arr_img[0]?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?=$row['name']?></h6>
                                        <span><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></span>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                            <?php
                            require('ketnoi/connect.php');
                            $sql_str = "select * from products LIMIT 3 OFFSET 0;";
                            $result = mysqli_query($conn,$sql_str);
                            while($row = mysqli_fetch_assoc($result)){ 
                                $arr_img = explode(";",$row['images'])
                            ?>
                                <a href="chitietsanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="quantri/<?=$arr_img[0]?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?=$row['name']?></h6>
                                        <span><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></span>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <!-- <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Blog Section End -->

    <?php 
    require_once('thanhphan/footer.php')
    ?>