<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>[★]</title>
    <link rel="stylesheet" type="text/css" href="public/css/admin.css">
</head>
<body style="margin: 0px;" scroll="no">
<div id="notice" class="notice hide"> <a href="javascript:;">  notice  </a> </div>
<table id="layout" cellpadding="0" cellspacing="0" height="100%" width="100%" style=" width:100%;">
		<tbody>
		<tr>
			<td colspan="2" height="90">
				<!-- ▼ ： 顶部 mainHD-->
				<div class="mainhd">
					<a href="<?php echo U('/admin/');?>" class="logo"></a>
					<div class="uinfo hide" id="frameuinfo" >
						<p>您好,  <em>admin</em> [<a href="admin.php?action=logout" target="_top">退出</a>]</p>
						<p class="btnlink"><a href="index.php" target="_blank">站点首页</a></p>
					</div>

					<div class="menu">
						<!-- ▼ ： 顶部主菜单 topmenu-->
						
<ul id="topmenu">
	<li class="menuon"><em><a id="menu_index" hidefocus="true" href="javascript:;" >首页</a></em></li>
	<li><em><a id="menu_global" hidefocus="true" href="javascript:;" >全局</a></em></li>
	<li><em><a id="menu_style" hidefocus="true" href="javascript:;" >界面</a></em></li>
	<li><em><a id="menu_topic" hidefocus="true" href="javascript:;" >内容</a></em></li>
	<li><em><a id="menu_user" hidefocus="true" href="javascript:;" >用户</a></em></li>
	<li><em><a id="menu_portal" hidefocus="true" href="javascript:;" >门户</a></em></li>
	<li><em><a id="menu_forum" hidefocus="true" href="javascript:;" >论坛</a></em></li>
	<li><em><a id="menu_group" hidefocus="true" href="javascript:;" >群组</a></em></li>
	<li><em><a id="menu_safe" hidefocus="true" href="javascript:;" >防灌水</a></em></li>
	<li><em><a id="menu_extended" hidefocus="true" href="javascript:;" >运营</a></em></li>
	<li><em><a id="menu_plugin" hidefocus="true" href="javascript:;">应用</a></em></li>
	<li><em><a id="menu_tools" hidefocus="true" href="javascript:;">工具</a></em></li>
	<li><em><a id="menu_founder" hidefocus="true" href="javascript:;">站长</a></em></li>
	<li><em><a id="menu_uc" hidefocus="true" href="javascript:;">UCenter</a></em></li>
</ul>
						<!-- ▲ ： 顶部主菜单 topmenu-->


						<div class="currentloca">
							<p id="admincpnav">界面&nbsp;»&nbsp;表情管理&nbsp;&nbsp;
								<a target="main" title="添加到常用操作" href="<?php echo U('/admin/setting/add/');?>url=action%253Dsmilies">[+]</a></p>
						</div>
						<div class="navbd"></div>
						<div class="sitemapbtn">
							<div style="float: left; margin:-7px 10px 0 0"><form name="search" method="post" autocomplete="off" action="admin.php?action=search" target="main"><input type="text" name="keywords" value="" class="txt" x-webkit-speech="" speech=""> <input type="hidden" name="searchsubmit" value="yes" class="btn"><input type="submit" name="searchsubmit" value="搜索" class="btn" style="margin-top: 5px;vertical-align:middle"></form></div>
							<span id="add2custom" style="display: none"></span>
							<a href="javascript:;" id="cpmap" onclick="showMap();return false;"><img src="" title="管理中心导航(ESC键)" width="46" height="18"></a>
						</div>

					</div>


				</div>			
				<!-- ▲ ： 顶部 mainHD-->
			</th>
		</tr>

		<tr>
			<td valign="top" width="160" class="menutd">
				<!-- ▼ ： 左侧 菜单 leftmenu-->
				<div id="leftmenu" class="nav">
	<!--▼::首页::index-->
	<ul id="nav_index" class="">
		<li>
			<a href="<?php echo U('/admin/index/main');?>" hidefocus="true" target="main" class="tabon">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				管理中心首页
			</a>
		</li>
		<li>
			<a href="<?php echo U('/admin/index/main');?>" hidefocus="true" target="main">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				会员
			</a>
		</li>
		<li>
			<a href="<?php echo U('/admin/member/lookup');?>" hidefocus="true" target="main">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				禁止用户
			</a>
		</li>
	</ul>
	<!--▲::首页::index-->

	<!--▼::群组::group-->
	<ul id="nav_group" class="hide">
		<li>
			<a href="<?php echo U('/admin/group/index');?>" hidefocus="true" target="main" class="tabon">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				群组信息
			</a>
		</li>
		<li>
			<a href="<?php echo U('/admin/member/setting');?>" hidefocus="true" target="main">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				会员全局
			</a>
		</li>
		<li>
			<a href="<?php echo U('/admin/member/lookup');?>" hidefocus="true" target="main">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				全局用户
			</a>
		</li>
	</ul>
	<!--▲::群组::group-->

	<!--▼::全局::global-->
	<ul id="nav_global" class="hide">
		<li>
			<a href="<?php echo U('/admin/global/index');?>" hidefocus="true" target="main" class="tabon">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				全局信息
			</a>
		</li>
		<li>
			<a href="<?php echo U('/admin/global/setting');?>" hidefocus="true" target="main">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				全局全局
			</a>
		</li>
		<li>
			<a href="<?php echo U('/admin/global/lookup');?>" hidefocus="true" target="main">
				<em onclick="menuNewwin(this)" title="新窗口打开"></em>
				全局用户
			</a>
		</li>
	</ul>
	<!--▲::全局::global-->
	
</div>
				<!-- ▲ ： 左侧 菜单 leftmenu-->
			</td>
			<td valign="top" width="100%" class="masktd">

				<!-- ▼ ： 右侧 main iframe-->
				<iframe src="<?php echo U('/admin/index/main');?>" id="main" name="main" width="100%" height="100%" frameborder="0" scrolling="yes" style="overflow: visible; ">
				</iframe>
				<!-- ▲ ： 右侧 main iframe-->
			</td>
		</tr>
	</tbody>
</table>


<script type="text/javascript" src="public/js/require.js" data-main="public/js/main"></script>
<script type="text/javascript">
requirejs(['src/admin/index']);
</script>

</body>
</html>