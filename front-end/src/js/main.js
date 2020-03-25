import Cookie from "./lib/Cookie";
import Loading from "./lib/Loading";

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

document.addEventListener('DOMContentLoaded', () => {
	Loading().then(() => {
		// GET HEIGHT SOMWE ELEMENT
		setHeightOverFolowBySomeElement('.thumbnail-image,.review-image,.index-5');
	});
	// WOW JS
	new WOW().init();
	// CHECK BANNER
	checkLayoutBanner();
	// SLIDER ĐỐI TÁC
	sliderCustomer();
	// MARGIN
	marginRightThumbnailSliderCustomer();
});

document.addEventListener('resize', () => {
	setHeightOverFolowBySomeElement('.thumbnail-image,.review-image,.index-5');
	marginRightThumbnailSliderCustomer();
})