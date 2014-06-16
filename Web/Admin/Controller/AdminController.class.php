<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {

	//管理后台的所有Controller控制器都继承自本类
	public function _initialize(){
		// $auth = new \Think\Auth();//加载Auth权限认证类库
		// if(!$auth->check(MODULE_NAME.'-'.ACTION_NAME, session('uid'))){
		// 	//$this->error('No Access，你没有权限');
		// }

        // /* 读取站点配置 */
        // $config = api('Config/lists');
        // C($config); //添加配置

		header('Content-Type:text/html; Charset=UTF-8');


        if(!C('WEB_SITE_CLOSE')){
            //$this->error('站点已经关闭，请稍后访问~');
        }



		if(!isset($_SESSION['uid'])){
			$this->uid = 0; 
			$this->redirect( U('/Admin/Account/index','','') );
		}else{
			$this->uid = $_SESSION['uid'];
			$this->nickname = $_SESSION['nickname'];
		}
		
	}

    public function index(){

    	echo 'AdminController';
		$this->display();
    }
}