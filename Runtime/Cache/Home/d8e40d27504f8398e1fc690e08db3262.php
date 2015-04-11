<?php if (!defined('THINK_PATH')) exit(); ?>

<!DOCTYPE html>
<html>
    <!-- head -->
    <?php  ?>
<head>
    <meta charset="UTF-8">
        
    <!-- css 文件 -->
    <?php echo C('MEDIA_CSS.JQUERYUI'); ?>
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
    <?php echo C('MEDIA_CSS.BASE'); ?>
    <?php echo C('MEDIA_CSS.MODAL'); ?>
    <?php echo C('MEDIA_CSS.ACTIVITY_VOTE'); ?>
    
    <title><?php echo C('APP_NAME'); if(!empty($meta_title)): ?>- <?php echo ($meta_title); endif; ?></title>
    <meta name="keywords" content="社团邦，<?php echo C('APP_NAME')?>，天津云脉三六五科技有限公司，即时通信，聊天APP，社团管理平台，人脉">
    <meta name="description" content="社团邦，社团管理平台">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <link rel="shortcut icon" href="/Public/common/images/favicon.ico" type="image/vnd.microsoft.icon">

    <!-- 加载JS文件 -->
    <?php  ?>

<!-- js 文件 -->
<?php echo C('MEDIA_JS.JQUERY'); ?>
<?php echo C('MEDIA_JS.JQUERYUI'); ?>
<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
<?php echo C('MEDIA_JS.JQUERY_VALIDATE'); ?>
<?php echo C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL'); ?>
<?php echo C('MEDIA_JS.JQUERY_LAZYLOAD'); ?>
<?php echo C('MEDIA_JS.JQUERY_AJAXUPLOAD'); ?>
<?php echo C('MEDIA_JS.IFRAME_BOX'); ?>
<?php echo C('MEDIA_JS.ZERO_CLIPBOARD'); ?>
<?php echo C('MEDIA_JS.COMMON'); ?>
<script type="text/javascript" src="/Public/common/js/jquery.lazyload.js"></script>

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
        <p class="topwd">社团邦 | 社团管理平台 <small style="color: #cccccc;">Preview 1.0</small></p>
      </div>
      <div class="col-xs-5">
        <div class="pull-right">
            <div class="row">
                <div class="headicon">
                    <a href="<?php echo U('Org/info')?>"><img id="top_logo" src="<?php echo get_image_path($auth['org_logo'])?>" class="headicon"></a>
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
                    
<link rel="stylesheet" type="text/css" href="/Public/home/css/create-theme.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/sign-up.css" />
<script type="text/javascript">
    // 组装 活动流程json串
    var ticket_items = [];
    <?php foreach($ticket as $k => $f): ?>
    ticket_items[<?php echo $k ?>] = {
        'guid' : "<?php echo $f['guid']; ?>",
        'name' : "<?php echo $f['name']; ?>",
        'num' : "<?php echo $f['num'] ?>",
        'num_used' : "<?php echo $f['num_used'] ?>",
        'verify_num' : "<?php echo $f['verify_num']; ?>",
        'is_for_sale' : "<?php echo $f['is_for_sale']; ?>"
    };
    <?php endforeach; ?>

</script>
<!-- 导入面包屑 -->
<?php
$breadcrumbs = array( 'base' => '活动管理', 'list' => array( array('url'=>U('Activity/index'), 'v'=>'主题列表'), array('url'=>U('Activity/activity_list', array('sguid'=>$subject_info['guid'])), 'v'=>$subject_info['name']), array('url'=>'', 'v'=>$activity_info['name']) ) ); ?>
<?php if (!empty($breadcrumbs)): ?>
    <div class="ymtitle">
        <?php echo $breadcrumbs['base']?>
        <?php foreach ($breadcrumbs['list'] as $l): ?>
            >>
            <?php
 if(mb_strlen($l['v'], 'UTF-8') > 18){ $v = mb_substr($l['v'], 0, 18, 'UTF-8').'...'; } else { $v = $l['v']; } ?>
            <?php if(!empty($l['url'])): ?>
                <a href="<?php echo $l['url']?>" class="h5title" title="<?php echo $l['v']?>"><?php echo $v;?></a>
            <?php else: ?>
                <span class="h5title"><?php echo $v;?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif;?>

<div class="ymnaw">
    <ul class="nav nav-tabs ymbtn" role="tablist">
        <li role="presentation" class="<?php echo (ACTION_NAME == 'activity_view') ? 'active' : ''; ?>"><a href="<?php echo U('Activity/activity_view', array('guid' => $activity_info['guid']))?>">报名详情</a></li>
        <li role="presentation" class="<?php echo (in_array(ACTION_NAME, array('signup_userinfo', 'signup_userdetail'))) ? 'active' : ''; ?>"><a href="<?php echo U('Activity/signup_userinfo', array('aid'=>$activity_info['guid']))?>">报名列表</a></li>
        <li role="presentation" class="<?php echo (ACTION_NAME == 'ticket') ? 'active' : ''; ?>"><a href="<?php echo U('Activity/ticket', array('guid' => $activity_info['guid']))?>">票务设置</a></li>
    <li role="presentation" class="<?php echo (ACTION_NAME == 'signup_setting') ? 'active' : ''; ?>"><a href="<?php echo U('Activity/signup_setting', array('guid' => $activity_info['guid'])); ?>">其它设置</a></li>
        <li role="presentation" class="pull-right"><a href="<?php echo U('Activity/signin', array('aid' => $activity_info['guid']))?>" target="_blank">进行签到 <i class="fa fa-pencil-square-o"></i></a></li>
    </ul>
</div>

<div class="rightmain">
    <div class="btn-group width798 pdlf10">
        <div class="pull-left"><h4>其它设置</h4></div>
        <div class="pull-right"><a href="<?php echo U('Activity/activity_list', array('sguid'=>$subject_info['guid']))?>"><i class="fa fa-arrow-left"></i> 活动列表</a></div>
    </div>
    <div class="width798">
        <form class="form-horizontal" method="post">
            <div class="page-header mt10"></div>

            <div class="form-group">
                <label for="inlineCheckbox1" class="col-sm-3 control-label">前台活动页是否显示<br />报名列表：</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio" name="show_front_list" value="1" <?php echo ($signup_info['show_front_list'] == 1) ? 'checked' : ''; ?>> 是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="show_front_list" value="0" <?php echo ($signup_info['show_front_list'] == 0) ? 'checked' : ''; ?>> 否
                    </label>
                </div>
            </div>

<!--            <div class="form-group">-->
<!--                <label for="inlineCheckbox1" class="col-sm-3 control-label">签到成功自动发送信息：</label>-->
<!--                <div class="col-sm-9">-->
<!--                    <label class="radio-inline">-->
<!--                        <input type="radio" name="optionsRadios" id="inlineCheckbox1" value="option1"> 是-->
<!--                    </label>-->
<!--                    <label class="radio-inline">-->
<!--                        <input type="radio" name="optionsRadios" id="inlineCheckbox2" value="option2" checked> 否-->
<!--                    </label>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group">-->
<!--                <label for="notice-content" class="col-sm-2 control-label">短信内容： </label>-->
<!--                <div class="col-sm-9">-->
<!--                    <textarea class="form-control noresize radius0"  id="notice-content" rows="4"></textarea>-->
<!--                </div>-->
<!--                <div class="col-sm-9 col-sm-offset-2 mt10">-->
<!--                    <nameo>内容不能为空！</nameo>-->
<!--                    <div class="pull-right"><nameh1>7/210字</nameh1></div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group">-->
<!--                <label for="notice-signature" class="col-sm-2 control-label">短信签名： </label>-->
<!--                <div class="col-sm-9">-->
<!--                    <input type="text" class="form-control" id="notice-signature" value="<?php echo C('APP_NAME')?>" placeholder="">-->
<!--                </div>-->
<!--                <div class="col-sm-9 col-sm-offset-2 mt10">-->
<!--                    <nameo>内容不能为空！</nameo>-->
<!--                </div>-->
<!--            </div>-->

            <div class="page-header mt10"></div>

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <div class="btn-group">
                        <button type="submit" class="btn mybtn active">保存</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>


<!-- modal 票务 -->
<div class="modal fade bs-example-modal-lg" id="modal_ticket" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-tk-position">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="export-import"><strong>票务设置</strong></h4>
            </div>
            <div class="modal-body">
                <form id="modal_ticket_form" class="form-horizontal">
                    <div class="form-group">
                        <label for="ticket-name" class="col-sm-2 control-label">票种名称：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" maxlength="8" id="ticket-name" name="modal_ticket_name" placeholder="最多8个字">
                        </div>
                        <!-- <div class="col-sm-4 error-pr">这里是错误信息！</div> -->
                    </div>

                    <div class="form-group">
                        <label for="ticket-number" class="col-sm-2 control-label">该票数量：</label>
                        <div class="col-sm-3">
                            <input type="number" name="points" min="1" max="10000" value="100" class="form-control" maxLength="8" name="modal_ticket_num" id="ticket-num" placeholder="">
                        </div>
                        <!-- <div class="col-sm-4 error-pr">这里是错误信息！</div> -->
                    </div>

                    <div class="form-group">
                        <label for="ticket-number2" class="col-sm-2 control-label">验证次数：</label>
                        <div class="col-sm-1">
                            <input type="text" min="1" max="30" value="10"  class="form-control" id="ticket-verifynum" name="modal_ticket_verifynum" placeholder="" />
                        </div>
                        <!--                         <div class="col-sm-4">-->
                        <!--                             <input type="range"  name="points" min="1" max="30" value="10"  class="form-control" id="ticket-number2" placeholder="最多30次">-->
                        <!--                         </div>-->
                        <div class="col-sm-3 text-left mt13 ml-12"><nameh1>最多30次</nameh1></div>
                    </div>

                    <div class="form-group">
                        <label for="ticket-number" class="col-sm-2 control-label">是否售票：</label>
                        <div class="col-sm-1">
                            <input id="ticket-forsale" data-on-color="success" value="1" type="checkbox" data-size="small" name="modal_ticket_forsale" data-on-text="是" data-off-text="否" checked>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 text-left">
                            <nameh1>用户报名后不能自动获取参会二维码，需要在参会人员中审核后发送二维码电子凭证</nameh1>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="btn-group pdlf10">
                                <input type="hidden" id="is_new" value="1" />
                                <input type="hidden" id="ticket_key" value="" /> <!-- 票编号 -->
                                <button type="button" id="modal_ticket_save" class="btn mybtn active">确定</button>
                                <button type="button" class="btn mybtn" data-dismiss="modal">取消</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/home/js/ticket.js"></script>

               </div>
	       </div>
	       
	   </div>
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
        			placeholder : "http://www.yunmai365.com//Public/common/images/grey.gif",    
        			effect : "fadeIn"  
        		});   
        	})
       </script>
	</body>
</html>