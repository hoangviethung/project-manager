<?php if($style=='grid'):?>
    <?php foreach($products as $item): ?>
        <div class="col-md-4 category-product-item text-center my-3">
            <a href="<?php echo site_url('product?id='.$item->id);?>"class="text-dark product-wrap-link">
                <figure class="figure category-product-figure">
                    <div class="category-product-item-img">
                        <img src="assets/public/avatar/<?php echo $item->img1 ?>" alt="" class="img-fluid">
                    </div>
                    <figcaption>
                        <h2 class="category-product-item-title"><?php echo $item->name?></h2>
                        <p class="category-prodcut-item-desc"><?php echo $item->short_des?></p>
                    </figcaption>
                </figure>
            </a>
        </div>
    <?php endforeach;?>
<?php elseif($style=='list'):?>
    <?php foreach($products as $item): ?>
        <div class="category-product-item text-center my-3 col-4">
            <a href="<?php echo site_url('product?id='.$item->id);?>"
                class="text-dark product-wrap-link">
                <figure class="figure category-product-figure">
                    <div class="category-product-item-img">
                        <img src="assets/public/avatar/<?php echo $item->img1 ?>" alt=""
                            class="img-fluid">
                    </div>
                </figure>
            </a>
        </div>
        <div class="col-8 category-product-item-text">
            <h2 class="category-product-item-title"><?php echo $item->name?></h2>
            <p class="category-prodcut-item-desc"><?php echo $item->short_des?></p>
        </div> 
    <?php endforeach;?>
<?php endif;?>