<?php 
session_start();
$is_homepage = false;
require_once('./ketnoi/connect.php');
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
if (isset($_POST['btnorder'])){
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $numberphone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $note = $_POST['note'];
// tao du lieu order
    $sqli = "insert into orders values (0, 0, '$fullname', '$address', '$numberphone', '$email', '$note', 'Processing', now(), now())";
    if (mysqli_query($conn, $sqli)) {
        $last_order_id = mysqli_insert_id($conn);
        foreach ($cart as $item) {
            $masp = $item['id'];
            $disscounted_price = $item['disscounted_price'];
            $qty = $item['qty'];
            $total = $item['qty'] * $item['disscounted_price'];
            $sqli2 = "insert into order_details values 
            (0, $last_order_id, $masp,  $disscounted_price, $qty, $total, now(), now())";
            mysqli_query($conn, $sqli2);
        }
    }
    unset($_SESSION["cart"]);
    header("Location: thankyou.php");
}
require_once('thanhphan/header.php')
?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div> -->
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="" method = "post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                        <div class="checkout__input">
                                <p>Họ và tên<span>*</span></p>
                                <input type="text" name = "fullname">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" name = "address" >
                                
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <input type="text" name = "note">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name = "phonenumber">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name = "email">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng</h4>
                                <table class="table table-borderless checkout">
                                    <thead>
                                    <tr >
                                        <th class = "shoping__product">Sản phẩm</th>
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
                                        <tr>
                                            <td class="shoping__cart__item"><?=$item['name']?></td>
                                            <td class="shoping__cart__item" ><?=number_format($total, 0, '', '.') . " VNĐ"?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <div class="checkout__order__subtotal">Tổng hoá đơn <span><?=number_format($subtotal, 0, '', '.') . " VNĐ"?></span></div>
                                <button type="submit" class="site-btn" name = "btnorder">Đặt Hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <?php require_once('thanhphan/footer.php')?>