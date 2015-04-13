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

    'TMPL_EXCEPTION_FILE'  => THINK_PATH . 'Tpl/think_exception.tpl',// 异常页面的模板文件
    'URL_404_REDIRECT'     => APP_PATH . 'Common/View/Default/Tpl/404.html', // 404页面地址

    'TMPL_PARSE_STRING'    => array(
        '__UPLOAD__' => '/Upload', // 增加新的上传路径替换规则
    ),

    // 文章分类
    'ARTICLE_CATEGORY' => array(
        1 => '企业简介',
        2 => '企业新闻',
        3 => '公司招聘',
        4 => '联系我们'
    ),
    // 图片分类
    'PIC_CATEGORY' => array(
        'top' => '首页约灯片',
        'client' => '合作伙伴'
    ),


    'SAVE_EXT' => 'png',
    'MAX_UPLOAD_SIZE' => 2*1024*1024,
    'ALLOWED_EXTS'      => array('jpg', 'png'),


    /* 数据库设置 */
    'DB_TYPE'      => 'mysql',     // 数据库类型

	 'DB_HOST'   =>  'localhost', // 本机服务器地址
    'DB_NAME'      => 'ym365',          // 数据库名
    'DB_USER'      => 'root',      // 用户名
	'DB_PWD'       => 'root',          // 本机密码
//    'DB_HOST'   =>  '10.4.12.173', // 本机服务器地址
//    'DB_NAME'      => 'db0da4da3abe545acbc8d4dc638d2b936',          // 数据库名
//    'DB_USER'      => 'uJQS2Q87f9cZa',      // 用户名
//    'DB_PWD'       => 'pex4foBOgoN9g',          // 本机密码

    'DB_PORT'      => '3306',        // 端口
    'DB_PREFIX'    => 'ym_',    // 数据库表前缀

    /**
     * GIT.OSCHINA.COM 数据库配置
     *
     * MOPAAS_MYSQL15869_NAME  db0da4da3abe545acbc8d4dc638d2b936
    MOPAAS_MYSQL15869_HOSTNAME  10.4.12.173
    MOPAAS_MYSQL15869_HOST  10.4.12.173
    MOPAAS_MYSQL15869_PORT  3306
    MOPAAS_MYSQL15869_USER  uJQS2Q87f9cZa
    MOPAAS_MYSQL15869_USERNAME  uJQS2Q87f9cZa
    MOPAAS_MYSQL15869_PASSWORD  pex4foBOgoN9g
     */


);