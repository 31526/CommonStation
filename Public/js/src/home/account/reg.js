define(['jquery','common'],function($){



	//js_refresh 刷新验证码
	//刷新验证码
	var vcodeimg = $("img#verifyimg").attr("src");
	$('#verifyimg').click(function(){
        if( vcodeimg.indexOf('?')>0){
            $(this).attr("src", vcodeimg+'&random='+Math.random());
        }else{
            $(this).attr("src", vcodeimg.replace(/\?.*$/,'')+'?'+Math.random());
        }
	});


	//失去焦点就检查 Email 是否正确和是否已经被注册

	$('#js_email').focusin(function(){
		$('.js_email').removeClass('frm-err frm-ok').addClass('frm-focus')
			.find('.frm-tips i').attr('class','i-doubt-s')
			.next('em').text('请填写常用邮箱，便于及时获取答案');	
	}).focusout(function(){
		var email = $.trim($('#js_email').val());
		if(email == ''){

			$('.js_email').removeClass('frm-focus').addClass('frm-err')
				.find('.frm-tips i').attr('class','i-error-s')
				.next('em').text('邮箱不能为空');	

		}else if(common.is_email(email)){
			checkEmail(email);
		}else{

			$('.js_email').removeClass('frm-focus').addClass('frm-err')
				.find('.frm-tips i').attr('class','i-error-s')
				.next('em').text('邮箱格式错误');			
		};
	});

	function checkEmail(email){
		$.ajax({
			url:$('#js_checkemail').val(),
			data:{'email':email},
			type:'post',
			success:function(json){
				if(json.status){

					$('#js_email').data('status',true);
					$('.js_email').removeClass('frm-focus frm-err').addClass('frm-ok')
						.find('.frm-tips i').attr('class','i-success-s')
						.next('em').text('');
				}else{

					$('.js_email').removeClass('frm-focus').addClass('frm-err')
						.find('.frm-tips i').attr('class','i-error-s')
						.next('em').html('邮箱已经注册，可以<a href="/login">直接登录</a>或<a href="/passport/find">找回密码</a>');
				}
			}
		});
	}


	//失去焦点就检查 Mobile 是否正确和是否已经被注册
	$('#js_nickname').focusin(function(){
		$('.js_nickname').removeClass('frm-err frm-ok').addClass('frm-focus')
			.find('.frm-tips i').attr('class','i-doubt-s')
			.next('em').text('5到20个字符，汉字、字母、数字或下划线');	
	}).focusout(function(){
		var nickname = $.trim($('#js_nickname').val());
		if(nickname == ''){
			$('.js_nickname').removeClass('frm-focus').addClass('frm-err')
				.find('.frm-tips i').attr('class','i-error-s')
				.next('em').text('用户名不能为空');	
		}else if(common.is_nickname(nickname)){
			checkNickname(nickname);
		}else{

			$('.js_email').removeClass('frm-focus').addClass('frm-err')
				.find('.frm-tips i').attr('class','i-error-s')
				.next('em').text('用户名格式错误');	
		};
	});

	function checkNickname(nickname){
		$.ajax({
			url:$('#js_checknickname').val(),
			data:{'nickname':nickname},
			type:'post',
			success:function(json){
				if(json.status){

					$('#js_nickname').data('status',true);
					$('.js_nickname').removeClass('frm-focus frm-err').addClass('frm-ok')
						.find('.frm-tips i').attr('class','i-success-s')
						.next('em').text('');
				}else{

					$('.js_nickname').removeClass('frm-focus').addClass('frm-err')
						.find('.frm-tips i').attr('class','i-error-s')
						.next('em').text('用户名已经被注册，换一个吧');
				}
			}
		});
	}




	//失去焦点就检查 Password 是否正确
	$('#js_password').focusin(function(){
		$('.js_password').removeClass('frm-err frm-ok').addClass('frm-focus')
			.find('.frm-tips i').attr('class','i-doubt-s')
			.next('em').text('密码由6到20个字符组成，区分大小写');	
	}).focusout(function(){
		var password = $.trim($('#js_password').val());
		var len = password.length;
		if(len >=6 && len <= 20){
			$('#js_password').data('status',true);
			$('.js_password').removeClass('frm-focus frm-err').addClass('frm-ok')
				.find('.frm-tips i').attr('class','i-success-s')
				.next('em').text('');

		}else{
			$('.js_password').removeClass('frm-err frm-ok').addClass('frm-focus')
				.find('.frm-tips i').attr('class','i-doubt-s')
				.next('em').text('密码由6到20个字符组成，区分大小写');	
		};
	});






	//失去焦点就检查 Mobile 是否正确和是否已经被注册
	$('#js_mobile').focusin(function(){
		$('.js_mobile').removeClass('frm-err frm-ok').addClass('frm-focus')
			.find('.frm-tips i').attr('class','i-doubt-s')
			.next('em').text('请填写常用邮箱，便于及时获取答案');	
	}).focusout(function(){
		var mobile = $.trim($('#js_mobile').val());		
		if(mobile == ''){
			console.log('手机不能为空')
		}else if(common.is_mobile(mobile)){
			checkMobile(mobile);
		}else{
			console.log('手机格式错误');
		};
	});

	function checkMobile(mobile){
		$.ajax({
			url:$('#js_checkmobile').val(),
			data:{'mobile':mobile},
			type:'post',
			success:function(json){
				if(json.status){
					console.log(json.message);
					$('#js_hide').removeClass('hide');
					$('#js_mobile').data('status',true);


				}else{
					console.log(json.message);
				}
			}
		});
	}




	//失去焦点就检查 Vcode 验证码 是否正确
	$('#js_vcode').focusin(function(){
		$('.js_vcode').removeClass('frm-err frm-ok').addClass('frm-focus')
			.find('.frm-tips i').attr('class','i-doubt-s')
			.next('em').text('请输入验证码');	
	}).focusout(function(){
		var vcode = $.trim($('#js_vcode').val());
		if(vcode.length == 4){
			checkVcode(vcode);
		}else{
			$('.js_vcode').removeClass('frm-err frm-ok').addClass('frm-focus')
				.find('.frm-tips i').attr('class','i-doubt-s')
				.next('em').text('请输入验证码');
		};
	});

	function checkVcode(vcode){
		$.ajax({
			url:$('#js_checkvcode').val(),
			data:{'vcode':vcode},
			type:'post',
			success:function(json){
				if(json.status){

					$('#js_vcode').data('status',true);
					$('.js_vcode').removeClass('frm-focus frm-err').addClass('frm-ok')
						.find('.frm-tips i').attr('class','i-success-s')
						.next('em').text('');
				}else{

					$('.js_vcode').removeClass('frm-focus').addClass('frm-err')
						.find('.frm-tips i').attr('class','i-error-s')
						.next('em').html('验证码错误，<a class="js_refresh" href="javascript:;">点击刷新</a>');
				}
			}
		});
	}










	//表单提交前检查一遍，格式正确再提交 /passport/registerHandler
	$('#js_form').submit(function(){
		var email = $('#js_email').data('status');
		var nickname = $('#js_nickname').data('status');
		//var mobile = $('#js_mobile').data('status');
		var password = $('#js_password').data('status');
		var vcode = $('#js_vcode').data('status');

		if(email && nickname && password && vcode){
			$('#js_form').submit();
		}else{
			return false;
		}
	});













	
});