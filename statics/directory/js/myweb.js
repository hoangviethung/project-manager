$(document).on('click','#btndelete',function(){
	userid = $(this).attr('data-id');
	fmodule = $(this).attr('module');
	href=base_url+"admin/"+fmodule+"?act=del&id="+userid+"&token="+token;
	$('#confirmDelete').attr('href',href);
	return false;
});