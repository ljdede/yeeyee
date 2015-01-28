<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
	public function index(){
		$mySQL_user = new \Home\Model\UserModel('User');
		$users = $mySQL_user->select();
		dump($users);
	}
	public function insertOne(){
		$mySQL_user = new \Home\Model\UserModel('User');
		$newuser = array(
				'email'			=>	'ljdede@126.com',
				'password'		=>	md5('ljdede'),
				'username'		=>	'ljdede',
				'avatar'		=>	'/Public/Common/img/users/default.jpg',
				'time_signup'	=>	time(),
				'activated'		=>	1,
				'verified'		=>	1,
				'times_login'	=>	13,
				'time_login'	=>	time(),
				'loginIp'		=>	'172.1.1.1',
			);
		$mySQL_user->data($newuser)->add();
	}

	public function mobile() {
		if (ismobile()) {
			echo "M";
		} else {
			echo "P";
		}
	}
}