<?php
namespace Home\Controller;
use Think\Controller;
class AccountController extends Controller {
    
    
    public function index(){
        
        $this->display();        
    }
    
    
    
    
    //登录
    public function login(){
        
        
        
        $this->display();        
    }
    
    
    //注册
    public function reg(){
        
        
        $this->display();
    }


    public function register(){
        
        p( I('post.')  );

        p( $_POST );

        if(!IS_POST){
            $this->error();
        }



        $email = strtolower(trim(I('post.email')));
        $nickname = trim(I('post.nickname'));
        $mobile = trim(I('post.mobile'));
        $password = trim(I('post.password'));

        
        if(M('user')->where(array('nickname' => $nickname))->getField('uid')){
            $this->error('nickname registered');
        }elseif(M('user')->where(array('email' => $email))->getField('uid')){
            $this->error('email registered');
        }/*elseif(M('user')->where(array('mobile' => $mobile))->getField('uid')){
            $this->error('mobile registered');
        }*/else{




            $email_encrypt = system_encrypt($email, C('SYSTEM_KEY'), 3600*24); //24小时有效的加密

            //插入数据库

            $ip = get_client_ip();
            $location = new \Org\Net\IpLocation();
            $location = $location->getlocation($ip);//获取某个IP地址所在的位置
            $data['register_time'] = NOW_TIME;
            $data['register_ip'] = $ip;
            $data['register_address'] =  $location['country'].' '.$location['area'];

            $data['email'] = $email;
            $data['nickname'] = $nickname;
            $data['mobile'] = $mobile;
            $data['password'] = md5($password);         
            $data['email_encrypt'] = $email_encrypt;
            $uid = M('user')->add($data);

            //echo json_encode(array('uid'=>$uid, 'email'=>$email, 'nickname'=>$nickname));

            //P($data);

            if($uid){

                session('uid', $uid);
                session('nickname', $nickname);

                cookie('uid', system_encrypt($uid, C('SYSTEM_KEY'), 3600*24*7));
                cookie('nickname', system_encrypt($nickname, C('SYSTEM_KEY'), 3600*24*7));

                //注册成功后，生成一个随机码，存储到 validate表，,发送一个链接到用户邮箱，验证注册邮箱
                //注册验证码发送之前，先把 user.email_status 修改为4，标识激活邮件发出，激活码没有被点击过
                $uid_encrypt = system_encrypt($uid, C('SYSTEM_KEY'), 3600*24); //24小时有效的加密

                $url = 'http://sendcloud.sohu.com/webapi/mail.send.json';
                //不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
                $param = array(
                            'api_user' => 'postmaster@registermail.sendcloud.org',
                            'api_key' => 'teXC9fBp',
                            'from' => 'postmaster@zzbm.com',
                            'fromname' => '郑州便民网',
                            'to' => $email,
                            'subject' => ''.$nickname.'，欢迎注册郑州便民网, 请激活验证邮箱。',
                            'html' => '点击验证 <a href="http://www.zzbm.com/account/activation?uidencrypt='.$uid_encrypt.'&emailencrypt='.$email_encrypt.'"><div style="width:200px; height:50px; line-height:50px; border:Solid 1px #ccc; color:#fff; font-size:18px; background-color:#dedede;"> 点击验证 </div></a> 激活注册邮箱。',
                        );

                $options = array('http' => array('method'  => 'POST','content' => http_build_query($param)));
                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);

                $this->redirect('/');

            }else{
                $this->error();
            }
        }
    }
    
    //退出
    public function logout(){
        
        $this->display();
    }
    
    
    























    //ajax 验证 Nickname 是否已经存在
    public function checkNickname(){
        if(!IS_AJAX){
            $this->error();
        }

        $nickname = I('post.nickname');
        $where = array('nickname' => $nickname);
        if(M('user')->where($where)->getField('uid')){
            $json = array(
                    'status' => 0,
                    'message' => 'this nickname is registered',
                );
            $this->ajaxReturn($json);
        }else{
            $json = array(
                    'status' => 1,
                    'message' => 'you can register this nickname',
                );
            $this->ajaxReturn($json);
        }
    }

    //ajax 验证 Email 是否已经存在
    public function checkEmail(){
        if(!IS_AJAX){
            $this->error();
        }

        $email = I('post.email');
        $where = array('email' => $email);
        if(M('user')->where($where)->getField('uid')){
            $json = array(
                    'status' => 0,
                    'message' => 'this email is registered',
                );
            $this->ajaxReturn($json);
        }else{
            $json = array(
                    'status' => 1,
                    'message' => 'you can register this email',
                );
            $this->ajaxReturn($json);
        }

    }

    //ajax 验证 Mobile 是否已经存在
    public function checkMobile(){
        if(!IS_AJAX){
            $this->error();
        }

        $mobile = I('post.mobile');
        $where = array('mobile' => $mobile);
        if(M('user')->where($where)->getField('uid')){
            $json = array(
                    'status' => 0,
                    'message' => 'this mobile is registered',
                );
            $this->ajaxReturn($json);
        }else{
            $json = array(
                    'status' => 1,
                    'message' => 'you can register this mobile',
                );
            $this->ajaxReturn($json);
        }
        
    }


    //ajax 验证 用户当前密码是否正确 
    public function checkPassword(){
        if(!IS_AJAX){
            $this->error();
        }

        $password = I('post.password');
        $where = 'nickname="' . $_SESSION['nickname'] . '" and password="' . md5($password) .'"';
        $uid = M('user')->where($where)->getField('uid');

        if($uid){
            $json = array(
                    'status' => 1,
                    'message' => 'success',
                    'info' => M('user')->getLastSql(),
                );
            $this->ajaxReturn($json);
        }else{
            $json = array(
                    'status' => 0,
                    'message' => 'password is error',
                    'info' => M('user')->getLastSql(),
                );
            $this->ajaxReturn($json);
        }
    }




    
    
}