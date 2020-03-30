import Cookie from "./lib/Cookie";
import Loading from "./lib/Loading";


// CONTROL SVG
function SVG() {
	jQuery('img.svg').each(function() {
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		jQuery.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			var $svg = jQuery(data).find('svg');

			// Add replaced image's ID to the new SVG
			if (typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			// Add replaced image's classes to the new SVG
			if (typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass + ' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
			if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
				$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
			}

			// Replace image with new SVG
			$img.replaceWith($svg);

		}, 'xml');
	});
}

// CHECK LAYOUT CÓ BANNER KHÔNG
const checkLayoutBanner = () => {
	const heightHeader = $('header').outerHeight();
	$('main').css('padding-top', heightHeader);
}

const sliderCustomer = () => {
	var thumbnail = new Swiper('.slider-customer .thumbnail-image .swiper-container', {
		spaceBetween: 10,
		slidesPerView: 1,
		loop: true,
		observer: true,
		observeParents: true,
		slideToClickedSlide: true,
		speed: 1000,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: '.thumbnail-image .swiper-button-next',
			prevEl: '.thumbnail-image .swiper-button-prev',
		},
		breakpoints: {
			768: {
				slidesPerView: 2,
			},
			1440: {
				slidesPerView: 4,
			}
		}
	});

	var review = new Swiper('.slider-customer .review-image .swiper-container', {
		effect: 'fade',
		fadeEffect: {
			crossFade: true,
		},
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		speed: 1000,
		spaceBetween: 20,
		loop: true,
		simulateTouch: false,
		slidesPerView: 1,
		thumbs: {
			swiper: thumbnail,
		},
		navigation: {
			nextEl: '.thumbnail-image .swiper-button-next',
			prevEl: '.thumbnail-image .swiper-button-prev',
		}
	});
}

const setHeightOverFolowBySomeElement = (selector) => {
	$(selector).each(function() {
		const heightGet = $(this).find('[data-getHeight]').innerHeight();
		const heightSet = $(this).find('[data-setHeight]');
		const responsive = heightSet.attr('data-setHeight');
		if (window.innerWidth > responsive) {
			heightSet.css('max-height', heightGet)
		}
	})
}

const marginRightThumbnailSliderCustomer = () => {
	const width = $('.slider-customer .thumbnail-image .swiper-button-next').outerWidth();
	$('.slider-customer .thumbnail-image .swiper-container').css('margin-right', width + 19);
}

const customTempleByAttr = () => {
	// COLOR
	$('[data-bg]').each(function() {
		const dataBg = $(this).attr('data-bg');
		$(this).css('background', dataBg)
	})
	// WIDTH
	$('[data-width]').each(function() {
		const dataWidth = $(this).attr('data-width');
		$(this).css('width', dataWidth)
	})
	// MAX WIDTH
	$('[data-max-width]').each(function() {
		const dataMaxWidth = $(this).attr('data-max-width');
		$(this).css("maxWidth", dataMaxWidth + 'px')
	})
	// HEIGHT
	$('[data-height]').each(function() {
		const dataHeight = $(this).attr('data-height');
		$(this).css('height', dataHeight)
	})
	// MAX HEIGHT
	$('[data-max-height]').each(function() {
		const dataMaxHeight = $(this).attr('data-max-height');
		$(this).css("maxHeight", dataMaxHeight + 'px')
	})
}

const ajaxFormLogin = () => {
	$('#block-login button').on('click', function(e) {
		e.preventDefault();
		const url = $(this).attr('data-url');
		const link = $(this).attr('data-redirect');
		const email = $('#block-login .block-form input[name="email"]').val();
		const password = $('#block-login .block-form input[name="password"]').val();
		$.ajax({
			type: "POST",
			url: url,
			data: {
				email: email,
				password: password,
			},
			success: function(res) {
				if (res.Code === 200) {
					$.fancybox.close();
					window.location.href(link);
				} else {
					alert(res.Messege);
				}
			}
		});
	});
}

const ajaxFormInvite = () => {
	$('#block-invite button').on('click', function(e) {
		e.preventDefault();
		const url = $(this).attr('data-url');
		const email = $('#block-invite .block-form textarea#email').val();
		const project = $('#block-invite .block-form input#project').val();
		$.ajax({
			type: "POST",
			url: url,
			data: {
				email: email,
				project: project,
			},
			success: function(res) {
				if (res.Code === 200) {
					alert(res.Messege);
					$.fancybox.close();
				} else {
					alert(res.Messege);
				}
			}
		});
	});
}

// HEADER
function dropdownHeader() {
	$('.item-click-dropdown').on('click', function() {
		$(this).siblings('.content-dropdown').slideToggle();
	});
}

// ASIDE MENU
function initializationClassAsideMenu() {
	// LEVEL 1
	$('.aside-list .aside-item').children('.list-link').addClass('list-link-level--1');
	$('.aside-list .aside-item').children('.name').addClass('name-link-level--1');
	$('.aside-list .aside-item .list-link-level--1').children('.link').addClass('link-level--1');
	// LEVEL 2
	$('.aside-list .aside-item .list-link-level--1').find('.list-link').addClass('list-link-level--2');
	$('.aside-list .aside-item .link-level--1').children('.name').addClass('name-link-level--2');
	$('.aside-list .aside-item .list-link-level--2').children('.link').addClass('link-level--2');
}

// TOGGLE ASIDE GỌN PHÓNG TÓ
function closeAsideMenu() {
	if ($(window).width() < 1024) {
		$('body, aside').addClass('active');
	}

	$('.block-logo .button-close').on('click', function() {
		if ($(window).width() > 1024) {
			$(this).toggleClass('active');
			$('body, aside').toggleClass('active');
		}
	});
}

function toggleAsideMenu() {
	$('.aside-list .aside-item .name-link-level--1').on('click', function() {
		// THIS IS 'NOT THIS'
		const _notthis = $('.aside-list .aside-item .name-link-level--1').not(this);
		// SHOW SUB MENU ==> ADD CLASS ACTIVE
		$(this).siblings('.list-link').slideToggle();
		$(this).toggleClass('active');
		_notthis.siblings('.list-link').slideUp();
		_notthis.removeClass('active');
		// CLOSE LELVEL 2
		$('.aside-list .aside-item .list-link-level--2').slideUp();
		$('.aside-list .aside-item .name-link-level--2').removeClass('active');
	});

	$('.aside-list .aside-item .name-link-level--2').on('click', function() {
		// THIS IS 'NOT THIS'
		const _notthis = $('.aside-list .aside-item .name-link-level--2').not(this);
		// SHOW SUB MENU AND ADD CLASS ACTIVE
		$(this).siblings('.list-link').slideToggle();
		$(this).toggleClass('active');
		_notthis.siblings('.list-link').slideUp();
		_notthis.removeClass('active');
	});
}

document.addEventListener('DOMContentLoaded', () => {
	Loading().then(() => {
		// GET HEIGHT SOMWE ELEMENT
		setHeightOverFolowBySomeElement('.thumbnail-image,.review-image,.index-5');
	});
	// WOW JS
	new WOW().init();
	// CONTROL SVG
	SVG();
	customTempleByAttr();
	// CHECK BANNER
	checkLayoutBanner();
	// SLIDER ĐỐI TÁC
	sliderCustomer();
	// MARGIN
	marginRightThumbnailSliderCustomer();
	// AJAX
	ajaxFormLogin();
	ajaxFormInvite();
	// HEADER
	dropdownHeader();
	// ASIDE MENU
	initializationClassAsideMenu();
	toggleAsideMenu();
	closeAsideMenu();
});

document.addEventListener('resize', () => {
	setHeightOverFolowBySomeElement('.thumbnail-image,.review-image,.index-5');
	marginRightThumbnailSliderCustomer();
})