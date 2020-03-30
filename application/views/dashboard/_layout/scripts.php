<script>
window.onscroll = function() {scrollFunction()};
function scrollFunction() 
{
    if (document.documentElement.scrollTop > 100) 
    {
        document.getElementById("navbartop").style.padding = "0px";
        document.getElementById("navbartop").style.width = "95%";
        document.getElementById("navbartop").style.height = "75px";
        document.getElementById("navbartop").style.margin = "0 auto";
        document.getElementById("navbartop").style.marginTop = "10px";
        document.getElementById("navbartop").style.backgroundColor = "#008000";
        document.getElementById("navbartop").style.boxShadow = "-1px 1px 5px";
        $(".search-form").css("max-height", "48px");
        $(".brand-logo").css("margin-top","0px");
        $(".brand-slogan").css("margin-top","8px");
        $(".navbar-lg").addClass("backGroundNav");
        $(".navbar-mobile").addClass("backGroundNav");
    } 
    else 
    {

        document.getElementById("navbartop").style.padding = "0px";
        document.getElementById("navbartop").style.width = "100%";
        document.getElementById("navbartop").style.height = "94px";
        document.getElementById("navbartop").style.margin = "0 auto";
        document.getElementById("navbartop").style.backgroundColor = "#008000dc";
        $(".search-form").css("max-height", "53px");
        $(".brand-logo").css("margin-top","5px");
        $(".brand-slogan").css("margin-top","13px");
          $(".navbar-desktop").removeClass("hideNav");
          $(".navbar-lg").removeClass("backGroundNav");
          $(".navbar-mobile").removeClass("backGroundNav");
    } 
    if (document.documentElement.scrollTop > 400) 
    {
        document.getElementById("back-to-top-btn").style.transform = "translateX(-20px)";
    } 
    else 
    {
          document.getElementById("back-to-top-btn").style.transform = "translateX(80px)";
    } 
}

$(document).ready(function(){
    <?php if($this->uri->segment(1)=="gallery" || $this->uri->segment(1)=="search"):?>
        var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                columnWidth: '.grid-sizer'
                }
        });
        $grid.imagesLoaded().progress(function () { 
            $grid.isotope('layout');
        });
    <?php endif;?>
    <?php if($this->uri->segment(1)==""):?>
        var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                layoutMode: 'packery',
                packery: {
                    gutter: 5,
                }
        });
        $grid.imagesLoaded().progress(function () { 
            $grid.isotope('layout');
        });
    <?php endif;?>
    
    $("#back-to-top-btn").on("click", function (e) {
        e.preventDefault();
        $("html,body").animate({
            scrollTop: 0
        }, 700);
    });
    $(".home-banner-slide-carousel.owl-carousel").owlCarousel({
        loop:true,
        margin:15,
        nav:true,
        navText:["<i class='fas fa-caret-left'></i>","<i class='fas fa-caret-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
    $(".owl-carousel.featured-products-slide").owlCarousel({
        margin:10,
        nav:true,
        navText:["<i class='fas fa-caret-left'></i>","<i class='fas fa-caret-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            768:{
                items:4
            },
            1000:{
                items:6
            }
        }
    });

    <?php if($this->uri->segment(1)=="product"|| $this->uri->segment(1)=="category"):?>
    $(".category-banner-title").mouseenter(function(){
        var alternate = anime({
            targets: ".product-back-icon",
            translateX: -15,
            direction: "alternate",
            duration: 800
            });
    });
    $(".category-banner-title").mouseleave(function(){
        var alternate = anime({
            targets: ".product-back-icon",
            translateX: 0,
            });
    });
    var alternate = anime({
        targets: ".product-back-icon",
        translateX: -15,
        direction: "alternate",
        duration: 600
      });
    if($(window).width() <= 991)
    {
        $('body').on('click',".dropdown-btn", function(){
            $(".category-list").slideToggle();
        });
    }

    if ($(window).width() <= 991) {
            $('.dropdown-toggle').removeClass('dropdown-toggle');
            $('.dropdown-menu').removeClass('dropdown-menu');
    }
    $(window).resize(function () {
        if ($(window).width() <= 991) {
            $('.dropdown-toggle').removeClass('dropdown-toggle');
            $('.dropdown-menu').removeClass('dropdown-menu');
        }
    });


    $(".dropdown-toggle").click(function(){
        $(this).closest(".category-list-item").find(".dropdown-menu").toggleClass("show-dropdown-menu");
    });
    $('.level1-title').click(function (){
        $(this).siblings('ul').slideToggle();
        $(this).find('.title-icon').toggleClass('icon-active');
    });
    $('.level2-title').click(function (){
        $(this).siblings('ul').slideToggle();
        $(this).find('.title-icon').toggleClass('icon-active');
    });
    $('.sub-category-list-item.level3.active').closest('.sub-category-list.level3').addClass('active');
    $('.sub-category-list.level3.active').closest('.sub-category-list.level2').addClass('active');
    $('.sub-category-list-item.level2.active').closest('.sub-category-list.level2').addClass('active');


    <?php endif;?>
});

var galleryThumbs = new Swiper(".gallery-thumbs", {
    spaceBetween: 1,
    slidesPerView: 3,
    direction: "vertical",
    loopedSlides: 3,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
});

var galleryTop = new Swiper(".gallery-top", {
spaceBetween: 10,
loop:true,
loopedSlides: 5,
navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
},
thumbs: {
    swiper: galleryThumbs,
},
});


var featuredProducts = new Swiper(".featured-shops-slide", {
    spaceBetween: 10,
    slidesPerView: 6,
    loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        991: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        575: {
            slidesPerView:2,
            spaceBetween: 30,
        }
    }
    });
<?php if($this->uri->segment(1)=="product"):?>
  const ps = new PerfectScrollbar("#perfect-scrollbar-product-info", {
    wheelSpeed: 1,
    wheelPropagation: true,
    minScrollbarLength: 20
  });
<?php endif; ?>

</script>

