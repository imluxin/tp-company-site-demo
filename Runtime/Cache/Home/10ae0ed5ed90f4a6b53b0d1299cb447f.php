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
    <meta name="Keywords" content="社团邦,社团邦登录,社团联盟商会组织管理工具APP软件,成员管理,活动发布,票务,会签,yunmai365">
    <meta name="Description" content="社团邦，为社团联盟商会组织而生的互联网管理工具APP软件。一款高效的社团活动、交流、组织、管理工具">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <link rel="shortcut icon" href="/Public/common/images/favicon.ico" type="image/vnd.microsoft.icon">
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/common/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/auth.css" />
    
    <!-- JS -->
    <script type="text/javascript" src="/Public/common/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/common/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/common/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/Public/common/js/common.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="bodybg">
    <div class="loginwrongtop">
      <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <img src="<?php echo PUBLIC_URL?>/home/images/logoiph-w.png" alt="社团邦" class="" />
            </div>
            <div class="col-xs-8">
                <div class="pull-right toptext">
                    <a href="http://www.yunmai365.com/" title="<?php echo C('APP_NAME')?>"><?php echo C('APP_NAME')?></a> |
                    <a href="<?php echo U('Home/Auth/register', '', true, true); ?>" title="社团注册">社团注册</a> |
                    <a href="<?php echo U('Home/Auth/login', '', true, true); ?>" title="社团登录">社团登录</a> |
                    <a href="<?php echo U('Member/Auth/login', '', true, true); ?>" title="个人中心">个人中心</a><!--  |
                    <a href="javascript:void(0);" onclick="window.location='http://www.yunmai365.com/Upload/ym/apk/yunmai.apk'" title="社团邦下载">社团邦下载</a> -->
                </div>
            </div>
        </div>
        <div class="row text-center">
            <h1 class="h1-white" title="社团邦"><small>For the community </small><br>社团邦 | 社团管理平台</h1>
        	<!-- <img src="<?php echo PUBLIC_URL?>/home/images/loginerror.png" alt="<?php echo C('APP_NAME')?> | 社团管理平台" class="" /> -->
        </div>
      </div>
    </div>
    <?php $flash = get_flash_msg()?>
    <?php if (!empty($flash['msg'])) :?>
    <div id="login-alert" class="logintopwarning">
      <div class="container">
          <div class="logintopwarningwr">
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                <?php echo $flash['msg']?>
        <!--         <?php  ?>

<?php $flash = get_flash_msg()?>
<?php echo $flash['type'].$flash['msg']?> -->
              </div>
          </div>
      </div>
    </div>
    <?php endif; ?>
    
    <div class="container">
      <div class="form-horizontalwr">
      <div class="row loginwr">
        <form id="login-form" class="form-horizontal" role="form" method="post" action="<?php echo U('Auth/login');?>">
          <h2 title="社团邦登录">登录</h2>

            <div class="row rmb10">
                <div class="pull-left input-group btnlgwr">
                    <div class="input-group-addon lgaddon"><img width="17px" src="<?php echo PUBLIC_URL?>/home/images/denglur2.gif" alt="手机/邮箱" class=""></div>
                    <input type="text" name="username" autofocus class="form-control" id="username" placeholder="邮箱" autocomplete="off" />
                </div>
                <div class="pull-left row tishiwr"></div>
            </div>

            <div class="row rmb10">
                <div class="pull-left input-group btnlgwr">
                    <div class="input-group-addon lgaddon"><img width="17px" src="<?php echo PUBLIC_URL?>/home/images/denglum2.gif" alt="密码" class=""></div>
                    <input type="password" name="password" class="form-control" id="password" placeholder="密码" autocomplete="off" />
                </div>
                <div class="pull-left row tishiwr"><!--密码不能为空--></div>
            </div>

            
            <div class="row rmb20 btnlgwr">
                <div class="checkbox pull-left">
                    <label>
                        <input type="checkbox" name="remember" value="yes"> 记住账号
                    </label>
                </div>
                <button type="submit" class="btn btn-default btnlg pull-right">登录</button>
            </div>

            <div class="row">
            <div class="btnlgwr">
              <div class="pull-right color-c"><a href="<?php echo U('Auth/find_password'); ?>">忘记密码?</a> 还没有账号，<a href="<?php echo U('Auth/register'); ?>">立即注册</a></div>
                </div>
            </div>
            

        </form>
      </div>
      </div>
        <script type="text/javascript">
        $(document).ready(function(){

            ym_fadeout('login-alert');

//        	$.validator.addMethod("checkformat", function(value, element) {
//        	    //验证是否为邮箱
//        		if (this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test( value ) ) {
//        		     return true;
//           		}
//                // 验证是否为手机
//                if (this.optional( element ) || /^1[3|4|5|8][0-9]\d{4,8}$/.test(value)) {
//                    return true;
//                }
//          		return false;
//        	}, "手机/邮箱格式不正确");
        	
        	// 注册FORM验证
            $("#login-form").validate({
            	errorClass: "invalid",
                errorPlacement: function(error, element){
                    element.parent().parent().find('.tishiwr').html(error);
                },
                rules: {
                    username: {
                        required: true,
                        email: true,
                        remote: {
                            url: "<?php echo U('Auth/check?type=username');?>",
                            type: "post",
                            data: {
                              username: function() {
                                return $( "#username" ).val();
                              }
                            }
                          }
                    },
                    password: {
                        required: true,
                        rangelength: [6, 18]
                    }
                },
                messages: {
                	username: {
                        required: "邮箱不能为空.",
                        email: "邮箱格式不正确",
                        remote: "邮箱不存在"
                    },
                    password: {
                        required: "密码不能为空",
                        rangelength: "密码必须为6到18个字符"
                    }
                }
            });
        });
        </script>
    
    </div> <!-- /container -->
    
    <div class="loginbottomwr">
      <div class="container">
        <p class="pull-right"><?php echo C('COPYRIGHT')?></p>
      </div>
    </div>
<!-- End Save for Web Slices -->
  </body>
</html>