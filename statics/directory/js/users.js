
function checkPassword(){
	password = $('#password').val();
	cfpassword = $('#cfpassword').val();
	if(password.length < 6){
		$('#pass-msg').removeClass('hide');
	}else{
		$('#pass-msg').addClass('hide');
		checkCfPass();
	}

	if(password == cfpassword){
		$('#cfpass-msg').addClass('hide');
		$('#formSubmit').removeAttr('disabled');
	}
}

function checkCfPass(){
	password = $('#password').val();
	cfpassword = $('#cfpassword').val();
	if(cfpassword.length > 0 && cfpassword != password){
		$('#cfpass-msg').removeClass('hide');
		$('#formSubmit').attr('disabled','disabled');
	}else{
		$('#cfpass-msg').addClass('hide');
		$('#formSubmit').removeAttr('disabled');
	}
}

$(document).on('click','#user-setpass',function(){
	//$('#changePassModal').modal({backdrop: 'static', keyboard: false});
	userid = $(this).attr('data-id');
	$.getJSON(base_url+"admin/users?act=uinfo&id="+userid+"&token="+token,function(data){
	}).done(function(data){
		str = "You're setting password for user <strong>"+data.user.username+"</strong> with Email <strong>"+data.user.email+"</strong>";
		$('#Uinfo').html(str);
		faction = base_url+"admin/users?act=setpass&id="+userid+"&token="+token;
		$('form#formInputPass').attr('action',faction);
	});
});

$(document).on('submit','form#formInputPass',function(e){
	password = $('#formInputPass input[name=password]').val();
	cfpassword = $('#formInputPass input[name=cfpassword]').val();
	if(password.length < 6){
		e.preventDefault();
		str = "Password must have at least 6 characters";
		$('#view-msg').html(str);
	}else{
		if(password != cfpassword){
			e.preventDefault();
			str = "Password not match";
			$('#view-msg').html(str);
		}
	}
});

$(document).on('click','#closeCPModal',function(){
	$('form#formInputPass')[0].reset();
	$('#view-msg').html("");
});


$(document).on('click','form#updateInfoProfile a.btn',function(e){
	e.preventDefault();
	$('form#updateInfoProfile input').removeClass('hide');
	$('form#updateInfoProfile h4').addClass('hide');
	$('form#updateInfoProfile h4#member-email').removeClass('hide');
	$('form#updateInfoProfile .btn-groups').removeClass('hide');
	$(this).addClass('hide');
});

$(document).on('click','form#changePassProfile a.btn',function(e){
	e.preventDefault();
	$('form#changePassProfile input').removeAttr('readonly');
	$('form#changePassProfile .btn-groups').removeClass('hide');
	$(this).addClass('hide');
});

$(document).on('click','form#changeAvatarProfile a.btn',function(e){
	e.preventDefault();
	$('form#changeAvatarProfile .btn-groups, form#changeAvatarProfile input').removeClass('hide');
	$(this).addClass('hide');
});

$(document).on('click','.form-cancel',function(e){
	e.preventDefault();
	f_id = $(this).attr("data-id");

	if(f_id=="updateInfoProfile"){
		$('form#updateInfoProfile input').addClass('hide');
		$('form#updateInfoProfile h4, form#updateInfoProfile a.btn').removeClass('hide');
		$('form#updateInfoProfile .btn-groups').addClass('hide');
	}

	if(f_id=="changePassProfile"){
		$('form#changePassProfile input').attr('readonly','true');
		$('form#changePassProfile .btn-groups').addClass('hide');
		$('form#changePassProfile a.btn').removeClass('hide');
	}

	if(f_id=="changeAvatarProfile"){
		$('form#changeAvatarProfile .btn-groups, form#changeAvatarProfile input').addClass('hide');
		$('form#changeAvatarProfile a.btn').removeClass('hide');
	}
});

$('form#changePassProfile').submit(function(e){
	e.preventDefault();
	oldpass = $('form#changePassProfile input[name=oldpassword]').val();
	newpass = $('form#changePassProfile input[name=newpassword]').val();
	cfmpass = $('form#changePassProfile input[name=cfmpassword]').val();
	if(newpass != cfmpass){
		$('#ProfileMsgView').html("<span class='text-danger'>Password not match</span>");
	}else{
		$('#ProfileMsgView').html('');
		$.post(base_url+"admin/users?act=upro&token="+token,{oldpass:oldpass,newpass:newpass,typeUpd:"P"},function(data){
		},'json').done(function(data){
			console.log(data);
			$('#ProfileMsgView').html(data.msg);
			if(data.rs==1){
				setTimeout(function(){
					location.href=base_url+"admin/logout";
				},3000)
			}
		});
	}
});

$(function(){
	$('form#updateInfoProfile h4, form#updateInfoProfile a.btn').removeClass('hide');
	$('form#updateInfoProfile .btn-groups').addClass('hide');
	$('form#changePassProfile .btn-groups').addClass('hide');
	$('form#changeAvatarProfile .btn-groups, form#changeAvatarProfile input').addClass('hide');
})