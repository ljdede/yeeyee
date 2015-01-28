<?php
namespace Home\Controller;
use Think\Controller;
class SignupController extends Controller {
    public function index(){
    	$this->display();

    }

    public function test(){
	// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');
	// mongodb 读取
		// dump($mongo_user->select());
		// $password = $mongo_user->where(array('email' => I('email')))->field('password')->select();
		
		// 子文档读取
			// $subname = $mongo_catagory->field('children.subname')->select();
			// $subname = $mongo_catagory->where(
			// 		array(
			// 			'children._id' => 1,
			// 		)
			// 	)->select();

	// mongodb 写入
		// $user['email'] = 'ljdede@126.com';
		// $user['name'] = 'ljdede';
		// $user['time'] = time();
		// $mongo_user->data($user)->add();
	// mongodb 删除
		// $mongo_user->where('name="ljdede"')->delete();
	// mongodb 更新
		// $data['name'] = 'heycat';
		// $mongo_user->where('name="ljdede"')->save($data);
	// mySQL
		// $mySQL_user = new \Home\Model\UserModel('User');
    	// var_dump($mySQL_user->select());

		$newuser['email']		=	'ljdede@126.com';
		$newuser['password']	=	md5('ljdede');
		$newuser['username']	=	'ljdede';
		$newuser['avatar']		=	'/Public/Common/img/users/default.jpg';
		$newuser['time_signup']	=	time();
		$newuser['activated']	=	1;
		$newuser['verified']	=	1;
		$newuser['times_login']=	13;
		$newuser['time_login']	=	time();
		$newuser['loginIp']		=	'172.1.1.1';

		$newuser['mobileNumber']=	'15999960721';
		$newuser['mobileNumber_short']	=	880721;
		$newuser['qq']			=	627222256;
		$newuser['weixin']		=	7627289;
		$newuser['weibo']		=	'weibo.com/ljdede';
		$newuser['realname']	=	'何小猫';
		$newuser['studentNumber']=	10333007;
		$newuser['major']		=	'信息与计算科学';
		$newuser['college']		=	'数学与计算科学学院';
		$newuser['notes']		=	'你好';

		$mongo_user->data($newuser)->add();
		// echo md5('ljdede');
	}

	public function sign_email(){
		if(I('email') == ''){
			echo -1;
		}else{
			// mongodb 连接
			$mongo_user = new \Home\Model\UserMongoModel('User');

			// dump($mongo_user->select());
			$email_exist = $mongo_user->where(array('email' => I('email')))->field('email')->find();
			if($email_exist == NULL){
				// 目标email不存在，可用
				$raw_password = rand(100000, 999999);
				$tempArray = explode('@', I('email'));
				$newuser['email']		=	I('email');
				$newuser['password']	=	md5($raw_password);
				$newuser['username']	=	$tempArray[0];
				$newuser['avatar']		=	'/Public/Common/img/users/default.jpg';
				$newuser['time_signup']	=	time();
				$newuser['hash'] 		=	md5(I('email'));
				$newuser['activated']	=	0;
				$newuser['verified']	=	0;
				$newuser['times_login']	=	0;

				if ( $mongo_user->data($newuser)->add() ) {

					$user_me = $mongo_user->where(array(
						'email' => I('email'),
						))->field('_id, email,username,avatar,activated,verified')->find();

					session('id', $user_me['_id']);
					session('username', $user_me['username']);
					session('email', $user_me['email']);
					session('avatar', $user_me['avatar']);
					session('activated', $user_me['activated']);
					session('verified', $user_me['verified']);

					echo $raw_password;

					$this->sendEmail_to(I('email'), $raw_password);
				} else {
					echo 0;
				}
			} else {
				// 不可用
				echo 0;
			}
		}
	}

	public function sign_password(){
		// echo I('password');
		preg_match('/^[A-Za-z0-9_]{6,20}$/', I('password'), $regResult);
		if(I('password') == ''){
			echo -1;
		}else if($regResult[0] == NULL){
			echo 0;
		}else{
			// mongodb 连接
			$mongo_user = new \Home\Model\UserMongoModel('User');
			$data['password'] = I('password', '', 'md5');
			
			if( $mongo_user->where(array(
					'email' => I('email')
				))->save($data) ){
				echo 1;
			}	
		}
	}

	public function activate() {
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		$data = array(
				'activated'	=>	1,
			);
		$map = array(
				'hash' => I('hash'),
				'activated' => 0,
			);
		if ($mongo_user->where($map)->find()) {
			$mongo_user->where($map)->save($data);
			$this->display();
		} else {
			echo "激活失败，请确认是否已激活，或请联系admin@yeeyee.net ";
		}

	}

	public function sendEmail_to($useremail, $raw_password) {
		$sendEmail = A('Email');
		return $sendEmail->think_send_mail($useremail, "易易网管理者", "成功注册账户的通知", $this->creatEmailBody($useremail, $raw_password));
	}
	// 生成邮件表格形式
	public function creatEmailBody($useremail, $raw_password) {
		$hash = md5($useremail);
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
				'你的邮箱<b>'.$useremail.'</b>刚刚在 易易网(www.yeeyee.net) 注册成功。<br>'.
				'你的密码是<b>'.$raw_password.'</b>，'.
				'如果你的密码未改依然是默认密码，请尽快到易易网修改密码。<br>'.
				'<br>'.
				'如果你确实在易易网注册过，请你点击以下链接以激活你的账户：<br>'.
				'<b><a href="http://www.yeeyee.net/Home/Signup/activate/?hash='.$hash.'">http://www.yeeyee.net/Home/Signup/activate/?hash='.$hash.'</a></b><br>'.
				'<br>'.
				'如果你不确定自己是否注册过易易网账户，或认为自己的邮箱被冒用注册，请与易易网管理者联系：<br>'.
				'admin@yeeyee.net<br>'.
				'<br>'.
				'祝你在易易网使用愉快！<br>'.
				date('Y-m-d H:i', time()).'<br>'.
			'</td></tr></table>'.
'</body></html>';
	}
	
}
