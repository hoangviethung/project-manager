<!DOCTYPE html>
<html lang="en">

<head>
    <title>LAJEW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300&amp;subset=latin,vietnamese" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>toastr/build/toastr.css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo site_url('statics/default/swiper/dist/css/swiper.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/aos.css">
    <link href="<?php echo base_url("statics/default/"); ?>css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url("statics/default/"); ?>css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="shortcut icon" type="ico" href="<?php echo base_url("statics/default/"); ?>images/favicon.png" />
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div style="background:#43d1ca;widht:100%;">
    <div class="container">
    <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="color:white;"><p style="font-weight:500;margin-bottom:0!important">Light Up Beauty</p></marquee>
    </div>
    </div>


    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <form method=get action="<?php echo site_url("/search"); ?>">
                            <div class="search-wrap">
                                <div class="float-left search_text" style="width:80%">
                                    <input type="text" name='search' class='search' style="width:100%" onfocusin='searchFocusIn()' onfocusout='searchFocusOut()' placeholder="Tìm Kiếm">
                                </div>
                                <div class="text-right">
                                    <button type=submit class="search-btn"><i class="fas fa-search" style="display:inline"></i></button>
                                </div>
                            </div>
                        </form>
                        <script>
                            function searchFocusIn() {
                                $(".search-wrap").addClass('focus-in');
                            }

                            function searchFocusOut() {
                                $(".search-wrap").removeClass('focus-in');
                            }
                        </script>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="<?php echo site_url(); ?>" class="site-logo">
                            <img src="<?php echo base_url("statics/default/"); ?>images/logo.png" alt="Image" class="img-fluid logo">
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-left float-left cart-item">
                            <a href="https://www.facebook.com/" class="mx-1" style="font-size:1.3rem">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="<?php echo site_url('cart');?>"><i class="fas fa-shopping-cart"></i></a>
                            <a id="cart" class="mx-2" style="font-size:1rem">
                                 Cart
                                <div class="cart-number"><?php echo isset($_SESSION['cart']['total_quantity'])?$_SESSION['cart']['total_quantity']:0;?></div>
                            </a>  
                            <!-- <a id="cart"><i class="fas fa-shopping-cart"></i> Cart <span class="badge">{{quantity}}</span></a> -->
                            
                            <div class="shopping-cart pb-3" >
                            
                                <div class="shopping-cart-header text-left">
                                    <form action='<?php echo site_url('cart/remove_cart');?>' method=post>
                                        <?php 
                                            $currentURL = current_url();
                                            $params   = $_SERVER['QUERY_STRING'];
                                            if(!empty($params))
                                            {
                                                $fullURL = $currentURL . '?' . $params; 
                                            }else{
                                                $fullURL = $currentURL;
                                            }
                                        ?>
                                            <input type=hidden name=url value="<?php echo $fullURL;?>">
                                            <span class="badge mr-2"><?php echo isset($_SESSION['cart']['total_quantity'])?$_SESSION['cart']['total_quantity']:0;?></span>
                                            <?php if(isset($_SESSION['cart'])):?>
                                            <button type=submit class='text-left bg-white remove-cart-icon mr-auto'>Xoá <i class="fas fa-trash-alt"></i></button>
                                            <?php endif;?>
                                    <div class="shopping-cart-total">
                                        <span class="lighter-text">Tổng:</span>
                                        <span class="main-color-text"><?php echo isset($_SESSION['cart']['total_price'])?number_format($_SESSION['cart']['total_price'],0):0;?> VND</span>
                                    </div>
                                    </form>

                                </div>
                                <?php if(isset($cart_products)){?>
                                <ul class="shopping-cart-items">
                                    <?php 
                                    
                                        foreach($cart_products as $cart_product){
                                    ?>
                                        <li class="clearfix">
                                            <img src="<?php echo base_url('assets/public/avatar/').$cart_product->img1;?>" class="img-fluid mt-3" style="width:40%">
                                            <b><span class="item-name"><?php echo $cart_product->name?></span></b>
                                            <?php if($cart_product->sale==0):?>
                                            <span class="item-price">Giá: <?php echo number_format($cart_product->price,0);?></span>
                                        <?php else:?>
                                        <span class="item-price">Giá: <?php echo number_format($cart_product->discount_price,0);?></span>
                                        <?php endif;?>
                                            <p class="item-quantity mt-0 mb-0">Số Lượng: <?php echo $cart_product->cart['quantity']?></p>
                                        </li>
                                    <?php
                                        }
                                    ?>
                                    <a href="<?php echo site_url('cart');?>" class="check-out-btn">Giỏ Hàng</a>
                                </ul>
                                <?php }else{
                                            echo '<p class="mt-3">Giỏ Hàng Trống</p>';
                                        } ?>
                            </div>

                        </div>
                        <div class="text-right">
                            <a href="#" class="mx-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><i class="fas fa-list"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <div class="mx-auto">
                            <nav class="site-navigation position-relative text-left" role="navigation">
                                <ul class="site-menu main-menu js-clone-nav mx-auto d-none pl-0 d-lg-block border-none">
                                    <li class="<?php echo $this->uri->segment(1) == "" ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>" class="nav-link text-left">HOME</a></li>
                                    <?php if(isset($categories)):?>
                                    <?php foreach ($categories as $category) { ?>
                                        <?php if ($category->level == 0) { ?>
                                            <li class="<?php echo $this->uri->segment(1) == $category->slug || (isset($category_parent) && $category->slug == $category_parent->slug) ? "active" : ""; ?>"><a href="<?php echo site_url($category->slug); ?>" class="nav-link text-left"><?php echo $category->name; ?></a></li>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php endif;?>
                                    <li class="<?php echo $this->uri->segment(1) == "sale" ? "active" : ""; ?>"><a href="<?php echo site_url('sale'); ?>" class="nav-link text-left menu-sale">SALE</a></li>
                                    <li class="<?php echo $this->uri->segment(1) == "search-order" ? "active" : ""; ?>"><a href="<?php echo site_url('search-order'); ?>" class="nav-link text-left">Theo dõi đơn hàng</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>