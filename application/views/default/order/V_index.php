<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="content_scene_cat">

                <!-- Category image -->
                <div class="content_scene_cat_bg" style="background:url('<?php echo base_url(); ?>statics/default/images/slide_1.jpg') center center no-repeat; background-size:cover; min-height:300px;">
                    <p style="font-size:.9rem" class="bread-crumb mt-3"><a class="text-white" href="<?php echo site_url(); ?>">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;Xác Nhận Đơn Hàng</p>

                    <h1 class="page-heading product-listing text-center mt-2" style="font-size:1.5rem;font-weight:400;">Xác Nhận Đơn Hàng
                    </h1>
                </div>
            </div>

        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <form method=POST action="<?php echo site_url('confirm-order'); ?>">
                <div class="row">
                    <div class="col-lg-7 mb-3">
                        <div class='border mb-4 p-3'>
                            <h2 style="font-size:1.5rem;font-weight:400">Thông Tin Khách Hàng</h2>
                            <hr>
                            <input type="radio" checked> Thanh Toán Tại Nhà
                        </div>
                        <div class="p-3 border">
                            <h2 style="font-size:1.5rem;font-weight:400">Thông Tin Khách Hàng</h2>
                            <hr>
                            <div class="border p-3">
                                <label class="mt-3 mb-0">Họ Tên Khách Hàng*</label>
                                <input type="text" name='order[customer_name]' class="form-control" required placeholder="">
                                <label class="mt-3 mb-0">Địa Chỉ Giao Hàng*</label>
                                <input type="text" name='order[address]' class="form-control" required placeholder="">
                                <label class="mt-3 mb-0">Số ĐT*</label>
                                <input type="text" name='order[phone]' class="form-control" required placeholder="">
                                <label class="mt-3 mb-0">Email*</label>
                                <input type="email" name='order[email]' class="form-control" required placeholder="">
                                <input type=hidden name="order[total_price]" value="<?php echo $_SESSION['cart']['total_price']; ?>">
                                <input type=hidden name="order[total_quantity]" value="<?php echo $_SESSION['cart']['total_quantity']; ?>">
                                <small>(*)Trường bắt buộc phải nhập</small>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-5 mb-3">

                        <div class="row border mb-3 p-3 pt-4">
                            <h2 style="font-size:1.5rem;font-weight:400">Thông Tin Đơn Hàng</h2>

                            <div class="col-12">
                                <hr>
                                <h3 class="p-2 bg-light text-dark" style="font-size:1rem;font-weight:500">Sản Phẩm<span class="float-right">Giá</span></h3>
                                <?php if (isset($products)) : ?>
                                    <?php foreach ($products as $product) : ?>
                                        <div class="mb-2 p-2 row border-top">
                                            <div class="col-5">
                                                <img src="<?php echo base_url('assets/public/avatar/') . $product->img1; ?>" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-7">
                                                <p class='mb-0'><a href="<?php echo site_url('san-pham/') . $product->slug; ?>" class=mb-0><b><?php echo $product->name; ?></b></p>

                                                <p class="mb-0" <?php echo $product->sale == 1 ? "style='text-decoration:line-through'" : ""; ?>><?php echo number_format($product->price, 0); ?> VNĐ</p> </a>
                                                <p class="mb-0" style="font-weight:500;color:red;margin-right:5px"><?php echo $product->sale == 1 ? number_format($product->discount_price, 0) . " VNĐ" : ""; ?></p>

                                                <p>x <b><?php echo $product->cart['quantity']; ?></b></p>
                                            </div>

                                            <?php //print_r($product->cart);
                                                    ?>
                                            <input type=hidden name="order_detail[<?php echo $product->cart['id']; ?>][product_id]" value="<?php echo $product->cart['id']; ?>">
                                            <input type=hidden name="order_detail[<?php echo $product->cart['id']; ?>][name]" value="<?php echo $product->name; ?>">
                                            <input type=hidden name="order_detail[<?php echo $product->cart['id']; ?>][quantity]" value="<?php echo $product->cart['quantity']; ?>">
                                            <input type=hidden name="order_detail[<?php echo $product->cart['id']; ?>][price]" value="<?php echo $product->cart['price']; ?>">
                                            <input type=hidden name="order_detail[<?php echo $product->cart['id']; ?>][slug]" value="<?php echo $product->slug; ?>">
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div class="mb-2">
                                    <textarea name="order[note]" class='form-control' cols="30" rows="3" placeholder="Ghi Chú"></textarea>
                                    <a href="<?php echo site_url('cart'); ?>">Quay về giỏ hàng</a>
                                </div>
                                <hr>
                                <div class="mb-2">
                                    <p class="mb-0 text-dark" style="font-weight:500">Tiền hàng<span class="text-dark float-right"><?php echo number_format($_SESSION['cart']['total_price'], 0); ?> VNĐ<span></p>
                                    <p class="mb-0 text-dark" style="font-weight:500">Tổng số lượng<span class="text-dark float-right">x <b><?php echo $_SESSION['cart']['total_quantity']; ?></b></span></p>
                                    <p class="mb-0 text-dark" style="font-weight:500">Phí vận chuyển<span class="text-dark float-right">0 VNĐ<span></p>

                                    <p class="mb-0 text-dark" style="font-weight:500">TỔNG CỘNG<span class="text-dark float-right"><?php echo number_format($_SESSION['cart']['total_price'], 0); ?> VNĐ<span></p>


                                </div>
                            </div>

                        </div>
                        <div style="width:100%">
                            <input type="submit" class="add-to-cart m-auto" value="Xác nhận đơn hàng" style="opacity:1;cursor:pointer;border-radius:5px;font-size:14px">
                            <a class="btn add-to-cart m-auto text-center ml-4" href="<?php echo site_url(); ?>" style="opacity:1;cursor:pointer;border-radius:5px;font-size:14px">Tiếp tục mua sắm</a>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</div>