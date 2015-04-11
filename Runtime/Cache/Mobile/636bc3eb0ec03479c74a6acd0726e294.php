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
            <h3><?php echo $vote_info['name']?><br><small><?php echo $subject_info['name']?></small></h3>
            <p class="f2 mb20"><?php echo date('Y-m-d H:i',$activity_info['start_time']);?> 至 <?php echo date('Y-m-d H:i',$activity_info['end_time']);?>&nbsp;&nbsp;<?php echo $org_name?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p><?php echo $vote_info['content']?></p>
            <!--投票-->
            <form id="vote_form" action="<?php echo U('Activity/vote_process')?>" method="post">
                <input type="hidden" name="vid" value="<?php echo $vote_info['guid']?>">
                <input type="hidden" name="uid" value="<?php echo $user_guid?>">
                <div class="container votemain">
                    <div class="row"><p class="f1 mb0">以下选项为单选</p></div>

                    <?php $bar_colors = array('green', 'brown', 'cyan', 'orange', 'red'); $i=0;?>
                    <?php foreach($option_info as $o):?>
                        <?php if($i>4) $i=0;?>
                        <div class="row">
                            <div class="col-xs-12 radio pding5">
                                <label><div class="activity-vote-options"><input type="radio" name="option" value="<?php echo $o['guid']?>"></div><?php echo $o['content']?></label>
                            </div>
                            <?php if(!empty($o['pic_url'])):?>
                                <div class="col-xs-12">
                                    <img data-original="<?php echo get_image_path($o['pic_url'])?>" class="lazy img-thumbnail" />
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 pding5">
                                <div class="progress">
                                    <div class="progress-bar bar-<?php echo $bar_colors[$i]; ?>" role="progressbar" aria-valuenow="<?php echo $option_static[$o['guid']]['percent']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $option_static[$o['guid']]['percent']?>%;">
                                        <?php echo $option_static[$o['guid']]['sum']?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2 pding5"><?php echo $option_static[$o['guid']]['percent']?>%</div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </div>
                <script>
                    $(document).ready(function(){
                        $('input').iCheck({
                            checkboxClass: 'icheckbox_square-blue',
                            radioClass: 'iradio_square-blue',
                            increaseArea: '20%'
                        });
                    });
                </script>
                <!--投票-->
                <div id="error" class="row mt20" style="display: none;">
                    <div class="alert alert-danger"></div>
                </div>
                <!--投票-->
                <div class="row mb40">
                    <?php if(!isset($is_over)){?>
                        <?php if(!isset($is_vote)){?>
                            <div class="col-xs-5 col-xs-offset-7">
                                <button type="button" class="ym_submit btn btn-primary btn-block" <?php echo session('preview')==1 ? 'disabled' : ''; ?>>提交</button>
                            </div>
                        <?php }else{ ?>
                            <div class="col-xs-5 col-xs-offset-7"><button type="button" class="js-reload btn btn-primary btn-block">刷新</button></div>
                        <?php }?>
                    <?php }?>
                </div>
            </form>
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
        <a class="jiathis_counter_style"></a>
    </div>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
</div>
<!-- JiaThis Button END -->

<div class="row">
    <div class="text_footer text-center mt20 mb20">© 社团邦</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
		
    	$('.js-reload').click(function(){
    		location.reload() 
    	})
    	
        $('.ym_submit').click(function(){
            var option = $('input[name=option]:checked').val();
            if(!option){
                $('div#error').show();
                $('div#error div').text('您必须选择一个选项.');
                return false;
            }
            $('form#vote_form').submit();
        });
    });
</script>
<!-- End Save for Web Slices -->
</body>
</html>