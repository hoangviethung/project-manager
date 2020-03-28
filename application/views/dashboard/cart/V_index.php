<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="content_scene_cat">

                <!-- Category image -->
                <div class="content_scene_cat_bg" style="background:url('<?php echo base_url(); ?>statics/default/images/slide_1.jpg') center center no-repeat; background-size:cover; min-height:300px;">
                    <p style="font-size:.9rem" class="bread-crumb mt-3"><a class="text-white" href="<?php echo site_url();?>">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;Giỏ Hàng</p>

                    <h1 class="page-heading product-listing text-center mt-2" style="font-size:1.5rem;font-weight:400;">Giỏ Hàng
                    </h1>
                </div>
            </div>

        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <img src="<?php echo base_url('assets/public/avatar/eaf23be0f9551e0b4744.jpg');?>" class="img-fluid cart-progress-img " alt="">
            <ul class="list-group cart_title_row_list" >
                <li class="list-group-item" style="font-weight: 300;   background: #646464;  border-color: #000;"><span><em>01. </em> Giỏ hàng</span></li>
                <li class="list-group-item"  style="background: #a4a4a4;"  ><span><em>02. </em>Đặt hàng</span></li>
                <li class="list-group-item" style="background: #a4a4a4;"><span><em>03. </em>Vận chuyển</span></li>
                <li class="list-group-item" style="background: #a4a4a4;"><span><em>04. </em>Thanh toán</span></li>
            </ul>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
        <?php if (isset($products)) : ?>
            <table style="width:100%" class='text-center table table-bordered cart-table'>
                <thead>
                    <tr class="" style="font-weight:400;background:#eafaf9;">
                        <th>Xoá</th>
                        <th>Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody>
                        <form action="<?php echo site_url("cart/update_cart"); ?>" method=POST>
                            <?php foreach ($products as $item) : ?>
                                <tr class="border-bottom">
                                    <?php if ($item->discount_price > 0) {
                                                $price = $item->discount_price;
                                            } else {
                                                $price = $item->price;
                                            } ?>
                                    <input type=hidden name="cart[<?php echo $item->id; ?>][id]" value=<?php echo $item->id; ?>>
                                    <input type=hidden name="cart[<?php echo $item->id; ?>][price]" value=<?php echo $price; ?>>
                                    <td class="py-lg-4" style="max-width:50px">
                                        <a href="<?php echo site_url('cart/remove_cart_item/') . $item->id; ?>" class='text-left bg-white remove-cart-icon mr-auto'> <i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    <td style="max-width:80px;padding:5px 25px 15px 25px;"><img src="<?php echo base_url('assets/public/avatar/') . $item->img1; ?>" class="img-fluid mt-3"></td>
                                    <td class="py-lg-4">
                                        <p class="ml-2"><?php echo $item->name; ?></p>
                                    </td>

                                    <td class="py-lg-4">
                                        <p class="ml-2"><?php echo number_format($price, 0); ?> VNĐ</p>
                                    </td>
                                    <td class="py-lg-4" style="max-width:150px"><div class="quantity"><input type=number min=0 name="cart[<?php echo $item->id; ?>][quantity]" class="ml-2 quantity-input disabled" style="opacity:1;width:80%;margin-bottom:12px;" value="<?php echo $item->cart['quantity']; ?>"></div></td>
                                    <td class="py-lg-4" style="max-width:200px">
                                        <p class="ml-2"><?php echo number_format($price * $item->cart['quantity'], 0); ?> VNĐ</p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class='' style="background:#f6f6f6;color:white">
                                <td colspan=4>
                                </td>
                                <th style="color: black;">Tổng tiền: </th>
                                <!-- <td><?php echo $_SESSION['cart']['total_quantity']; ?></td>-->
                                <td> 
                                    <p class="ml-2 mb-0" style="color: black;"><?php echo number_format($_SESSION['cart']['total_price'], 0); ?> VNĐ</p>
                                </td>
                            </tr>
                            <tr  style="background:#f6f6f6;color:white">
                                <td colspan=4>
                                </td>
                                <th style="color: black;">Thanh toán: </th>
                                <!-- <td><?php echo $_SESSION['cart']['total_quantity']; ?></td>-->
                                <td style="background: white;" > 
                                    <p class="ml-2 mb-0" style="color: black;"> <?php echo number_format($_SESSION['cart']['total_price'], 0); ?> VNĐ</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=4  style="border:none!important"></td>
                                <td class="text-center" style="border:none!important">
                                    <button type=submit class="btn add-to-cart m-2" style="opacity:1;font-size:.9rem">Cập Nhật Giỏ Hàng</button>
                                </td>
                                <td class="text-center"  style="border:none!important;">
                                    <a href="<?php echo site_url('check-out'); ?>" class="btn add-to-cart m-2" style="opacity:1;font-size:.9rem">Tiếp Tục</a>
                                </td>
                            </tr>
                        </form>
                </tbody>
            </table>
            <div class="cart-mobile">
                <form action="<?php echo site_url("cart/update_cart"); ?>" method=POST>
                <div class="row">
                    <?php foreach ($products as $item) : ?>
                        <div class="col-12">
                            <div class="row border-bottom pt-2 pb-4">
                                <div class="col-12">
                                <?php if ($item->discount_price > 0) {
                                            $price = $item->discount_price;
                                        } else {
                                            $price = $item->price;
                                        } ?>
                                <input type=hidden name="cart[<?php echo $item->id; ?>][id]" value=<?php echo $item->id; ?>>
                                <input type=hidden name="cart[<?php echo $item->id; ?>][price]" value=<?php echo $price; ?>>

                                </div>
     
                                <div class="col-sm-5"><img src="<?php echo base_url('assets/public/avatar/') . $item->img1; ?>" class="img-fluid"></div>
                                <div class="col-sm-7">
                                    <a href="<?php echo site_url('cart/remove_cart_item/') . $item->id; ?>" class='text-left bg-white remove-cart-icon float-right'>Xoá <i class="fas fa-trash-alt"></i></a>
                                    <p class="mb-0" style="font-weight:500;font-size:1.2rem"><?php echo $item->name; ?></p>
                                        <?php if($item->sale==1):?>
                                        Giá Nguyên: 
                                        <span style="text-decoration:line-through"><?php echo number_format($item->price, 0); ?> VNĐ</span>
                                        <p class='mb-0' style="color:red">Giá Giảm <?php echo number_format($price, 0); ?> VNĐ</p>
                                        <?php else:?>
                                        Đơn Giá: 
                                        <span><?php echo number_format($price, 0); ?> VNĐ</span>
                                        <?php endif;?>
                                    <div class="quantity">Số Lượng: <input type=number min=0 name="cart[<?php echo $item->id; ?>][quantity]" class=" quantity-input disabled" style="opacity:1;width:100%;margin-bottom:12px;" value="<?php echo $item->cart['quantity']; ?>"></div>
                                    <p class="mb-0">Thành tiền: <?php echo number_format($price * $item->cart['quantity'], 0); ?> VNĐ</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 text-right">
                        <p class="mb-0 mt-3" ><span style="font-weight:500">Tổng số Lượng: </span><?php echo $_SESSION['cart']['total_quantity']; ?> Sản Phẩm</p>
                        <p class=""><span style="font-weight:500">Tổng Tiền: </span><?php echo number_format($_SESSION['cart']['total_price'], 0); ?> VNĐ</p>
                    </div>
                    <div class="col-12 text-right">
                            <button type=submit class="btn add-to-cart mr-2" style="opacity:1;font-size:.9rem">Cập Nhật Giỏ Hàng</button>
                            <a href="<?php echo site_url('check-out'); ?>" class="btn add-to-cart" style="opacity:1;font-size:.9rem">Tiếp Tục</a>
                    </div>
                </div>
                </form>
            </div>
            <?php else: ?>
                <p>Giỏ Hàng Trống</p>
            <?php endif; ?>
        </div>
    </div>
</div>