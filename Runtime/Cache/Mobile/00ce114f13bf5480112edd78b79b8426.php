<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Keywords" content="社团邦,社团联盟商会组织管理工具APP软件,成员管理,活动发布,票务,会签,yunmai365">
    <meta name="Description" content="社团邦，为社团联盟商会组织而生的互联网管理工具APP软件。一款高效的社团活动、交流、组织、管理工具">
    <meta name="Author" content="社团邦" />
    <title><?php echo $meta_title; ?> - <?php echo C('APP_NAME'); ?></title>
    <!-- css -->
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
    <?php echo C('MEDIA_CSS.ICHECK_SKIN_ALL'); ?>
    <link rel="stylesheet" type="text/css" href="/Public/common/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/common/mobiscroll/css/mobiscroll.custom-2.6.2.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/mobile/css/article.css" />
    <style>
        .main img, img{display:block;max-width:100%;}
    </style>

    <!--JS-->
    <?php
 echo C('MEDIA_JS.JQUERY') .C('MEDIA_JS.BOOTSTRAP') .C('MEDIA_JS.JQUERY_LAZYLOAD') .C('MEDIA_JS.ICHECK') .C('MEDIA_JS.ICHECK_CUSTOM') .C('MEDIA_JS.JQUERY_VALIDATE') .C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL'); ?>
    <!-- datetimepicker js 加载 -->
    <script type="text/javascript" src="/Public/common/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/Public/common/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/Public/common/mobiscroll/js/mobiscroll.custom-2.6.2.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]> -->
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <!--[endif]-->
    <script type="text/javascript">
        $(document).ready(function(){
            //图片异步加载
            $("img").lazyload({
                effect : "fadeIn",
                threshold: 200
            });
        });
    </script>
</head>

    <body>
        <div class="container">
            <!-- 或不在APP中打开, 显示社团邦头 -->
            
<?php if(I('get.app') != 1): ?>
    <div class="row">
        <div class="top-copyright">
            <img src="/Public/mobile/images/topicon.png" class="pull-left">
            <div class="text-center">社团邦</div>
        </div>
    </div>
<?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <h3><?php echo $article_info['name']; ?><br><small>主题：<?php echo $subject_info['name'];?></small></h3>
                    <p class="f2 mb20"><?php echo date('Y-m-d H:i',$activity_info['start_time']);?>&nbsp;至&nbsp;<?php echo date('Y-m-d H:i',$activity_info['end_time']);?>&nbsp;&nbsp;<?php echo $org_name;?></p>
                    <?php echo htmlspecialchars_decode($article_info['content']);?>
                </div>
            </div>
            <div class="row mt20 mb40">
                <div class="col-xs-12">
                    <div class="pull-left">
                        <a class="f1">阅读&nbsp;<?php echo $activity_info['total_view']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </div>
                    <div class="pull-left"><span class="yunmaizan <?php echo ($activity_info['is_like'] > 0) ? 'active' : ''; ?>"></span></div>
                    <div class="pull-left" style="margin-left: 5px;"><a class="yunmaizan_count f1"><?php echo $activity_info['total_like']; ?></a></div>
                    <div class="pull-right">
                        <?php if(session('preview') == 0): ?>
                            <?php if(I('get.app') == 1): ?>
                                <a href="<?php echo U('Activity/report', array('aid'=>I('get.aid'), 'uid' =>I('get.uid')))?>" class="f1">举报</a>
                            <?php endif;?>
                        <?php else: ?>
                            <a href="javascript:void(0);" class="f1">举报</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
<!-- JiaThis Button BEGIN -->
<div class="row">
    <div class="jiathis_style_24x24 mb10 mt10">
        <a class="jiathis_button_qzone"></a>
        <a class="jiathis_button_tsina"></a>
        <a class="jiathis_button_tqq"></a>
        <a class="jiathis_button_weixin"></a>
        <a class="jiathis_button_renren"></a>
        <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
<!--        <a class="jiathis_counter_style"></a>-->
    </div>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
</div>
<!-- JiaThis Button END -->

<div class="row">
    <div class="text_footer text-center mt20 mb20">© 社团邦</div>
</div>
        </div>
        <?php if(session('preview') == 0 && I('get.app') == 1) :?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('.yunmaizan').click(function(){
                        var is_active = $(this).hasClass('active'),
                            is_like = 1;
                        if (is_active == true) {
                            var is_like = 0;
                        }
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo U('Activity/ajax_like', array('token' => I('get.token'))); ?>',
                            data: { aid: "<?php echo $activity_info['guid'] ?>", is_like: is_like},
                            dataType: 'json',
                            success: function(data) {
                                if(data.status == 'ok') {
                                    var count = $('.yunmaizan_count').text();
                                    if(is_active) {
                                        $('.yunmaizan').removeClass('active');
                                        $('.yunmaizan_count').text(parseInt(count)-1);
                                    } else {
                                        $('.yunmaizan').addClass('active');
                                        $('.yunmaizan_count').text(parseInt(count)+1);
                                    }
                                } else {
                                    alert(data.msg);
                                }
                            }
                        });
                    });
                });
            </script>
        <?php endif; ?>
    </body>
</html>