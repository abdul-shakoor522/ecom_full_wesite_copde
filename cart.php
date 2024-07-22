<?php
session_start();
include "db.php";
include "warning.php";
if(isset($_POST['delrec'])){
    $delid = $_POST['delcart'];
    $del = "DELETE FROM cart WHERE id='$delid'";
    mysqli_query($con, $del);
    
}

?>

<?php include "header.php"; ?>

<body>

    <!-- Main Wrapper Start -->
    <div id="main-wrapper" class="section">


        <!-- Header Section Start -->
        <?php include "header-nav.php"; ?>
        <!-- Header Section End -->


        <!-- Page Banner Section Start-->
        <div class="page-banner-section section" style="background-image: url(img/bg/page-banner.jpg)">
            <div class="container">
                <div class="row">

                    <!-- Page Title Start -->
                    <div class="page-title text-center col">
                        <h1>Cart</h1>
                    </div><!-- Page Title End -->

                </div>
            </div>
        </div><!-- Page Banner Section End-->


        <!-- Cart Section Start-->
        <div class="cart-section section pt-120 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="table-responsive mb-30">
                            <table class="table cart-table text-center">

                                <!-- Table Head -->
                                <thead>
                                    <tr>
                                        <th class="number">id</th>
                                        <th class="image">image</th>
                                        <th class="name">product name</th>
                                        <th class="qty">quantity</th>
                                        <th class="price">price</th>
                                        <th class="total">totle</th>
                                        <th class="remove">remove</th>
                                    </tr>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                    <?php

                                    $se = "SELECT * FROM cart";
                                    $sql = mysqli_query($con, $se);

                                    $total_price = 0;
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                        $tlp = 0;
                                        $id = $data['product_id'];
                                        $cond = "SELECT * FROM prd_details WHERE id = '$id'";
                                        $qs = mysqli_query($con, $cond);
                                        $d = mysqli_fetch_assoc($qs);
                                        $qty = $data['qty'];
                                        $total_price +=$d['price']*$qty; 
                                        $tlp +=$d['price']*$qty; 
                                        // $total_price *=$qty;

                                        ?>
                                        <tr>
                                            <td><span class="cart-number"><?php echo $data['id']; ?></span></td>
                                            <td><a href="#" class="cart-pro-image"><img
                                                        src="/classes/Dark-Admin/images/<?php echo $d['img'] ?>"
                                                        alt="" /></a></td>
                                            <td><a href="#" class="cart-pro-title"><?php echo $d['name']; ?></a></td>
                                            <td>
                                                <div class="product-quantity">
                                                    <input type="text" value="<?php echo $data['qty']; ?>" name="qtybox">
                                                </div>
                                            </td>
                                            <td>
                                                <p class="cart-pro-price"><?php echo $d['price'].' X '.$qty; ?></p>
                                            </td>
                                            <td>
                                                <p class="cart-price-total"><?php echo $tlp; ?></p>
                                            </td>
                                            <td>
                                                <form action="" method="POST">
                                                <input type="hidden" name="delcart" value="<?php echo $data['id'] ?>">
                                                <button class="cart-pro-remove" name="delrec"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">

                            <!-- Cart Action -->
                            <div class="cart-action col-lg-4 col-md-6 col-12 mb-30">
                                <a href="index.php" class="button">Continiue Shopping</a>
                                <button class="button">update cart</button>
                            </div>

                            <!-- Cart Cuppon -->
                            <div class="cart-cuppon col-lg-4 col-md-6 col-12 mb-30">
                                <h4 class="title">Discount Code</h4>
                                <p>Enter your coupon code if you have</p>
                                <form action="#" class="cuppon-form">
                                    <input type="text" placeholder="Cuppon Code">
                                    <button class="button">apply coupon</button>
                                </form>
                            </div>

                            <!-- Cart Checkout Progress -->
                            <div class="cart-checkout-process col-lg-4 col-md-6 col-12 mb-30">
                                <h4 class="title">Process Checkout</h4>
                                <p><span>Subtotal</span><?php echo $total_price; ?></>
                                </p>
                                <h5><span>Grand total</span><span><?php echo $total_price; ?></span></h5>
                                <a href="checkout.php" class="btn btn-danger">process to checkout</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div><!-- Cart Section End-->


        <!-- Footer Section Start-->
        <?php include "footer.php"; ?>
        <!-- Footer Section End-->


    </div><!-- Main Wrapper End -->

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins JS -->
    <script src="js/plugins.js"></script>
    <!-- Ajax Mail JS -->
    <script src="js/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
</body>


</html>