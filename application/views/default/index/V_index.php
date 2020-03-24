<div class="owl-carousel hero-slide owl-style">
  <?php foreach ($banners as $banner) { ?>
    <img src="<?php echo base_url("assets/public/avatar/") . $banner->img; ?>" />
  <?php }; ?>
</div>

<div class=" banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-6  col-md-6" data-aos="fade-up">
        <a href="shop-single.html" class="thumbnail d-block mb-4"><img src="<?php echo base_url("statics/default/"); ?>images/banner1.jpg" alt="Image" class="w-100 bannerElement "></a>
      </div>
      <div class="col-lg-6  col-md-6" data-aos="fade-up">
        <a href="shop-single.html" class="thumbnail d-block mb-4"><img src="<?php echo base_url("statics/default/"); ?>images/banner2.jpg" alt="Image" class="w-100 bannerElement "></a>
      </div>
      <div class="col-lg-6  col-md-6" data-aos="fade-up">
        <a href="shop-single.html" class="thumbnail d-block mb-4"><img src="<?php echo base_url("statics/default/"); ?>images/banner3.jpg" alt="Image" class="w-100 bannerElement "></a>
      </div>
      <div class="col-lg-6  col-md-6" data-aos="fade-up">
        <a href="shop-single.html" class="thumbnail d-block mb-4"><img src="<?php echo base_url("statics/default/"); ?>images/banner4.jpg" alt="Image" class="w-100 bannerElement "></a>
      </div>
    </div>
  </div>
</div>


  <div class="container mt-5">
    <hr>
    <div class="row " data-aos="fade-up">
      <div class="col-12 section-title text-center ">
        <h2 class="d-block">SẢN PHẨM MỚI</h2>
        <p>Mỗi tuyệt tác trang sức là một câu chuyện về những giá trị đích thực,
          những phẩm chất cao quý và vẻ đẹp tinh tế của riêng bạn mà chúng tôi mãi tôn vinh.</p>
        <!-- <p><a href="#">Xem tất cả <span class="icon-long-arrow-right"></span></a></p> -->
      </div>
    </div>
    <div class="row">
      <?php if (isset($new_products)&&$new_products) : ?>
        <?php foreach ($new_products as $new_product) : ?>
          <div class="col-lg-3 mb-5 col-md-6" data-aos="fade-up">
            <div class="wine_v_1 text-center pb-4" style="background-image:url('<?php echo base_url('assets/public/avatar/') . $new_product->img1; ?>');background-size:100% 50%;background-position:center top;background-repeat:no-repeat;height:480px;padding-top:70%;  border: 1px solid #43d1ca;">
              <form action="<?php echo site_url("cart/add_to_cart"); ?>" method=post>
                <div>
                  <div class="text-left" style="position:relative">
                    <img src="<?php echo base_url('statics/default/images/'); ?>logo.png" alt="Image" style="height: 20px;width:50px">
                    <?php if ($new_product->sale == 1) { ?>
                  <p class="float-right sale-icon" style="position:absolute;right:0;top:-10px">SALE</p>
                <?php } ?>
                  </div>
                  <h3 class="heading mb-1"><a href="<?php echo site_url('san-pham/') . $new_product->slug; ?>"><?php echo $new_product->name; ?></a></h3>
                  <span class="price" style="font-size:0.9rem;color:#43d1ca;<?php if ($new_product->sale == 1) {echo "text-decoration:line-through;";} ?>"><?php echo number_format($new_product->price, 0); ?> VNĐ</span>
                  <?php if ($new_product->sale == 1) {; ?>
                    <span class="price" style="font-size:0.9rem;color:red;"><?php echo number_format($new_product->discount_price, 0); ?> VNĐ</span>
                    <input type=hidden name=price value="<?php echo $new_product->discount_price; ?>">
                  <?php } else { ?>
                    <input type=hidden name=price value="<?php echo $new_product->price; ?>">
                  <?php } ?>
                  <input type=hidden name=id value="<?php echo $new_product->id; ?>">
                  <?php
                      $currentURL = current_url();
                      $params   = $_SERVER['QUERY_STRING'];
                      if (!empty($params)) {
                        $fullURL = $currentURL . '?' . $params;
                      } else {
                        $fullURL = $currentURL;
                      }
                      ?>
                      <?php if($new_product->remained==0):?>
                      <p class='btn-danger'>Hết hàng</p>

                  <?php endif;?>
                </div>

                <div class="mt-2" style="position:absolute;bottom:25px;left:50%;transform:translateX(-50%);">
                  <div class="quantity">
                    <input type=number name=quantity value="0" min="0" class="quantity-input form-control add-to-cart-quantity" style="width:100%">
                  </div>
                  <input type=hidden name=url value="<?php echo $fullURL; ?>">
                  <button type=submit class="add-to-cart <?php echo $new_product->remained==0?'disabled':'';?>" <?php echo $new_product->remained==0?'disabled':'';?>>
                    <i class="fas fa-shopping-cart" style="font-size:.7rem"></i>
                    <span>Đặt hàng</span>
                  </button>
                </div>
              </form>
                </div>
          </div>
        <?php endforeach; ?>
        <?php else:?>
        <div class="col-12 text-center">
        <b class="text-center">Không có sản phẩm mới</b>
        </div>
                 
      <?php endif; ?>
    </div>
    <hr>
  </div>

<!-- INSTAGRAM  col-lg-4 col-md-4 col-sm-12 col-xs-12 -->
<div class="container mb-3">
  <h3 class="text-center">INSTAGRAM</h3>
  <div class="instawrp row">
    <div class="leftBlock col-12	col-sm-12	col-md-12	col-lg-4 col-xl-4" data-aos="fade-up">
      <div class="row">
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"> <img src="<?php echo base_url("statics/default/"); ?>images/insta1.jpg" alt="Image" class="w-100 imgInsta"></div>
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"><img src="<?php echo base_url("statics/default/"); ?>images/insta2.jpg" alt="Image" class="w-100 imgInsta"></div>
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"><img src="<?php echo base_url("statics/default/"); ?>images/insta3.jpg" alt="Image" class="w-100 imgInsta"></div>
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"><img src="<?php echo base_url("statics/default/"); ?>images/insta4.jpg" alt="Image" class="w-100 imgInsta"></div>
      </div>
    </div>
    <div class="centerBlock col-12	col-sm-12	col-md-12	col-lg-4 col-xl-4" data-aos="fade-up">
      <img src="<?php echo base_url("statics/default/"); ?>images/instacenter.jpg" alt="Image" class="w-100">
    </div>
    <div class="rightBLock  col-12	col-sm-12	col-md-12	col-lg-4 col-xl-4" data-aos="fade-up">
      <div class="row">
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"> <img src="<?php echo base_url("statics/default/"); ?>images/insta5.jpg" alt="Image" class="w-100 imgInsta">
        </div>
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"><img src="<?php echo base_url("statics/default/"); ?>images/insta6.jpg" alt="Image" class="w-100 imgInsta">
        </div>
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"><img src="<?php echo base_url("statics/default/"); ?>images/insta7.jpg" alt="Image" class="w-100 imgInsta">
        </div>
        <div class="col-6	col-sm-6	col-md-6	col-lg-6 col-xl-6"><img src="<?php echo base_url("statics/default/"); ?>images/insta8.jpg" alt="Image" class="w-100 imgInsta">
        </div>
      </div>
    </div>
  </div>
</div>