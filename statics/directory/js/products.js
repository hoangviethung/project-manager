$(document).on('change','input[name="typeoff"]',function(){
	type = $(this).val();
	if(type==0){
		$('input#sale_off').addClass('hide');
		$('input#percent').removeClass('hide');
	}else{
		$('input#percent').addClass('hide');
		$('input#sale_off').removeClass('hide');
	}
});