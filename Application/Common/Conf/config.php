<?php
return array(
	//'配置项'=>'配置值'
	
	// 设置默认的模板主题
	'DEFAULT_THEME'    =>    'default',


	//版本信息
	'VERSION' => '3.618 (20141130)',
	// 'DEFAULT_MODULE' => 'Home', //默认模块
	'URL_MODEL' => '2', //URL模式 去除index.php
	'URL_HTML_SUFFIX'=>'',
	
	// 页面trace
	'SHOW_PAGE_TRACE' =>false,

	//Mongo数据库配置
	'DB_TYPE' => 'mongo', // 数据库类型
	'DB_HOST' => 'localhost', // 服务器地址
	'DB_NAME' => 'platform', // 数据库名
	'DB_USER' => '', // 用户名
	'DB_PWD' => '', // 密码
	'DB_PORT' => '27017', // 端口


	//mySQL数据库配置1
	'DB_CONFIG_mySQL' => array(
		'DB_TYPE'		=>	'mysql',
		'DB_USER'		=>	'root',
		'DB_PWD'		=>	'ljdede',
		'DB_HOST'		=>	'localhost',
		'DB_PORT'		=>	'3306',
		'DB_NAME'		=>	'platform',
		'DB_PREFIX'		=>	'platform_', // 数据库表前缀
		),

	//邮件配置
	'THINK_EMAIL' => array(
	    'SMTP_HOST'   => 'smtp.exmail.qq.com', //SMTP服务器
	    'SMTP_PORT'   => '465', //SMTP服务器端口
	    'SMTP_USER'   => 'admin@yeeyee.net', //SMTP服务器用户名
	    'SMTP_PASS'   => 'yeeyee20110721', //SMTP服务器密码
	    'FROM_EMAIL'  => 'admin@yeeyee.net', //发件人EMAIL
	    'FROM_NAME'   => '易易网的管理者', //发件人名称
	    'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
	    'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
	),
);