<?php include "header.php" ?>

<body>

<!-- Main Wrapper Start -->
<div id="main-wrapper" class="section">
    

    <!-- Header Section Start -->
     <?php include "header-nav.php" ?>
    <!-- Header Section End -->
    
       
    <!-- Page Banner Section Start-->
    <div class="page-banner-section section" style="background-image: url(img/bg/page-banner.jpg)">
        <div class="container">
            <div class="row">
                
                <!-- Page Title Start -->
                <div class="page-title text-center col">
                    <h1>Wishlist</h1>
                </div><!-- Page Title End -->
                
            </div>
        </div>
    </div><!-- Page Banner Section End-->
    
       
    <!-- Wishlist Section Start-->
    <div class="wishlist-section section pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   
                    <div class="table-responsive mb-30">
                        <table class="table cart-table text-center">
                            
                            <!-- Table Head -->
                            <thead>
                                <tr>
                                    <th class="number">#</th>
                                    <th class="image">image</th>
                                    <th class="name">product name</th>
                                    <th class="qty">stock status</th>
                                    <th class="price">price</th>
                                    <th class="total">add to cart</th>
                                    <th class="remove">remove</th>
                                </tr>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                <tr>
                                    <td><span class="cart-number">1</span></td>
                                    <td><a href="#" class="cart-pro-image"><img src="img/product/1.jpg" alt="" /></a></td>
                                    <td><a href="#" class="cart-pro-title">Holiday Candle</a></td>
                                    <td><p class="stock in-stock">in stock</p></td>
                                    <td><p class="cart-pro-price">$104.99</p></td>
                                    <td><button class="wl-add-cart-btn">add to cart</button></td>
                                    <td><button class="cart-pro-remove"><i class="fa fa-trash-o"></i></button></td>
                                </tr>
                                <tr>
                                    <td><span class="cart-number">2</span></td>
                                    <td><a href="#" class="cart-pro-image"><img src="img/product/2.jpg" alt="" /></a></td>
                                    <td><a href="#" class="cart-pro-title">Christmas Tree</a></td>
                                    <td><p class="stock in-stock">in stock</p></td>
                                    <td><p class="cart-pro-price">$85.99</p></td>
                                    <td><button class="wl-add-cart-btn">add to cart</button></td>
                                    <td><button class="cart-pro-remove"><i class="fa fa-trash-o"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div><!-- Wishlist Section End-->

       
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