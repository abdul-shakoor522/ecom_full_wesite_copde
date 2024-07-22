<?php
session_start();
include "db.php";
include "warning.php";

$sel_tp = "SELECT * FROM cart";
$tp_q = mysqli_query($con, $sel_tp);
date_default_timezone_set('Asia/Karachi');
$date = date('m/d/Y');
$total_prds = mysqli_num_rows($tp_q);
$total_price = $_SESSION['total_price'];
if (isset($_POST['order'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $ch_user = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $ch_q = mysqli_query($con, $ch_user);
    $data_ch = mysqli_fetch_assoc($ch_q);
    if ($ch_q->num_rows > 0) {
        $user_no1 = $data_ch['user_no'];
        $upd_user = "UPDATE users SET name='$name',email='$email', password='$password',
         country='$country', address='$address', phone='$phone' WHERE user_no='$user_no1'";
        mysqli_query($con, $upd_user);
        echo 'UPDATED';

        $user_ch = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $user_q = mysqli_query($con, $user_ch);
        $data_no = mysqli_fetch_assoc($user_q);
        $_SESSION['user_no'] = $data_no['user_no'];
        $user_no = $_SESSION['user_no'];
        $ch_order = "SELECT * FROM orders WHERE user_no='$user_no'";
        $order_q = mysqli_query($con, $ch_order);
        if ($order_q->num_rows > 0) {
            $upd_order = "UPDATE orders SET order_no = order_no+1,
            total_product=total_product+$total_prds,total_price=total_price+$total_price, date='$date' WHERE user_no='$user_no'";
            $upd_q = mysqli_query($con, $upd_order);
        }

        //orderd_products work-->Fetching data from cart using while loop--->fetching from orders where user_no=$user_no

        $cart_1 = "SELECT * FROM cart";
        $cart_q = mysqli_query($con, $cart_1);
        while ($cart_data = mysqli_fetch_assoc($cart_q)) {
            $prd_id = $cart_data['product_id'];
            $prd_qty = $cart_data['qty'];
            $prd_price = $cart_data['price'];

            $sel_order = "SELECT * FROM orders WHERE user_no='$user_no'";
            $order_q1 = mysqli_query($con, $sel_order);
            $order_d = mysqli_fetch_assoc($order_q1);
            $order_no = $order_d['order_no'];


            //new
            $sel_unq = "SELECT * FROM orderd_products WHERE product_id='$prd_id'";
            $unq_q = mysqli_query($con, $sel_unq);
            $unq_d = mysqli_fetch_assoc($unq_q);
            $unq_qty = $unq_d['qty'];
            //new-end
            $sel_prd = "SELECT * FROM orderd_products WHERE product_id='$prd_id' AND user_no='$user_no'";
            $prd_q = mysqli_query($con, $sel_prd);
            if($prd_q->num_rows>0){
                
                $upd_p = "UPDATE orderd_products SET
                 order_no='$order_no',qty='$prd_qty'+'$unq_qty' WHERE user_no='$user_no' AND product_id='$prd_id'";
                 mysqli_query($con, $upd_p);
                 //del cart
                 $del_cart = "DELETE FROM cart";
                mysqli_query($con, $del_cart);
                header("location:index.php");
                }else{ 
                    
                    //inserting data into orderd_products
                    //start
                    $sel_order1 = "SELECT * FROM orderd_products WHERE user_no='$user_no'";
                    $qqq = mysqli_query($con, $sel_order1);
                    // $DD = mysqli_fetch_assoc($qqq);
                    // $user0 = $DD['user_no']; 
                if($qqq->num_rows>0){
                    $ins_new = "INSERT INTO orderd_products(user_no,order_no,product_id, qty, price) VALUES('$user_no', $order_no+1, '$prd_id','$prd_qty','$prd_price')";
                }
                $ins2 = "INSERT INTO 
                orderd_products(user_no, order_no, product_id, qty, price)
                 VALUES('$user_no','$order_no','$prd_id','$prd_qty','$prd_price')";
                mysqli_query($con, $ins2);
                $del_cart = "DELETE FROM cart";
                mysqli_query($con, $del_cart);
                header("location:index.php");
                }
            //End
        }

    } else {
        $add_user = "INSERT INTO users(name, email, password, country, address, phone)
         VALUES('$name', '$email', '$password', '$country', '$address', '$phone')";
        $add_q = mysqli_query($con, $add_user);
        $get_user = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $get_q = mysqli_query($con, $get_user);
        $dd_get = mysqli_fetch_assoc($get_q);
        $unq_user = $dd_get['user_no'];


        $ins_order = "INSERT INTO orders(user_no, order_no, total_product, total_price, date, status) VALUES('$unq_user', '1', '$total_prds', '$total_price', '$date', 'Pending')";
        $order_q = mysqli_query($con, $ins_order);


        $user_ch = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $user_q = mysqli_query($con, $user_ch);
        $data_no = mysqli_fetch_assoc($user_q);
        $_SESSION['user_no'] = $data_no['user_no'];
        $user_no = $_SESSION['user_no'];

        //sart
        $cart_1 = "SELECT * FROM cart";
        $cart_q = mysqli_query($con, $cart_1);
        while ($cart_data = mysqli_fetch_assoc($cart_q)) {
            $prd_id = $cart_data['product_id'];
            $prd_qty = $cart_data['qty'];
            $prd_price = $cart_data['price'];

            $sel_order = "SELECT * FROM orders WHERE user_no='$user_no'";
            $order_q1 = mysqli_query($con, $sel_order);
            $order_d = mysqli_fetch_assoc($order_q1);
            $order_no = $order_d['order_no'];


            //inserting data into orderd_products
            //start
            $sel_order1 = "SELECT * FROM orderd_products WHERE user_no='$user_no'";
            $qqq = mysqli_query($con, $sel_order1);
            // $DD = mysqli_fetch_assoc($qqq);
            // $user0 = $DD['user_no']; 
            if($qqq->num_rows>0){
                $ins_new = "INSERT INTO orderd_products(user_no,order_no,product_id, qty, price) VALUES('$user_no', $order_no+1, '$prd_id','$prd_qty','$prd_price')";
            }
            $ins2 = "INSERT INTO 
            orderd_products(user_no, order_no, product_id, qty, price)
             VALUES('$user_no','$order_no','$prd_id','$prd_qty','$prd_price')";
            mysqli_query($con, $ins2);
            $del_cart = "DELETE FROM cart";
            mysqli_query($con, $del_cart);
            header("location:index.php");
            //End
        }   
        //End

        $cart_1 = "SELECT * FROM cart";
        $cart_q = mysqli_query($con, $cart_1);
        while ($cart_data = mysqli_fetch_assoc($cart_q)) {
            $prd_id = $cart_data['product_id'];
            $prd_qty = $cart_data['qty'];
            $prd_price = $cart_data['price'];

            $sel_order = "SELECT * FROM orders WHERE user_no='$user_no'";
            $order_q1 = mysqli_query($con, $sel_order);
            $order_d = mysqli_fetch_assoc($order_q1);
            $order_no = $order_d['order_no'];

            $ins2 = "INSERT INTO 
            orderd_products(order_no, product_id, qty, price)
             VALUES('$order_no','$prd_id','$prd_qty','$prd_price')";
            mysqli_query($con, $ins2);

            $del_cart = "DELETE FROM cart";
            mysqli_query($con, $del_cart);
            header("location:index.php");

        }
    }

}


?>

<?php include "header.php"; ?>

<body>

    <!-- Main Wrapper Start -->
    <div id="main-wrapper" class="section">


        <!-- Header Section Start -->
        <?php include "header-nav.php"; ?>
        <!-- Header Bottom End -->

    </div><!-- Header Section End -->


    <!-- Page Banner Section Start-->
    <div class="page-banner-section section" style="background-image: url(img/bg/page-banner.jpg)">
        <div class="container">
            <div class="row">

                <!-- Page Title Start -->
                <div class="page-title text-center col">
                    <h1>Checkout</h1>
                </div><!-- Page Title End -->

            </div>
        </div>
    </div><!-- Page Banner Section End-->


    <form action="" method="POST" class="checkout-login-form">

        <!-- Checkout Section Start-->
        <div class="cart-section section pt-120 pb-90">
            <div class="container">


                <div class="row">

                    <div class="col-lg-6 col-12 mb-30">

                        <!-- Checkout Accordion Start -->
                        <div id="checkout-accordion" class="panel-group">

                            <!-- Checkout Method -->
                            <div class="panel single-accordion">

                                <a class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion"
                                    href="#checkout-method">Checkout method</a>

                                <div id="checkout-method" class="collapse show">
                                    <div class="checkout-method accordion-body fix">

                                        <ul class="checkout-method-list">
                                            <!-- <li class="active" data-form="checkout-login-form">Login</li> -->

                                        </ul>

                                        <div class="row">
                                            <div class="input-box col-md-6 col-12 mb-20"><input type="text"
                                                    placeholder="Name : " name="name" required></div>
                                            <div class="input-box col-md-6 col-12 mb-20"><input type="email"
                                                    placeholder="Email Address : " name="email" required></div>
                                            <div class="input-box col-md-6 col-12 mb-20"><input type="text"
                                                    placeholder="Password : " name="password" required></div>
                                            <div class="input-box col-md-6 col-12 mb-20"><input type="text"
                                                    placeholder="Country : " name="country" required></div>
                                            <div class="input-box col-md-6 col-12 mb-20"><input type="text"
                                                    placeholder="Address : " name="address" required></div>
                                            <div class="input-box col-md-6 col-12 mb-20"><input type="text"
                                                    placeholder="Phone : " name="phone" required></div>

                                        </div>



                                    </div>
                                </div>

                            </div>






                        </div><!-- Checkout Accordion Start -->

                    </div>

                    <!-- Order Details -->
                    <div class="col-lg-6 col-12 mb-30">

                        <div class="order-details-wrapper">
                            <h2>your order</h2>
                            <div class="order-details">
                                <ul>
                                    <li>
                                        <p class="strong">product</p>
                                        <p class="strong">total</p>
                                    </li>
                                    <?php

                                    $sel = "SELECT * FROM cart";
                                    $qry = mysqli_query($con, $sel);
                                    $tp = 0;
                                    while ($data = mysqli_fetch_assoc($qry)) {
                                        $id = $data['product_id'];
                                        $sel_prd = "SELECT * FROM prd_details WHERE id='$id'";
                                        $q = mysqli_query($con, $sel_prd);
                                        $d = mysqli_fetch_assoc($q);
                                        $qty = $data['qty'];
                                        $tp += $d['price'] * $qty;
                                        // $tp *= $qty;
                                        ?>
                                        <li>
                                            <p><?php echo $d['name']; ?></p>
                                            <p><?php echo $d['price'] . " X " . $qty; ?></p>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <p class="strong">cart subtotal</p>
                                        <p class="strong"><?php echo $tp;
                                        $_SESSION['total_price'] = $tp; ?></p>
                                    </li>
                                    <li>
                                        <p class="strong">shipping</p>
                                        <p>
                                            <input type="radio" name="order-shipping" id="flat" /><label for="flat">Flat
                                                Rate $ 7.00</label><br />
                                            <input type="radio" name="order-shipping" id="free" /><label for="free">Free
                                                Shipping</label>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="strong">order total</p>
                                        <p class="strong"><?php echo $tp; ?></p>
                                    </li>
                                    <li><button class="button" name="order">place order</button></li>
                                </ul>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div><!-- Checkout Section End-->
    </form>

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