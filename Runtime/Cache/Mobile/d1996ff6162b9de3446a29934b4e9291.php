<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>电子票</title>
    <?php echo C('MEDIA_FAVICON')?>
    <!-- Bootstrap -->
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <link rel="stylesheet" type="text/css" href="/Public/mobile/css/ticketonline.css" />
    <link href="css/ticketonline.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="ticket_body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="/Public/mobile/images/tickettop.png" class="ticket_img mt20">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ticket_main">
                    <h2>电子票</h2>
                    <img data-original="<?php echo U('Activity/signin_qrcode', array('tid' => $ticket_info['guid'])); ?>" class="lazy ticket_img_block">
                    <div class="community_information">
                        <h4><?php echo $activity_info['name']; ?><br><small><?php echo $org_name?></small></h4>
                    </div>
                    <div class="td-wd"><em title="时间" class="registration icon-time"></em><?php echo date('Y-m-d H:i', $activity_info['start_time']).'~'.date('Y-m-d H:i', $activity_info['end_time']); ?></div>
                    <div class="td-wd"><em title="地点" class="registration icon-place"></em><?php echo $signup_info['areaid_1_name'].' '.$signup_info['areaid_2_name'].' '.$signup_info['address']; ?></div>
                </div>
            </div>
        </div>
        <div class="row"><div class="col-md-12"><img src="/Public/mobile/images/ticketbat.png" class="ticket_img_foot"></div></div>
        <div class="row">
            <div class="col-md-12"><img src="/Public/mobile/images/ticketfooter.png" class="ticket_img"><div class="text_copyright">有效票务</div></div>
        </div>
    </div>
    <div class="text_footer">© <?php echo C('APP_NAME')?></div>
<!-- End Save for Web Slices -->
<?php
echo C('MEDIA_JS.JQUERY') .C('MEDIA_JS.BOOTSTRAP') .C('MEDIA_JS.JQUERY_LAZYLOAD') ?>
<script type="text/javascript">
$(document).ready(function(){
    //图片异步加载
    $("img").lazyload({
        effect : "fadeIn",
        threshold: 200
    });
});
</script>
</body>
</html>