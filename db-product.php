<div class="row">
                
                <!-- Product Start-->

                <?php

                 while($data = mysqli_fetch_assoc($q)){

                 
                ?>
                <div class="col-lg-4 col-md-6 col-12 mb-60">
                   
                    <div class="product">

                        <!-- Image Wrapper -->
                        <div class="image">
                            <!-- Image -->
                            <a href="product-details.php" class="img"><img src="/classes/Dark-Admin/images/<?php echo $data['img']?>" alt="Product"></a>
                            <!-- Wishlist -->
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
                                    <h5 class="title"><a href="product-details.php"><?php echo $data['name']; ?></a></h5>
                                    <a href="shop.php" class="category">Catalog</a>
                                </div>
                                <!-- Price -->
                                <div class="price float-right">
                                    <span class="new"><?php echo $data['price']; ?></span>
                                    <!-- Old Price Mockup If Need -->
                                    <!-- <span class="old">$46</span> -->
                                </div>
                                
                            </div>
                            
                            <!-- Action Button -->
                            <div class="action-button fix">
                                <a href="#">add to cart</a>
                            </div>
                            
                        </div>

                    </div>
                    
                </div><!-- Product End-->
                <?php } ?>
                
                
                
                
                
                
            </div>