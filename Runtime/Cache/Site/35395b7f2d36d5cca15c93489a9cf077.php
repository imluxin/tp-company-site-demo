<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo C('APP_NAME')?>-为社团而生</title>
    <meta name="Keywords" content="社团邦,社团联盟商会组织管理工具APP软件,成员管理,活动发布,票务,会签,yunmai365">
    <meta name="Description" content="社团邦，为社团联盟商会组织而生的互联网管理工具APP软件。一款高效的社团活动、交流、组织、管理工具">
    <meta name="author" content="<?php echo C('APP_NAME')?>" />
    <link rel="shortcut icon" href="/Public/site/images/favicon.ico" type="image/vnd.microsoft.icon">
    <!-- Bootstrap -->
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
    <link href="/Public/site/css/screen.css" rel="stylesheet">
    <link href="/Public/site/css/index.css" rel="stylesheet">
    <link href="/Public/site/css/component.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
	
	<script type="text/javascript">
	   var browser = {
            versions: function () {
                var u = navigator.userAgent, app = navigator.appVersion;
                var data = {
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                    iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
                    Blackberry: u.indexOf('Blackberry') > -1 //是否黑莓系统
                };
				return data;
            }(),
            language: (navigator.browserLanguage || navigator.language).toLowerCase()
        }
		if (browser.versions.ios == true || browser.versions.android == true || browser.versions.Blackberry == true) {
            window.location.href = "<?php echo U('Index/wap')?>";
        }
	</script>
</head>
<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<?php echo C('MEDIA_JS.JQUERY'); ?>
<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
<script src="/Public/site/js/jqueryTipsy.js"></script>
<script src="/Public/site/js/gototop.js"></script>
<script src="/Public/site/js/index.js"></script>

<!--返回头部的锚点-->
<div id="gototop">
    <a style="display: none;" class="totop totop01" href="#gototop" ><div>&nbsp;</div></a>
    <a style="display: none;" class="totop totop02" href="#gototop"><div>&nbsp;</div></a> </div>
<!-- body -->
<!-- header //style="display: none;"//-->
<div style="display:none;" class="yunmai-header">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <a href="http://www.yunmai365.com" title="社团邦"><img class="logo" src="/Public/site/images/logo.png" alt="社团邦"></a>
            </div>
            <div class="pull-right">
                <div class="navbar-yunmai-row">
                    <a class="btn btn-default" href="<?php echo U('Home/Auth/register', '', true, true); ?>" title="社团注册" target="_blank"><span>社团注册</span></a>
                    <a class="btn btn-default" href="<?php echo U('Home/Auth/login', '', true, true); ?>" title="社团登录" target="_blank"><span>社团登录</span></a>
                    <a class="btn btn-default" href="<?php echo U('Member/Auth/login', '', true, true); ?>" title="登录个人中心" target="_blank"><span>登录个人中心</span></a>
                    <a class="btn btn-default" id="topweixin"><i class="fa fa-weixin"></i></a>
                    <a class="btn btn-default" id="topweibo"><i class="fa fa-weibo"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--js-->
<script type="text/javascript">
    $(document).ready(function(){
        // 导航点击触发
        $('.to_next').click(function(){
            tonext = $(this).attr('tonext');
            $(".navwrap .nav[inx=" + tonext + "]").click();
            return false;
        });
        // 鼠标经过头像触发

        $('#topweixin').popover({
            content: '<div class="weixinsm">'
            +'<div class="text-center"><img src="/Public/site/images/erweima.jpg" alt="云脉365官方微信"></div>'
            +'<div class="text-center"><h5>云脉365官方微信</h5><h5>请扫描二维码并关注</h5></div>'
            +'</div>',
            html: true,
            placement: 'bottom',
            trigger: 'hover'
        });
        $('#topweibo').popover({
            content: '<div class="weixinsm">'
            +'<div class="text-center"><img src="/Public/site/images/erweibo.jpg" alt="云脉365官方微博"></div>'
            +'<div class="text-center"><h5>云脉365官方微博</h5><h5>请扫描二维码并关注</h5></div>'
            +'</div>',
            html: true,
            placement: 'bottom',
            trigger: 'hover'
        });
    });
</script>
<!--js结束-->
<!-- header -->
<div class="wrap">
    <div style="display: block;" class="navwrap">
        <div original-title="" class="nav nav_1 cur" inx="1"></div>
        <div original-title="" class="nav nav_2" inx="2"></div>
        <div original-title="" class="nav nav_3" inx="3"></div>
        <div original-title="" class="nav nav_4" inx="4"></div>
        <div original-title="" class="nav nav_5" inx="5"></div>
        <div original-title="" class="nav nav_6" inx="6"></div>
        <div original-title="" class="nav nav_7" inx="7"></div>
    </div>
    <div class="main">
        <!-- screen 01 -->
        <div class="item item_1 fp-item active" toinx='1'>
            <div class="container">
                <div class="row item_1_nav">
                    <div class="pull-left"><a href="http://www.yunmai365.com" title="<?php echo C('APP_NAME')?>"><img src="/Public/site/images/logo-white.png" alt="<?php echo C('APP_NAME')?>"></a></div>
                    <div class="pull-right mt5">
                      <a class="colorfff" href="<?php echo U('Home/Auth/register', '', true, true); ?>" title="社团注册" target="_blank">社团注册</a>
                      <a class="colorfff">&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                      <a class="colorfff" href="<?php echo U('Home/Auth/login', '', true, true); ?>" title="社团登录" target="_blank">社团登录</a>
                      <a class="colorfff">&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                      <a class="colorfff" href="<?php echo U('Member/Auth/login', '', true, true); ?>" title="登录个人中心" target="_blank">登录个人中心</a>
                    </div>
                </div>
            </div>
            <div class="logotopmt">
                <div class="container">
                    <div class="row text-center">
                        <div class="item1display"><a class="item1logo" title="社团邦">社团邦</a><a class="item1logo-sm" title="云脉365旗下">云脉365旗下</a></div>
                        <div class="item_1_text">
                            <h1 title="社团邦-国内第一款为社团而生的应用">国内第一款为社团而生的应用</h1>
                            <h2>The first app service for the community</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item_1_footer">
                <div class="text-center item_1_h50">
                    <a class="down_text to_next" href="javascript:void(0);" tonext='2'>VIEW MORE<br><i class="fa fa-chevron-down"></i></a>
                </div>
            </div>
        </div>
        <!-- screen 01 end -->
        <!-- screen 02 -->
        <div class="item item_2 fp-item" id="zhan" toinx='2'>
            <div class="textWrapper container">
               <div class="row">
                    <h1 class="text-center"><small><i class="fa fa-quote-left"></i></small> 为社团而生 <small><i class="fa fa-quote-right"></i></small></h1>
                </div>
            </div>
            <div class="container hi-icon-wrap hi-icon-effect-2">
                <a href="javascript:void(0);" tonext='3' class="to_next component" title="高效沟通">
                    <i class="hi-icon fa fa-comments"></i>
                    <span class="text">沟通</span>
                </a>
                <a href="javascript:void(0);" tonext='4' class="to_next component" title="社团管理">
                    <i class="hi-icon fa fa-th-large"></i>
                    <span class="text">管理</span>
                </a>
                <a href="javascript:void(0);" tonext='5' class="to_next component" title="拓展人脉">
                    <i class="hi-icon fa fa-user"></i>
                    <span class="text">人脉</span>
                </a>
                <a href="javascript:void(0);" tonext='6' class="to_next component" title="社团活动">
                    <i class="hi-icon fa fa-flag"></i>
                    <span class="text">活动</span>
                </a>
            </div>
        </div>
        <!-- screen 02 end -->
        <!-- screen 03 -->
        <div class="item item_3 fp-item" toinx='3'>
            <div class="textWrapper container">
                <div class="row">
                    <h1>精准定位 高效沟通</h1>
                    <p>不论生意上的伙伴，还是生活中的朋友</p>
                    <p>在社团邦畅所欲言</p>
                    <p>我们一同快乐的玩耍</p>
                    <!-- <a class="item_a_1"></a> -->
                    <a class="btn btn-default btn-lg" href="<?php echo U('Site/Index/application', '', true, true); ?>" title="社团邦下载">社团邦下载</a>
                </div>
            </div>
            <div class="imgWrapper">
                <img style="display: inline;" src="/Public/site/images/prodimg3.jpg" data-lazysrc="/Public/site/images/prodimg3.jpg" alt="高效沟通" width="1452" height="917">
            </div>
        </div>
        <!-- screen 03 end -->
        <!-- screen 04 -->
        <div class="item item_4 fp-item" toinx='4'>
            <div class="textWrapper right container">
                <div class="row">
                    <h1 title="社团">团队与个人 共成长</h1>
                    <p>在社团邦，社团和每一位成员紧紧相连</p>
                    <p>我们共组社团大家庭</p>
                    <a class="item_a_1" title="加入社团邦">想加入？</a>
                    <a href="http://mp.yunmai365.com/auth/register" title="免费注册社团邦社团账户" target="_blank">免费注册社团账户</a>
                </div>
            </div>
            <div class="imgWrapper">
                <img style="display: inline;" src="/Public/site/images/prodimg4.jpg" data-lazysrc="/Public/site/images/prodimg4.jpg" alt="社团管理" width="1305" height="944">
            </div>
        </div>
        <!-- screen 04 end -->
        <!-- screen 05 -->
        <div class="item item_5 fp-item" toinx='5'>
            <div class="textWrapper container">
                <div class="row">
                    <h1 title="人脉">拓展人脉 组建你的圈子</h1>
                    <p>实名注册——靠谱</p>
                    <p>多渠道获取人脉——广阔</p>
                    <p>按需查询——精准</p>
                    <p>快来组建属于你的圈子吧</p>
                </div>
            </div>
            <div class="imgWrapper">
                <img style="display: inline;" src="/Public/site/images/prodimg5.jpg" data-lazysrc="/Public/site/images/prodimg5.jpg" alt="拓展人脉" width="1647" height="1186">
            </div>
        </div>
        <!-- screen 05 end -->
        <!-- screen 06 -->
        <div class="item item_6 fp-item" toinx='6'>
            <div class="textWrapper container">
                <div class="row">
                    <h1 class="text-center">便捷高效 做你所想</h1>
                    <h2 class="text-center">在精彩的活动中，拉近社团成员的距离；在社团邦，收获属于你的精彩</h2>
                </div><!-- 讲座，文化，庆典，会议，交流，分享...，社团活动一网打尽<br> -->
            </div>
            <div class="container hi-icon-wrap hi-icon-effect-6">
                <div class="component">
                    <a class="hi-icon hi-icon-small"><i class="activity act1"></i></a>
                    <h4>文章</h4>
                </div>
                <div class="component">
                    <a class="hi-icon hi-icon-small"><i class="activity act2"></i></a>
                    <h4>讨论</h4>
                </div>
                <div class="component">
                    <a class="hi-icon hi-icon-small"><i class="activity act3"></i></a>
                    <h4>投票</h4>
                </div>
                <div class="component">
                    <a class="hi-icon hi-icon-small"><i class="activity act4"></i></a>
                    <h4>报名</h4>
                </div>
                <div class="component">
                    <a class="hi-icon hi-icon-small"><i class="activity act5"></i></a>
                    <h4>问卷</h4>
                </div>
                <div class="component">
                    <a class="hi-icon hi-icon-small"><i class="activity act6"></i></a>
                    <h4>未知</h4>
                </div>
            </div>
        </div>
        <!-- screen 06 end -->
        <!-- screen 07 -->
        <div class="item item_7 fp-item" toinx='7'>
            <div class="container  item_7_position">
                <div class="row">
                    <div class="col-md-6 col-lg-6 contactus_l">
                        <h3 class="mt0" title="社团邦">社团邦</h3>
                        <p>我们专注于社团APP开发，全力打造国内第一款为社团而生的应用。</p>
                        <p>云脉三六五旗下，充满创造力的团队！</p>
                        <p>我们专注高效，做社团最靠谱的小伙伴！</p>
                        <div class="lianxi">
                            <p><span class="add-ym add-email"></span><?php echo C('SERVICE_EMAIL')?> <small>（如果你看到的是“#”请在发邮件时替换成“@”）</small></p>
                            <p><span class="add-ym add-phone"></span><?php echo C('SERVICE_TEL')?></p>
                            <p><span class="add-ym add-qq"></span><?php echo C('SERVICE_QQ')?></p>
                            <p><span class="add-ym add-add"></span>天津市河东区十一经路万隆太平洋大厦</p>
                        </div>
                        <div class="item_7img">
                            <div class="pull-left"><img src="/Public/site/images/erweima.jpg" width="110" height="110" alt="云脉365官方微信"></div>
                            <div class="item_7img_weibo pull-left"><img src="/Public/site/images/erweibo.jpg" width="110" height="110" alt="云脉365官方微博"></div>
                        </div>

                    </div>
                    <div class="col-md-6 col-lg-5 col-lg-offset-1 contactus_r">
                        <form id="contact_form" role="form">
                            <div class="form-group">
                                <label for="exampleInputPassword1">姓名</label>
                                <input type="text" id="name" name="name" class="form-control input-sm" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">邮箱</label>
                                <input type="text" id="email" name="email" class="form-control input-sm" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">电话</label>
                                <input type="text" id="phone" name="phone" class="form-control input-sm" placeholder="Phone number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">信息</label>
                                <textarea name="content" id="content" class="form-control input-sm" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>验证码</label>
                                <div class="form-inline index-verify">
                                    <input type="text" id="verify" class="form-control input-sm input-verification" name="verify">
                                    <img id="verifyimg" class="verifyimg" onclick="refresh_verify()" src="<?php echo U('Index/verify');?>">
                                    <a onclick="refresh_verify();" style="cursor:pointer">看不清?换一张</a>
                                </div>
                            </div>
                            <button type="button" id="send" data-loading-text="Sending..."  class="btn btn-default" autocomplete="off">Send</button>
                        </form>
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

                            $(document).ready(function(){
                                $('#send').click(function(){
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo U('Index/ajax_submit_contact'); ?>",
                                        data: { name:$('#name').val(), email:$('#email').val(), phone:$('#phone').val(), content:$('#content').val(), verify:$('#verify').val() },
                                        dataType: "json",
                                    beforeSend: function(){
                                            $('#send').button('loading');
                                        },
                                    success: function(data){
                                            $('#send').button('reset');
                                            if (data.status=='ok') {
                                                refresh_verify();
                                                $('form#contact_form')[0].reset();
                                                $('#send').after('<div class="saveiconp ml5">'+data.msg+'</div>');
                                                $('.saveiconp').fadeOut(2000);
                                            } else {
                                                alert(data.msg);
                                            }
                                        }
                                    });

                            });
                            });
                        </script>
                        <script>
                            $('#verify').on('click', function () {
                                var $btn = $(this).button('loading')
                                // business logic...
                                $btn.button('reset')
                            })
                        </script>

                    </div>
                </div>
            </div>
            <!-- Foot Starting -->
            <div class="indexfooter">
                <div class="container">
                    <div class="row">
                        <div class="pull-right footer_textmax">
                            本站由 <a target="_blank" href="https://www.dnspod.cn/">DNSPOD</a> 提供 DNS 解析服务，开发协作工具由 <a target="_blank" href="https://worktile.com/">Worktile.com</a> 提供。<br>
                            © 云脉365&nbsp;&nbsp;津ICP备11001221号
                        </div>
                    </div>
                </div>
            </div>
            <!-- Foot Ending -->
        </div>
        <!-- screen 07 end -->
    </div>
</div>
</body>
</html>