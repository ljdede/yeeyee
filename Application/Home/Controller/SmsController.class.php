<?php
namespace Home\Controller;
use Think\Controller;
class SmsController extends Controller {
	
	public function index(){
		
		if(!IS_POST) $this->error('页面不存在！');
		
		// echo $this->sendSms();
	}

	public function sendSms() {
		// 检测是否激活
		$check = A('Login');
		if ($check->check_activation() == 0) {
			// 3表示激活未成功
			echo -3;
			return false;
		}
		
		// mongodb 连接
		$mongo_sms_new = new \Home\Model\Sms_newMongoModel('Sms_new');
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');
		if (session('id') == I('uid')) {
			return false;
		}

		$user_me = $mongo_user->where(array(
			'_id' => session('id'),
			))->field('avatar,_id')->find();

		$newSms = array(
			'senderId' => session('id'),
			'receiverId' => I('uid'),
			'send_time' => time(),
			'read_time' => 0,
			'type' => 0,
			'content' => I('content'),
			'status' => 0
			);
		
		if($mongo_sms_new->data($newSms)->add()) {
			$this->getSms();
			// echo json_encode($returnInfo);
		}
	}

	public function getSms() {
		// mongodb 连接
		$mongo_sms_new = new \Home\Model\Sms_newMongoModel('Sms_new');
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		$user_opposite = $mongo_user->where(array(
			'_id' => I('uid'),
			))->field('avatar,_id')->find();

		// ThinkPHP下mongoDB不灵活的查询导致的
		$sms = array();
		$map_1 = array(
			'senderId' => session('id'),
			'receiverId' => $user_opposite['_id'],
			'status' => 0,
			);
		$sms_1 = $mongo_sms_new->where($map_1)->field('_id,senderId,send_time,read_time,type,content')->select();
		$map_2 = array(
			'senderId' => $user_opposite['_id'],
			'receiverId' => session('id'),
			'status' => 0,
			);
		$sms_2 = $mongo_sms_new->where($map_2)->field('_id,senderId,send_time,read_time,type,content')->select();

		if ($sms_1 != '') {
			$sms = array_merge($sms, $sms_1);
		}
		if ($sms_2 != '') {
			$sms = array_merge($sms, $sms_2);
		}
		
		// $sms = array_merge($sms, $sms_2);

		foreach ($sms as $key => $value) {
			$send_time[$key] = $sms['send_time'];
		}

		$tempArray = array();
		foreach ($sms as $key => $value) {
			if ($value['send_time'] > I('lastSmsTime')) {
				if ($value['senderId'] == session('id')) {
					$value['avatar'] = session('avatar');
					$value['toOrFrom_type'] = 1;
				} else if ($value['senderId'] == $user_opposite['_id']) {
					$value['avatar'] = $user_opposite['avatar'];
					$value['toOrFrom_type'] = 0;
				}
				$value['send_time_raw'] = $value['send_time'];
				$value['send_time'] = date('Y-m-d H:i', $value['send_time']);
				// 多维排序的条件
				$send_time[$key] = $sms['send_time'];

				array_push($tempArray, $value);
			} else {
				continue;
			}
		}
		// 多维排序，弥补ThinkPHP下mongoDB不灵活的查询
		array_multisort($send_time, $tempArray);


		echo json_encode($tempArray);
	}

	public function checkSms_tryRead() {
		if (session('id') != '') {
			// mongodb 连接
			$mongo_sms_new = new \Home\Model\Sms_newMongoModel('Sms_new');
			// mongodb 连接
			$mongo_user = new \Home\Model\UserMongoModel('User');

			
			$map = array(
				'status' => 0,
				'read_time' => 0
				);
			$sms_notRead = $mongo_sms_new->where($map)->select();

			foreach ($sms_notRead as $key => $value) {
				if ($value['receiverId'] == session('id')) {

					$user_opposite = $mongo_user->where(array(
						'_id' => $value['senderId'],
						))->field('username')->find();

					$sms_notRead_array[$key] = array(
						'uid' => $value['senderId'],
						'username' => $user_opposite['username'],
						);
				}
			}
			// array_unique用于去除重复数组项
			echo json_encode(array_unique($sms_notRead_array));
		} else {
			echo '';
		}
		
	}

	public function checkSms_array() {
		// mongodb 连接
		$mongo_sms_new = new \Home\Model\Sms_newMongoModel('Sms_new');
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');
		// 
		$users = explode('-', I('users'));
		foreach ($users as $key => $value) {
			if( $value == '') {
				continue;
			}
			$user_opposite = $mongo_user->where(array(
			'_id' => $value,
			))->field('_id')->find();
			$map = array(
				'senderId' => $user_opposite['_id'],
				'receiverId' => session('id'),
				'status' => 0,
				'read_time' => 0
				);
			$smsCount[$key] = $mongo_sms_new->where($map)->count();
		}
		$smsCountAll = implode('-', $smsCount);
		echo $smsCountAll;
	}

	public function readSms() {
		// mongodb 连接
		$mongo_sms_new = new \Home\Model\Sms_newMongoModel('Sms_new');
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		$user_opposite = $mongo_user->where(array(
			'_id' => I('uid'),
			))->field('_id')->find();


		$map = array(
			'senderId' => $user_opposite['_id'],
			'receiverId' => session('id'),
			'status' => 0,
			);
		$new = array(
			'read_time' => time()
			);
		if( !$mongo_sms_new->where($map)->save($new) ){
			return -2;
		} else {
			return 1;
		}
	}
}
