<?php
namespace Home\Controller;
use Think\Controller;
class SetupController extends CommonController {
	// 记得重新配置session
	// session('id', );
	// session('username', );
	// session('email', );
	// session('avatar', );
	// session('activated', );
	// session('verified', );

	public function index(){
		if (ismobile()) {
			$this->display();
		} else {
			
			if(session('username') == ''){
				$this->redirect('/Home/Index', '', 0);
			}
			// mongodb 连接
			$mongo_user = new \Home\Model\UserMongoModel('User');
			$user = $mongo_user->where(array(
						'_id'	=>	session('id'),
					))->find();
			// 分配模板标签
			$this->assign('user', $user);
			$this->display();
		}
		
	}
	// 用户设置
	public function setting_user(){
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		if(I('username') != ""){
			$mongo_user->where(array(
					'_id'	=>	session('id'),
				))->save(array(
					'username'=>	I('username'),
				));
			// 更新session
			session('username', I('username'));
			echo 1;
		}else{
			echo 0;
		}
	}
	// 密码设置
	public function setting_password(){
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');
		$user = $mongo_user->where(array(
					'_id'	=>	session('id'),
				))->find();
		preg_match('/^[A-Za-z0-9_]{6,20}$/', I('password_new'), $regResult);
		if($user['password'] != I('password_old', '', 'md5')){
			// 密码不正确
			echo 0;
		}else if($regResult[0] == NULL){
			// 新密码应该为6到20位！
			echo -2;
		}else if(I('password_new') != I('password_new_2')){
			// 新密码两次输入不一致
			echo -1;
		}else{
			$data = array(
					'password'		=>	I('password_new','', 'md5'),
				);

			$mongo_user->where(array(
					'_id'	=>	session('id'),
				))->save($data);
			echo 1;
		}
		
		// echo 1;
	}
	// 联系设置
	public function setting_contact(){
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		$data = array(
				'mobileNumber'		=>	I('mobileNumber'),
				'mobileNumber_short'=>	I('mobileNumber_short'),
				'qq'				=>	I('qq'),
				'weixin'			=>	I('weixin'),
				'weibo'				=>	I('weibo'),
				'notes'				=>	I('notes'),
			);

		$mongo_user->where(array(
				'_id'	=>	session('id'),
			))->save($data);
		
		echo 1;
	}
	// 个人资料
	public function setting_profile(){
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		$data = array(
				'realname'			=>	I('realname'),
				'studentNumber'		=>	I('studentNumber'),
				'college'			=>	I('college'),
				'major'				=>	I('major'),
			);

		$mongo_user->where(array(
				'_id'	=>	session('id'),
			))->save($data);
		
		echo 1;
	}

	// 上传-删除
	public function upload(){
		$config = array(
				'maxSize'	=>	5500000,
				'rootPath'	=>	'./Public/',
				'savePath'	=>	'./Common/img/users/',
				'saveName'	=>	time().'_'.mt_rand(),
				'exts'		=>	array('jpg', 'gif', 'png', 'jpeg'),
				'autoSub'	=>	true,
				'subName'	=>	array('date','Ymd'),
			);
		$upload = new \Think\Upload($config);

		$info	=	$upload->uploadOne($_FILES['file']);

		if(!$info) {
			// 上传错误提示错误信息
			// $this->error($upload->getError());
			header("http/1.1 404 Not Found");
		}else{
			// 上传成功 获取上传文件信息

			// mongodb 连接
			$mongo_user = new \Home\Model\UserMongoModel('User');
			$temp = explode('.', $config['rootPath']);
			$path = $temp[1].$info['savepath'].$info['savename'];

			$mongo_user->where(array(
					'_id'	=>	session('id'),
				))->save(array(
					'avatar'=>	$path,
				));
			// 更新session
			session('avatar', $path);

			$info['rootpath'] = $config['rootPath'];
			echo json_encode($info);
		}
	}
	public function upload_delete(){
		// 删除上传了的图片
		$url = __ROOT__.I('src');
		if (file_exists($url)) {
			$result = unlink ($url);

			// mongodb 连接
			$mongo_user = new \Home\Model\UserMongoModel('User');
			$defaultImg = '/Public/Common/img/users/default.jpg';
			$mongo_user->where(array(
					'_id'	=>	session('id'),
				))->save(array(
					'avatar'=>	$defaultImg,
				));
			// 更新session
			session('avatar', $defaultImg);

			$resultArray['unlink'] = $result;
			$resultArray['img'] = $defaultImg;
			echo json_encode($resultArray);
		}
	}
}