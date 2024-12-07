<?php
function addToCart(){
    $cart = [];
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    }
    $isFound  =false;
    for($i=0;$i< count($cart);$i++){
        if($cart[$i]['id']==$id){
            $cart[$i]['qty'] ++;// tang so luong len 1
            $isFound = true;
            break;
        }
    }
    if(!$isFound){ // k tim thay sp trong gio
        $product = 1;
        $product['qty'] = $quantity;
        $cart[] = $product;
    }
    // update session
    $_SESSION['cart'] = $cart;
}
?>