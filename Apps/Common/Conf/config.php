<?php

/**
 * 通用配置
 * 
 * CT: 2014-09-12 15:00 by YLX
 * UT: 2014-09-17 16:00 by YLX
 * UT: 2014-12-04 16:51 by QXL
 */

return array(
    'APP_NAME'             => '云脉365',
    'LOAD_EXT_CONFIG'      => 'deploy', // 分割配置文件
//    'URL_MODEL'            => 2, // url模式

    //控制器层 
    'ACTION_SUFFIX'        => '',     // 操作方法后缀
    'DEFAULT_MODULE'       => 'Home', // 默认模块
    'URL_HTML_SUFFIX'      => '',     // 默认模板文件后缀
    'URL_CASE_INSENSITIVE' => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写

    // 视图层
    'DEFAULT_THEME'        => 'Default', // 默认模板主题名称
    'LAYOUT_ON'            => true, // 是否启用布局
    'LAYOUT_NAME'          => 'layout', // 当前布局名称 默认为layout

//    'TMPL_ACTION_ERROR'    => APP_PATH . 'Common/View/Default/Tpl/dispatch_jump.tpl', // 默认错误跳转对应的模板文件
//    'TMPL_ACTION_SUCCESS'  => APP_PATH . 'Common/View/Default/Tpl/dispatch_jump.tpl', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'  => THINK_PATH . 'Tpl/think_exception.tpl',// 异常页面的模板文件
    'URL_404_REDIRECT'     => APP_PATH . 'Common/View/Default/Tpl/404.html', // 404页面地址

    'TMPL_PARSE_STRING'    => array(
        '__UPLOAD__' => '/Upload', // 增加新的上传路径替换规则
    ),


    'SAVE_EXT' => 'png',
    'MAX_UPLOAD_SIZE' => 2*1024*1024,
    'MAX_UPLOAD_CREDENTIALS_SIZE' => 4*1024*1024,
    'ALLOWED_EXTS'      => array('jpg', 'png'),


    /* 数据库设置 */
    'DB_TYPE'      => 'mysql',     // 数据库类型
	 'DB_HOST'   =>  'localhost', // 本机服务器地址
    'DB_NAME'      => 'ym365',          // 数据库名
    'DB_USER'      => 'root',      // 用户名
	'DB_PWD'       => 'root',          // 本机密码
    'DB_PORT'      => '3306',        // 端口
    'DB_PREFIX'    => 'ym_',    // 数据库表前缀


);