<?php
// +----------------------------------------------------------------------
// | 天津云脉三六五科技有限公司
// | 社团邦
// +----------------------------------------------------------------------

// 应用入口文件

// 项目入口
if(file_exists('global.php')){
	require 'global.php';
}else{
	exit("ERROR : No Global File!");
}

// 重命名库路径
define('THINK_PATH', __DIR__.'/Vendor/');
// 引入框架入口文件
require THINK_PATH.'ThinkPHP.php';

// 引入发送邮件submail sdk
require_once(THINK_PATH.'Library/Vendor/submail/SUBMAILAutoload.php');

// end