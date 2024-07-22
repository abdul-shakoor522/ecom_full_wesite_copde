<?php
include "db.php";
include "header.php";
$se = "SELECT * FROM cart";
$sql = mysqli_query($con, $se);
$num_rows = mysqli_num_rows($sql);
if (isset($_POST['remove'])) {

    // $rr = $_SESSION['pid'];
    $delid = $_POST['delid'];
    $del = "DELETE FROM cart WHERE id='$delid'";
    if(mysqli_query($con, $del)){
        header("Location:index.php");
    }
}
?>
<div class="header-section section">

    <!-- Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Header Top Wrapper Start -->
                    <div class="header-top-wrapper">
                        <div class="row">

                            <!-- Header Social -->
                            <div class="header-social col-md-4 col-12">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>

                            <!-- Header Logo -->
                            <div class="header-logo col-md-4 col-12">
                                <a href="index.php" class="logo"><img style="width:400px;" src="img/Main_Logo.png" alt="logo"></a>
                            </div>

                            <!-- Account Menu -->
                            <div class="account-menu col-md-4 col-12">
                                <ul>
                                    <li><a href="contact.php">My Account</a></li>
                                    <li><a href="wishlist.php">Wishlist</a></li>
                                    <li><a href="#" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i><span
                                                class="num"><?php echo $num_rows; ?></span></a>

                                        <!-- Mini Cart -->
                                        <div class="mini-cart-brief dropdown-menu text-left">
                                            <!-- Cart Products -->
                                            <div class="all-cart-product clearfix">
                                                <?php
                                                // session_start();
                                                


                                                $total_price = 0;

                                                // echo $id;
                                                while ($data = mysqli_fetch_assoc($sql)) {
                                                    $qty = $data['qty'];
                                                    $pro_id = $data['product_id'];
                                                    $cond = "SELECT * FROM prd_details WHERE id = '$pro_id'";
                                                    $qs = mysqli_query($con, $cond);
                                                    $d = mysqli_fetch_assoc($qs);
                                                    $total_price += $d['price']*$qty;
                                                    // $total_price *=$qty;

                                                    ?>
                                                    <div class="single-cart clearfix">
                                                        <div class="cart-image">
                                                            <a href="product-details.php"><img
                                                                    src="/classes/Dark-Admin/images/<?php echo $d['img'] ?>"
                                                                    alt=""></a>
                                                        </div>
                                                        <div class="cart-info">
                                                            <h5><a href="product-details.php"><?php echo $d['name']; ?></a>
                                                            </h5>
                                                            <p><?php echo $d['price'] . ' X ' . $data['qty']; ?></p>
                                                            <form action="" method="POST">
                                                                <input type="hidden" value="<?php echo $data['id']; ?>"
                                                                    name="delid">
                                                                <button class="cart-delete border" name="remove"
                                                                    title="Remove this item"><i
                                                                        class="fa fa-trash-o"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <!-- Cart Total -->
                                            <div class="cart-totals">
                                                <h5>Total <span><?php echo $total_price; ?></span></h5>
                                            </div>
                                            <!-- Cart Button -->
                                            <div class="cart-bottom  clearfix">
                                                <a href="cart.php">View cart</a>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div><!-- Header Top Wrapper End -->

                </div>
            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom section">
        <div class="container">
            <div class="row">

                <!-- Header Bottom Wrapper Start -->
                <div class="header-bottom-wrapper text-center col">

                    <!-- Header Bottom Logo -->
                    <div class="header-bottom-logo">
                        <a href="index.php" class="logo"><img src="img/logo.png" alt="logo"></a>
                    </div>

                    <!-- Main Menu -->
                    <nav id="main-menu" class="main-menu">
                        <ul>
                            <li class="active"><a href="index.php">home</a></li>
                            <li><a href="shop.php">shop</a>
                                <ul class="sub-menu">
                                    <li><a href="shop.php">shop page</a></li> 
                                </ul>
                            </li>
                            <li><a href="about.php">about</a></li>
                            <li><a href="#">pages</a>
                                <ul class="sub-menu">
                                    <li><a href="cart.php">cart</a></li>
                                    <li><a href="checkout.php">checkout</a></li>
                                    <li><a href="wishlist.php">wishlist</a></li>
                                    <li><a href="under-construction.php">Under Construction</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.php">blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.php">blog page</a></li>
                                    <li><a href="blog-details.php">blog details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.php">contact</a></li>
                        </ul>
                    </nav>

                    <!-- Header Search -->
                    <div class="header-search">

                        <!-- Search Toggle -->
                        <button class="search-toggle"><i class="ion-ios-search-strong"></i></button>

                        <!-- Search Form -->
                        <div class="header-search-form">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>

                    </div>

                    <!-- Mobile Menu -->
                    <div class="mobile-menu section d-md-none"></div>

                </div><!-- Header Bottom Wrapper End -->

            </div>
        </div>
    </div><!-- Header Bottom End -->

</div><!-- Header Section End -->