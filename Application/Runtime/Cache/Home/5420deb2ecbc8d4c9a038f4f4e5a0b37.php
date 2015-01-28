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
<link rel="stylesheet" type="text/css" href="/Public/Signup/css/signup.css" />

<script type="text/javascript" src="/Public/Common/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/common.js"></script>
<script type="text/javascript" src="/Public/Signup/js/signup.js"></script>
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
		<div class="title">现在注册</div>
		<div class="text">马上加入我们吧！</div>
	</div>
</div>


<!-- 右半InfoPlatform_mainRight -->
<div id="InfoPlatform_mainRight">
	<div class="step step_1" >
		<form action="/Home/Signup/sign_email" method="get">
			<div class="title">填写你的email地址建立账户！</div>
			<div class="text">填写你的email即可一步完成注册。这个email地址将作为你本站账号！</div>
			<div class="input">
				<input type="text" name="email" class="form-control" id="step_1_input" placeholder="输入你的email地址">
			</div>
			<div class="tips">注意！参加注册表示你接受本站服务条款。</div>
			<div class="alert alert-warning" style="display:none;">
				 请输入用户名。
			</div>
			<div class="alert alert-danger" style="display:none;">
				 该email已被占用，可直接登录，或者 <a href="javascript:void(0)">找回密码</a> 。
			</div>
			<div class="controller">
				<button type="submit" class="btn btn-primary btn-lg">立即注册</button>
			</div>
		</form>
	</div>
	<div class="step step_2" style="display:none;">
		<form action="/Home/Signup/sign_password" method="post">
			<div class="title">恭喜你，注册成功！</div>
			<div class="text">
				以下是本站系统默认生成的密码：<b>909789</b>
				<br />
				我们建议你重新修改为你自己的密码，密码不少于6位，不多于20位哦！
			</div>
			<div class="input">
				<input type="password" name="password" class="form-control" id="step_2_input" placeholder="输入你的新密码">
			</div>
			<div class="tips">注意！参加注册表示你接受本站服务条款。</div>
			<div class="alert alert-warning" style="display:none;">
				 请输入密码。
			</div>
			<div class="alert alert-danger" style="display:none;">
				 密码少于6位或多于20位。
			</div>
			<div class="controller">
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-lg">暂不修改</button>
					<button type="submit" class="btn btn-primary btn-lg">立即更改</button>
				</div>
			</div>
		</form>
	</div>
	<div class="step step_3" style="display:none;">
	<!-- style="display:none;" -->
		<form action="">
			<div class="title">马上开始你的交易吧！</div>
			<div class="text">
				1. 我们会发送一封包含你的账号和密码的激活信到你的email邮箱，注意查收。
				<br />
				2. 现在你可以在本站和对方获得联系了！
				<br />
				3. <span class="glyphicon glyphicon-warning-sign"></span> 注意，只有<b> 已激活 </b>用户才能发布信息！
			</div>
			<!-- <div class="input">
				<input type="password" class="form-control" id="step_2_input" placeholder="输入你的新密码">
			</div> -->
			<div class="tips"><a href="javascript:void(0)" class="gotoEmail" target="_blank">点此去你的邮箱 激活易易账户！</a></div>
			<div class="controller">
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-lg" id="toDetail">填写详细资料</button>
					<button type="button" class="btn btn-primary btn-lg" id="toIndex">立即开始浏览</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- 页尾InfoPlatform_footer -->
<div id="InfoPlatform_footer">
	<div id="aboutBox">
		<ul>
			<li><a href="/Home/About/aboutus">关于我们</a></li>
			<li><a href="/Home/About/tos">网站守约</a></li>
		</ul>
	</div>
	<div id="copyrightBox">©yeeyee.net 易易网 版权所有 Version <?php echo C('VERSION');?></div>
</div>

</body>

</html>