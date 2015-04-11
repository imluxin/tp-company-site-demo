<?php if (!defined('THINK_PATH')) exit(); ?>

<!DOCTYPE html>
<html>
    <!-- head -->
    <?php  ?>
<head>
    <meta charset="UTF-8">
        
    <!-- css 文件 -->
    <?php
 echo C('MEDIA_CSS.JQUERYUI') .C('MEDIA_CSS.BOOTSTRAP') .C('MEDIA_CSS.FONT_AWESOME') .C('MEDIA_CSS.BASE') .C('MEDIA_CSS.MODAL') .C('MEDIA_CSS.ACTIVITY_VOTE'); ?>
    
    <title><?php echo C('APP_NAME'); if(!empty($meta_title)): ?>- <?php echo ($meta_title); endif; ?></title>
    <meta name="keywords" content="社团邦，云脉365，天津云脉三六五科技有限公司，即时通信，聊天APP，社团管理平台，人脉">
    <meta name="description" content="社团邦，社团管理平台">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <?php echo C('MEDIA_FAVICON')?>

    <!-- 加载JS文件 -->
    <?php  ?>

<!-- js 文件 -->
<?php
echo C('MEDIA_JS.JQUERY') .C('MEDIA_JS.JQUERYUI') .C('MEDIA_JS.BOOTSTRAP') .C('MEDIA_JS.JQUERY_VALIDATE') .C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL') .C('MEDIA_JS.JQUERY_LAZYLOAD') .C('MEDIA_JS.JQUERY_AJAXUPLOAD') .C('MEDIA_JS.IFRAME_BOX') .C('MEDIA_JS.ZERO_CLIPBOARD') .C('MEDIA_JS.COMMON'); ?>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
    
	<body class="bodybg">
       <!-- 顶部导航栏 -->
	   <?php  ?>

<!-- Head Starting -->   
<div class="header">
  <div class="container">
    <div class="row">
      <div class="col-xs-7">
        <p class="topwd">社团邦 | 社团管理平台 <small style="color: #ccc;">Preview 1.0</small></p>
      </div>
      <div class="col-xs-5">
        <div class="pull-right">
            <div class="row">
                <div class="headicon">
                    <a href="<?php echo U('Org/info')?>">
                        <img id="top_logo" data-original="<?php echo get_image_path($auth['org_logo'])?>" class="lazy headicon">
                    </a>
                </div>
                <div class="ligeticon">
                    <a href="<?php echo U('Message/index')?>" class="pull-left" title="消息管理"><i class="fa fa-comment"></i></a>
                    <span class="mybadge"><?php echo !empty($new_msg_count)?'1':null; ?></span>
                </div>
                <div class="ligeticon mt3 mr5">
                    <a class="user_logout" href="<?php echo U('Auth/logout')?>" title="退出登陆"><i class="fa fa-power-off"></i></a>
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- Head Ending --> 
         
       
       <!-- 主体 -->
	   <div class="container">
	       <div class="row main">
	           <div class="col-xs-2 main-left">
	               <?php  ?>

<!-- 左边导航 -->
<div class="row">
    <ul class="nav nav-pills nav-stacked left-menu" role="tablist">
      <li role="presentation" class="left-menu-home <?php echo in_array(CONTROLLER_NAME, array('Index'))?'left-menu-home-active':''?>">
        <a href="<?php echo U('Index/index')?>"><i class="fa fa-home fa-4x"></i></a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Org'))?'active':''?>">
        <a href="<?php echo U('Org/info')?>">
          <i class="fa fa-cog fa-2x"></i><br>
          <label class="mt10">基本信息</label>
        </a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Message'))?'active':''?>">
        <a href="<?php echo U('Message/index')?>">
          <i class="fa fa-comments fa-2x"></i><br>
          <label class="mt10">消息管理</label>
        </a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Member'))?'active':''?>">
        <a href="<?php echo U('Member/index')?>">
          <i class="fa fa-user fa-2x"></i><br>
          <label class="mt10">社员管理</label>
        </a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Activity'))?'active':''?>">
        <a href="<?php echo U('Activity/index')?>">
          <i class="fa fa-flag fa-2x"></i><br>
          <label class="mt10">活动管理</label>
        </a>
      </li>
    </ul>
</div>
<div class="leftbarlast"></div>

	           </div>
	           <div class="col-xs-10 main-right">
                    <link rel="stylesheet" type="text/css" href="/Public/home/css/message-list.css" />
<div class="ymtitle">
    消息管理 >> <a href="<?php echo U('Message/index')?>" class="h5title" title="消息列表">消息列表</a>
    >> <a href="#" class="h5title" title="消息列表">消息详情</a>
</div>
<div class="ymnaw">
    <ul class="nav nav-tabs ymbtn" role="tablist">
        <li role="presentation" class="active">
            <a href="<?php echo U('Message/index')?>">消息列表</a>
        </li>
        <li role="presentation">
            <a href="<?php echo U('Notice/index')?>">通知列表</a>
        </li>
    </ul>
</div>
<!--右侧主体开始-->
<div class="rightmain">
    <div class="btn-group width798 pdlf10">
        <div class="pull-left">
            <h5>与 
                <nameo>
                  <?php echo $u_info['real_name']?>
                </nameo>
                的聊天
            </h5>
        </div>
        <div class="pull-right">
            <a href="<?php echo U('Message/index')?>"><i class="fa fa-arrow-left"></i> 消息列表</a>
        </div>
    </div>
    <div class="message-list mt10">
        <?php $now_day = '';$last_day=''; $auth = session('auth'); ?>
        <?php foreach ($list as $k => $l) :?>
		<!--时间分割线 begin-->
		<?php $now_day = date('Y-m-d', $l['created_at']);?>
        <?php if ($k == '0'):?>
        <div class="row timebox">
            <div class="timeline">
                <div class="pull-left timebg">
                    <a href="#" class="ml5 mr5">
                        <nameh>
                            <?php echo $now_day?>
                        </nameh>
                    </a>
                </div>
            </div>
        </div>
        <?php else: ?>
        <?php if ($now_day != $last_day):?>
        <div class="row timebox">
            <div class="timeline">
                <div class="pull-left timebg">
                    <a href="#" class="ml5 mr5">
                        <nameh>
                            <?php echo $now_day?>
                        </nameh>
                    </a>
                </div>
            </div>
        </div>
        <?php endif;?>
        <?php endif;?>
		<!--时间分割线 end-->
        <?php  $type='2'; if ($l['from_guid'] == $auth['org_guid']) { $type = '1'; } ?>
			
		<!--消息内容 begin-->	
        <?php if ($type=='2'):?>
        <div class="row details">
            <div class="pull-left">
                <a href="#"><img data-original="<?php echo get_image_path($l['from_photo'])?>" alt="" class="lazy img56"></a>
				<img src="/Public/home/images/bleft.png" alt="" class="imgb ml5" />
            </div>
            <div class="pull-left detailsbg">
                <div class="row margin0">
                    <a href="#" class="blacknm pull-left">
                        <nameo>
                            <?php echo $l['from_name']?>
                        </nameo>
                    </a>
                    <p class="pull-left ml12 m0">
                        <?php echo mdate($l['created_at'])?>
                    </p>
                </div>
                <div class="row margin0">
                    <p class="m0">
                        <?php echo $l['content']?>
                    </p>
                </div>
            </div>
            <div class="pull-left dl-details">
                <a class="ym_del" href="javascript:void(0);"
                   url="<?php echo U('Message/del', array('guid'=>$l['guid']))?>"><i class="fa fa-times fa-2x"></i></a>
            </div>
        </div>
        <?php else:?>
        <div class="row details">
            <div class="pull-right">
                <img src="/Public/home/images/bright.png" alt="" class="imgb mr5">
                <a href="#"><img data-original="<?php echo get_image_path($l['from_photo'])?>" alt="" class="lazy img56"></a>
            </div>
            <div class="pull-right detailsbg detailsbg-r">
                <div class="row margin0">
                    <p class="pull-right m0">
                        <?php echo mdate($l['created_at'])?>
                    </p>
                    <a href="#" class="blacknm pull-right mr12">
                        <nameb>
                            我
                        </nameb>
                    </a>
                </div>
                <div class="row margin0">
                    <p class="m0 text-right">
                        <?php echo $l['content']?>
                    </p>
                </div>
            </div>
            <div class="pull-right dl-details">
                <a class="ym_del" href="javascript:void(0);" 
                    url="<?php echo U('Message/del', array('guid'=>$l['guid']))?>"><i class="fa fa-times fa-2x"></i></a>
                <?php if($l['sdk_msg_status'] == '0'): ?>
                    <br />
                    <a class="resend" guid="<?php echo $l['guid']; ?>" href="javascript:void(0);"><i class="fa fa-refresh fa-2x"></i></a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif;?>
		<!--消息内容 end-->	
		
       
		<?php $last_day = date('Y-m-d', $l['created_at']);?>
        <?php endforeach; ?>
    </div>
    <div class="btn-group width798 pdlf10">
        <div class="pull-right message-reply">
            <a href="javascript:void(0);" id="send_msg"><i class="fa fa-reply"></i> 回复</a>
        </div>
    </div>
    <div class="btn-group mb40">
        <?php echo $page; ?>
    </div>
</div>
<!--右侧主体结束-->

<script type="text/javascript">
$(document).ready(function(){
	
	// 发送消息
	$("#send_msg").click(function(){
        $.showBox({
        'src'   : "<?php echo U('Message/reply', array('to_guid'=>$u_info['guid']))?>",
        'width': 680,
        'height': 400,
       // 'data'  : "Say hello to your father",
        'success':function(data){
            alert(data);
        }
        }); 
    });

    $('.resend').click(function(){
        if($(this).hasClass('fa-spin')) {
            return false;
        }
        var ele = $(this);
        var guid = ele.attr('guid');
        $.ajax({
            type: "GET",
            url: "<?php echo U('Message/resend')?>",
            data: { guid: guid},
            dataType: "json",
            beforeSend: function(){
                ele.find('.fa').addClass('fa-spin');
            },
            success: function(data){
                if (data.status=='ok') {
                    ele.text('发送成功').fadeOut(1000);
                } else if (data.status=='ko') {
                    console.log(data.status);
                    alert('发送失败, 请稍侯重试!');
//                    ele.text('发送失败').fadeOut(5000);
                    ele.html('<i class="fa fa-refresh fa-2x"></i>');
//                    ele.html('<i class="fa fa-refresh fa-2x"></i>');
                }
            }
        });
    });

});
</script>

               </div>
	       </div>
	       
	   </div>
	   <!-- 提示信息 -->
       
<!-- 提示信息 BEGIN -->
<div class="modal fade" id="tips-modal" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">提示信息</h4>
      </div>
      <div class="modal-body">
        <p class="tips-msg"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="confirm-modal" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">提示信息</h4>
      </div>
      <div class="modal-body">
        <p class="tips-msg"></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_yes" class="btn btn-primary js-confirm" data-dismiss="modal">确定</button>
        <button type="button" id="confirm_no" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 提示信息 END -->

       <!-- footer -->
	   <?php  ?>

<!-- Foot Starting -->    
<div class="footer">
  <div class="container">
    <p class="pull-right"><?php echo C('COPYRIGHT')?></p>
  </div>
</div>
<!-- Foot Ending -->
       

       <script type="text/javascript">
        	$(function(){
        		//图片异步加载
        		$("img").lazyload({
//        			placeholder : "http://www.yunmai365.com/Public/common/images/grey.gif",
        			effect : "show",
                    threshold: 200
        		});
        	})
       </script>
	</body>
</html>