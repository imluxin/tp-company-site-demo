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
                    <?php
 ?>


<link rel="stylesheet" type="text/css" href="/Public/home/css/message-list.css" />

<div class="row homepg">
    <div class="pull-left mb20">
        <img data-original="<?php echo get_image_path($org['logo_orginal'])?>" class="homeimg lazy">
    </div>
    <div class="pull-left ml12">
        <p class="hometit"><?php echo $org['name']; ?></p>
        <p class="p12">社员总数 <nameb><?php echo $org['total_member']; ?></nameb></p>
        <p class="p12"><?php echo $org['mail']?></p>
        <p class="p12"><?php echo $org['address']?></p>
    </div>

    <!--<div class="pull-right ml40"><p class="homebti">365</p><p class="text-center mb0">入社申请</p></div>-->
    <div class="pull-right"><p class="homebti"><?php echo $OrgNewMsgTotal;?></p><p class="text-center mb0">最新消息</p></div>
</div>

<!--右侧主体开始-->
<div class="rightmain">
    <?php if(!empty($OrgMsgList)):?>
        <div class="message-list">
            <?php foreach ($OrgMsgList as $data) :?>
                <div class="row themessage">
                    <div class="pull-left left10 mt13">
                        <a href="<?php echo U('Message/history', array('guid'=>$data['from_guid']))?>">
                            <img data-original="<?php echo get_image_path($data['from_photo']);?>" alt="" class="img70 layzy">
                        </a>
                    </div>
                    <div class="pull-right right88">
                        <div class="row margin0">
                            <a  href="<?php echo U('Message/history', array('guid'=>$data['from_guid']))?>" class="blacknm pull-left">
                                <name0><?php echo $data['from_name'];?></name0>
                            </a>
                            <p class="signature pull-left ml12">对你说</p>
                            <p class="signature pull-right"><?php echo mdate($data['sent_time']);?></p>
                        </div>
                        <div class="row margin0">
                            <div class="pull-left width30"><i class="fa fa-quote-left fa-2x"></i></div>
                            <div class="pull-left mainheight">
                                <a href="<?php echo U('Message/history', array('guid'=>$data['from_guid']))?>"><nameh><?php echo $data['content'];?></nameh></a>
                            </div>
                        </div>
                        <div class="row margin0">
                            <div class="message-reply pull-left mt10">
                                <a class="send_msg" href="javascript:void(0);" url="<?php echo U('Home/Message/reply', array('to_guid'=>$data['from_guid']))?>">
                                    <i class="fa fa-reply fa-lg"></i> 回复
                                </a>
                            </div>
                            <div class="message-delete pull-left mt10">
                                <a class="ml30 ym_del" href="javascript:void(0);" url="<?php echo U('Home/Message/del', array('guid'=>$data['guid']))?>" class="ml30">
                                    <i class="fa fa-times fa-lg"></i> 删除
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row mb30">
            <a class="pull-right mr25" href="<?php echo U('Message/index');?>">查看更多</a>
        </div>
    <?php else: ?>
        <div class="message-list listnone">暂无消息</div>
    <?php endif; ?>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        // 发送消息
        $(".send_msg").click(function(){
            $.showBox({
                'src': $(this).attr('url'),
                'width': 680,
                'height': 400,
                // 'data'  : "Say hello to your father",
                'success': function(data){
                    alert(data);
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