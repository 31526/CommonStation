<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    
    

	/* 空操作，用于输出404页面 */
	// public function _empty(){
	// 	$this->redirect(U('/'));
	// }

	// public function _initialize(){
	// 	$auth = new \Think\Auth();//加载Auth权限认证类库
	// 	if(!$auth->check(MODULE_NAME.'-'.ACTION_NAME, session('uid'))){
	// 		//$this->error('No Access，你没有权限');
	// 	}
 //        /* 读取站点配置 */
 //        $config = api('Config/lists');
 //        C($config); //添加配置
 //        if(!C('WEB_SITE_CLOSE')){
 //            $this->error('站点已经关闭，请稍后访问~');
 //        }
	// 	header('Content-Type:text/html; Charset=UTF-8');
	// 	if(!isset($_SESSION['uid'])){
	// 		$this->uid = 0;
	// 		//redirect(U('/login'));
	// 	}else{
	// 		$this->uid = $_SESSION['uid'];
	// 		$this->nickname = $_SESSION['nickname'];
	// 	}
	// }




	//输出验证码
    public function verify(){
        $verify = new \Think\Verify();
        $verify->fontSize = 30;//验证码字体大小
        $verify->length   = 4;//验证码位数
        $verify->fontttf = '5.ttf';//指定验证码字体
        $verify->useNoise = true;//是否使用验证码杂点
        $verify->useImgBg = false;//是否使用验证码背景
        $verify->useCurve = false;//是否使用混淆曲线 默认为true
        $verify->expire = 300;//验证码的有效期（秒）

        $verify->entry();
    }


	//验证验证码是否正确
    public function checkVerify(){
    	if(!IS_AJAX){
    		$this->error();
    	}

    	$vcode = I('post.vcode');

    	if(check_verify($vcode)){
    		$json = array(
    				'status'=>1,
    				'message'=>'success',
    			);
    		$this->ajaxReturn($json);
    	}else{
    		$json = array(
    				'status'=>0,
    				'message'=>'error',
    			);
    		$this->ajaxReturn($json);
    	};

    }







	/* 用户登录检测 */
	protected function login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('/login'));
	}





    //上传用户头像的接口函数处理脚本
    public function uploadAvatarHandler(){
        if(!IS_POST){
            $this->error('error');
        }
        $this->_uploadAvatar();
    }


    //上传用户头像的私有方法
    private function _uploadAvatar(){

        //获取sessionID组建文件名
        $uid = session('uid');
        $uid = abs(intval($uid)); //UID取整数绝对值
        $uid = sprintf("%09d", $uid); //前边加0补齐8位，例如UID为31的用户变成 00,00,00/31
        $dir1 = substr($uid, 0, 3);  //取左边2位，即 00
        $dir2 = substr($uid, 3, 2);  //取4-5位，即00
        $dir3 = substr($uid, 5, 2);  //取6-7位，即00
        //$path = 'http://imgs.zzbm.com/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).'_avatar_'.$size.'.jpg';   

        $filePath = $dir1.'/'.$dir2.'/'.$dir3.'/';
        $fileName = substr($uid, -2);   //根据uid生成保存的头像文件名


        // p($filePath);
        // p($fileName);

        $upload = new \Think\Upload();//引入ThinkPHP文件上传类

        $upload->maxSize = C('UPLOAD_AVATAR_MAX_SIZE');//文件上传的最大文件大小
        $upload->savePath= C('UPLOAD_AVATAR_PATH') . $filePath; // C('UPLOAD_AVATAR_PATH') . $filePath;//文件保存路径'./uploads/'+ 'avatar/' + filePath;
        $upload->saveName = $fileName;//保存的文件名
        $upload->replace = true;//覆盖同名文件
        $upload->rootPath = './'; //重置上传的根目录
        $upload->saveExt = 'jpg'; //上传文件的保存后缀，不设置的话使用原文件后缀
        $upload->autoSub = false; //自动使用子目录保存上传文件 默认为true
        $upload->exts = C('UPLOAD_AVATAR_EXTS');//允许上传的文件后缀
        $upload->mimes = '';//允许上传文件的类型,使用数组或者逗号分隔的字符串设置，默认为空

        $info = $upload->upload();
        if($info){

            $filedata = $info['Filedata'];
            $name = $filedata['savename'];
            $url = $filedata['savepath'].$filedata['savename'];
            //用户上传头像成功后，设置数据库 avatar_status = 1
            M('member')->where(array('uid'=>session('uid')))->save(array('avatar_status'=>1));

            $l = $upload->savePath.$fileName.'_l.jpg';
            $m = $upload->savePath.$fileName.'_m.jpg';
            $s = $upload->savePath.$fileName.'_s.jpg';

            //用户上传图片完成后，对图片进行系统裁切，
            $image = new \Think\Image(); 
            $image->open($url);
            $image->thumb(280, 280, \Think\Image::IMAGE_THUMB_CENTER)->save($l);
            $image->thumb(120, 120, \Think\Image::IMAGE_THUMB_CENTER)->save($m);
            $image->thumb(60,  60,  \Think\Image::IMAGE_THUMB_CENTER)->save($s);

            unlink($url);//生成缩略图后删除原文件


            $json = array(
                'status'=>1, 
                'message'=>'success', 
                'data'=> $filedata,
                'img'=>array(
                    'l' => $l,
                    'm' => $m,
                    's' => $s,
                )
            );

           
            echo json_encode($json);
        }else{
            echo json_encode(array('status'=>0, 'message'=> $upload->getError()));
        };

    }


}