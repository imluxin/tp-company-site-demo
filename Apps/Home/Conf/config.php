<?php
return array(
    'LOAD_EXT_CONFIG'      => 'custom', // 分割配置文件
	// 应用设置
    'REMEMBER_KEY'          => 'B984F5F82123CCF9D2E6AEB5171B0365', // 记住登录cookie名称
    'REMEMBER_EXPIRE'       =>  2592000, // 记住登录过期时长(1个月)

    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写

    // 路由配置
    'URL_ROUTER_ON'         =>  true,
    'URL_ROUTE_RULES'       =>  array(
        array('/', array('Index/index')),
        array('home', array('Index/index')),

        // 基本信息
        array('me', array('Org/info')),

        // 消息管理

        // 社员管理
        array('m', 'Member/index?p=1'),

        // 活动管理
        array('activity/', 'Activity/index'),
        array('activity/subject/add', 'Activity/subject_add'),
        array('activity/subject/view/:guid', array('Activity/subject_view'))
    )
);