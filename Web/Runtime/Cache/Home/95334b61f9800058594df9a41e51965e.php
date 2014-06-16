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

        <!--▼::Account::reg-->
        <div class="reg">
            <form action="<?php echo U('/account/register');?>" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="5"> register </th>                                                
                    </tr>                    
                </thead>
                <tbody>
                    <tr>
                        <td><span  class="reg-lspan">email</span></td>
                        <td><span  class="reg-cspan"><input class="reg-cinput" type="text" id="js_email" name="email" /></span></td>
                        <td><span  class="reg-rspan"></span></td>
                    </tr>
                    <tr>
                        <td><span  class="reg-lspan">nickname</span></td>
                        <td><span  class="reg-cspan"><input class="reg-cinput" type="text" id="js_nickname" name="nickname" /></span></td>
                        <td><span  class="reg-rspan"></span></td>
                    </tr>
                    <tr>
                        <td><span  class="reg-lspan">password</span></td>
                        <td><span  class="reg-cspan"><input class="reg-cinput" type="password" id="js_password" name="password" /></span></td>
                        <td><span  class="reg-rspan"></span></td>
                    </tr>
                    <tr>
                        <td><span  class="reg-lspan">verify</span></td>
                        <td>
                            <span  class="reg-cspan">
                                <input class="reg-cinput-verify" type="text" id="js_verify" name="verify" />
                                <img src="<?php echo U('/Common/Verify');?>" id="verifyimg" title="点击刷新" class="reg-cimg-verify" />
                            </span>
                        </td>
                        <td><span  class="reg-rspan"></span></td>
                    </tr>
                    <tr>
                        <td><span  class="reg-lspan"></span></td>
                        <td>
                            <span  class="reg-cspan reg-cspan-submit">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </span>
                        </td>
                        <td><span  class="reg-rspan"></span></td>
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
        <!--▲::Account::reg-->
        
        
    </div>
    
    

</div>


<table>
<tr><td>年</td><td>制造商</td><td>型号</td><td>说明</td><td>价值</td></tr>
<tr><td>1997</td><td>Ford</td><td>E350</td><td>"ac</td><td> abs</td><td> moon"</td><td>3000.00</td></tr>
<tr><td>1999</td><td>Chevy</td><td>"Venture ""Extended Edition"""</td><td>""</td><td>4900.00</td></tr>
<tr><td>1999</td><td>Chevy</td><td>"Venture ""Extended Edition</td><td> Very Large"""</td><td>""</td><td>5000.00</td></tr>
<tr><td>1996</td><td>Jeep</td><td>Grand Cherokee</td><td>"MUST SELL!</td></tr>
<tr><td>air</td><td> moon roof</td><td> loaded"</td><td>4799.00</td></tr>
</table>








<div class="footer">
    <div class="common">
        
        footer
        
    </div>    
</div>
<script type="text/javascript" src="public/js/require.js" data-main="public/js/main"></script>

    
<script type="text/javascript">
require(['src/home/account/reg']);
</script>



<div style="display:none;">
    <script srcxxx="http://s4.cnzz.com/stat.php?id=5912709&web_id=5912709" language="JavaScript"></script>
</div>

    </body>    
</html>