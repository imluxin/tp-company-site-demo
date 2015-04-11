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
    <?php echo C('MEDIA_FAVICON'); ?>
    <!-- css -->
    <?php
 echo C('MEDIA_CSS.BOOTSTRAP') .C('MEDIA_CSS.FONT_AWESOME') .C('MEDIA_CSS.ICHECK_SKIN_ALL'); ?>
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
            <h3><?php echo $signup_info['name']; ?><br><small>主题：<?php echo $activity_info['name']; ?></small></h3>
            <!-- <p class="f2 mb20">2015-02-14 15:00&nbsp;&nbsp;云脉三六五</p> -->
        </div>
    </div>

    <?php if(!empty($signup_info['poster']) && is_file(UPLOAD_PATH.$signup_info['poster'])) :?>
        <div class="row">
            <div class="col-md-12">
                <img data-original="<?php echo get_image_path($signup_info['poster'], 'postersimg.jpg')?>" class="lazy postersimg">
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-registration"><em title="活动简介" class="icon-col"></em><span>活动简介</span></div>
        <div class="col-md-12">
            
            <div><?php echo htmlspecialchars_decode($signup_info['content']); ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-registration"><em title="时间地点" class="icon-col icon-main"></em><span>时间地点</span></div>
        <div class="col-md-12">
            <div class="td-wd"><em title="时间" class="registration icon-time"></em><?php echo date('Y年m月d日 H:i',$activity_info['start_time']);?> ～ <?php echo date('Y年m月d日 H:i',$activity_info['end_time']);?></div>
            <div class="td-wd">
                <em title="地点" class="registration icon-place"></em><?php echo $address = $signup_info['areaid_1_name'].' '.$signup_info['areaid_2_name'].' '.$signup_info['address']?>
            </div>

            <img data-original="http://api.map.baidu.com/staticimage?height=100&zoon=14&copyright=1&markers=<?php echo $signup_info['lng'].','.$signup_info['lat']; ?>" class="lazy">
            <a class="btn btn-default" style="margin-top: 5px;width: 100%;"
               href="http://api.map.baidu.com/marker?location=<?php echo $signup_info['lat'].','.$signup_info['lng']; ?>&title=活动地点&content=<?php echo $address; ?>&output=html">点击导航</a>

        </div>
    </div>

    <?php if(!empty($flow)): ?>
        <div class="row">
            <div class="col-registration"><em title="活动流程" class="icon-col icon-process"></em><span>活动流程</span></div>
            <div class="col-md-12">
                <?php foreach($flow as $f): ?>
                    <div class="td-wd">
                        <div><?php echo $f['title']?></div>
                        <div><?php echo date('Y-m-d H:i', $f['start_time']); ?>～<?php echo date('Y-m-d H:i', $f['end_time']); ?></div>
                        <div><?php echo $f['content']?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if(!empty($undertaker)): ?>
        <div class="row">
            <div class="col-registration"><em title="承办机构" class="icon-col icon-take"></em><span>承办机构</span></div>
            <div class="col-md-12">
                    <?php foreach($undertaker as $u): ?>
                        <div class="td-wd"><?php echo C('ACTIVITY_UNDERTAKER')[$u['type']].': '.$u['name']; ?></div>
                    <?php endforeach; ?>
                <!-- <div class="td-wd"><em title="人数" class="registration icon-number"></em>限额100人</div> -->
            </div>
        </div>
    <?php endif; ?>

    <!-- 是否显示已经报名人员列表 -->
    <?php if($signup_info['show_front_list'] == 1): ?>
        <div class="row">
            <div class="col-registration"><em title="报名情况" class="icon-col icon-personnel"></em><span>报名情况</span></div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr><td colspan="2">已报名人数： <?php echo $user_count; ?></td></tr>
                    </thead>
                    <tbody id="user_list_body">
                        <tr><th>姓名</th><th>手机号码</th></tr>
                        <?php foreach($user_list as $u):?>
                            <tr>
                                <td><?php echo mb_substr($u['real_name'], 0, 1, 'UTF-8').'*'; ?></td>
                                <td><?php echo substr_replace($u['mobile'], '******', 3, 6); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php if($user_count > C('NUM_PER_PAGE', null, 10)):?>
                    <tfoot id="user_list_foot">
                        <tr><td colspan="2" class="text-center">
                                <a id="next_page" href="javascript:void(0);" title="下一页"><i class="fa fa-angle-double-down fa-2x"></i></a>
                                <input type="hidden" id="current_page_num" value="<?php echo I('get.p', 1);?>" />
                            </td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>


    
<!-- JiaThis Button BEGIN -->
<div class="row">
    <div class="bdsharebuttonbox">
        <style>.bdsharebuttonbox a{ float: right; }</style>
        <a href="#" class="bds_more" data-cmd="more"></a>
        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
        <span style="float: right; font-size: 16px; line-height: 41px; margin-right: 7px;">分享: </span>
    </div>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</div>
<!-- JiaThis Button END -->

<div class="row">
    <div class="text_footer text-center mt20 mb20">© 社团邦</div>
</div>

<style>
    .btn-link {
        padding: 6px 20px;
        margin-top: 10px;
        border: solid 1px ;
    }
    .btn-link:hover{

    }
</style>
    <div class="btn-position">
        <?php if($user_can_signup == false): ?> <!-- 报名人数已满-->
            <a href="javascript:void(0);" class="btn btn-signfull pull-right" disabled>报名人数已满<?php echo !empty($is_user_signed) ? ', 您已报名' : ''; ?></a><br />
            <?php if(!empty($is_user_signed)):?> <!-- 已报名-->
                <a class="btn btn-signcheck"
                        href="<?php echo U('Activity/signup_userinfo', array('aid' => $activity_info['guid'], 'token'=>I('get.token'), 'app' => I('get.app')))?>">查看报名信息</a>
            <?php endif; ?>
        <?php else: ?><!-- 报名人数未满-->
            <?php if(!empty($is_user_signed)):?> <!-- 已报名-->
                    <a class="btn btn-signcheck"
                       href="<?php echo U('Activity/signup_userinfo', array('aid' => $activity_info['guid'], 'token'=>I('get.token'), 'app' => I('get.app')))?>">查看报名信息</a><br />
            <?php else: ?>  <!-- 未报名-->
                <a class="btn btn-signup"
                   href="<?php echo U('Activity/signup_user', array('aid' => $activity_info['guid'], 'token'=>I('get.token'), 'app' => I('get.app')))?>">我要报名</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        /**
         * 下一页
         */
        var i_num = <?php echo isset($i) ? $i : 0; ?>;
        $('#next_page').click(function(){
            var current_page = $('#current_page_num').val();
            var next_page = parseInt(current_page)+1;

            $.ajax({
                url: '<?php echo U('Activity/ajax_signup_user_list', array('aid' => $activity_info['guid'])) ?>/p/'+next_page,
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){
                    $('#next_page').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                },
                success: function(data){
                    $('#next_page').html('<i class="fa fa-angle-double-down fa-2x"></i>');
                    if(data.status == 'ok'){
                        $('#current_page_num').val(next_page);
                        var html = '';
                        $.each(data.data, function(k, info){
                            html += '<tr>';
                            html += '<td>'+ info.real_name.substring(0, 1) +'*</td>';
                            html += '<td>'+ info.mobile.substring(0,3) + '******' + info.mobile.substring(9, 11) +'</td>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('#user_list_body').append(html);
                    }else if(data.status == 'ko'){
//                        alertTips($('#tips-modal'), data.msg);
                        $('tfoot#user_list_foot').remove();
                    } else if(data.status == 'nomore') {
//                        alertTips($('#tips-modal'), data.msg);
                        $('tfoot#user_list_foot').remove();
                    }
                }
            });
        });
    });
</script>
</body>
</html>