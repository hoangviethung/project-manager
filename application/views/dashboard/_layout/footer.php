<!-- Footer -->
<footer class="pt-5 pb-4 " id="contact">
  <div class="container pt-4" style="border-top:1px solid grey">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4 border-right">
        <h5 class="mb-3">LAJEW</h5>
        <p class="mb-2">TRANG SỨC BẠC </p>
        <p class="mb-2">NGỌC QUÝ ĐÁ QUÝ </p>
        <p class="mb-2">NEW ARRIVALS </p>
        <p class="mb-2">BIG SALE </p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4  border-right" >
        <h5 class="mb-3">THÔNG TIN</h5>
        <ul class="f-address pl-0">
          <li>
            <div class="row">
              <div class="col-12">
                <p class="mb-2"><a href="#">Hướng dẫn đo size nhẫn</a></p>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-12">
                <p class="mb-2"><a href="#">Hướng dẫn đo size vòng & lắc tay</a></p>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-12">
                <p class="mb-2"><a href="#"><b>Hướng dẫn nhận và trả bảo hành</b></a></p>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-12">
                <p class="mb-2"><a href="#">Facebook: <span style="text-decoration:underline">LAJEW</span></a></p>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-12">
                <p class="mb-2"><a href="#">Instagram: <span style="text-decoration:underline">LAJEW</span></a></p>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4  border-right">
        <h5 class="mb-3">THÔNG TIN CỬA HÀNG LAJEW</h5>
        <ul class="pl-0">
          <li>
            <span>376 Lê Trọng Tấn, P.Tây Thạnh, Q.Tân Phú, TP.HCM</span>
          </li>
          <li>
            <span>Hotline: 0941 45 45 05 - 0931 30 80 20</span>
          </li>
          <li>
            <span>Email: trangsuclajew@gmail.com</span>
          </li> 
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4">
        <h5 class="mb-3">Tìm Kiếm</h5>

        <form method=get action="<?php echo site_url("/search"); ?>">
          <div class="search-wrap">
            <div class="float-left search_text" style="width:80%">
              <input type="text" name='search' class='search' style="width:100%" onfocusin='searchFocusIn()' onfocusout='searchFocusOut()' placeholder="Tìm Kiếm">
            </div>
            <div class="text-right">
              <button type=submit class="search-btn"><i class="fas fa-search" style="display:inline"></i></button>
            </div>
          </div>
        </form>
        <ul class="social-pet mt-4">
          <li><a href="#" title="facebook"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#" title="instagram"><i class="fab fa-instagram"></i></a></li>
        </ul>
        <img src="https://lajew.nhahanghondat.vn/statics/default/images/icon-dangky.png" alt="" class='img-fluid'>
      </div>
    </div>
  </div>
</footer>
<!-- Copyright -->
<section class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ">
        <div class="text-center text-white">
          &copy; 2019 Lajew. All Rights Reserved.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15" /></svg></div>

<script src="<?php echo base_url('statics/default/'); ?>js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery-ui.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/popper.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/owl.carousel.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery.stellar.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery.countdown.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/aos.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery.fancybox.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery.sticky.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery.mb.YTPlayer.min.js"></script>
<script src="<?php echo site_url('statics/default/swiper/dist/js/swiper.min.js'); ?>"></script>
<script src="<?php echo base_url('statics/default/'); ?>toastr/build/toastr.min.js"></script>


<script src="<?php echo base_url('statics/default/'); ?>js/main.js"></script>
<script>
  AOS.init({
    duration: 1500,
  })
  jQuery(document).ready(function($) {
    <?php if (isset($_SESSION['toastr'])) : ?>
      <?php if (isset($_SESSION['toastr']['info'])) : ?>
        toastr.info('<?php echo $_SESSION['toastr']['info']; ?>');
      <?php elseif (isset($_SESSION['toastr']['success'])) : ?>
        toastr.success('<?php echo $_SESSION['toastr']['success']; ?>');
      <?php elseif (isset($_SESSION['toastr']['warning'])) : ?>
        toastr.warning('<?php echo $_SESSION['toastr']['warning']; ?>');
      <?php elseif (isset($_SESSION['toastr']['error'])) : ?>
        toastr.error('<?php echo $_SESSION['toastr']['error']; ?>');
      <?php endif; ?>
    <?php
      unset($_SESSION['toastr']);
    endif; ?>
  });
</script>
</body>

</html>