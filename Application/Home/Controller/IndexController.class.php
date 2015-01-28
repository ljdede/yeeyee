<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;


class IndexController extends CommonController {
	public function index(){
		$this->show();
	}

	public function sendEmail() {
		if ($this->sendEmail_to() && $this->sendEmail_from()) {
			echo true;
		} else {
			echo false;
		}
	}

	public function sendEmail_to() {
		$sendEmail = A('Email');
		return $sendEmail->think_send_mail(I('email_orignal'), "易易网管理者", "信息被关注的通知", $this->creatEmailBody(1, 1));
	}
	public function sendEmail_from() {
		$sendEmail = A('Email');
		return $sendEmail->think_send_mail(session('email'), "易易网管理者", "你关注信息的通知", $this->creatEmailBody(2, 2));
	}
	// 生成邮件表格形式
	public function creatEmailBody($sendEmail_explanation_type, $sendEmail_toOrFrom_type) {
		if ( $sendEmail_explanation_type == 1) {
			$sendEmail_explanation = '你好，这是来自易易网的邮件。<br>您在易易网的信息已经被人关注。ta的信息如下，请及时与ta取得联系。<br>感谢使用易易网。';
		} else if ( $sendEmail_explanation_type == 2) {
			$sendEmail_explanation = '你好，这是来自易易网的邮件。<br>您在易易网的信息已经发给你关注的人。你的信息如下，请等待ta与你联系。<br>感谢使用易易网。';
		}
		if ( $sendEmail_toOrFrom_type == 1) {
			$sendEmail_toOrFrom = '关注你信息的用户：';
		} else if ( $sendEmail_toOrFrom_type == 2) {
			$sendEmail_toOrFrom = '你发出的信息：';
		}

		if ( I('realname') != '') {
			$emailBody_realname = '<tr><td>姓名：</td><td>'.I('realname').'</td></tr>';
		} else {
			$emailBody_realname = '';
		}
		if ( I('mobileNumber') != '') {
			$emailBody_mobileNumber = '<tr><td>手机号码：</td><td>'.I('mobileNumber').'</td></tr>';
		} else {
			$emailBody_mobileNumber = '';
		}
		if ( I('mobileNumber_short') != '') {
			$emailBody_mobileNumber_short = '<tr><td>手机短号：</td><td>'.I('mobileNumber_short').'</td></tr>';
		} else {
			$emailBody_mobileNumber_short = '';
		}
		if ( I('qq') != '') {
			$emailBody_qq = '<tr><td>QQ号码：</td><td>'.I('qq').'</td></tr>';
		} else {
			$emailBody_qq = '';
		}
		if ( I('weixin') != '') {
			$emailBody_weixin = '<tr><td>微信号码：</td><td>'.I('weixin').'</td></tr>';
		} else {
			$emailBody_weixin = '';
		}
		if ( I('weibo') != '') {
			$emailBody_weibo = '<tr><td>微博地址：</td><td>'.I('weibo').'</td></tr>';
		} else {
			$emailBody_weibo = '';
		}
		if ( I('notes') != '') {
			$emailBody_notes = '<tr><td>备注事项：</td><td>'.I('notes').'</td></tr>';
		} else {
			$emailBody_notes = '';
		}
		return '
			<!DOCTYPE html>'.
			'<html lang="en">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title></title>'.
				'<style type="text/css">'.
					'*{'.
						'font-family:"微软雅黑";'.
					'}'.
					'.mainTable {'.
						'width: 530px;'.
					'}'.
						'.mainTable td {'.
							'border: solid 1px #000000;'.
							'padding: 5px;'.
						'}'.
						'.mainTable .leftTd {'.
							'width: 100px;'.
						'}'.
						'.mainTable .infoTd {'.
							'color: #6699FF;'.
						'}'.
				'</style>'.
			'</head>'.
			'<body>'.
				'<table class="mainTable">'.
					'<tr>'.
						'<td colspan="2">'.
							$sendEmail_explanation.
						'</td>'.
					'<tr>'.
						'<td colspan="2">'.$sendEmail_toOrFrom.'</td>'.
					'</tr>'.
					'</tr>'.
					'<tr>'.
						'<td class="leftTd">用户名：</td>'.
						'<td>'.session('username').'</td>'.
					'</tr>'.
					'<tr>'.
						'<td>Email：</td>'.
						'<td>'.I('email').'</td>'.
					'</tr>'.
						$emailBody_realname.$emailBody_mobileNumber.$emailBody_mobileNumber_short.$emailBody_qq.$emailBody_weixin.$emailBody_weibo.$emailBody_notes.
					'<tr>'.
						'<td colspan="2" class="infoTd">相关信息：</td>'.
					'</tr>'.
					'<tr>'.
						'<td class="infoTd">信息名称：</td>'.
						'<td class="infoTd">'.I('title').'</td>'.
					'</tr>'.
					'<tr>'.
						'<td class="infoTd">发布时间：</td>'.
						'<td class="infoTd">'.I('time_created').'</td>'.
					'</tr>'.
					'<tr>'.
						'<td class="infoTd">栏目分类：</td>'.
						'<td class="infoTd">'.I('category').'</td>'.
					'</tr>'.
					// '<tr>'.
					// 	'<td class="infoTd">信息描述：</td>'.
					// 	'<td class="infoTd">'.I('description_compressed').'</td>'.
					// '</tr>'.
				'</table>'.
			'</body>'.
			'</html>';
	}

	

	// 上传-删除
	public function upload(){
		$config = array(
				'maxSize'	=>	5500000,
				'rootPath'	=>	'./Public/',
				'savePath'	=>	'./Index/img/info/',
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
			$info['rootpath'] = $config['rootPath'];
			echo json_encode($info);
		}
	}
	public function upload_delete(){
		// 删除上传了的图片
		$url = __ROOT__.I('src');
		if (file_exists($url)) {
			$result = unlink ($url);
			echo $result;
		}
	}

	// 栏目-分类
	public function category_generate(){
		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');
		$newCategory1 = array(
				'name'		=>	'物品交易',
				'collection'=>	'info_item',
				'children'	=>	array(
						array(
							'_id'		=>	0,
							'subname'	=>	'图书杂志',
							'total'		=>	0,
							),
						array(
							'_id'		=>	1,
							'subname'	=>	'电子产品',
							'total'		=>	0,
							),
						array(
							'_id'		=>	2,
							'subname'	=>	'单车',
							'total'		=>	0,
							),
						array(
							'_id'		=>	3,
							'subname'	=>	'运动物品',
							'total'		=>	0,
							),
						array(
							'_id'		=>	4,
							'subname'	=>	'音乐CD',
							'total'		=>	0,
							),
					),
			);
		$newCategory2 = array(
				'name'		=>	'校园信息',
				'collection'=>	'info_school',
				'children'	=>	array(
						array(
							'_id'		=>	0,
							'subname'	=>	'海报墙',
							'total'		=>	0,
							),
						array(
							'_id'		=>	1,
							'subname'	=>	'电子传单',
							'total'		=>	0,
							),
						array(
							'_id'		=>	2,
							'subname'	=>	'教务处信息',
							'total'		=>	0,
							),
						array(
							'_id'		=>	3,
							'subname'	=>	'学院通知',
							'total'		=>	0,
							),
						array(
							'_id'		=>	4,
							'subname'	=>	'社团信息',
							'total'		=>	0,
							),
						array(
							'_id'		=>	5,
							'subname'	=>	'同乡会',
							'total'		=>	0,
							),
						
					),
			);
		$mongo_category->data($newCategory1)->add();
		$mongo_category->data($newCategory2)->add();
		dump($mongo_category->select());
	}
	public function category_get(){
		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');
		// dump($mongo_category->select());
		echo json_encode($mongo_category->select());

	}

	// 发布信息
	public function creator_make(){
		if(session('id') == 0){
			// 代码0表示未登录
			return -1;	
		}
		// 检测是否激活
		$check = A('Login');
		if ($check->check_activation() == 0) {
			// 3表示激活未成功
			return -3;
		}

		// 字段检测
		if( I('title') == '' || I('description') == '' || I('pid') == -1 || I('cid') == -1 ){
			return 0;
		}
		// url提取域名
		if( I('url') != ''){
			preg_match('@^(?:http://)?([^/]+)@i', I('url'), $matches);  
			$url = $matches[1];
			// if ($matches[0] == 'http://') {
			// 	$url_raw = I('url');
			// } else {
			// 	$url_raw = 'http://'.I('url');
			// }
			// $url_raw = 'http://'.$matches[1].$matches[2];
			if (!preg_match("/^(http|ftp):/", I('url'))) {
				$url_raw = 'http://'.I('url');
			} else {
				$url_raw = I('url');
			}
			// $myArray=explode("://", I('url'), 2);
			// if($myArray[0] == "http" || $myArray[0] == "https") {
			// 	return $myURL;
			// } else {
			// 	$url_raw "http://".$myURL;
			// }
		}else{
			$url = '';
		}

		// 组建文档
		$info = array(
				'uid'			=>	session('id'),
				'time_created'	=>	time(),
				'times_viewed'	=>	0,
				'times_clicked'	=>	0,
				'status'		=>	1,

				'title'			=>	I('title'),
				'price'			=>	I('price'),
				'description'	=>	I('description'),
				'img'			=>	I('img'),
				'pid'			=>	I('pid'),
				'cid'			=>	I('cid'),
				'url'			=>	$url,
				'url_raw'		=>	$url_raw,
			);
		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');
		$collectionName = $mongo_category->where(array(
				'_id'	=>	I('pid'),
			))->field('collection')->find();


		if($collectionName['collection'] == 'info_item'){
			$mongo_info = new \Home\Model\info_itemMongoModel('info_item');
		}else if($collectionName['collection'] == 'info_school'){
			$mongo_info = new \Home\Model\info_schoolMongoModel('info_school');
		}

		
		// 关联更新栏目分类的文档的统计数据
		$matchDoc = array(
				'_id'		=>	I('pid'),
				'children._id'	=>	(int)I('cid'),	
				);
		$new = array(
			'children.$.total' => array('inc', 1),
		);
		if( !$mongo_category->where($matchDoc)->save($new) ){
			return -2;
		}

		if($mongo_info->data($info)->add()){
			return 1;
		} else {
			return 0;
		}
	}
	public function creator(){
		echo $this->creator_make();
	}
	public function creator_moblie_page() {
		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');
		$category = $mongo_category->select();
		$this->assign('category', $category);
		$this->display();
	}

	// 读取信息
	public function info(){
		// G('begin');

		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');

		if(I('pid') == -1){
			$mongo_infoItem = new \Home\Model\info_itemMongoModel('info_item');
			$mongo_infoSchool = new \Home\Model\info_schoolMongoModel('info_school');

			$infos = $mongo_infoItem->order('time_created desc')->select();
			$infos_2 = $mongo_infoSchool->order('time_created desc')->select();

			// 新增collection
			$infos = $infos + $infos_2;
		}else{
			$collectionName = $mongo_category->where(array(
					'_id'	=>	I('pid'),
				))->field('collection')->find();

			if($collectionName['collection'] == 'info_item'){
				$mongo_info = new \Home\Model\info_itemMongoModel('info_item');
			}else if($collectionName['collection'] == 'info_school'){
				$mongo_info = new \Home\Model\info_schoolMongoModel('info_school');
			}

			if(I('cid') == -1){
				$infos = $mongo_info->order('time_created desc')->limit(I('begin'),I('offset'))->select();
				// echo (I('cid'));
			}else{
				$matchDoc = array(
					'cid'	=>	I('cid'),
					);
				$infos = $mongo_info->order('time_created desc')->limit(I('begin'),I('offset'))->where($matchDoc)->select();
			}
		}
		
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		$tempArray = array();
		foreach ($infos as $key => $value) {
			// dump($value['uid']);
			$user = $mongo_user->where(array(
				'_id' => $value['uid'],
				))->field('username,avatar')->find();
			$value['username'] = $user['username'];
			$value['avatar'] = $user['avatar'];

			$category_1 = $mongo_category->where(array(
				'_id' => $value['pid'],
				))->field('name')->find();
			$value['category_1'] = $category_1['name'];

			$matchDoc = array(
				'_id'		=>	$value['pid'],
				'children._id'	=>	(int)$value['cid'],	
				);
			$category_2 = $mongo_category->where($matchDoc)->field('children.$.subname')->find();
			$value['category_2'] = $category_2['children'][0]['subname'];

			$value['time_created_raw'] = $value['time_created'];

			$value['time_created'] = date('Y-m-d H:i', $value['time_created']);

			// 生成压缩的详细描述信息
			$value['description_compressed'] = $this->substr_CN($value['description'], 360);
			// 生成包含换行号的描述信息
			$order = array("\r\n", "\n", "\r");
			$replace = "<br />";
			$value['description_raw'] = "<br />".str_replace($order, $replace, $value['description']);
			$value['currentuid'] = session('id');

			$time_created_raw[$key] = $value['time_created_raw'];

			array_push($tempArray, $value);
		}



		// 多维排序，弥补ThinkPHP下mongoDB不灵活的查询
		array_multisort($time_created_raw, SORT_DESC, $tempArray);

		if(I('pid') == -1 ){
			$tempArray = array_slice($tempArray, I('begin'), I('offset'));

			foreach ($tempArray as $key => $value) {
				$time_created_raw_done[$key] = $value['time_created_raw'];
			}
			array_multisort($time_created_raw_done, SORT_DESC, $tempArray);
		}


		echo json_encode($tempArray);
		// G('end');
		// $time = G('begin','end').'s';
		// F('data', $time);
	}
	public function info_one(){
		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');
		$collectionName = $mongo_category->where(array(
				'_id'	=>	I('pid'),
			))->field('collection')->find();


		if($collectionName['collection'] == 'info_item'){
			$mongo_info = new \Home\Model\info_itemMongoModel('info_item');
		}else if($collectionName['collection'] == 'info_school'){
			$mongo_info = new \Home\Model\info_schoolMongoModel('info_school');
		}

		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');

		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');
		
		$info_one = $mongo_info->where(array(
				'_id'	=>	I('_id'),
			))->find();

		$user = $mongo_user->where(array(
			'_id' => $info_one['uid'],
			))->field('username,avatar,email,_id')->find();
		$info_one['username'] = $user['username'];
		$info_one['avatar'] = $user['avatar'];
		$info_one['email'] = $user['email'];
		$info_one['uid'] = $user['_id'];

		$category_1 = $mongo_category->where(array(
			'_id' => $info_one['pid'],
			))->field('name')->find();
		$info_one['category_1'] = $category_1['name'];

		$matchDoc = array(
			'_id'		=>	$info_one['pid'],
			'children._id'	=>	(int)$info_one['cid'],	
			);
		$category_2 = $mongo_category->where($matchDoc)->field('children.$.subname')->find();
		$info_one['category_2'] = $category_2['children'][0]['subname'];

		$info_one['time_created'] = date('Y-m-d H:i', $info_one['time_created']);

		// 生成压缩的详细描述信息
		$info_one['description_compressed'] = $this->substr_CN($info_one['description'], 360);
		// 生成包含换行号的描述信息
		$order = array("\r\n", "\n", "\r");
		$replace = "<br />";
		$info_one['description_raw'] = str_replace($order, $replace, $info_one['description']);

		echo json_encode($info_one);
		// dump($info_one);
	}

	public function info_one_user(){
		// mongodb 连接
		$mongo_user = new \Home\Model\UserMongoModel('User');
		$user = $mongo_user->where(array(
					'_id'	=>	session('id'),
				))->find();
		// dump($user);
		echo json_encode($user);
	}

	public function info_checkNew() {
		// mongodb 连接
		$mongo_category = new \Home\Model\CategoryMongoModel('Category');

		if(I('pid') == -1){
			$mongo_infoItem = new \Home\Model\info_itemMongoModel('info_item');
			$mongo_infoSchool = new \Home\Model\info_schoolMongoModel('info_school');

			$map['time_created'] = array('gt', (int)I('time_created_raw'));
			$infoNum = $mongo_infoItem->where($map)->count();
			$infoNum_2 = $mongo_infoSchool->where($map)->count();

			// 新增collection
			$infoNum = $infoNum + $infoNum_2;
		}else{
			$collectionName = $mongo_category->where(array(
					'_id'	=>	I('pid'),
				))->field('collection')->find();

			if($collectionName['collection'] == 'info_item'){
				$mongo_info = new \Home\Model\info_itemMongoModel('info_item');
			}else if($collectionName['collection'] == 'info_school'){
				$mongo_info = new \Home\Model\info_schoolMongoModel('info_school');
			}

			$map['time_created'] = array('gt', (int)I('time_created_raw'));
			if(I('cid') == -1){
				$infoNum = $mongo_info->where($map)->count();
				// echo (I('cid'));
			}else{
				$map['cid'] = I('cid');
				$infoNum = $mongo_info->where($map)->count();
			}
		}
		echo $infoNum;
	}

	public function info_test(){
		$string = 'http://httplotehttpost1.ljde.http/';
		// $result = array();
		

		preg_match('@^(?:http://)?([^/]+)@i', $string, $matches);  
		$host = $matches[1];
		echo $host;
	}


	// 用来解决截取字符时中文被砍断而出现null的问题
	public function substr_CN($str,$len){
		for($i=0;$i<$len;$i++) {
			$temp_str=substr($str,0,1);
			if(ord($temp_str) > 127) {
				$i++;
				if($i<$len) {
					$new_str[]=substr($str,0,3);
					$str=substr($str,3);
				}
			} else {
				$new_str[]=substr($str,0,1);
				$str=substr($str,1);
			}
		}
		return join($new_str);
	}

}