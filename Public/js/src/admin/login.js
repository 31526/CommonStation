define(['jquery'],function($){

	var index = {


		init:function(){


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




		}



	}

	index.init();
});