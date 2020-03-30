<div class="container mt-5">
    <div class="row">
        <div class="col-12">
        <p style="font-size:.9rem" class="mt-3 border p-1 breadcrumb bg-light">
                <a class='mr-2 ml-2'><i class="fas fa-home"></i></a><a class="text-dark ml-0" href="<?php echo site_url(); ?>">Home</a>  <a><img src="<?php echo base_url('assets/public/avatar/');?>Screenshot_121.png" class="arrow-right">Tìm Đơn Hàng</a>
            </p>
        </div>
        <div class="col-12">
            <div class="content_scene_cat">

                <!-- Category image -->
                <div class="content_scene_cat_bg" style="background:url('<?php echo base_url(); ?>statics/default/images/slide_1.jpg') center center no-repeat; background-size:cover; min-height:300px;">
                    <p style="font-size:.9rem" class="bread-crumb mt-3"><a class="text-white" href="<?php echo site_url(); ?>">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;Đơn Hàng&nbsp;&nbsp;/&nbsp;&nbsp;Tìm Đơn Hàng</p>
                    <h1 class="page-heading product-listing text-center mt-2" style="font-size:1.5rem;font-weight:400;">Tìm Đơn Hàng
                    </h1>
                </div>
            </div>

        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <h2 class="mb-3 text-dark" style="font-size:1.3rem;font-weight:500">Xin vui lòng nhập mã đơn hàng và Email hoặc Số ĐT dùng để mua hàng</h2>
            <form method=post action="<?php echo site_url('search-order'); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-3 mb-0">Mã Đơn Hàng*</label>
                        <input type="text" name='order_code' required class="form-control">
                        <small>(*) trường bắt buộc phải nhập</small>
                    </div>
                    <div class="col-md-6 border-left">
                        <label class="mb-0 mt-3">Số ĐT*</label>
                        <input type="text" name='phone' class="form-control">

                        <label class="mb-0 mt-3">Email*</label>
                        <input type="text" name='email' class="form-control">
                        <small>Nhập 1 trong 2 trường</small>
                    </div>
                    <div class="col-12 text-center">
                    <p><?php echo isset($message)?$message:"";?></p>
                    <input type=submit value="Kiếm Đơn Hàng" class="add-to-cart" style="opacity:1;cursor:pointer">
                    </div>

                </div>

            </form>
        </div>

    </div>
</div>