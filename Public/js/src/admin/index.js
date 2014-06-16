define(['jquery'],function($){

	var index = {

		//管理后台导航控制相关
		nav:function(){

			$('#topmenu').on('click','li a',function(){
				var id = $(this).attr('id').substr(5);
				
				$('#topmenu li').removeClass('menuon');
				$(this).parents('li').addClass('menuon');

				$('#leftmenu ul').addClass('hide');
				$('ul#nav_'+id).removeClass('hide');
			});

			$('#leftmenu').on('click','li a',function(){
				$(this).parents('ul').find('li a').removeClass('tabon');
				$(this).addClass('tabon');
			});

		},
		    	


		init:function(){

			//顶部导航和左侧导航联动的导航控制器启动
			this.nav();


		}



	}

	index.init();
});