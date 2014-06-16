<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo ($pageinfo["title"]); ?></title>
        <meta name="keywords" content="<?php echo ($pageinfo["keywords"]); ?>">
        <meta name="description" content="<?php echo ($pageinfo["description"]); ?>">
        
        <link rel="stylesheet" type="text/css" href="public/css/common.css">
        
        


    


	<link rel="stylesheet" type="text/css" href="public/css/<?php echo CONTROLLER_NAME;?>.css">
</head>
<body>
	
<!--▼::Public::topbar-->
<div class="topbar">
    <div class="common">
        <span class="z">

        	<a href="<?php echo U('/');?>">Welcome</a>
        
            <a href="<?php echo U('/login');?>">登录</a>
            <a href="<?php echo U('/reg');?>">注册</a>
        
        </span>
        <span class="y"> 

        	<a href="<?php echo U('/Admin');?>">administration</a>

        </span>
    </div>    
</div>
<!--▲::Public::topbar-->






<div class="wraper">
    
    <div class="header"></div>

    <div class="banner"></div>
    
    <div class="module"></div>
    
    <div class="module"></div>
    
    <div class="module"></div>
    
    <div class="module"></div>

</div>










<div class="footer">
    <div class="common">
        
        footer
        
    </div>    
</div>
<script type="text/javascript" src="public/js/require.js" data-main="public/js/main"></script>

    
<script type="text/javascript">
require(['src/sidebar'],function(sidebar){
    sidebar.init();
});
    
</script>



<div style="display:none;">
    <script srcxxx="http://s4.cnzz.com/stat.php?id=5912709&web_id=5912709" language="JavaScript"></script>
</div>

    </body>    
</html>