<?php if (!defined('THINK_PATH')) exit();?>
<?php
 ?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>社团邦登录-<?php echo C('APP_NAME')?></title>
    <meta name="Keywords" content="社团邦,密码找回,社团联盟商会组织管理工具APP软件,成员管理,活动发布,票务,会签,yunmai365">
    <meta name="Description" content="社团邦，为社团联盟商会组织而生的互联网管理工具APP软件。一款高效的社团活动、交流、组织、管理工具">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <link rel="shortcut icon" href="/Public/common/images/favicon.ico" type="image/vnd.microsoft.icon">
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/common/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/auth.css" />
    
    <!-- JS -->
    <script type="text/javascript" src="/Public/common/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/common/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/common/js/common.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="bodylg">
    <div class="container">
      <div class="row loginr">
        <div class="col-lg-8 col-md-7 col-xs-12">
          <div class="loginrow">
    		    <h1 class="login-title">欢迎登陆  社团邦</h1>
    		    <h4 class="login-desc">管理您的社团和更多精彩，获取社员动态实时更新，在活动中拉近距离，把彼此相连</h4>
            <div>请使用<a href="http://dow2.pc6.com/cz1/chrome.zip">Chrome（谷歌）浏览器</a>登录，以保证享受最佳体验</div>
          </div>
        </div>
        <div class="col-lg-4 col-md-5 col-xs-10"><div class="form-horizontallg">
          <h2 class="form-signin-heading">登录</h2>
          <form class="form-horizontal" role="form" action="<?php echo U('Auth/login');?>" method="post">
            <div class="form-group">
              <div class="col-xs-12">
                <div class="input-group btnlgwr">
                  <div class="input-group-addon lgaddon"><img width="17px" src="<?php echo PUBLIC_URL?>/home/images/denglur2.gif" alt="手机/邮箱" class=""></div>
                  <input name="username" type="text" autofocus autocomplete="off" class="form-control" id="inputEmail3" placeholder="邮箱" value="" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <div class="input-group btnlgwr">
                  <div class="input-group-addon lgaddon"><img width="17px" src="<?php echo PUBLIC_URL?>/home/images/denglum2.gif" alt="密码" class=""></div>
                  <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="密码" autocomplete="off" value="" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember" value="yes"> 记住账号
                  </label>
                </div>
              </div>
              <div class="col-xs-8"><div class="pull-right">
                <button type="submit" class="btn btn-default btnlg">登录</button>
              </div></div>
            </div>
            <div class="pull-right color-c"><a href="<?php echo U('Auth/find_password'); ?>">忘记密码?</a> 还没有账号，<a href="<?php echo U('Auth/register'); ?>">立即注册</a></div>
          </form>
        </div></div> 
      </div>
    </div>
    
    <div class="loginbottom">
      <div class="container">
        <p class="pull-right"><?php echo C('COPYRIGHT')?></p>
      </div>
    </div>
<!-- End Save for Web Slices -->
  </body>
</html>