<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="content_scene_cat">
                <!-- Category image -->

            </div>
        </div>
        <div class="col-12 text-left">
            <p style="font-size:.9rem" class="mt-3 border p-1 breadcrumb bg-light">
                <a class='mr-2 ml-2'><i class="fas fa-home"></i></a><a class="text-dark ml-0" href="<?php echo site_url(); ?>">Home</a> <?php echo $this->uri->segment(1) == 'sale' ? ' <a><img src="' . base_url('assets/public/avatar/') . 'Screenshot_121.png" class="arrow-right">Sale</a>' : ''; ?><?php echo isset($parent_1) ? "<a class='text-dark' href='" . site_url() . $parent_1->slug . "'><img src='" . base_url('assets/public/avatar/') . "Screenshot_121.png' class='arrow-right'>" . $parent_1->name . "</a>" : ''; ?><?php if (isset($parent_2) && $parent_2 == TRUE) {echo "<a class='text-dark' href='" . site_url() . $parent_2->slug . "'><img src='" . base_url('assets/public/avatar/') . "Screenshot_121.png' class='arrow-right'>" . $parent_2->name . "</a>";} ?><?php echo isset($category) ? "<a class='text-dark' style='font-weight:500' href='" . site_url() . $category->slug . "'><img src='" . base_url('assets/public/avatar/') . "Screenshot_121.png' class='arrow-right'><b>" . $category->name . "</b></a>" : ''; ?>
            </p>
        </div>
        <div class="col-12">
            <hr>
        </div>

        <!-- ----------------LEFT ----------------------->
        <div class="col-xs-12 col-lg-3 mt-3">
            <!-- Category -->
            <?php if (isset($cate)) : ?>
                <div id="categories_block_left" class="block">
                    <h2 class="title_block pr-0">
                        Danh mục sản phẩm <span class="float-right text-dark"  data-toggle="collapse" data-target="#sub_category_left_menu" style="font-size:.8rem;line-height:30px;cursor:pointer;"><i class="fas fa-plus"></i></span>
                    </h2>
                    <div class="block_content collapse show" id="sub_category_left_menu">
                        <div class="accordion" id="accordionExample">
                            <?php if (isset($sub_categories)&&$sub_categories) : ?>
                                <?php foreach ($sub_categories as $sub_category) : ?>
                                    <?php if ($sub_category->level == 1) : ?>
                                        <div class="borderless">
                                            <div class="border-top border-bottom" id="heading <?php echo $sub_category->id; ?>" style="background:white!important;">
                                                <p class='mb-1 mt-2 pl-2'>
                                                    <a href="<?php echo site_url($sub_category->slug); ?>" title="<?php echo $sub_category->name; ?>" style="font-size:.9rem!important;text-transform:uppercase;<?php echo $category->id == $sub_category->id ? "font-weight:500" : "" ?>">
                                                        <b><?php echo $sub_category->name; ?></b> </a>
                                                    <span class="btn btn-link float-right" data-toggle="collapse" data-target="#collapse<?php echo $sub_category->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $sub_category->id; ?>">
                                                        <i class="fas fa-angle-down rotate-icon"></i>
                                                    </span>
                                                </p>
                                            </div>

                                            <div id="collapse<?php echo $sub_category->id; ?>" class="collapse <?php echo $category->id == $sub_category->id ? "show" : "" ?>" aria-labelledby="heading<?php echo $sub_category->id; ?>" data-parent="#accordionExample">
                                                <div>
                                                    <?php foreach ($sub_categories as $category_child) : ?>
                                                        <?php if ($category_child->parent_2 == $sub_category->id) : ?>
                                                            <li>
                                                                <a href="<?php echo site_url($category_child->slug); ?>" title="<?php echo $category_child->name; ?>" class="accordion-item-content <?php echo $category->id == $category_child->id ? "active" : "" ?> " style="font-weight:400;text-transform:capitalize">-
                                                                    <span class='ml-2'><?php echo $category_child->name; ?></span> </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Không có danh mục sp</p>
                            <?php endif; ?>

                        </div>
                        <!-- <ul class="tree dynamized" style="display: block;list-style-type: none;padding-left: unset;">
                            <?php if ($sub_categories) : ?>
                                <?php foreach ($sub_categories as $sub_category) : ?>
                                    <?php if ($sub_category->level == 1) : ?>
                                        <li class="<?php echo $category->id == $sub_category->id ? "active" : "" ?>">
                                            <span class="grower CLOSE"> <i class="icon-plus"></i> </span>
                                            <a href="<?php echo site_url($sub_category->slug); ?>" title="<?php echo $sub_category->name; ?>">
                                                <?php echo $sub_category->name; ?> </a>
                                            <ul style="display: block;">
                                                <?php foreach ($sub_categories as $category_child) : ?>
                                                    <?php if ($category_child->parent_2 == $sub_category->id) : ?>
                                                        <li class="<?php echo $category->id == $category_child->id ? "active" : "" ?>">
                                                            <a href="<?php echo site_url($category_child->slug); ?>" title="<?php echo $category_child->name; ?>">
                                                                <?php echo $category_child->name; ?> </a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul> -->
                    </div>
                </div>
            <?php endif; ?>
            <!-- Price -->
            <div id="manufacturers_block_left" class="block blockmanufacturer">
                <p class="title_block pr-0">
                    Lọc giá <span class="float-right text-dark"  data-toggle="collapse" data-target="#price_filter_left_menu" style="font-size:.8rem;line-height:30px;cursor:pointer;"><i class="fas fa-plus"></i></span>
                </p>
                <div class="block_content list-block collapse show" id="price_filter_left_menu">
                    <?php
                    $query = $_GET;
                    // replace parameter(s)
                    unset($query['from']);
                    unset($query['to']);
                    $query = http_build_query($query);
                    ?>
                    <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $query; ?>" style="padding: 0 5px;font-size: 15px" title="Bỏ chọn giá" href="#" class="fas fa-times"> Bỏ Chọn Giá</a>
                    <ul style="list-style-type: none ; padding-left: unset;">
                        <form method=get>
                            Từ <input type=number min=0 max=10000000 name=from class=form-control placeholder="VNĐ" value="<?php echo isset($from) ? $from : ""; ?>">
                            Đến <input type=number min=0 max=10000000 name=to class=form-control placeholder="VNĐ" value="<?php echo isset($to) ? $to : ""; ?>">
                            <input type=submit value="Tìm Kiếm" class="form-control mt-2">
                        </form>
                    </ul>
                </div>
            </div>

            <!-- New Product -->
            <div id="new-products_block_right" class="block products_block">
                <h4 class="title_block pr-0">
                    <a title="Sản phẩm mới">Sản phẩm mới <span class="float-right text-dark"  data-toggle="collapse" data-target="#new_product_left_menu" style="font-size:.8rem;line-height:30px;cursor:pointer;"><i class="fas fa-plus"></i></span></a>
                </h4>
                <div class="block_content products-block collapse show" style="margin-left:-40px" id="new_product_left_menu">
                    <ul class="products">
                        <?php if ($new_products) : ?>
                            <?php foreach ($new_products as $new_product) : ?>
                                <li class="clearfix">
                                    <a class="products-block-image getImg" id="<?php echo $new_product->id; ?>" href="<?php echo site_url('san-pham/') . $new_product->slug; ?>" title="<?php echo $new_product->name; ?>">
                                        <img width="98" height="150" class="replace-2x img-responsive" src="<?php echo base_url('assets/public/avatar/') . $new_product->img1; ?>" alt="<?php echo $new_product->name; ?>">
                                    </a>
                                    <div class="product-content">
                                        <h5>
                                            <a class="product-name" style="text-overflow: inherit;white-space: pre-line;" href="<?php echo site_url('san-pham/') . $new_product->slug; ?>" title="<?php echo $new_product->name; ?>"><?php echo $new_product->name; ?></a>
                                        </h5>
                                        <span class="price product-price" style="font-size:0.9rem;<?php if ($new_product->sale == 1) {
                                                                                                echo "text-decoration:line-through;";
                                                                                            } ?>"><?php echo number_format($new_product->price, 0); ?> VNĐ</span>
                                                    <?php if ($new_product->sale == 1) {; ?>
                                                    <p class="price" style="font-size:0.9rem;color:red;"><?php echo number_format($new_product->discount_price, 0); ?> VNĐ</p>
                                                                                                                                                                                                                         <?php }?>
                                        <p class="product-description"></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <small>Không có sp mới</small>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php if (isset($_SESSION['recent_products'])) : ?>
            <div id="new-products_block_right" class="block products_block">
                <h4 class="title_block pr-0">
                    <a title="Sản phẩm mới">Sản Phẩm Đã Xem <span class="float-right text-dark"  data-toggle="collapse" data-target="#recent_product_left_menu" style="font-size:.8rem;line-height:30px;cursor:pointer;"><i class="fas fa-plus"></i></span></a>
                </h4>
                <div class="block_content products-block collapse show" style="margin-left:-40px" id="recent_product_left_menu">
                    <ul class="products">

                            <?php foreach ($_SESSION['recent_products'] as $recent_product) : ?>
                                <li class="clearfix">
                                    <a class="products-block-image getImg" id="<?php echo $recent_product->id; ?>" href="<?php echo site_url('san-pham/') . $recent_product->slug; ?>" title="<?php echo $recent_product->name; ?>">
                                        <img width="98" height="150" class="replace-2x img-responsive" src="<?php echo base_url('assets/public/avatar/') . $recent_product->img1; ?>" alt="<?php echo $recent_product->name; ?>">
                                    </a>
                                    <div class="product-content">
                                        <h5>
                                            <a class="product-name" style="text-overflow: inherit;white-space: pre-line;" href="<?php echo site_url('san-pham/') . $recent_product->slug; ?>" title="<?php echo $recent_product->name; ?>"><?php echo $recent_product->name; ?></a>
                                        </h5>
                                        <span class="price product-price" style="font-size:0.9rem;<?php if ($recent_product->sale == 1) {
                                                                                                echo "text-decoration:line-through;";
                                                                                            } ?>"><?php echo number_format($recent_product->price, 0); ?> VNĐ</span>
                                        <?php if ($recent_product->sale == 1) {; ?>
                                            <p class="price" style="font-size:0.9rem;color:red;"><?php echo number_format($recent_product->discount_price, 0); ?> VNĐ</p>
                                        <?php } ?>
                                        <p class="product-description"></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        
                    </ul>
                </div>
            </div>
            <?php endif; ?>
        </div>


        <!-- ----------------RIGHT ----------------------->
        <div class="col-xs-12 col-lg-9 mt-3">
            <!-- Subcategories -->
            <div class="content_scene_cat_bg" style="background:url('<?php echo base_url(); ?>statics/default/images/slide_1.jpg') center center no-repeat; background-size:cover; min-height:300px;">


            </div>
            <h2 class="text-left mt-2" style="font-size:2rem;font-weight:400;<?php echo $this->uri->segment(1) == 'sale' ? 'color:red' : ''; ?>"><?php echo isset($category) ? strtoupper($category->name) : ""; ?><?php echo $this->uri->segment(1) == 'sale' ? 'Hàng Giảm Giá' : ''; ?>
            </h2>
            <div class="content_sortPagiBar clearfix">
                <div class="sortPagiBar clearfix">
                    <div class="col-12 text-right">
                        Sắp Xếp:
                        <?php if ($by == "name") : ?>
                            <?php if ($order == "asc") : ?>
                                <?php
                                        $query = $_GET;
                                        // replace parameter(s)
                                        $query['by'] = 'name';
                                        $query['order'] = 'desc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">TÊN <span style="color:black !important;"><i class="fas fa-caret-up"></i></span></a>
                                <?php
                                        $query['by'] = 'price';
                                        $query['order'] = 'asc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">GIÁ <i class="fas fa-caret-up"></i></i></a>
                            <?php elseif ($order == "desc") : ?>
                                <?php $query = $_GET;
                                        // replace parameter(s)
                                        $query['by'] = 'name';
                                        $query['order'] = 'asc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">TÊN <span style="color:black !important;"><i class="fas fa-caret-down"></i></i></span></a>
                                <?php
                                        $query['by'] = 'price';
                                        $query['order'] = 'asc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">GIÁ <i class="fas fa-caret-up"></i></i></a>
                            <?php endif; ?>
                        <?php elseif ($by == "price") : ?>
                            <?php if ($order == "asc") : ?>
                                <?php
                                        $query = $_GET;
                                        // replace parameter(s)
                                        $query['by'] = 'name';
                                        $query['order'] = 'asc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">TÊN <i class="fas fa-caret-up"></i></i></a>
                                <?php
                                        $query['by'] = 'price';
                                        $query['order'] = 'desc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">GIÁ <span style="color:black !important;"><i class="fas fa-caret-up"></i></span></a>
                            <?php elseif ($order == "desc") : ?>
                                <?php $query = $_GET;
                                        // replace parameter(s)
                                        $query['by'] = 'name';
                                        $query['order'] = 'asc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">TÊN <i class="fas fa-caret-up"></i></i></a>
                                <?php
                                        $query['by'] = 'price';
                                        $query['order'] = 'asc';
                                        $sort = http_build_query($query);
                                        ?>
                                <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">GIÁ <span style="color:black !important;"><i class="fas fa-caret-down"></i></i></span></a>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php
                                $query = $_GET;
                                // replace parameter(s)
                                $query['by'] = 'name';
                                $query['order'] = 'asc';
                                $sort = http_build_query($query);
                                ?>
                            <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">TÊN <i class="fas fa-caret-up"></i></i></a>
                            <?php
                                $query['by'] = 'price';
                                $query['order'] = 'desc';
                                $sort = http_build_query($query);
                                ?>
                            <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $sort; ?>" style="text-dectoration:none;font-size:.9rem;font-weight:400" class="mx-3">GIÁ <i class="fas fa-caret-down"></i></i></a>
                        <?php endif; ?>
                        <?php if ($style == "list") : ?>
                            <?php
                                $query = $_GET;
                                // replace parameter(s)
                                $query['style'] = 'grid';
                                $grid = http_build_query($query);
                                ?>
                            <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $grid; ?>" style="text-dectoration:none;color:orange;font-size:1.2rem;" class="mx-1"><span style="text-dectoration:none;font-size:.9rem;font-weight:400">Lưới </span><i class="fas fa-th"></i></a>
                        <?php elseif ($style == "grid" || !$style) : ?>
                            <?php
                                $query = $_GET;
                                $query['style'] = 'list';
                                $list = http_build_query($query);
                                ?>
                            <a href="<?php echo base_url() . uri_string(); ?>?<?php echo $list; ?>" style="text-dectoration:none;color:orange;font-size:1.2rem;" class="mx-1"><span style="text-dectoration:none;font-size:.9rem;font-weight:400">Danh Sách </span><i class="fas fa-list"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Products list -->
            <ul class="product_list grid row clearfix mt-5">
                <?php if ($products) : ?>
                    <?php foreach ($products as $product) : ?>
                        <?php if (!isset($_GET['style']) || isset($_GET['style']) && $_GET['style'] == "grid") : ?>
                            <div class="col-lg-4 mb-5 col-md-6" data-aos="fade-up">
                                <div class="wine_v_1 text-center pb-4" style="background-image:url('<?php echo base_url('assets/public/avatar/') . $product->img1; ?>');background-size:100% 50%;background-position:center top;background-repeat:no-repeat;height:480px;padding-top:70%">
                                    <form action="<?php echo site_url("cart/add_to_cart"); ?>" method=post>
                                        <a href="<?php echo site_url('san-pham/') . $product->slug; ?>" class="thumbnail d-block">
                                            <!-- <img src="<?php echo base_url('assets/public/avatar/') . $product->img1; ?>" alt="<?php echo $product->name; ?>" class="img-fluid product-img product-img-detail "> </a> -->
                                            <div>
                                                <div class="text-left mt-3" style="position:relative">
                                                    <img src="<?php echo base_url('statics/default/images/'); ?>logo.png" alt="Image" style="height: 20px;width:50px">
                                                    <?php if ($product->sale == 1) { ?>
                                                <p class="float-right sale-icon" style="position:absolute;right:0;top:-10px">SALE</p>
                                            <?php } ?>
                                                </div>
                                                <h3 class="heading mb-1"><a href="<?php echo site_url('san-pham/') . $product->slug; ?>"><?php echo $product->name; ?></a></h3>
                                                <span class="price" style="font-size:0.9rem;color:#43d1ca;<?php if ($product->sale == 1) {
                                                                                                                            echo "text-decoration:line-through;";
                                                                                                                        } ?>"><?php echo number_format($product->price, 0); ?> VNĐ</span>
                                                <?php if ($product->sale == 1) {; ?>
                                                    <span class="price" style="font-size:0.9rem;color:red;"><?php echo number_format($product->discount_price, 0); ?> VNĐ</span>
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
                                                    <?php if($product->remained==0):?>
                                                    <p class='btn-danger'>Hết hàng</p>
                                                    <?php endif;?>
                                            </div>

                                            <div class="mt-2" style="position:absolute;bottom:30px;left:50%;transform:translateX(-50%);">
                                                <div class="quantity">
                                                    <input type=number name=quantity value="0" min="0" class="quantity-input disabled form-control add-to-cart-quantity" style="width:100%">
                                                </div>

                                                <input type=hidden name=url value="<?php echo $fullURL; ?>">
                                                <button type=submit class="add-to-cart <?php echo $product->remained==0?'disabled':'';?>" <?php echo $product->remained==0?'disabled':'';?>>
                                                    <i class="fas fa-shopping-cart" style="font-size:.7rem"></i>
                                                    <span>Đặt hàng</span>
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        <?php elseif ((isset($_GET['style']) && $_GET['style'] == "list")) : ?>
                            <div class="mb-3 col-12" data-aos="fade-up">
                                <div class="wine_v_1 text-center" style="height:100%!important;padding-top:0!important;">
                                    <form action="<?php echo site_url("cart/add_to_cart"); ?>" method=post>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="<?php echo site_url('san-pham/') . $product->slug; ?>" class="thumbnail d-block product-list-item-image" style="background-image:url('<?php echo base_url('assets/public/avatar/') . $product->img1; ?>');background-position:center;background-size:cover;background-repeat:no-repeat;width:100%">

                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <div>
                                                    <div class="text-left">
                                                        <img src="<?php echo base_url('statics/default/images/'); ?>logo.png" alt="Image" style="height: 20px;width:50px">
                                                    </div>
                                                    <h3 class="heading mb-1"><a href="<?php echo site_url('san-pham/') . $product->slug; ?>"><?php echo $product->name; ?></a></h3>
                                                    <span class="price" style="font-size:0.9rem;color:#43d1ca;<?php if ($product->sale == 1) {
                                                                                                                                echo "text-decoration:line-through;";
                                                                                                                            } ?>"><?php echo number_format($product->price, 0); ?> VNĐ</span>
                                                    <?php if ($product->sale == 1) {; ?>
                                                        <p class="price" style="font-size:0.9rem;color:red;"><?php echo number_format($product->discount_price, 0); ?> VNĐ</p>
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

                                                </div>
                                                <?php if ($product->sale == 1) { ?>
                                                    <p class="float-right sale-icon" style="position:absolute;right:10px;top:5px">SALE</p>
                                                <?php } ?>
                                                <div class="mt-2" style="">
                                                    <input type=number name=quantity value="0" min="0" class="quantity-input form-control add-to-cart-quantity" style="width:100%">
                                                    <input type=hidden name=url value="<?php echo $fullURL; ?>">
                                                    <button type=submit class="add-to-cart">
                                                        <i class="fas fa-shopping-cart" style="font-size:.9rem"></i>
                                                        <span>Đặt hàng</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Không tìm thấy sản phẩm nào</p>
                <?php endif; ?>
            </ul>
            <div class="content_sortPagiBar">
                <div class="bottom-pagination-content clearfix">
                    <!-- Pagination -->
                    <div id="pagination_bottom" class="pagination clearfix">
                    </div>
                    <div class="product-count">
                        <div class="paginator text-center"><span class="labelPages"></span>
                            <?php if ($page > 1) : ?>
                                <?php
                                    $query = $_GET;
                                    $query['page'] = $page - 1;
                                    $query = http_build_query($query);
                                    ?>
                                <a rel="nofollow" class="page" href="<?php echo site_url() . uri_string(); ?>?<?php echo $query; ?>"><?php echo $page - 1; ?></a>
                            <?php endif; ?>
                            <span class=" current-page page"><?php echo $page; ?></span>
                            <?php if ($page < $total_pages) : ?>
                                <?php
                                    $query = $_GET;
                                    $query['page'] = $page + 1;
                                    $query = http_build_query($query);
                                    ?>
                                <a rel="nofollow" class="page" href="<?php echo site_url() . uri_string(); ?>?<?php echo $query; ?>"><?php echo $page + 1; ?></a>
                            <?php endif; ?>
                            <?php if ($page < $total_pages && $total_pages > 3) : ?>
                                ...
                                <?php
                                    $query = $_GET;
                                    $query['page'] = $total_pages;
                                    $query = http_build_query($query);
                                    ?>
                                <a rel="nofollow" class="page page-last" href="<?php echo site_url() . uri_string(); ?>?<?php echo $query; ?>">
                                    <?php echo $total_pages; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>