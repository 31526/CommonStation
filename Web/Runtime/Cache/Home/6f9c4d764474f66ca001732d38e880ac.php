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

    <div class="common">
    
        <table class="loginbox">
            <thead>
                <tr>
                    <th colspan="6">loginbox</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>name</td>
                    <td>
                        <input class="input-m" type="text">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>
                        <input class="input-m" type="password">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input class="input-s" type="text">
                        <img src="">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input class="input-s" type="button">
                        <img src="">
                    </td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">loginbox.footer</td>
                </tr>
            </tfoot>
        </table>
        
        
    </div>

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