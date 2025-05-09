<?php

//create sesssion

// if (!isset($_SESSION['cart'])) {
//     $_SESSION['cart'] = [];
// }

// $cartItems = [
//     'id' => $_POST['merch_id'],
//     'title' => $_POST['merch_title'],
//     'price' => $_POST['merch_price'],
//     'quantity' => 1,
// ];

// $found = false;
// foreach ($_SESSION['cart'] as $item) {
//     if ($item['id'] == $product['id']) {
//         $item['quantity']++;
//         $found = true;
//         break;
//     }
// }
// unset($item);

// if (!$found) {
//     $_SESSION['cart'][] = $product;
// }
?>
<div class="cartModal" id="cartContainer">
    <form action="addToCart" method="post">
        <input type="hidden" name="product_id" value="">
        <input type="hidden" name="product_id" value="">
        <input type="hidden" name="product_id" value="">
        <button type="button" onclick="hideCart()">View Cart</button>
        <button type="button" onclick="checkout()">Checkout</button>
    </form>
</div>
<script>
    function hideCart() {
        const cart = document.getElementById("cartContainer");
        cart.classList.toggle("hideCart");
    }
    function checkout(){
        window.location.href = "cart.php";
    }
</script>