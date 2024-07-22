<?php
include "db.php";

if (isset($_POST['add-to-cart'])) {
    $qty = 1;
    $ipaddress = getenv("REMOTE_ADDR");
    $id = $_POST['pid'];
    $cart = "SELECT * FROM cart WHERE product_id='$id'"; 
    $ddl = mysqli_query($con, $cart);
    $num_rows = mysqli_num_rows($ddl);
    $select_prd = "SELECT * FROM prd_details WHERE id='$id'";
    $select_1 = mysqli_query($con, $select_prd);
    $price_of_prd = mysqli_fetch_assoc($select_1);
    $real_price = $price_of_prd['price'];
    if($num_rows > 0){
        $ups_cart = "UPDATE cart SET qty='$qty' WHERE product_id='$id'";
        mysqli_query($con, $ups_cart);
    }
    else{
        $ins = "INSERT INTO cart(product_id, ip_address, price) VALUES('$id', '$ipaddress', '$real_price')";
        if (mysqli_query($con, $ins)) {
            header('Location:shop.php');
        }
    }
$_SESSION['pid'] = $id;
// header("Location:cart.php");
}

$sel = "SELECT * from prd_details";
if (isset($_POST['add-to-cart'])) {
    header("Location:shop.php");
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
        <div class="page-banner-section section" style="background-image: url(img/banner_new.jfif)">
            <div class="container">
                <div class="row">

                    <!-- Page Title Start -->
                    <div class="page-title text-center col">
                        <h1>shop page</h1>
                    </div><!-- Page Title End -->

                </div>
            </div>
        </div><!-- Page Banner Section End-->


        <!-- Product Section Start-->
        <div class="product-section section pt-70 pb-60">
            <div class="container">

                <!-- Section Title Start-->
                <div class="row">
                    <div class="section-title text-center col mb-60">
                        <h1>Featured Products</h1>
                    </div>
                </div><!-- Section Title End-->

                <!-- Product Wrapper Start-->

                <div class="row">

                    <!-- Product Start-->

                    <?php

                    $sel = "SELECT * FROM prd_details";
                    $q = mysqli_query($con, $sel);

                    while ($data = mysqli_fetch_assoc($q)) {


                        ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-60">

                            <div class="product">

                                <!-- Image Wrapper -->
                                <div class="image">
                                    <!-- Image -->
                                     <form action="" method="POST">
                                    <a href="product-details.php?id=<?php echo $data['id']; ?>" class="img"><img style="height:   250px;"
                                            src="/classes/Dark-Admin/images/<?php echo $data['img'] ?>" alt="Product"></a>
                                    <!-- Wishlist --></form>
                                    <a href="#" class="wishlist"><i class="fa fa-heart-o"></i></a>
                                    <!-- Label -->
                                    <span class="label">New</span>
                                </div>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Head Content -->
                                    <div class="head fix">

                                        <!-- Title & Category -->
                                        <div class="title-category float-left">
                                            <h5 class="title"><a href="product-details.php"><?php echo $data['name']; ?></a>
                                            </h5>
                                            <a href="shop.php" class="category">Catalog</a>
                                        </div>
                                        <!-- Price -->
                                        <div class="price float-right">
                                            <span class="new"><?php echo $data['price']; ?></span>
                                            <!-- Old Price Mockup If Need -->
                                            <span class="old">$46</span>
                                            
                                        </div>

                                    </div>

                                    <!-- Action Button -->
                                    <div class="action-button fix">
                                        <form action="" method="POST">
                                        <input type="hidden" name="pid" value="<?php echo $data['id'];  ?>">
                                        <button class="btn btn-dark" name="add-to-cart">add to cart</button>
                                        </form>
                                    </div>

                                </div>

                            </div>

                        </div><!-- Product End-->
                    <?php } ?>






                </div>
                <!-- Product Wrapper End-->

            </div>
        </div><!-- Product Section End-->


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