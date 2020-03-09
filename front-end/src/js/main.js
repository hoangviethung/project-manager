import Cookie from "./lib/Cookie";
import Loading from "./lib/Loading";

// CHECK LAYOUT CÓ BANNER KHÔNG
const checkLayoutBanner = () => {
	const heightHeader = $('header').outerHeight();
	$('main').css('padding-top', heightHeader);
}

document.addEventListener('DOMContentLoaded', () => {
	Loading();
	checkLayoutBanner();
});