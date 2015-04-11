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
    <meta name="keywords" content="社团邦，云脉365，天津云脉三六五科技有限公司，即时通信，聊天APP，社团管理平台，人脉">
    <meta name="description" content="社团邦，社团管理平台">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <?php echo C('MEDIA_FAVICON')?>

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
        <p class="topwd">社团邦 | 社团管理平台 <small style="color: #ccc;">Preview 1.0</small></p>
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

<style>
    .pt7 {padding-top:7px;}
</style>

<!-- 导入面包屑 -->
<?php
$breadcrumbs = array( 'base' => '活动管理', 'list' => array( array('url' => U('Activity/activity_view', array('guid'=>$info['activity_guid'])), 'v'=>'活动详情'), array('url'=>U('Activity/signup_userinfo', array('aid' => $info['activity_guid'])), 'v'=> '报名名单'), array('url' => '', 'v' => '人员详情') ) ); $activity_info['guid'] = $info['activity_guid']; ?>
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
        <div class="pull-left">报名表</div>
        <div class="pull-right"><a href="<?php echo U('Activity/signup_userinfo', array('aid' => $info['activity_guid'])); ?>"><i class="fa fa-arrow-left"></i> 返回</a></div>
    </div>
    <div class="width798 mt20">
        <form id="regorg" role="form" class="form-horizontal" method="post">

            <?php if(!empty($tickets)): ?>
                <div class="form-group">
                    <label for="area" class="col-sm-2 control-label"><span>* </span>票务：</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="ticket">
                            <?php foreach($tickets as $t): ?>
                                <option value="<?php echo $t['guid']?>" <?php echo ($user_ticket['ticket_guid'] == $t['guid']) ? 'selected' : ''; ?>>
                                    <?php echo $t['name']?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <?php foreach($build_info as $k => $b): ?>
                <!-- 获取当前表单类型 -->
                <?php if($b['is_info'] != 1):?>
                    <input type="hidden" name="<?php echo 'other['.$b['guid'].']'?>[ym_type]" value="<?php echo $b['ym_type']?>"/>
                    <input type="hidden" name="<?php echo 'other['.$b['guid'].']'?>[other_info_guid]" value="<?php echo $other[$b['guid']]['guid']; ?>"/>
                <?php endif; ?>

                <div class="form-group">
                    <label for="contact" class="col-sm-2 control-label">
                        <?php if($b['is_required']):?><span>* </span><?php endif; echo $b['name']?>：
                    </label>
                    <div class="col-sm-5 form_field">
                        <!-- form -->
                        <?php $name = ($b['is_info']==1)?'info':'other'; ?>
                        <?php if($b['html_type'] == 'text'): ?>
                            <?php if($b['is_info'] == 1):?>
                                <?php
 if($b['ym_type'] == 'real_name') { $field_val = $info['real_name']; }elseif($b['ym_type'] == 'mobile') { $field_val = $info['mobile']; } else { $field_val = ''; } ?>
                                <input type="text" class="form-control <?php echo ($b['ym_type']=='date') ? 'ym_date' : ''; ?>" name="<?php echo $name.'['.$b['ym_type'].']'?>" placeholder="<?php echo $b['note']?>" value="<?php echo $field_val;?>"  <?php echo ($b['ym_type']=='date') ? 'readonly' : ''; ?>/>
                            <?php else: ?>
                                <input type="text" class="form-control <?php echo ($b['ym_type']=='date') ? 'ym_date' : ''; ?>" name="<?php echo $name.'['.$b['guid'].']'?>[value]" value="<?php echo $other[$b['guid']]['value']; ?>" placeholder="<?php echo $b['note']?>"  <?php echo ($b['ym_type']=='date') ? 'readonly' : ''; ?>/>
                                <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>" />
                            <?php endif; ?>

                        <?php elseif($b['html_type'] == 'textarea'):?>
                            <textarea class="form-control" rows="7" name="<?php echo $name.'['.$b['guid'].']'?>[value]" placeholder="<?php echo $b['note']?>"><?php echo $other[$b['guid']]['value']; ?></textarea>
                            <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>" />

                        <?php elseif($b['html_type'] == 'select'):?>
                            <div class="select">
                                <select name="<?php echo $name.'['.$b['guid'].']'?>[value]" class="form-control ym_select">
                                    <option value="">请选择</option>
                                    <?php foreach($option_info[$b['guid']] as $ok => $ov): ?>
                                        <option value="<?php echo $ov['value']?>" <?php echo ($ov['value'] == $other[$b['guid']]['value']) ? 'selected':''; ?>><?php echo $ov['value']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>">

                        <?php elseif ($b['html_type'] == 'radio' || $b['html_type'] == 'checkbox'): ?>
                            <?php $vals = explode('_____', $other[$b['guid']]['value']); ?>
                            <?php foreach($option_info[$b['guid']] as $ok => $ov): ?>
                                <?php if($b['is_info'] == 1):?>
                                    <div class="<?php echo $b['html_type']?>">
                                        <label>
                                            <div class="activity-vote-options">
                                                <input type="<?php echo $b['html_type']?>" name="<?php echo $name.'['.$b['ym_type'].']'?>" class="" value="<?php echo $ov['value']?>">
                                            </div>
                                            <?php echo $ov['value']?>
                                        </label>
                                    </div>
                                <?php else: ?>
                                    <div class="<?php echo $b['html_type']?>">
                                        <label>
                                            <div class="activity-vote-options">
                                                <input type="<?php echo $b['html_type']?>" name="<?php echo $name.'['.$b['guid'].']'?>[value][]" class="123" value="<?php echo $ov['value']?>" <?php echo in_array($ov['value'], $vals) ? 'checked':'';?>>
                                            </div>
                                            <?php echo $ov['value']?>
                                        </label>
                                    </div>
                                    <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-5 tishinr"></div>
                </div>
            <?php endforeach; ?>

            <div class="form-group">
                <label for="area" class="col-sm-2 control-label"></label>
                <div class="col-sm-5">
                    <button class="btn mybtn" type="button" onclick="location.href='<?php echo U('Activity/signup_userinfo', array('aid' => $info['activity_guid'])); ?>'">返回</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>

</div>


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
        			placeholder : "http://www.yunmai365.com//Public/common/images/grey.gif",    
        			effect : "fadeIn"  
        		});   
        	})
       </script>
	</body>
</html>