<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $meta_title; ?> - <?php echo $app_name; ?></title>
    <!-- Bootstrap -->
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
    <link rel="stylesheet" type="text/css" href="/Public/home/css/sign-up.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/sign-in.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container sigin-in-main">
    <div class="form-horizontalwr">
        <div class="row">
            <div class="col-xs-3 mt30">
                <img src="/Public/common/images/shield.jpg">
            </div>
            <div class="col-xs-9">

                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="page-header" title="<?php echo $app_name; ?>管理账户充值"><?php echo $app_name; ?>管理账户充值</h3>
                        <p>为了保障社团邦用户的权益及账号安全，我们暂时不开放自助充值。请联系客服，感谢您的支持！</p>
                    </div>
                    <div class="col-xs-8">
                        <h4><strong>充值价格</strong></h4>
                        <div class="sigin-in-table">
                            <table class="table">
                                <thead>
                                <tr class="tr-bgcolor">
                                    <td>短信</td>
                                    <td>邮件</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="sigin-in-other-bg">
                                    <td>10条/元</td>
                                    <td>1000封/3元</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4><strong>收款方式</strong></h4>
                        <a class="copy-account"><?php echo $app_name; ?>支付宝账户：service@yunmai365.com</a> <a data-clipboard-text="service@yunmai365.com" class="copy-button" title="复制账户" href="javascript:void(0);">复制账户</a>
                        <h4 class="mt30"><strong>联系方式</strong></h4>
                            <p>电话：022-58654945 QQ：550022365
                                <br>邮箱：service#yunmai365.com <small>（如果你看到的是“#”请在发邮件时替换成“@”）</small>
                            </p>
                        <input type="button" name="close" class="btn btn-danger" value="关闭" onclick="window.close();"/>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php echo C('MEDIA_JS.JQUERY'); ?>
<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
<?php echo C('MEDIA_JS.ZERO_CLIPBOARD'); ?>
<?php echo C('MEDIA_JS.COMMON'); ?>
</body>
</html>