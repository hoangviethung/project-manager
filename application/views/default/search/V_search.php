
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="content_scene_cat">

                <!-- Category image -->
                <div class="content_scene_cat_bg" style="background:url('<?php echo base_url(); ?>statics/default/images/slide_1.jpg') center center no-repeat; background-size:cover; min-height:300px;">

                    <h1 class="page-heading product-listing text-center mt-2" style="font-size:1.5rem;font-weight:400;">                Kết Quả Tìm Kiếm Cho:
                <br>
                "<?php echo isset($_GET['search']) ? $_GET['search'] : ""; ?>"
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-12">
            <hr>
        </div>
    </div>
</div>

<?php if (!empty($search)) : ?>
    <?php if (isset($search['product'])) : ?>
            <div class="container">
                <div class="product-list">
                    <div class="product-list-content">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="search-section-title m-3">
                                    <span>Sản phẩm</span>
                                </h2>
                            </div>
                            <?php foreach ($search['product'] as $product) : ?>
                            <div class="col-lg-4 mb-5 col-md-6" data-aos="fade-up">
                                <div class="wine_v_1 text-center pb-4" style="height:480px">
                                    <form action="<?php echo site_url("cart/add_to_cart");?>" method=post>
                                        <a href="<?php echo site_url('san-pham/').$product->slug;?>" class="thumbnail d-block mb-2">
                                            <img src="<?php echo base_url('assets/public/avatar/') . $product->img1; ?>" alt="<?php echo $product->name; ?>" class="img-fluid product-img product-img-detail "> </a>
                                        <div>
                                            <div class="text-left"> 
                                                <img src="<?php echo base_url('statics/default/images/'); ?>logo.png" alt="Image" style="height: 20px;width:50px">
                                            </div>
                                            <h3 class="heading mb-1"><a href="#"><?php echo $product->name; ?></a></h3>
                                            <span class="price" style="font-size:0.9rem;color:#43d1ca;<?php if($product->discount_price>0){echo "text-decoration:line-through;";} ?>"><?php echo number_format($product->price, 0); ?> VNĐ</span>
                                            <?php if($product->discount_price>0){;?>
                                            <span class="price" style="font-size:0.9rem;color:red;"><?php echo number_format($product->discount_price, 0); ?> VNĐ</span>
                                            <input type=hidden name=price value="<?php echo $product->discount_price;?>">
                                            <?php }else{?>
                                                <input type=hidden name=price value="<?php echo $product->price;?>">
                                            <?php } ?>
                                            <input type=hidden name=id value="<?php echo $product->id;?>">
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
                                            
                                        </div>
                                        <div class="mt-2" style="position:absolute;bottom:30px;left:50%;transform:translateX(-50%);">
                                        <input type=number name=quantity value="0" min="0" class="quantity-input form-control add-to-cart-quantity" style="width:100%">
                                        <input type=hidden name=url value="<?php echo $fullURL;?>">
                                            <button type=submit class="add-to-cart">
                                            <i class="fas fa-shopping-cart" style="font-size:.9rem"></i>
                                                <span>Đặt hàng</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (isset($search['category'])) : ?>
        <div class="container">
            <hr>
        </div>
        <section class="home-category my-5">
            <div class="container my-2">
                <div class="row">
                    <div class="col-12">
                        <h2 class="search-section-title m-3">
                            <span>Danh Mục Sản Phẩm</span>
                        </h2>
                    </div>
                    <?php foreach ($search['category'] as $category) : ?>
                        <div class="col-lg-3 col-md-4 col-xs-6 category-item">
                            <div class="figure category-figure-item">
                                <h3 class="category-item-title"><?php echo $category ? $category->name : ""; ?></h2>
                                    <a href="<?php echo $category ? site_url('category?cate=') . $category->id : ""; ?>" class="home-category-item-link">
                                        <img src="<?php echo $category ? site_url('assets/public/avatar/') . $category->img : ""; ?>" class="figure-img img-fluid rounded" width=100% height=100% alt="">
                                    </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    <?php endif; ?>

<?php elseif (isset($error)) : ?>
    <div class="container">
        <div class="row">
            <p class="mx-auto mb-5 display-4"><b>Lỗi: Vui lòng nhập nhiều hơn 1 từ</b>
                <p>
        </div>
    </div>
<?php else : ?>
    <div class="container">
        <div class="row">
            <p class="mx-auto mb-5 display-4"><b>Không có kết quả tìm kiếm</b>
                <p>
        </div>
    </div>
<?php endif; ?>