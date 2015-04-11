<?php

/**
 * 部署设置
 * 
 * CT: 2014-10-22 16:00 by YLX
 * UT: 2014-10-22 16:00 by YLX
 */

return array(
    // 部署相关
    'APP_SUB_DOMAIN_DEPLOY'   =>    false, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    =>    array(
        'www.yunmai365.com'    => 'Site',  // 域名指向Site模块
        'api.yunmai365.com'    => 'Api',  // 域名指向Api模块
        'api1.yunmai365.com'   => 'Api',  // 域名指向Api模块
        'mp.yunmai365.com'     => 'Home',  // 域名指向Home模块
        'admin.yunmai365.com'  => 'Admin',  // 域名指向Admin模块
        '3g.yunmai365.com'     => 'Mobile',  // 域名指向Mobile模块
        'task.yunmai365.com'   => 'Task',  // 域名指向Task模块
        'member.yunmai365.com' => 'Member',  // 域名指向Member模块
    ),

    // 日志记录 (现只记录SQL)
    'LOG_RECORD'            =>  true,  // 进行日志记录
    'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志
    'LOG_LEVEL'             =>  'SQL',  // 允许记录的日志级别
    'DB_SQL_LOG'            =>  true, // 记录SQL信息

    'MEDIA_FAVICON' => '<link rel="shortcut icon" href="/Public/common/images/favicon.ico" type="image/vnd.microsoft.icon">',
    // 静态JS
    'MEDIA_JS' => array(
        'JQUERY'                     => '<script type="text/javascript" src="/Public/common/js/jquery.js"></script>',
        'JQUERYUI'                   => '<script type="text/javascript" src="/Public/common/js/jqueryui.js"></script>',
        'BOOTSTRAP'                  => '<script type="text/javascript" src="/Public/common/bootstrap/js/bootstrap.js"></script>',
        'BOOTSTRAP_DATETIMEPICKER'   => '<script type="text/javascript" src="/Public/common/js/bootstrap-datetimepicker.min.js"></script>',
        'JQUERY_VALIDATE'            => '<script type="text/javascript" src="/Public/common/js/jquery.validate.js"></script>',
        'JQUERY_VALIDATE_ADDITIONAL' => '<script type="text/javascript" src="/Public/common/js/additional-methods.js"></script>',
//        'JQUERY'                     => '<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>',
//        'JQUERYUI'                   => '<script type="text/javascript" src="http://apps.bdimg.com/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>',
//        'BOOTSTRAP'                  => '<script type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js"></script>',
//        'BOOTSTRAP_DATETIMEPICKER'   => '<script type="text/javascript" src="http://cdnjscn.b0.upaiyun.com/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script>',
//        'JQUERY_VALIDATE'            => '<script type="text/javascript" src="http://cdnjscn.b0.upaiyun.com/libs/jquery-validate/1.12.0/jquery.validate.min.js"></script>',
//        'JQUERY_VALIDATE_ADDITIONAL' => '<script type="text/javascript" src="http://cdnjscn.b0.upaiyun.com/libs/jquery-validate/1.12.0/additional-methods.js"></script>',
        'JQUERY172'                  => '<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.min.js"></script>',
        'JQUERY_LAZYLOAD'            => '<script type="text/javascript" src="http://cdnjscn.b0.upaiyun.com/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>',
        'JQUERY_AJAXUPLOAD'          => '<script type="text/javascript" src="/Public/common/js/jquery.ajaxupload.js"></script>',
        'IFRAME_BOX'                 => '<script type="text/javascript" src="/Public/common/js/showBox/FenBox.js"></script>',
        'ZERO_CLIPBOARD'             => '<script type="text/javascript" src="/Public/common/js/zeroclipboard/ZeroClipboard.js"></script>',
        'COMMON'                     => '<script type="text/javascript" src="/Public/common/js/common.js"></script>',
        'JQUERY_FORM' 				 => '<script type="text/javascript" src="http://cdnjscn.b0.upaiyun.com/libs/jquery.form/3.50/jquery.form.js"></script>',
        'ICHECK'					 => '<script type="text/javascript" src="http://cdnjscn.b0.upaiyun.com/libs/iCheck/1.0.1/icheck.min.js"></script>',
        'ICHECK_CUSTOM'				 => '<script type="text/javascript" src="http://cdnjscn.b0.upaiyun.com/libs/iCheck/1.0.1/demo/js/custom.min.js"></script>',
        'JQPRINT'                    => '<script type="text/javascript" src="/Public/common/js/jquery.jqprint-0.3.js"></script>',
        'CHART'                      => '<script type="text/javascript" src="/Public/common/js/chart.min.js"></script>',
        'HTML5SHIV'				     => '<script type="text/javascript" src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>',
        'RESPOND'				     => '<script type="text/javascript" src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>',
    ),
    'MEDIA_CSS' => array(
        'BOOTSTRAP'       => '<link rel="stylesheet" type="text/css" href="/Public/common/bootstrap/css/bootstrap.css">',
        'FONT_AWESOME'    => '<link rel="stylesheet" type="text/css" href="/Public/common/font-awesome/css/font-awesome.css">',
//        'BOOTSTRAP'       => '<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/bootstrap/3.2.0/css/bootstrap.min.css">',
//        'FONT_AWESOME'    => '<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.2.0/css/font-awesome.min.css">',
        'JQUERYUI'        => '<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/jqueryui/1.9.2/themes/redmond/jquery.ui.theme.css">',
        'BASE'            => '<link rel="stylesheet" type="text/css" href="/Public/home/css/base.css">',
        'MODAL'           => '<link rel="stylesheet" type="text/css" href="/Public/home/css/modal.css">',
        'ACTIVITY_VOTE'   => '<link rel="stylesheet" type="text/css" href="/Public/home/css/activity-vote.css">',
        'ICHECK_SKIN_ALL' => '<link rel="stylesheet" type="text/css" href="http://cdnjscn.b0.upaiyun.com/libs/iCheck/1.0.1/skins/all.css">',
    )
);