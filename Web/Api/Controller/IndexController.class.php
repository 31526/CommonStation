<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function index(){
        
        
        $json = array(
                "id"=>9527,
                "name"=>"dodolook",
                "cid"=>"fessing",
                "info"=>array(
                        "id"=>"8520015",
                        "name"=>"服务器工作站",
                    ),
                "status"=>"0",              
            );
        $this->ajaxReturn($json);
        
        
    }
    
    
    
}