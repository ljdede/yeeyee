<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	protected $connection= 'DB_CONFIG_mySQL';
	protected $tablePrefix = 'platform_';

}
