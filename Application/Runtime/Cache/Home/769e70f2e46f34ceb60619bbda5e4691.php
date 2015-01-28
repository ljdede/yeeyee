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
<link rel="stylesheet" type="text/css" href="/Public/Index/css/index.css" />

<script type="text/javascript" src="/Public/Common/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Common/js/common.js"></script>
<script type="text/javascript" src="/Public/Common/js/dropzone.js"></script>
<script type="text/javascript" src="/Public/Common/js/textareaAutoSize.js"></script>
<script type="text/javascript" src="/Public/Index/js/index.js"></script>

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
				<b></b> <span class="glyphicon glyphicon-user"></span>
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
<div id="InfoPlatform_mainLeft" cid="dd">
	<div id="panel">
		<div class="title">分类目录</div>

		<input type="hidden" name="info_get_pid" value="-1" />
		<input type="hidden" name="info_get_cid" value="-1" />

		<div class="header">
			<ul>
				<li>
					<a href="javascript:void(0)" class="active" id="-1">全部显示</a>
				</li>
				<!-- <li>
					<a href="javascript:void(0)">物品交易</a>
				</li>
				<li>
					<a href="javascript:void(0)">校园资讯</a>
				</li> -->
			</ul>
		</div>
		<div class="body">
			<ul>
				<!-- <li>
					<a href="javascript:void(0)">图书杂志 （<span>9</span>）</a>
				</li>
				<li>
					<a href="javascript:void(0)">电子产品 （<span>19</span>）</a>
				</li>
				<li>
					<a href="javascript:void(0)">单车 （<span>91</span>）</a>
				</li>
				<li>
					<a href="javascript:void(0)">运动物品 （<span>119</span>）</a>
				</li>
				<li>
					<a href="javascript:void(0)">音乐CD （<span>59</span>）</a>
				</li> -->
			</ul>

		</div>
	</div>
	<div id="contactPanel" style="display:none;">
		<table>
			<tr><td class="userBox">
				<div class="userImg">
					<img src="" alt="" />
				</div>
				<div class="userName">发布者： <b></b></div>
				<div class="userMessage">
					<span class="label label-info">
						<span class="glyphicon glyphicon-comment"></span> 私信
					</span>
				</div>
			</td></tr>
			<tr><td style="vertical-align: top;">
				<div class="infoBox">
					<input type="hidden" name="_id" value="0" />
					<input type="hidden" name="email_orignal" value="0" />
					<input type="hidden" name="uid" value="0" />
					<ul>
						<li><span class="title">信息名称 <span class="glyphicon glyphicon-align-left"></span></span><span></span></li>
						<li><span class="title">发布时间 <span class="glyphicon glyphicon-time"></span></span><span></span></li>
						<li><span class="title">栏目分类 <span class="glyphicon glyphicon-folder-open"></span></span><span></span></li>
					</ul>
				</div>
				<div class="contentBox">
					<span class="title">信息描述 <span class="glyphicon glyphicon-list-alt"></span></span>
					<span class="text"></span>
					<span class="more">
						<a href="javascript:void()">... <span class="label label-default">跳转查看</span></a>
					</span>
				</div>
				<div class="tipsBox">
					<span class="title">发送你的联系信息 <span class="glyphicon glyphicon-envelope"></span></span>
					<span class="text">本平台通过email形式通知交易双方，email将附带你的联系信息，你可以通过下面的选项<b>勾选</b>或<b>修改</b>信息，让对方能和你联系。</span>
				</div>
				<div class="profileBox">

						<div class="input-group">
							<span class="input-group-addon input-group_title">email</span>
							<input type="text" name="email" class="form-control" placeholder="" disabled>
							<span class="input-group-addon">
								<input type="checkbox" checked="checked" disabled>
							</span>
						</div>
						<div class="input-group">
							<span class="input-group-addon input-group_title">手机号码</span>
							<input type="text" name="mobileNumber" class="form-control" placeholder="">
							<span class="input-group-addon">
								<input type="checkbox">
							</span>
						</div>
						<div class="input-group">
							<span class="input-group-addon alert-info">点击这里，提供更多联系信息</span>
						</div>
						<div class="input-group" style="display:none;">
							<span class="input-group-addon input-group_title">姓名</span>
							<input type="text" name="realname" class="form-control" placeholder="">
							<span class="input-group-addon">
								<input type="checkbox">
							</span>
						</div>
						<div class="input-group" style="display:none;">
							<span class="input-group-addon input-group_title">手机短号</span>
							<input type="text" name="mobileNumber_short" class="form-control" placeholder="">
							<span class="input-group-addon">
								<input type="checkbox">
							</span>
						</div>
						<div class="input-group" style="display:none;">
							<span class="input-group-addon input-group_title">qq号码</span>
							<input type="text" name="qq" class="form-control" placeholder="">
							<span class="input-group-addon">
								<input type="checkbox">
							</span>
						</div>
						<div class="input-group" style="display:none;">
							<span class="input-group-addon input-group_title">微信号码</span>
							<input type="text" name="weixin" class="form-control" placeholder="">
							<span class="input-group-addon">
								<input type="checkbox">
							</span>
						</div>
						<div class="input-group" style="display:none;">
							<span class="input-group-addon input-group_title">微博网址</span>
							<input type="text" name="weibo" class="form-control" placeholder="">
							<span class="input-group-addon">
								<input type="checkbox">
							</span>
						</div>
						<div class="input-group" style="display:none;">
							<span class="input-group-addon input-group_title">备注事项</span>
							<input type="text" name="notes" class="form-control" placeholder="">
							<span class="input-group-addon">
								<input type="checkbox" name="check">
							</span>
						</div>
				</div>
			</td></tr>
			<tr><td class="controllerBox">
				<div class="btn-group">
					<button type="submit" class="btn btn-success">发送联系信息</button>
					<button type="button" class="btn btn-default">关闭面板</button>
				</div>
			</td></tr>
		</table>
	</div>
</div>

<!-- 右半InfoPlatform_mainRight -->
<div id="InfoPlatform_mainRight">
	<div class="infoStream creator">
		<form action="/Home/Index/creator" method="post" >
			<div class="titleBox">
				<input type="text" name="title" class="form-control" id="titleBox_title" placeholder="输入信息名称">
				<input type="text" name="price" class="form-control" id="titleBox_price" style="display:none;" placeholder="输入价格，免费则留空">
			</div>
			<div class="textBox" style="display:none;">
				<textarea name="description" class="form-control" id="textBox_text" placeholder="输入正文说明"></textarea>
			</div>
			<div class="optionBox" style="display:none;">
				<div class="pictureBox">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#pictureBox_uploadBox"><span class="glyphicon glyphicon-picture"></span> 添加图片</a>
					
					<table style="display:none;">
						<tr>
							<td>
								<img src="/Public/Index/img/info/12222222222.jpg" alt="" />
								<input type="hidden" name="img" value="" />
							</td>
							<td>
								<!-- <form action="" method="post" > -->
									 <a href="javascript:void(0)"><span class="glyphicon glyphicon-remove"></span> </a> 
								<!-- </form> -->
							</td>
						</tr>
					</table>

				</div>
				<div class="detailBox">
					<div class="categoryBox">
						<div class="header">添加分类：</div>
						<div class="body">
							<div class="category_1">
								<div class="dropdown">
									<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
										<span class="glyphicon glyphicon-folder-open"></span>
										 选择栏目
									</a>
									<ul class="dropdown-menu">
										<!-- <li><a href="javascript:void(0)" id="">动作</a></li>
										<li><a href="javascript:void(2)">另一动作</a></li>
										<li><a href="javascript:void(3)">其他</a></li> -->
										
									</ul>
									<input type="hidden" name="pid" value="-1" />
								</div>
							</div>
							<div class="category_2">
								<div class="dropdown">
									<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
										<span class="glyphicon glyphicon-align-left"></span>
										 选择分类
									</a>
									<ul class="dropdown-menu">
										<!-- <li><a href="javascript:void(1)">动作</a></li>
										<li><a href="javascript:void(1)">另一动作</a></li>
										<li><a href="javascript:void(1)">其他</a></li> -->
										
									</ul>
									<input type="hidden" name="cid" value="-1" />
								</div>
							</div>
						</div>
						<input type="hidden" value="1" id="categoryBox_category_1" />
						<input type="hidden" value="2" id="categoryBox_category_2" />
					</div>
					<div class="linkBox">
						<div class="header">添加超链接：</div>
						<div class="body">
							<input type="url" name="url" class="form-control" id="linkBox_link" placeholder="输入原信息的网址">
						</div>
					</div>
				</div>
				<div class="controllerBox">
					<button type="submit" class="btn btn-success">发布</button>
					<button type="button" class="btn btn-default">收起</button>
				</div>
			</div>
		</form>
	</div>
	<!-- 避免form重叠提出来的Modal -->
	<div class="modal fade" id="pictureBox_uploadBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">上传图片</h4>
				</div>
				<div class="modal-body">
					<!--  -->
					<!-- <form action="/Public/Common/upload.php" class="dropzone" id="myAwesomeDropzone" > -->
					<form action="/Home/Index/upload" class="dropzone" id="myAwesomeDropzone"  enctype="multipart/form-data" method="post">
					</form>
					<!--  -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">完成</button>
					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div class="infoStream entry_mark btn btn-info">
		当前类别你有 <b>3</b> 条新的信息，点击加载...
	</div>
	<!-- 示例信息条目 -->
	<!-- <div class="infoStream entry">
		<table>
			<tr>
				<td colspan="2" class="entry_top"></td>
			</tr>
			<tr>
				<td class="entry_user">
					<img src="/Public/Common/img/users/sdasdsx.jpg" alt="" />
				</td>
				<td rowspan="2" class="entry_main">
					<div class="contentBox">
						<span class="username">LJDe.de</span>
						<span class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, cumque quo rem quidem doloremque. Culpa, neque, inventore, ratione, cum beatae facilis officia non adipisci atque quasi voluptas molestias minus quo facere vero a cupiditate veritatis itaque reprehenderit aperiam! Dignissimos, officiis, magnam officia debitis praesentium  accusantium suscipit tenetur eligendi voluptate saepe sapiente sequi tempora architecto necessitatibus fugit delectus nihil ipsa molestias placeat ullam? Debitis, laborum.</span>
						<span class="more">
							<a href="javascript:void()">... <span class="label label-default">阅读全文</span></a>
						</span>
					</div>
					<div class="pictureBox">
						<img src="/Public/Common/img/users/sdasdsx.jpg" alt="" />
						<input type="hidden" value="" />
					</div>
					<div class="infoBox">
						<ul>
							<li><span class="title">信息名称 <span class="glyphicon glyphicon-align-left"></span></span><span>天使湾聚变第2季</span></li>
							<li><span class="title">发布时间 <span class="glyphicon glyphicon-time"></span></span><span>2011-12-01 09:40:41</span></li>
							<li><span class="title">栏目分类 <span class="glyphicon glyphicon-folder-open"></span></span><span>物品信息-电子产品</span></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<td class="entry_contact">
					<button type="button" class="btn btn-info">联系TA</button>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="entry_bottom"></td>
			</tr>
		</table>
	</div> -->
	<!-- ...示例信息条目 -->
	<div class="infoStream entry" style="display:none;">
		<input type="hidden" name="time_created_raw" value="0" />
	</div>
</div>

<!-- 私信InfoPlatform_sms -->
<div id="InfoPlatform_sms">
	<div class="header">
		<input type="hidden" name="uid" value="0" />
		<input type="hidden" name="lastSmsTime" value="0" />
		<div class="title">
			与 <b>Heycat</b> 的私信
		</div>
		<div class="close">
			<span class="glyphicon glyphicon-remove"></span>
		</div>
	</div>
	<div class="content">
<!-- 	<div class="to">
			<div class="content_user_img">
				<img src="/Public/Common/img/users/default.jpg" alt="">
			</div>
			<div class="content_body">
				<div class="time">2014-11-29 10:43</div>
				<div class="text">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, tenetur.
				</div>
			</div>
		</div>

		<div class="from">
			<div class="content_user_img">
				<img src="/Public/Common/img/users/default.jpg" alt="">
			</div>
			<div class="content_body">
				<div class="time">2014-11-29 10:43</div>
				<div class="text">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, tenetur.
				</div>
			</div>
		</div> -->
	</div>
	<div class="input">
		<textarea class="form-control" rows="3"></textarea>
	</div>
	<div class="controller">
		<div class="tips_1">
			你还可以输入<b>140</b>个字
		</div>
		<div class="tips_2">
			你已超出<b>5</b>个字
		</div>
		<div class="submit">
			<button type="submit" class="btn btn-primary">发送</button>
		</div>
	</div>
</div>

<!-- 页尾上的私信项InfoPlatform_smsRemind -->
<div id="InfoPlatform_smsRemind">
	<ul>
		<!-- <li><input type="hidden" name="uid" value="0" /><span class="glyphicon glyphicon-envelope"></span> LJDede3</li> -->
	</ul>
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