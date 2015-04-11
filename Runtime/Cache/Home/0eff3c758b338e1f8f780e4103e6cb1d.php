<?php if (!defined('THINK_PATH')) exit(); ?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>404</title>
    <!-- Bootstrap -->
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
    <link rel="stylesheet" type="text/css" href="/Public/home/css/base.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bodybg">
<?php echo C('MEDIA_JS.JQUERY'); ?>
<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
<script type="text/javascript" src="/Public/common/js/common.js"></script>
<!-- Main Starting -->
<div class="container">
    <div class="row bg404">
        <div class="col-xs-6 col-xs-offset-5">
            <h1 class="text404">404！</h1>
            <ul class="jumph">
                <li>What？被绑票了！</li>
                <li>网页君去火星出差了</li>
                <li>雾霾太大啥都看不到了。</li>
                <li>你输入了错误的网址？</li>
            </ul>
            <h3>火星太危险，赶紧回地球吧.</h3>
            <a type="button" class="btn btn-primary btn-lg mt20" href="<?php echo U('Index/index')?>">返回首页</a>
        </div>
    </div>
    <div class="row text-center mt30">
        Copyright © 2014-2016 版权所有 天津云脉三六五科技有限公司
    </div>
</div>
</body>
</html>