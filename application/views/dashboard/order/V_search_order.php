<div class="container mt-5">
    <div class="row">
    <div class="col-12 text-left">
    <p style="font-size:.9rem" class="mt-3 border p-1 breadcrumb bg-light">
                <a class='mr-2 ml-2'><i class="fas fa-home"></i></a><a class="text-dark ml-0" href="<?php echo site_url(); ?>">Home</a>  <a><img src="<?php echo base_url('assets/public/avatar/');?>Screenshot_121.png" class="arrow-right">Theo Dõi Đơn Hàng</a>
            </p>
        </div>
        <div class="col-12">
            <div class="content_scene_cat">

                <!-- Category image -->
                <div class="content_scene_cat_bg" style="background:url('<?php echo base_url(); ?>statics/default/images/slide_1.jpg') center center no-repeat; background-size:cover; min-height:300px;">
                    <p style="font-size:.9rem" class="bread-crumb mt-3"><a class="text-white" href="<?php echo site_url(); ?>">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;Đơn Hàng&nbsp;&nbsp;/&nbsp;&nbsp;Theo Dõi Đơn Hàng</p>
                    <h1 class="page-heading product-listing text-center mt-2" style="font-size:1.5rem;font-weight:400;">Theo Dõi Đơn Hàng
                    </h1>
                </div>
            </div>

        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <h2 class="mb-3 text-dark" style="font-size:1.3rem;font-weight:400;text-decoration:underline">Đơn hàng số: <strong><?php echo $search_order_result->order_code ?></strong></h2>
            <div class="row">
                <div class="col-md-6">
                    <h3 style="font-size:1.2rem;font-weight:400;margin-bottom:20px">Thông tin đơn hàng:</h3>
                    <p class="mb-1"><b>Tên khách hàng : </b><span class="text-dark" style="font-weight:500"><?php echo $search_order_result->customer_name; ?></span></p>
                    <?php $time=strtotime($search_order_result->order_at);?>
                    <p class="mb-1"><b>Đặt hàng lúc : </b><span class="text-dark" style="font-weight:500"> <?php echo date('H:i:s',$time); ?> </span></p>
                    <p class="mb-1"><b>Ngày : </b> <span class="text-dark" style="font-weight:500"><?php echo date('d',$time); ?> - <?php echo date('m',$time); ?> - <?php echo date('Y',$time); ?> </span></p>
                    <p class="mb-1"><b>Đại chỉ giao hàng : </b><span class="text-dark" style="font-weight:500"><?php echo $search_order_result->address; ?></span></p>
                    <p class="mb-1"><b>Số ĐT: </b><span class="text-dark" style="font-weight:500"><?php echo $search_order_result->phone; ?></span></p>
                    <p class="mb-1"><b>Email : </b><span class="text-dark" style="font-weight:500"><?php echo $search_order_result->email; ?></span></p>
                    <p class="mb-1"><b>Số lượng sản phẩm : </b><span class="text-dark" style="font-weight:500"><?php echo $search_order_result->total_quantity; ?> món</span></p>
                    <p class="mb-1"><b>Tổng Tiền : </b><span class="text-dark" style="font-weight:500"><?php echo number_format($search_order_result->total_price, 0); ?> VNĐ</span></p>
                </div>

                <div class="col-md-6">
                    <h3 style="font-size:1.2rem;font-weight:400;margin-bottom:20px">Trạng Thái Đơn hàng:</h3>

                    <?php if ($search_order_result->cancelled == 1) : ?>
                        <p class="text-white p-2 btn btn-danger" style="color:red;font-weight:500;">Đơn hàng đã huỷ</p>
                    <?php else : ?>
                        <?php if ($search_order_result->paid == 0) : ?>
                            <p class="btn btn-primary p-2" style="">Chưa thanh toán</p>
                        <?php elseif ($search_order_result->paid == 1) : ?>
                            <p class="btn btn-success p-2" style="">Đã thanh toán</p>
                        <?php endif; ?>
                        <?php if ($search_order_result->delivered == 0) : ?>
                            <p class="btn btn-primary p-2" style="">Chưa giao hàng</p>
                        <?php elseif ($search_order_result->delivered == 1) : ?>
                            <p class="btn btn-success p-2" style="">Đã giao hàng</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 mt-3">
                    <h3 style="font-size:1.2rem;font-weight:400">Chi tiết đơn hàng:</h3>
                    <?php //print_r($products);
                    ?>
                    <div class="row mb-0 pt-2 pb-2" style="box-shadow:1x 0px 2px grey">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-6">
                            <b>Sản Phẩm</b>
                        </div>
                        <div class="col-md-1">
                            <b>Qty</b>
                        </div>
                        <div class="col-md-1">
                            <b>Giá</b>
                        </div>
                        <div class="col-md-2">
                            <b>Tổng</b>
                        </div>
                    </div>
                    <?php if ($products) : ?>
                        <?php //print_r($products);
                            ?>
                        <?php foreach ($products as $product) : ?>
                            <div class="row mb-1 pt-2 pb-2" style="box-shadow:0px 0px 3px grey">
                                <div class="col-md-2">
                                    <img src="<?php echo base_url("assets/public/avatar/") . $product->img1; ?>" class=img-fluid>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $product->name; ?>
                                </div>
                                <div class="col-md-1">
                                    <?php echo $product->order_details['quantity']; ?>
                                </div>
                                <div class="col-md-1">
                                    <?php echo number_format($product->order_details['price'], 0); ?> VNĐ
                                </div>
                                <div class="col-md-2">
                                    <?php echo number_format($product->order_details['price'] * $product->order_details['quantity'], 0); ?> VNĐ
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>