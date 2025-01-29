<style>
    #cartContainer{
        background-color: whitesmoke;
        width: 400px;
        height: 100vh;
        float: right;
        padding-top: 10vh;
        padding-left: 20px;
        padding-right: 20px;
        border-left: 2px solid lightgray;
    }
    #cartContainer h2{
        text-align: center;
    }
    #cartContainer span{
        float: right;
        
    }
    .half_line{
        opacity: 0.5;
    }
    .full_line{
        color: black;
    }

</style>
<div id="cartContainer">
    <h2>Cart</h2>
    <hr class="full_line">
    <strong>item 1: <span>$money</span></strong>
    <hr class="half_line">
    <strong>item 2: <span>$money</span></strong>
    <hr class="half_line">
    <strong>item 3: <span>$money</span></strong>
    <hr class="full_line">
    <strong>sub total: <span>$totalMoney</span></strong>
    <br><br><br><br><br><br>
    
    <button id="checkoutBtn">Checkout</button>
</div>