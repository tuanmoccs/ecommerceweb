<?php
    require_once('./ketnoi/connect.php');
    session_start();
    $is_homepage = false;
    if (isset($_POST['atcbtn'])) {
        $id = $_POST['pid'];
        $qty = $_POST['qty'];
        // them san pham vao gio hang
        $cart = [];
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }
        // print_r($cart);
        $isFound = false;
        for ($i = 0; $i < count($cart); $i++) {
            // print_r($cart[$i]);
            if ($cart[$i]['id'] == $id) {
                $cart[$i]['qty']+= $qty; 
                $isFound = true;
                break;
            }
        }
        if (!$isFound) {  //khong tim thay san pham trong gio
            $sql_str = "select * from products where id = $id";
            // echo $sql_str; exit;
            $result = mysqli_query($conn, $sql_str);
            $product = mysqli_fetch_assoc($result);//thuc thi cau lenh ('select * from products where id = '.$id, true);
            $product['qty'] = $qty;
            $cart[] = $product;
        }

        //update session
        $_SESSION['cart'] = $cart;
        // print_r($cart); exit;
    }
    require_once('thanhphan/header.php');
    
    $idsp = $_GET['id'];
    $sql_str = "select * from products where id = $idsp";
    $result  = mysqli_query($conn, $sql_str);
    $row = mysqli_fetch_assoc($result);
    $arr_img = explode(";",$row['images']);
?>
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Chi tiết sản phẩm</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Trang chủ</a>
                            <a href="shop.php">Shop</a>
                            <span>Chi tiết sản phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="quantri/<?=$arr_img[0]?>" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php 
                            for($i=0; $i<count($arr_img);$i++){
                            ?>
                            <img data-imgbigurl="quantri/<?=$arr_img[$i]?>"
                            src="quantri/<?=$arr_img[$i]?>" alt="">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?=$row['name']?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price"><?=number_format($row['disscounted_price'],0,'','.'). "VND"?></div>
                        <p><?=$row['summary']?></p>
                        <form method="post">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" >
                                        <input type="hidden" value="1" name="qty">
                                    </div>
                                    <input type="hidden" name="pid" value="<?=$idsp?>">
                                </div>
                            </div>
                            <button class="primary-btn" name="atcbtn">Thêm vào giỏ hàng</button>
                        </form>
                        
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Tình trạng</b> <span><?=$row['status']?></span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả sản phẩm</h6>
                                    <p><?=$row['description']?></p>
                                </div>
                            </div>
                            <!-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php 
            require_once('./ketnoi/connect.php');
            $idsp = $_GET['id'];
            $sql_str = "SELECT * FROM products WHERE category_id IN ( SELECT category_id FROM products GROUP BY category_id HAVING COUNT(*) > 1 );";
            $result  = mysqli_query($conn, $sql_str);
            while( $row = mysqli_fetch_assoc($result)){
                $arr_img = explode(";",$row['images']);
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="quantri/<?=$arr_img[0]?> ">
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
            <?php
            }
            ?>

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php
    require_once('thanhphan/footer.php');
    ?>