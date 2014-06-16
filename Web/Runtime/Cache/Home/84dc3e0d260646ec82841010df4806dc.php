<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo ($pageinfo["title"]); ?></title>
        <meta name="keywords" content="<?php echo ($pageinfo["keywords"]); ?>">
        <meta name="description" content="<?php echo ($pageinfo["description"]); ?>">
        
        <link rel="stylesheet" type="text/css" href="public/css/common.css">
        
        


    
    


    </head>
    <body>



    
<div class="topbar">
    <div class="common">
        <span class="z">Welcome
        
            <a href="<?php echo U('/login');?>">登录</a>
            <a href="<?php echo U('/reg');?>">注册</a>
        
        </span>
        <span class="y">登录 </span>
    </div>    
</div>


<div class="wraper">
    
    <div class="header"></div>

    <div class="banner"></div>
    
    <div class="common">
        
        注册
         
        <form action="<?php echo U('/account/register');?>" method="post">
            <table class="table form">
                <thead>
                    <tr>
                        <th colspan="5"> register </th>                                                
                    </tr>                    
                </thead>
                <tbody>
                    <tr>
                        <td><span  class="tar">email</span></td>
                        <td><input type="text" id="" name="" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span  class="tar">nickname</span></td>
                        <td><input type="text" id="" name="" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span  class="tar">password</span></td>
                        <td><input type="password" id="" name="" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span  class="tar">verify</span></td>
                        <td>
                            <img src="" id="" class="" />
                            <input type="text" id="" name="" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span  class="tar">submit</span></td>
                        <td><button id="" type="submit" >submit</button></td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">tfoot</td>
                    </tr>
                </tfoot>                
            </table>
                 

        </form>
        
        
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
    <script src="http://s4.cnzz.com/stat.php?id=5912709&web_id=5912709" language="JavaScript"></script>
</div>

    </body>    
</html>