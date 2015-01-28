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
<link rel="stylesheet" type="text/css" href="/Public/About/css/about.css" />

<script type="text/javascript" src="/Public/Common/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/common.js"></script>
<script type="text/javascript" src="/Public/About/js/about.js"></script>
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
		<div class="title"><img src="/Public/Common/img/frame/yeeLogoB.png" alt="" /></div>
		<div class="text">易易网服务条款</div>
	</div>
</div>


<!-- 右半InfoPlatform_mainRight -->
<div id="InfoPlatform_mainRight">
	<div class="step" >
		<div class="title">易易网服务条款 Terms Of Service</div>
		<div class="text">
		1. 不要在使用服务的时候威胁，骚扰或伤害他人或侵犯其他人的隐私。<br />
		2. 易易网不是一个舆论平台，不要发布任何舆论信息。<br />
		3. 如果您对于用户界面或网站功能上有任何建议或idea，这里非常欢迎您的反馈。用户的建议经采纳并在实践后为易易网带来可观测的发展，易易网将会用礼品的形式报答用户。<br />
		4. 所有用户发表的内容，包括文字，照片不代表易易网的观点或立场。<br />
		5. 用户可以通过易易网账号在易易网上发布文字，照片。但任何非法，侮辱，诽谤，不适当，粗俗，色情，淫秽，政治，不雅，侵害他人隐私，偏见，针对种族，民族，宗教等言论，或其他不良内容和照片是不允许发表和上传的。您有责任对你所发布或所做的事情负责。<br />
		6. 不要以一些公司的名称，或者一些名人的的名称，或者毫无意义的名称故意抢注作为你的用户名。易易网有权利删除此类的账户进行清除，以确保它们的权利。<br />
		7. 您所登录的密码会在你注册的时候加密保存，您同样有责任记牢此密码。这里强烈建议您使用复杂的强密码来保证您的密码安全。<br />
		8. 用户同意遵守《中华人民共和国保守国家秘密法》、《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》等有关计算机及互联网规定的法律和法规、实施办法。在任何情况下，易易网合理地认为用户的行为可能违反上述法律、法规，易易网可以在任何时候，不经事先通知终止向该用户提供服务。<br />
		9. 用户应了解国际互联网的无国界性，应特别注意遵守当地所有有关的法律和法规。<br />
		10. 如果违反上述条款，我们有权利删除其内容或使用者账号。<br />
		11. 易易网承诺尽最大能力保护用户的隐私和数据安全。如遇到不可抵抗力，包括但不限于地震，黑客入侵等情况，用户因此受到的各种损失易易网不负任何责任。<br />
		12. 如有需要，服务条款将更新或修改。更新或修改时，易易网将新版放置于网站上，并通过电子邮件通知用户，如果用户继续使用易易网的服务，则视为用户同意新的条款。一般情况下，易易网不会增加用户的义务，不会削减用户的权利。<br />
		13. 解释，修改和更新服务条款的权利均属于易易网。<br />
		</div>
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