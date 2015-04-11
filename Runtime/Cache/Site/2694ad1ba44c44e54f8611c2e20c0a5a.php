<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>申请下载-<?php echo C('APP_NAME')?></title>
    <meta name="Keywords" content="社团邦,社团联盟商会组织管理工具APP软件,成员管理,活动发布,票务,会签,yunmai365">
    <meta name="Description" content="社团邦，为社团联盟商会组织而生的互联网管理工具APP软件。一款高效的社团活动、交流、组织、管理工具">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <?php echo C('MEDIA_FAVCION'); ?>
    <!-- Bootstrap -->
    <?php
 echo C('MEDIA_CSS.BOOTSTRAP') .C('MEDIA_CSS.FONT_AWESOME'); ?>
    <link href="/Public/home/css/register.css" rel="stylesheet">

    <?php echo C('MEDIA_JS.JQUERY').C('MEDIA_JS.JQUERY_VALIDATE'); ?>
    <!--[if lt IE 9]>
    <?php echo C('MEDIA_JS.HTML5SHIV'); ?>
    <?php echo C('MEDIA_JS.RESPOND'); ?>
    <![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
</head>
  <body class="bodylg">
<div class="loginwrongtop">
    <div class="container">
        <div class="row">
            <div class="col-xs-7">
                <img src="/Public/home/images/logoiph-w.png" alt="社团邦" class="" />
            </div>
            <div class="col-xs-5">
                <div class="pull-right top-jump">
                    <a class="toptext" href="<?php echo U('Index/index'); ?>" title="<?php echo C('APP_NAME')?>"><?php echo C('APP_NAME')?></a> |
                    <a class="toptext" href="<?php echo U('Home/Auth/register', '', true, true); ?>" title="社团注册">社团注册</a> |
                    <a class="toptext" href="<?php echo U('Home/Auth/login', '', true, true); ?>" title="社团登录">社团登录</a> |
                    <a class="toptext" href="<?php echo U('Member/Auth/login', '', true, true); ?>" title="个人中心">个人中心</a>
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
            <h3><i class="fa fa-check-circle"></i> 成功提交申请!</h3>
          </div>
        </div>
    </div>
    <div class="col-sm-8 col-sm-offset-2 registered-suc">
      <p>您的 下载申请 已经成功提交</p>
      <p>申请人  <span><?php echo substr($app_application_info['name'],0,3).'**';?>
      </span><br>联系电话 <span><?php echo substr($app_application_info['mobile'],0,3).'******'.substr($app_application_info['mobile'],9,11);?></span>
      </p>
      <p class="mb20">社团邦工作人员会在7个工作日内进行审核，审核通过后, 会以邮件的形式给您发送下载连接, 感谢您的支持。</p>
    </div>
    <div class="col-sm-5 col-sm-offset-2 btnmb">   
        <a class="btn btn-default" href="<?php echo U('Index/index')?>">返回社团邦</a>
    </div> 
  </div>
</div>



<!-- /container -->
<div class="container">
    <div class="row">
        <div class="loginbottomwr">
          <p class="pull-right">Copyright &copy; 2014-2016 版权所有 天津云脉三六五科技有限公司</p>
       </div>
    </div>
</div>

</body>
</html>