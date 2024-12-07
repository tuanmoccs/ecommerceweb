<?php
session_start();
$is_homepage = false;

require_once('./ketnoi/connect.php');



require_once('thanhphan/header.php');
?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <!-- <a href="./index.html">Home</a>
                            <span>Shopping Cart</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lương</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cart = [];
                            if (isset($_SESSION['cart'])) {
                                $cart = $_SESSION['cart'];
                            }
                            // var_dump($cart);die();
                            $count = 0; //số thứ tự
                            $total = 0;
                            $subtotal =0;
                            foreach ($cart as $item) {
                                $total = $item['qty'] * $item['disscounted_price'];
                                $arr_img = explode(";",$item['images']);
                                $subtotal += $total;
                                ?>
                            <form action="updatecart.php?id=<?= $item['id'] ?>" method="post">
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="quantri/<?=$arr_img[0]?> " alt="">
                                        <h5><?=$item['name']?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?= number_format($item['disscounted_price'], 0, '', '.') . " VNĐ"?>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                            <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                    <?= number_format($total, 0, '', '.') . " VNĐ"?>
                                    </td>
                                    <td>
                                        <button class="primary-btn cart-btn cart-btn-right"
                                        style = "font-size: 10px; margin-left: 20px; margin-right: 20px;">
                                            <span class="icon_loading"></span>
                                            Cập nhật</button>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href='deletecart.php?id=<?= $item['id'] ?>' class="icon_close"
                                        style = "font-size : 25px;"></a>
                                    </td>
                                    
                                </tr>
                            </form>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="shop.php" class="primary-btn cart-btn">Mua thêm</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <!-- <div class="shoping__discount">
                            <h5>Mã Giảm Giá</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">OK</button>
                            </form>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Tổng <span><?=number_format($subtotal, 0, '', '.') . " VNĐ"?></span></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">Thanh Toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

<?php include_once('thanhphan/footer.php'); ?>