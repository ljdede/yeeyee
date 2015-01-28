<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>易易网 分类信息平台</title>

<!-- <link rel="shortcut icon" href="/Public/Common/img/frame/yeeLogo.png" /> -->

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="/Public/Common/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/Common/css/bootstrap-theme.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/Common/css/common.css" />
<link rel="stylesheet" type="text/css" href="/Public/Common/css/dropzone.css" />
<link rel="stylesheet" type="text/css" href="/Public/Setup/css/setup.css" />

<script type="text/javascript" src="/Public/Common/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/common.js"></script>
<script type="text/javascript" src="/Public/Common/js/dropzone.js"></script>
<script type="text/javascript" src="/Public/Setup/js/setup.js"></script>
</head>

<body>

<!-- 页首InfoPlatform_header -->
<div id="InfoPlatform_header">
	<div id="logoBox">
		<a href="/"><img src="/Public/Common/img/frame/yeeLogo.png" alt="" />易易网</a>
	</div>
	<div id="searchBox">
		<form role="form">
			<input type="text" class="form-control" id="searchMe" placeholder="输入搜索项">
			<button type="submit" class="btn btn-default">搜索</button>
		</form>
	</div>
	<div id="userBox">
		<div id="signup">
			<a href="/Home/Signup">
				注册 <span class="glyphicon glyphicon-cloud-upload"></span>
			</a>
		</div>
		<div id="login">
			<a href="javascript:void(0)" data-toggle="modal" data-target="#userBox_loginBox">
				登录 <span class="glyphicon glyphicon-user"></span>
			</a>
		</div>
		<div id="username">
			<a href="javascript:void(0)" data-toggle="modal" data-target="#userBox_manageBox">
				<b>ljd2ede</b> <span class="glyphicon glyphicon-user"></span>
			</a>
		</div>
		<div id="userimg">
			<img src="/Public/Common/img/users/sdasds2x.jpg" alt="" />
		</div>
	</div>
</div>

<!-- 特殊，把modal提出来 -->
<!-- Modal -->
<div class="modal fade" id="userBox_loginBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form action="/Home/Login" method="post" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">用户登录</h4>
				</div>
				<div class="modal-body">
					<!--  -->
					
						<div class="input-group">
							<span class="input-group-addon">email地址</span>
							<input type="text" name="email" class="form-control" placeholder="Email">
						</div>
						<div class="input-group">
							<span class="input-group-addon">个人密码</span>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div class="input-group">
							<span class="input-group-addon"><a href="/Home/Login/findPassword/">忘记密码？</a></span>
						</div>
						<div class="alert alert-success" style="display:none;">
							<strong>恭喜!</strong> 成功登录。
						</div>
						<div class="alert alert-warning" style="display:none;">
							<strong>错误!</strong> 用户名或密码，请核实。
						</div>
					<!--  -->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" >提交</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="userBox_manageBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form action="/Home/Login/logout" method="get" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">用户设置</h4>
				</div>
				<div class="modal-body">
					<!--  -->
					<a href="/Home/setup">进入用户设置</a>
					<div class="alert alert-success" style="display:none;">
						 成功退出。
					</div>
					<div class="alert alert-warning" style="display:none;">
						 注销失败，请再试。
					</div>
					<!--  -->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger" >注销</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ...特殊，把modal提出来 -->



<!-- 左半InfoPlatform_mainLeft -->
<div id="InfoPlatform_mainLeft">
	<div id="welcomePanel">
		<div class="userBox">
			<div class="userImg">
				<img src="<?php echo ($user["avatar"]); ?>" alt="" />
			</div>
			<div class="userName"><?php echo ($user["username"]); ?></div>
			<div class="userMessage">
				<span class="label label-success">
					<span class="glyphicon glyphicon-comment"></span> 认证用户
				</span>
			</div>
		</div>
		<div class="detailBox">
			<ul>
				<li><span class="title">注册邮箱 <span class="glyphicon glyphicon-envelope"></span></span><span>ljdede@126.com</span></li>
				<li><span class="title">登录次数 <span class="glyphicon glyphicon-info-sign"></span></span><span><?php echo ($user["times_login"]); ?></span></li>
				<li><span class="title">注册时间 <span class="glyphicon glyphicon-time"></span></span><span><?php echo (date('Y-m-d H:i', $user["time_signup"])); ?></span></li>
			</ul>
		</div>
	</div>
</div>

<!-- 右半InfoPlatform_mainRight -->
<div id="InfoPlatform_mainRight">
	<div class="settingTabs">
		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#setting_user" data-toggle="tab">用户设置</a></li>
			<li><a href="#setting_password" data-toggle="tab">密码设置</a></li>
			<li><a href="#setting_avatar" data-toggle="tab">头像设置</a></li>
			<li><a href="#setting_contact" data-toggle="tab">联系设置</a></li>
			<li><a href="#setting_profile" data-toggle="tab">个人资料</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade in active" id="setting_user">
				<form action="/Home/Setup/setting_user" method="post">
					<div class="input-group">
						<span class="input-group-addon">用户昵称</span>
						<input type="text" name="username" class="form-control" placeholder="<?php echo ($user["username"]); ?>">
					</div>
					<div class="controller">
						<button type="submit" class="btn btn-primary btn-lg">修改</button>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="setting_password">
				<form action="/Home/Setup/setting_password" method="post">
					<div class="input-group">
						<span class="input-group-addon">验证原密码</span>
						<input type="password" name="password_old" class="form-control" placeholder="Old password">
					</div>
					<div class="input-group">
						<span class="input-group-addon">输入新密码</span>
						<input type="password" name="password_new" class="form-control" placeholder="New password">
					</div>
					<div class="input-group">
						<span class="input-group-addon">重复新密码</span>
						<input type="password" name="password_new_2" class="form-control" placeholder="New password again">
					</div>
					<div class="controller">
						<button type="submit" class="btn btn-primary btn-lg">修改</button>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="setting_avatar">
				<form action="/Home/Setup/upload" class="dropzone" id="myAwesomeDropzone"  enctype="multipart/form-data" method="post">
				</form>
			</div>
			<div class="tab-pane fade" id="setting_contact">
				<form action="/Home/Setup/setting_contact" method="post">
					<div class="input-group">
						<span class="input-group-addon">手机号码</span>
						<input type="text" name="mobileNumber" class="form-control" placeholder="<?php echo ($user["mobileNumber"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">手机短号</span>
						<input type="text" name="mobileNumber_short" class="form-control" placeholder="<?php echo ($user["mobileNumber_short"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">QQ号码</span>
						<input type="text" name="qq" class="form-control" placeholder="<?php echo ($user["qq"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">微信号码</span>
						<input type="text" name="weixin" class="form-control" placeholder="<?php echo ($user["weixin"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">微博网址</span>
						<input type="text" name="weibo" class="form-control" placeholder="<?php echo ($user["weibo"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">备注</span>
						<input type="text" name="notes" class="form-control" placeholder="<?php echo ($user["notes"]); ?>">
					</div>
					<div class="controller">
						<button type="submit" class="btn btn-primary btn-lg">修改</button>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="setting_profile">
				<form action="/Home/Setup/setting_profile" method="post">
					<div class="input-group">
						<span class="input-group-addon">姓名</span>
						<input type="text" name="realname" class="form-control" placeholder="<?php echo ($user["realname"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">学号</span>
						<input type="text" name="studentNumber" class="form-control" placeholder="<?php echo ($user["studentNumber"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">学院</span>
						<input type="text" name="college" class="form-control" placeholder="<?php echo ($user["college"]); ?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">专业</span>
						<input type="text" name="major" class="form-control" placeholder="<?php echo ($user["major"]); ?>">
					</div>
					<div class="controller">
						<button type="submit" class="btn btn-primary btn-lg">修改</button>
					</div>
				</form>
			</div>
		</div>

		<div class="alert alert-success">修改成功！</div>
		<div class="alert alert-danger">...</div>
	</div>
</div>

<!-- 页尾InfoPlatform_footer -->
<div id="InfoPlatform_footer">
	<div id="aboutBox">
		<ul>
			<<li><a href="/Home/About/aboutus">关于我们</a></li>
			<li><a href="/Home/About/tos">网站守约</a></li>
		</ul>
	</div>
	<div id="copyrightBox">©yeeyee.net 易易网 版权所有 Version <?php echo C('VERSION');?></div>
</div>

</body>

</html>