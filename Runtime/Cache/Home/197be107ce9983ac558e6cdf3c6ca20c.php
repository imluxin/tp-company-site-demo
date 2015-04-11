<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>社团注册 - 社团邦</title>
    <meta name="keywords" content="社团邦，社团注册，云脉365，天津云脉三六五科技有限公司，即时通信，聊天APP，社团邦管理平台，人脉">
    <meta name="description" content="社团邦，社团注册">
    <meta name="Author" content="云脉365" />
    <link rel="shortcut icon" href="/Public/common/images/favicon.ico" type="image/vnd.microsoft.icon">
    <!-- Bootstrap -->
    <link href="<?php echo PUBLIC_URL?>/common/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo PUBLIC_URL?>/common/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo PUBLIC_URL?>/home/css/register.css" rel="stylesheet">
    <script src="/Public/common/js/jcrop/js/jquery.min.js"></script>
    <?php echo C('MEDIA_JS.JQUERY_VALIDATE'); ?>
    <!--[if lt IE 9]>
    <?php echo C('MEDIA_JS.HTML5SHIV'); ?>
    <?php echo C('MEDIA_JS.RESPOND'); ?>
    <![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
</head>
<body class="bodylg">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo PUBLIC_URL?>/common/bootstrap/js/bootstrap.min.js"></script>
<div class="loginwrongtop">
    <div class="container">
        <div class="row">
            <div class="col-xs-7">
                <img src="<?php echo PUBLIC_URL?>/home/images/logoiph-w.png" alt="社团邦" class="" />
            </div>
            <div class="col-xs-5">
                <div class="pull-right top-jump">
                    <a class="toptext" href="http://www.yunmai365.com/" title="云脉365">云脉365</a> | 
                    <a class="toptext" href="<?php echo U('Home/Auth/register', '', true, true); ?>" title="社团注册">社团注册</a> |
                    <a class="toptext" href="<?php echo U('Home/Auth/login', '', true, true); ?>" title="社团登录">社团登录</a> |
                    <a class="toptext" href="<?php echo U('Member/Auth/login', '', true, true); ?>" title="个人中心">个人中心</a><!--  |
                    <a class="toptext" href="javascript:void(0);" onclick="window.location='http://www.yunmai365.com/Upload/ym/apk/yunmai.apk'" title="社团邦下载">社团邦下载</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container form-main">
    <div class="row">
        <div class="col-sm-12">
            <form role="form" class="form-horizontal main-form" action="<?php echo U('Auth/register');?>" method="post" id="registerForm">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="welcome" title="欢迎注册云脉365社团账号">欢迎注册社团邦 社团账号</h3>
                            <p>社团账号仅限web端登录，对社团成员及活动进行管理。</p><!-- 您可以绑定手机端账号，在手机端接收社团消息进行互动。 -->
                        </div>
                    </div>
                </div>

                <div class="forgottext">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-1">
                            <p class="forgot-list">账号信息</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="email"><span>* </span>邮箱：</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" name="email" id="email" placeholder="必填项">
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label"><span>* </span>设置密码：</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" id="password" placeholder="必填项">
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="form-group">
                    <label for="repassword" class="col-sm-2 control-label"><span>* </span>确认密码：</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="repassword" id="repassword" placeholder="必填项">
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="forgottext">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <p class="forgot-list">联系人信息</p>
                        </div>
                        <div class="col-sm-5 tishinr">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_name" class="col-sm-2 control-label"><span>* </span>联系人：</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="必填项">
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="col-sm-2 control-label"><span>* </span>手机：</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="必填项">
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="forgottext">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-1">
                            <p class="forgot-list">社团信息</p>
                        </div>
                    </div>
                    <div class="col-sm-5">
                    </div>
                </div>
                <div class="form-group">
                    <label for="org_name" class="col-sm-2 control-label"><span>* </span>社团名称：</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="org_name" id="org_name" placeholder="必填项">
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="form-group">
                    <label for="org_name" class="col-sm-2 control-label"><span>* </span>社团简介：</label>
                    <div class="col-sm-5">
                        <textarea type="text" value="" placeholder="必填项" class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="form-group">
                    <label for="area" class="col-sm-2 control-label"><span>* </span>所属区域：</label>
                    <div class="form-inline" role="form" id="area">
                        <div class=" pull-left col-sm-5">
                            <select class="form-control radius0 pull-left" name="areaid_1" id="area1" style="width: 160px;">
                                <option value=''></option>
                                <?php foreach ($area_1 as $v): ?>
                                <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                                <?php endforeach;?>
                            </select>
                            <div class="col-sm-1"></div>
                            <select class="form-control radius0" name="areaid_2" id="area2" style="width: 180px;">
                            </select>
                        </div>
                        <div class="pull-left tishinr"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">地址：</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control"  name="address" id="address">
                    </div>
                    <div class="col-sm-5 tishinr">
                    </div>
                </div>
                <div class="form-group">
                    <label for="verify" class="col-sm-2 control-label"><span>* </span>验证码：</label>
                    <div class="">
                        <div class="col-sm-5 form-inline pull-left">
                            <input type="text" name="verify" class="form-control input-verification" id="verify" placeholder="必填项">
                            <img id="verifyimg" onclick="refresh_verify()" class="verifyimg input-verification" src="<?php echo U('Auth/verify');?>">
                        </div>
                        <div class="col-sm-5 pull-left tishinr">
                        </div>
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"><a onclick="refresh_verify();">看不清?换一张</a></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-2">
                        <input type="checkbox" name="agree" checked/> 同意<a href="terms.html">《云脉365服务条款》</a>
                    </div>
                    <div class="col-sm-5 pull-right tishinr">
                    </div>
                </div>
                <div class="forgottext-bt">
                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-2">
                            <div class="pull-right">
                                <a class="forgot-password" href="<?php echo U('Auth/login'); ?>">登录 </a>
                                <input type="submit" class="btn btn-primary" value="立即注册">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="loginbottomwr">
          <p class="pull-right">Copyright &copy; 2014-2016 版权所有 天津云脉三六五科技有限公司</p>
       </div>
    </div>
</div>
<!-- /container -->
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
        $('#registerForm').validate({
            errorPlacement: function(error, element){
                element.parent().next('.tishinr').html(error);
            },
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote:{
                        url:"<?php echo U('Auth/ajax_check_email'); ?>",
                        type:'post'
                    }
                },
                contact_name: {
                    required: true
                },
                mobile: {
                    required: true,
                    isMobile: true,
                    remote: {
                        url:"<?php echo U('Auth/ajax_check_mobile'); ?>",
                        type: 'post'
                    }
                },
                password: {
                    required: true,
                    rangelength: [6, 18]
                },
                repassword: {
                    required: true,
                    equalTo: "#password"
                },
                org_name: {
                    required: true
                },
                agree: {
                    required: true
                },
                areaid_1: {
                    required: true
                },
                areaid_2: {
                    required: true
                },
                address: {
                    rangelength: [0,50]
                },
                description: {
                    required: true,
                    rangelength: [2,200]
                },
                verify: {
                    required: true,
                    rangelength: [4,4]
                }
            },
            messages: {
                email: {
                    required: "邮箱不能为空",
                    email: "邮箱格式不对",
                    remote:"该电子邮箱已存在"
                },
                contact_name: {
                    required: "联系人名字不能为空"
                },
                mobile: {
                    required: "手机号不能为空",
                    isMobile: "手机号输入不正确",
                    remote: "该手机号已存在"
                },
                password: {
                    required: "密码不能为空",
                    rangelength: "密码位数不得小于6位，不得多于18位"
                },
                repassword: {
                    required: "确认密码不能为空",
                    equalTo: "两次密码不一致"
                },
                org_name: {
                    required: "社团名称不能为空"
                },
                agree:  {
                    required: "请同意我们的条款."
                },
                areaid_1: {
                    required: "区域必须填写"
                },
                areaid_2: {
                    required: "区域必须填写"
                },
                address: {
                    rangelength: "社团地址不能多于50字"
                },
                description: {
                    required: "社团简介不能为空",
                    rangelength: "社团简介不能多于200字"
                },
                verify: {
                    required: "验证码不能为空",
                    rangelength: "验证码不是4位"
                }
            }
        });

        // 选择一级区域
        $('#area1').change(function(){
            var id1 = $(this).val();
            if(id1 == '') $('#area2').html('');
            $.ajax({
                type: 'POST',
                url: "<?php echo U('Auth/ajax_two_area')?>",
                data: {area1_id: id1},
                dataType: "json",
                success: function(data){
                    if(data.status=='ok'){
                        var html = '<option value=""></option>';
                        $.each(data.data, function(k, v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#area2').html(html);
                    }else{
                        $('#area2').text(msg);
                    }
                }
            });
        });

    });

</script>
</body>
</html>