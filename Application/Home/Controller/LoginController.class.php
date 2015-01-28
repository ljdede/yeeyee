<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	
	public function index(){
		
		if(!IS_POST) $this->error('页面不存在！');
		
		echo $this->login();
	}

	public function login(){
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		// 只返回指定域的操作
		$userinfo = $mongo_user->where(array('email' => I('email')))->field('email,password,username,avatar,activated,verified')->find();
		// 验证
		if (!$userinfo || $userinfo['password'] != I('password', '', 'md5')) {
			return 0;
			// $this->error('账户或密码错误！');
		}
		// 登录成功后，更新用户登录详情
		$data = array(
				'time_login'	=>	time(),
				'loginIp'	=>	get_client_ip(),
				// 自增加1
				'times_login'	=>	array('inc', 1),
			);
		$mongo_user->where(array('email' => I('email')))->save($data);

		// 开始配置session
		session('id', $userinfo['_id']);
		session('username', $userinfo['username']);
		session('email', $userinfo['email']);
		session('avatar', $userinfo['avatar']);
		session('activated', $userinfo['activated']);
		session('verified', $userinfo['verified']);

		// dump($_SESSION);
		// 最后的成功！！
		return 1;
	}
	public function logout(){
		session_unset();
		session_destroy();
		$this->getSession();
	}

	public function getSession(){
		echo json_encode($_SESSION);
	}
	// 用以检测是否登录
	public function getSession_uid() {
		echo session('id');
	}
	// 用以监测是否激活的用户
	public function check_activation() {
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');
		$activation = $mongo_user->where(array(
			'_id' => session('id'),
			))->field('activated')->find();
		return $activation['activated'];
	}

	// 忘记密码
	public function findPassword() {
		$this->display();
	}
	public function newPassword() {
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		$userinfo = $mongo_user->where(array(
			'email' => I('email'),
			))->field('email,_id')->find();
		// echo ($userinfo['email']);
		if ($userinfo == '') {
			echo -1;
		} else {
			// echo ($userinfo['email']);
			$raw_password = rand(100000, 999999);
			
			$this->sendEmail_to($userinfo['email'], $raw_password);

			$mongo_user->where(array(
			'email' => $userinfo['email'],
			))->save(array(
			'password' => md5($raw_password),
			));

			echo 0;
		}
	}


	public function sendEmail_to($useremail, $raw_password) {
		$sendEmail = A('Email');
		return $sendEmail->think_send_mail($useremail, "易易网管理者", "重置密码的通知", $this->creatEmailBody($useremail, $raw_password));
	}
	// 生成邮件表格形式
	public function creatEmailBody($useremail, $raw_password) {
		return '
			<!DOCTYPE html>'.
'<html lang="en">'.
'<head>'.
	'<meta charset="UTF-8">'.
	'<title></title>'.
	'<style type="text/css">'.
		'*{font-family:"微软雅黑";}'.
		'.mainTable {width: 530px;}'.
		'.mainTable td {border: solid 1px #000000;padding: 5px;}'.
		'b {color: red;}'.
	'</style>'.
'</head>'.
'<body><table class="mainTable"><tr><td colspan="2">'.
				'你好，这是来自易易网的邮件。<br>'.
				'<br>'.
				'尊敬的用户：<br>'.
				'你好！<br>'.
				'你的邮箱<b>'.$useremail.'</b>刚刚在 易易网(www.yeeyee.net) 重置了密码。<br>'.
				'你的密码是<b>'.$raw_password.'</b>，'.
				'这是系统生成的默认密码，请尽快到易易网修改密码。<br>'.
				'<br>'.
				
				'如果你不确定自己是否在易易网重置过密码，请亲自重置密码并修改成自己的密码，或请与易易网管理者联系：<br>'.
				'admin@yeeyee.net<br>'.
				'<br>'.
				'祝你在易易网使用愉快！<br>'.
				date('Y-m-d H:i', time()).'<br>'.
			'</td></tr></table>'.
'</body></html>';
	}
	
}

