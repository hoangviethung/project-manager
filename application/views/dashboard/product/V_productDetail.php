<section class="product-overview py-2">
    <div class="container">
        <div class="row">
            <!-- <div class="col-12">
                <p style="font-size:.9rem" class="mt-1">
                    <a class="" href="<?php echo site_url(); ?>">Home</a> <?php echo isset($product) ? "<a class='' href='" . site_url() . $product->category_slug . "'>&nbsp;&nbsp;/&nbsp;&nbsp;<b>" . $product->category_name . "</b></a>" : ''; ?>
                </p>
            </div> -->
            <div class="col-12 text-left">
                <p style="font-size:.9rem" class="mt-3 border p-1 breadcrumb bg-light">
                    <a class='mr-2 ml-2'><i class="fas fa-home"></i></a><a class="text-dark ml-0" href="<?php echo site_url(); ?>">Home</a> <?php echo $this->uri->segment(1) == 'sale' ? ' Sale' : ''; ?><?php echo isset($product_category_0) ? "<a class='text-dark' href='" . site_url() . $product_category_0->slug . "'><img src='" . base_url('assets/public/avatar/') . "Screenshot_121.png' class='arrow-right'>" . $product_category_0->name . "</a>" : ''; ?><?php if (isset($product_category_1) && $product_category_1 == TRUE) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "<a class='text-dark' href='" . site_url() . $product_category_1->slug . "'><img src='" . base_url('assets/public/avatar/') . "Screenshot_121.png' class='arrow-right'>" . $product_category_1->name . "</a>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?><?php echo isset($product_category) ? "<a class='text-dark' style='font-weight:500' href='" . site_url() . $product_category->slug . "'><img src='" . base_url('assets/public/avatar/') . "Screenshot_121.png' class='arrow-right'><b>" . $product_category->name . "</b></a>" : ''; ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-sm-12 product-overview-images border-top border-bottom border-left p-5">
                <div class="swiper-container gallery-top">
                    <div class="swiper-wrapper">
                    <?php if($images):?>
                        <?php foreach($images as $image):?>
                        <?php if($image->main==1):?>
                        <div class="swiper-slide" style="background-image:url('<?php echo base_url(); ?><?php echo 'assets/public/avatar/' . $image->image_file; ?>')">
                        </div>
                        <?php endif;?>
                        <?php endforeach;?>
                        <?php endif;?>
                        <?php if($images):?>
                        <?php foreach($images as $image):?>
                        <div class="swiper-slide" style="background-image:url('<?php echo base_url(); ?><?php echo 'assets/public/avatar/' . $image->image_file; ?>')">
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next swiper-button-black"></div>
                    <div class="swiper-button-prev swiper-button-black"></div>
                </div>
                <div class="swiper-container gallery-thumbs">
                    <div class="swiper-wrapper">
                    <?php if($images):?>
                        <?php foreach($images as $image):?>
                        <?php if($image->main==1):?>
                        <div class="swiper-slide" style="background-image:url('<?php echo base_url(); ?><?php echo 'assets/public/avatar/' . $image->image_file; ?>')">
                        </div>
                        <?php endif;?>
                        <?php endforeach;?>
                        <?php endif;?>

                        <?php if($images):?>
                        <?php foreach($images as $image):?>
                        <div class="swiper-slide" style="background-image:url('<?php echo base_url(); ?><?php echo 'assets/public/avatar/' . $image->image_file; ?>')">
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    <div class="swiper-button-next swiper-button-black"></div>
                    <div class="swiper-button-prev swiper-button-black"></div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 text-center border-top border-bottom border-right py-5 pr-5 pl-0">
                <div class="border-left pl-5">

                    <div class="">
                        <div class="text-left">
                            <img src="<?php echo base_url('statics/default/images/'); ?>logo.png" alt="Image" style="height: 20px;width:50px;margin-bottom:10px">
                        </div>
                        <h1 class="heading my-3" style="font-size:1.5rem;font-weight:400;"><a href="#"><?php echo $product->name; ?></a></h1>
                        <?php if ($product->remained == 1) {; ?>
                            <p>Tình trạng: <span class="btn btn-success text-white">Còn Hàng</span></p>
                        <?php } else { ?>
                            <p>Tình trạng: <span class="btn btn-danger text-white">Hết Hàng</span></p>
                        <?php } ?>
                    </div>
                    <span class="price" style="font-size:1.7rem;color:#43d1ca;
                    <?php if ($product->sale == 1) {
                        echo "text-decoration:line-through;";
                    } ?>">
                        <?php echo number_format($product->price, 0); ?> VNĐ
                    </span>
                    <?php if ($product->sale == 1) {; ?>
                        <p class="price" style="font-size:1.7rem;color:red;"><?php echo number_format($product->discount_price, 0); ?> VNĐ</p>
                    <?php } ?>
                    <form class="mt-2" action="<?php echo site_url("cart/add_to_cart"); ?>" method=post>
                        <div class="quantity">
                            Số Lượng:
                            <input type=number name=quantity value="0" min="0" class="quantity-input disabled form-control add-to-cart-quantity" style="width:100%">
                        </div>
                        <?php if ($product->sale == 1) {; ?>

                            <input type=hidden name=price value="<?php echo $product->discount_price; ?>">
                        <?php } else { ?>
                            <input type=hidden name=price value="<?php echo $product->price; ?>">
                        <?php } ?>
                        <input type=hidden name=id value="<?php echo $product->id; ?>">
                        <?php
                        $currentURL = current_url();
                        $params   = $_SERVER['QUERY_STRING'];
                        if (!empty($params)) {
                            $fullURL = $currentURL . '?' . $params;
                        } else {
                            $fullURL = $currentURL;
                        }
                        ?>
                        <input type=hidden name=url value="<?php echo $fullURL; ?>">
                        <button type=submit class="add-to-cart <?php echo $product->remained==0?'disabled':"";?>" <?php echo $product->remained==0?'disabled':"";?> style="opacity:1;width:100%;cursor:pointer;height:50px;">
                            <i class="fas fa-shopping-cart" style="font-size:1rem"></i>
                            <span>Đặt hàng</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <h2 style="font-size:1.5rem;font-weight:400;">Thông Tin Chi Tiết</h2>
                <?php echo $product->description; ?>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
</section>

<?php if (count($relate_products) > 1) : ?>
    <section class="home-featured-products">
        <div class="container">
            <div class="row section-title-wrap mb-4">
                <div class="section-title-line"></div>
                <h2 class="text-center section-title m-auto px-3">Sản phẩm liên quan</h2>
            </div>
        </div>
        <div class="container p-5">
            <div class="owl-carousel featured-products-slide">
                <?php foreach ($relate_products as $relate_product) : ?>
                    <?php if ($relate_product->id != $product->id) : ?>
                        <div class="justify-content-center">
                            <figure class="figure featured-products-item-figure">
                                <a href="<?php echo site_url('san-pham/' . $relate_product->slug); ?>" class="featured-products-link">
                                    <div class="featured-products-item-wrap">
                                        <img class="featured-products-img img-fluid" src="<?php echo base_url(); ?>assets/public/avatar/<?php echo $relate_product->img1 ?>" alt="">
                                        <figcaption class="figure-caption m-auto text-center">
                                            <h3 class="featured-products-title text-center text-dark mt-2">
                                                <?php echo $relate_product->name ?></h3>
                                            <span class="price" style="color:#43d1ca;
                                            <?php if ($relate_product->sale == 1) {
                                                            echo "text-decoration:line-through;";
                                                        } ?>">
                                                <?php echo number_format($relate_product->price, 0); ?> VNĐ
                                            </span>
                                            <?php if ($relate_product->sale == 1) {; ?>
                                                <span class="price" style="color:red;"><?php echo number_format($relate_product->discount_price, 0); ?> VNĐ</span>
                                            <?php } ?>
                                        </figcaption>
                                    </div>
                                </a>
                            </figure>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>