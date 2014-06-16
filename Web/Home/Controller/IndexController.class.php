<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        
        $pageinfo = array(
            "title"=>"index",
            "keywords"=>"key",
            "description"=>"desc",
        );
        $this->pageinfo = $pageinfo;
        
        
        $this->display();
    }
    
    
    
}