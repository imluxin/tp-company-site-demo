<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>社团注册 - 社团邦</title>
    <meta name="keywords" content="社团邦社团注册，社团邦，云脉365，天津云脉三六五科技有限公司，即时通信，聊天APP，社团邦管理平台，人脉">
    <meta name="description" content="社团邦社团注册">
    <meta name="Author" content="云脉365" />
    <link rel="shortcut icon" href="/Public/common/images/favicon.ico" type="image/vnd.microsoft.icon">
    <!-- Bootstrap -->
    <link href="<?php echo PUBLIC_URL?>/common/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo PUBLIC_URL?>/common/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo PUBLIC_URL?>/home/css/register.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!--[if lt IE 9]>-->
    <!--<?php echo C('MEDIA_JS.HTML5SHIV'); ?>-->
    <!--<?php echo C('MEDIA_JS.RESPOND'); ?>-->
    <!--<![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
</head>
<body class="bodylg">
<!--<script src="<?php echo PUBLIC_URL?>/common/bootstrap/js/bootstrap.min.js"></script>-->
<div class="loginwrongtop">
    <div class="container">
        <div class="row">
            <div class="col-xs-7">
                <img src="<?php echo PUBLIC_URL?>/home/images/logoiph-w.png" alt="云脉365" class="" />
            </div>
            <div class="col-xs-5">
                <div class="pull-right top-jump">
                    <a class="toptext" href="http://www.yunmai365.com/" title="云脉365首页">云脉365首页</a> |
                    <a class="toptext" href="http://mp.yunmai365.com/auth/login" title="社团管理平台">社团管理平台</a> |
                    <a class="toptext" href="http://www.yunmai365.com/" title="云脉365首页">云脉365首页</a><!--  |
                    <a class="toptext" href="http://www.yunmai365.com/Upload/ym/apk/yunmai.apk" title="云脉365下载">云脉365下载</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container form-main">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="tishinr tishinr-success">
                    <h3 title="欢迎注册云脉365社团账号"><i class="fa fa-check-circle"></i> 注册成功!</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-sm-offset-2 registered-suc">
            <p class="fa"><h4  class="text-info">社团信息提交成功，云脉365审核人员会在七个工作日完成审核工作</h4></p>
            <p>恭喜您的 <span><?php echo $org_info['name']?></span> 账号注册成功</p>
            <p>您的登录账号为 <span><?php echo $org_info['email']?></span><br>联系人 <span><?php echo $org_info['contact_name']?></span><br>联系人电话 <span><?php echo $org_info['phone']?></span>
            </p>
            <p class="mb20">您可以返回云脉365官网继续浏览，或登录云脉365社团管理平台完善资料</p>
        </div>
        <div class="col-sm-5 col-sm-offset-2 btnmb">
            <a class="btn btn-default" href="http://www.yunmai365.com/">返回官网</a>
            <a class="btn btn-default" href="<?php echo U('Auth/login')?>">立即登录</a>
        </div>
    </div>
</div>
<!-- /container -->
<div class="loginfoot">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>邮箱：service#yunmai365.com <small>（如果你看到的是“#”请在发邮件时替换成“@”）</small><br>Q Q：550022365 电话：022-58654945</p>© 云脉365 津ICP备11001221号
            </div>
        </div>
    </div>
</div>
</body>
</html>