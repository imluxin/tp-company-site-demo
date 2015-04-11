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

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h3 class="welcome" title="社团邦APP下载申请">社团邦APP下载申请</h3>
              <p>社团邦暂时不开放公共下载，如有需求，请如实填写以下信息，社团邦工作人员会在7个工作日内与您取得联系。感谢您的支持。</p>
            </div>
          </div>
        </div>
        <form role="form" class="form-horizontal main-form" id="application_form" method="post" action="<?php U('Index/application')?>">
        <div class="forgottext">
          <div class="form-group">
            <div class="col-sm-6 col-sm-offset-1">
                <p class="forgot-list">申请人信息</p>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label"><span>* </span>姓名：</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="name" placeholder="必填项" name="name">
          </div>
          <div class="tishinr tishinr-success"></div>
        </div>
        <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label"><span>* </span>手机：</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" maxlength="11" name="mobile" id="mobile" placeholder="必填项">
          </div>
          <div class="tishinr tishinr-success"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="email"><span>* </span>邮箱：</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="email" placeholder="必填项" name="email">
          </div>
          <div class="tishinr"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="company"><span>* </span>公司：</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="company" placeholder="必填项" name="company">
          </div>
          <div class="tishinr"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="duties"><span>* </span>职务：</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="duties" placeholder="必填项" name="duties">
          </div>
          <div class="tishinr"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="reason"><span>* </span>申请原因：</label>
          <div class="col-sm-5">
            <textarea class="form-control resize-none" rows="3" id="reason" rows="3" placeholder="请说明为什么申请下载社团邦" name="reason"></textarea>
<!--             <input type="text" class="form-control" id="reason" rows="3" placeholder="请说明为什么申请下载社团邦" name="reason"> -->
          </div>
          <div class="tishinr"></div>
        </div>
        <div class="form-group">
          <label for="verify" class="col-sm-2 control-label"><span>* </span>验证码：</label>
          <div class="col-sm-5 form-inline index-verify">
              <input style="width: 120px;" type="text" name="verify" maxlength="4" class="form-control pull-left" id="verify" placeholder="必填项">
              <img id="verifyimg" onclick="refresh_verify()" class="verifyimg" src="<?php echo U('Index/verify');?>">
              <a onclick="refresh_verify();" style="cursor:pointer">看不清?换一张</a>
          </div>
          <div class="tishinr pull-left"></div>
        </div>
        <div class="form-group">
          <div class="col-sm-5 col-sm-offset-2">
            <input type="checkbox" name="agree" checked/> 已阅读并同意<a href="#" class="reg-terms">《云脉365服务协议》</a>
          </div>
          <div class="tishinr pull-left"></div>
        </div>
        <div class="forgottext-bt">
          <div class="form-group">
            <div class="col-sm-5 col-sm-offset-2">
              <div class="pull-right">
                <a class="forgot-password" href="http://www.yunmai365.com/"><input type="button" onclick="" class="btn btn-primary" value="返回"></a>
                <input type="submit" class="btn btn-primary" value="提交申请">
              </div>
            </div>
          </div>
        </div>

      </form>
    </div> 
  </div>
</div>

<!-- End Save for Web Slices -->
<script type="text/javascript">
    //刷新验证码
    function refresh_verify(){
        var verifyimg = $(".verifyimg").attr("src");
        if( verifyimg.indexOf('?')>0){
            $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
        }else{
            $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
        }
    }

    //validate自定义验证手机号
    jQuery.validator.addMethod("isMobile", function(value, element){
        var length = value.length;
        return this.optional(element) || length == 11 && /^1[358]\d{9}$/.test(value);
    }, "请填写正确的手机号码");


    $(document).ready(function () {

        //表单验证
        $('#application_form').validate({
            errorPlacement: function(error, element){
                element.parent().next('.tishinr').html(error);
            },
            rules: {
                name: {
                    required: true,
                    rangelength: [1,15]
                },
                mobile: {
                    required: true,
                    isMobile: true
                },
                email: {
                    required: true,
                    email: true
                },
                company: {
                    required: true,
                    rangelength: [1,30]
                },
                duties: {
                    required: true,
                    rangelength: [1,15]
                },
                reason: {
                    required: true,
                    rangelength: [1,60]
                },
                verify: {
                    required: true,
                    rangelength: [4,4],
                    remote: {
                        url: "<?php echo U('Index/check_verify')?>",
                        type: "post",
                        data: {
                            check_verify:function(){return $('#verify').val()}
                        }
                    }
                },
                agree: {
                    required: true
                }
            },
            messages: {
                
                name: {
                    required: "申请人名字不能为空",
                    rangelength: "姓名不超过15字"
                },
                mobile: {
                    required: "手机号不能为空",
                    isMobile: "手机号输入不正确"
                },
                email: {
                    required: "邮箱不能为空",
                    email: "邮箱格式不对"
                },
                company: {
                    required: "申请人公司不能为空",
                    rangelength: "申请人公司名称过长"
                },
                duties: {
                    required: "申请人职务不能为空",
                    rangelength: "申请人职务名称过长"
                },
                reason: {
                    required: "申请原因不能为空",
                    rangelength: "申请原因过长"
                },
                verify: {
                    required: "验证码不能为空",
                    rangelength: "验证码不是4位",
                    remote: "验证码不正确"
                },
                agree: {
                    required: "请阅读云脉365协议"
                }
            }
        });
    });

</script>



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