<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="content_scene_cat">

                <!-- Category image -->
                <div class="content_scene_cat_bg" style="background:url('<?php echo base_url(); ?>statics/default/images/slide_1.jpg') center center no-repeat; background-size:cover; min-height:300px;">
                    <p style="font-size:.9rem" class="bread-crumb mt-3"><a class="text-white" href="<?php echo site_url(); ?>">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;Đơn Hàng&nbsp;&nbsp;/&nbsp;&nbsp;Đơn Hàng Đã Xác Nhận</p>
                    <h1 class="page-heading product-listing text-center mt-2" style="font-size:1.5rem;font-weight:400;">Đơn Hàng Đã Xác Nhận
                    </h1>
                </div>
            </div>

        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <h2 class="mb-3 text-dark" style="font-size:1.3rem;font-weight:500">Cám ơn đã mua hàng. Đơn Hàng Của Bạn Đã Được Xác Nhận.</h2>
            <ul class="pl-0">
                <!-- <li>Mã Đơn Hàng: <?php echo $order_code; ?></li>
                <li>Tổng Cộng: <?php echo number_format($order['total_price'], 0); ?> VNĐ</li>
                <li>Ngày Đặt: <?php echo date("d-m-Y"); ?></li>
                <li>Họ Tên Người Đặt: <?php echo $order['customer_name']; ?></li>
                <li>Địa Chỉ: <?php echo $order['address']; ?></li>
                <li>Số ĐT: <?php echo $order['phone']; ?></li>
                <li>Email: <?php echo $order['email']; ?></li> -->

                <li class="ml-0 mb-2">Đơn Hàng Số : <span class="text-dark" style="font-weight:500;font-size:1.5rem;text-decoration:underline"> <?php echo $order_code; ?></span></li>
                <li class="ml-3 mb-2" style="list-style-type:circle;">Tổng Cộng: <span class="text-dark" style="font-weight:500"><?php echo number_format($order['total_price'], 0); ?> VND</span></li>
                <li class="ml-3 mb-2" style="list-style-type:circle;">Ngày Đặt: <span class="text-dark" style="font-weight:500"><?php echo date("d-m-Y"); ?></span></li>
                <li class="ml-3 mb-2" style="list-style-type:circle;">Họ Tên Người Đặt: <span class="text-dark" style="font-weight:500"><?php echo $order['customer_name']; ?></span></li>
                <li class="ml-3 mb-2" style="list-style-type:circle;">Địa Chỉ: <span class="text-dark" style="font-weight:500"><?php echo $order['address']; ?></span></li>
                <li class="ml-3 mb-2" style="list-style-type:circle;">Số ĐT: <span class="text-dark" style="font-weight:500"><?php echo $order['phone']; ?></span></li>
                <li class="ml-3 mb-3" style="list-style-type:circle;">Email: <span class="text-dark" style="font-weight:500"><?php echo $order['email']; ?></span></li>
            </ul>
            <div class="border p-3">
            <h2 class="text-dark" style="font-size:1.5rem;font-weight:400">Chi Tiết Đơn Hàng</h2>
            <h3 class="p-3 bg-light text-dark" style="font-size:1rem;font-weight:500">Sản Phẩm<span class="float-right text-dark">Giá</span></h3>
            <?php foreach($products as $product):?>
            <div class="mb-2 p-3">
                <a href="<?php echo site_url('san-pham/') . $product->slug; ?>" class=mb-0><b><?php echo $product->name; ?></b>
                <span class="float-right" style="font-weight:500;<?php echo $product->sale==1?"text-decoration:line-through":"";?>"><?php echo number_format($product->price, 0); ?> VNĐ<span>
                <span class="float-right" style="font-weight:500;color:red; margin-left:10px"><?php echo $product->sale==1?number_format($product->discount_price, 0)." VNĐ":"";?> </span>
                </a>
                <p>x <b><?php echo $product->cart['quantity']; ?></b></p>
            </div>
            <?php endforeach;?>
            <hr>
            <div class="mb-2 p-3">
                <p class="mb-0 text-dark" style="font-weight:500">TỔNG CỘNG<span class="float-right"><?php echo number_format($order['total_price'], 0); ?> VNĐ<span></p>
                <p style="font-weight:500">x <b><?php echo number_format($order['total_quantity'], 0); ?></b></p>
            </div>
            </div>

        </div>

    </div>
</div>