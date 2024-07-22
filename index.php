<?php
session_start();
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
                header('Location:index.php');
            }
        }
    $_SESSION['pid'] = $id;
    // header("Location:cart.php");
}
?>


<?php include "header.php"; ?>

<body>

    <!-- Main Wrapper Start -->
    <div id="main-wrapper" class="section">


        <!-- Header Section Start -->
        <?php include "header-nav.php"; ?>


        <!-- Hero Slider Start-->
        <div class="hero-slider section fix">

            <!-- Hero Slide Item Start-->
            <div class="hero-item" style="background-image: url(baner_best1.jfif); background-position: left; background-size:cover;">

                <!-- Hero Content Start-->
                <div class="hero-content text-center m-auto">

                    <h2>Save 25%</h2>
                    <h1>Eid Sale</h1>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                        alteration in some form, by injected humour, or randomised words which.</p>
                    <a href="#">LEARN MORE</a>

                </div><!-- Hero Content End-->


            </div><!-- Hero Slide Item End-->

            <!-- Hero Slide Item Start-->
            <div class="hero-item" style="background-image: url(baner_best.jfif)">

                <!-- Hero Content Start-->
                <div class="hero-content text-center m-auto">

                    <h2>Save 25%</h2>
                    <h1>Eid Sale</h1>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                        alteration in some form, by injected humour, or randomised words which.</p>
                    <a href="#">LEARN MORE</a>

                </div><!-- Hero Content End-->


            </div><!-- Hero Slide Item End-->

        </div><!-- Hero Slider End-->


        <!-- Banner Section Start-->
        <div class="banner-section section pt-120">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-30">

                        <div class="single-banner">
                            <img style="height: 380px;" src="baner3.jfif" alt="banner">
                            <div class="banner-content right">
                                <h1 class="white"><span>Gifts Of</span>Eid</h1>
                                <a href="#" class="button">Shop Now</a>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                        <div class="single-banner">
                            <img src="baner_best.jfif" style="height: 380px;" alt="banner">
                            <div class="banner-content left">
                                <h2 class="black"><span class="small text-light">Save <span class="red">25%</span></span><span
                                        class="red">Offer</span> Eid</h2>
                                        <a href="#" class="button">Shop Now</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div><!-- Banner Section End-->


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

                    $sel = "SELECT * FROM prd_details ORDER BY id DESC LIMIT 8";
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


        <!-- Testimonial Section Start-->
        <div class="testimonial-section section bg-gray pt-100 pb-65"
            style="background-image: url(img/bg/testimonial.png)">
            <div class="container">

                <!-- Section Title Start-->
                <div class="row">
                    <div class="section-title text-center col mb-60">
                        <h1>Customer Reviews</h1>
                    </div>
                </div><!-- Section Title End-->

                <div class="row">
                    <div class="col-lg-8 col-md-10 col-12 ml-auto mr-auto">

                        <!-- Testimonial Slider Start -->
                        <div class="testimonial-slider text-center">

                            <!-- Single Testimonial -->
                            <div class="single-testimonial">
                                <img src="man1.jfif" alt="customer">
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and
                                    praising pain was born and I will give you a complete account of the system.</p>
                                <h5>Betty Moore</h5>
                            </div>

                            <!-- Single Testimonial -->
                            <div class="single-testimonial">
                                <img src="man2.jfif" alt="customer">
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and
                                    praising pain was born and I will give you a complete account of the system.</p>
                                <h5>Betty Moore</h5>
                            </div>

                            <!-- Single Testimonial -->
                            <div class="single-testimonial">
                                <img src="man3.jfif" alt="customer">
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and
                                    praising pain was born and I will give you a complete account of the system.</p>
                                <h5>Betty Moore</h5>
                            </div>

                        </div><!-- Testimonial Slider End -->

                    </div>
                </div>

            </div>
        </div><!-- Testimonial Section End-->


        <!-- Newsletter Section Start-->
        <div class="newsletter-section section pt-100 pb-120">
            <div class="container">

                <!-- Section Title Start-->
                <div class="row">
                    <div class="section-title text-center col mb-55">
                        <h1>Newsletter</h1>
                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled
                            and demoralized by the charms of pleasure of the moment.</p>
                    </div>
                </div><!-- Section Title End-->

                <div class="row">
                    <div class="text-center col">

                        <!-- Newsletter Form -->
                        <form
                            action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                            method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                            class="subscribe-form validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                                <label for="mce-EMAIL" class="d-none">Subscribe to our mailing list</label>
                                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL"
                                    placeholder="Your email address" required>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                                        name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                <button type="submit" name="subscribe" id="mc-embedded-subscribe"
                                    class="button">subscribe</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div><!-- Testimonial Section End-->


        <!-- Blog Section Start-->
        <div class="blog-section section bg-gray pt-100 pb-60">
            <div class="container">

                <!-- Section Title Start-->
                <div class="row">
                    <div class="section-title text-center col mb-60">
                        <h1>our happy customers</h1>
                    </div>
                </div><!-- Section Title End-->

                <div class="row">

                    <!-- Blog Item Start-->
                    <div class="blog-item col-lg-4 col-md-6 col-12 mb-60">

                        <!-- Image -->
                        <a href="blog-details.php" class="image"><img src="man1.jfif" alt="blog"></a>

                        <!-- Content -->
                        <div class="content fix">

                            <!-- Publish Date -->
                            <span class="publish"><span>Published on:</span> 25 May 2017</span>

                            <!-- Title -->
                            <h4 class="title"><a href="blog-details.php">If you are going to use a passage.</a></h4>

                            <!-- Decs -->
                            <p>If you are going to use a passage of Lorem Ipsum, yneed to be sure there isn't anything
                                embarrassing hidden ithe middle text. All the Lorem Ipsum.</p>

                            <!-- Read More Link -->
                            <a href="blog-details.php" class="read-more">Read More</a>

                        </div>

                    </div><!-- Blog Item End-->

                    <!-- Blog Item Start-->
                    <div class="blog-item col-lg-4 col-md-6 col-12 mb-60">

                        <!-- Image -->
                        <a href="blog-details.php" class="image"><img src="man2.jfif" alt="blog"></a>

                        <!-- Content -->
                        <div class="content fix">

                            <!-- Publish Date -->
                            <span class="publish"><span>Published on:</span> 25 May 2017</span>

                            <!-- Title -->
                            <h4 class="title"><a href="blog-details.php">Ut enim ad minima veniam, quis.</a></h4>

                            <!-- Decs -->
                            <p>If you are going to use a passage of Lorem Ipsum, yneed to be sure there isn't anything
                                embarrassing hidden ithe middle text. All the Lorem Ipsum.</p>

                            <!-- Read More Link -->
                            <a href="blog-details.php" class="read-more">Read More</a>

                        </div>

                    </div><!-- Blog Item End-->

                    <!-- Blog Item Start-->
                    <div class="blog-item col-lg-4 col-md-6 col-12 mb-60">

                        <!-- Image -->
                        <a href="blog-details.php" class="image"><img src="man3.jfif" alt="blog"></a>

                        <!-- Content -->
                        <div class="content fix">

                            <!-- Publish Date -->
                            <span class="publish"><span>Published on:</span> 25 May 2017</span>

                            <!-- Title -->
                            <h4 class="title"><a href="blog-details.php">At vero eos et accusamus et iusto</a></h4>

                            <!-- Decs -->
                            <p>If you are going to use a passage of Lorem Ipsum, yneed to be sure there isn't anything
                                embarrassing hidden ithe middle text. All the Lorem Ipsum.</p>

                            <!-- Read More Link -->
                            <a href="blog-details.php" class="read-more">Read More</a>

                        </div>

                    </div><!-- Blog Item End-->

                </div>

            </div>
        </div><!-- Blog Section End-->


        <!-- Footer Section Start-->


        <?php include "footer.php"; ?>
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