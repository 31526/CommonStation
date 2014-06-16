<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>[★System-Admin-Login★]</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/admin.css">
    <style type="text/css">
	body{font-family: Verdana, Arial,"微软雅黑";}

	.login{margin:10% auto; width: 400px; height: 200px; }


    .login input{ width:200px; line-height: 20px; padding:5px; border:solid 1px #ccc; font-size: 14px;}
    .login .spl{ display:inline-block; text-align: right; margin-right: 5px; line-height: 30px;  padding:5px 0px; font-size: 14px; width: 120px;}
    .login .spr{ display:inline-block; margin-left: 5px; line-height: 30px; padding:5px 0px;}
    .login .verify-ipt{ width:94px; height:20px;}
    .login .verify-img{ width:100px; height:30px; vertical-align: middle; margin-top: -4px;}
   

    .login a.button, 
    .login a.button:link, 
    .login a.button:active, 
    .login a.button:visited{ 
    	background-color: #4a2; 
    	display: inline-block;
    	cursor:pointer;
    	width: 100px;
    	height: 20px; 
    	line-height: 20px; 
    	margin-top: 0px;
    	color:#fff;
    	padding:5px 12px; 
    	border: solid 0px #ccc;}

   	.login a.button:hover{ background-color: #ff9922; }
 
    </style>
</head>
<body>

<div class="login">
	<form action="<?php echo U('/Admin/Account/login');?>" method="post">
		<table>
			<tr>
				<td><span class="spl">name</span></td>
				<td><span class="spr"><input id="name" type="text" name="name"/></span></td>
			</tr>
			<tr>
				<td><span class="spl">password</span></td>
				<td><span class="spr"><input id="password" type="password" name="password"/></span></td>
			</tr>
			<tr>
				<td><span class="spl">verify</span></td>
				<td>
					<span class="spr"><input id="verifycode" class="verify-ipt" type="text" name="verify"/>
					<img id="verifyimg" class="verify-img" src="<?php echo U('/Home/Common/verify');?>"/></span>
				</td>
			</tr>
			<tr>
				<td><span class="spl"></span></td>
				<td><span class="spr"><button id="submit" class="button">Submit Login</button></span></td>
			</tr>
		</table>

	</form>
</div>

<script type="text/javascript" src="/public/js/require.js" data-main="/public/js/main"></script>
<script type="text/javascript">
require(['src/admin/login']);
</script>

</body>
</html>