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
    <?php echo C('MEDIA_JS.JQUERY'); ?>
    <?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_JS.JQUERY_LAZYLOAD'); ?>
    <?php echo C('MEDIA_JS.ICHECK'); ?>
    <?php echo C('MEDIA_JS.ICHECK_CUSTOM'); ?>
    <?php echo C('MEDIA_JS.JQUERY_VALIDATE'); ?>
    <?php echo C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL'); ?>
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
</head>
    <link href="/Public/mobile/css/topic.css" rel="stylesheet" type="text/css"/>
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
                <div class="subject_header">
                    <h4 class="subject_title text-center"><?php echo ($question_info["name"]); ?></h4>
                </div>

                <form method="post" id="form_topic" class="form-horizontal">
                    <?php if(is_array($topic_info)): $i = 0; $__LIST__ = $topic_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="container topic_list">
                            <div class="panel panel-default topic-list-item" data-type="<?php echo ($vo["type"]); ?>">
                              <div class="panel-heading"><?php echo ($vo["name"]); ?> <?php if(($vo["type"]) == "2"): ?>（多选）<?php endif; ?></div>
                              <ul class="list-group option-list">
                              <?php switch($vo["type"]): case "1": ?><input type="hidden" name="<?php echo ($vo["guid"]); ?>[type]" value="<?php echo ($vo["type"]); ?>" />
                                        <?php if(is_array($vo["option"])): $i = 0; $__LIST__ = $vo["option"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="list-group-item option-list-item icheckbox_div">
                                                <span class="col-xs-2"><input type="radio" name="<?php echo ($vo["guid"]); ?>[answer]" value="<?php echo ($v["guid"]); ?>" id="<?php echo ($v["guid"]); ?>"></span>
                                                <label for="<?php echo ($v["guid"]); ?>" class="col-xs-10"><?php echo ($v["option"]); ?></label>
                                            </li><?php endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "2": ?><input type="hidden" name="<?php echo ($vo["guid"]); ?>[type]" value="<?php echo ($vo["type"]); ?>" />
                                        <?php if(is_array($vo["option"])): $i = 0; $__LIST__ = $vo["option"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="list-group-item option-list-item icheckbox_div">
                                                <span class="col-xs-2"><input type="checkbox" name="<?php echo ($vo["guid"]); ?>[answer][]" value="<?php echo ($v["guid"]); ?>" id="<?php echo ($v["guid"]); ?>"></span>
                                                <label for="<?php echo ($v["guid"]); ?>" class="col-xs-10"><?php echo ($v["option"]); ?></label>
                                            </li><?php endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "3": ?><input type="hidden" name="<?php echo ($vo["guid"]); ?>[type]" value="<?php echo ($vo["type"]); ?>" />
                                         <li class="list-group-item option-list-item icheckbox_div">
                                            <span class="col-xs-12"><input type="text" class="form-control option-text" name="<?php echo ($vo["guid"]); ?>[answer]" /></span>
                                        </li><?php break;?>
                                    <?php case "4": ?><input type="hidden" name="<?php echo ($vo["guid"]); ?>[type]" value="<?php echo ($vo["type"]); ?>" />
                                         <?php if(is_array($vo["option"])): $i = 0; $__LIST__ = $vo["option"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="list-group-item option-list-item icheckbox_div">
                                                <span class="col-xs-12 option-tips"><?php echo ($v["option"]); ?></span>
                                                <label for="<?php echo ($v["oguid"]); ?>" class="col-xs-12"><input type="text" class="form-control option-text" name="<?php echo ($vo["guid"]); ?>[answer][]" /></label>
                                            </li><?php endforeach; endif; else: echo "" ;endif; break; endswitch;?>
                              </ul>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

                    <div class="container">
                        <?php if(session('preview') == 1): ?>
                            <button type="button" class="btn btn-primary topic-submit-btn">提交问卷</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-primary topic-submit-btn js-submit">提交问卷</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            
<!-- JiaThis Button BEGIN -->
<div class="row text-right">
    <div class="jiathis_style_24x24">
        <a class="jiathis_button_qzone"></a>
        <a class="jiathis_button_tsina"></a>
        <a class="jiathis_button_tqq"></a>
        <a class="jiathis_button_weixin"></a>
        <a class="jiathis_button_renren"></a>
        <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
        <a class="jiathis_counter_style"></a>
    </div>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
</div>
<!-- JiaThis Button END -->

<div class="row">
    <div class="text_footer text-center mb20">© 社团邦</div>
</div>
        </div>

		
		<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
		<script src="http://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="http://cdn.bootcss.com/iCheck/1.0.1/icheck.min.js" type="text/javascript"></script>
		<script src="/Public/mobile/js/topic.js" type="text/javascript"></script>
	</body>
</html>