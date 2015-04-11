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
                    
<link rel="stylesheet" type="text/css" href="/Public/common/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/create-theme.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/sign-up.css" />

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
    <div class="pull-right mt20"><a href="<?php echo U('Activity/activity_list', array('sguid'=>$activity_info['subject_guid']))?>"><i class="fa fa-arrow-left"></i> 活动列表</a></div>
    <h4>活动名称： <?php echo $activity_info['name']?></h4><br>
    <h4>报名列表 <small>总人数为： <?php echo $user_count; ?></small></h4>

    <div class="width798 mt20">
        <form id="signup_user_list_form" method="post">
            <?php $get = I('get.'); unset($get['token']); unset($get['p']);?>
            <table class="table table-hover">
                <thead>
                <tr class="">
                    <td colspan="8">

                        <div class="list-btn-group">
                            <button type="button" id="btn_send_ticket" class="btn btn-default pull-left mr10 radius0">发送电子票/通知</button>

                            <div class="dropdown pull-left mr10">
                                <button class="btn btn-default dropdown-toggle radius0" type="button" id="operationmenu" data-toggle="dropdown">
                                    更多操作
                                    <i class="fa fa-angle-down ml12"></i>
                                </button>
                                <ul class="dropdown-menu radius0" id="more_op" role="menu" aria-labelledby="operationmenu">
                                    <li role="presentation" op="batch_confirm"><a role="menuitem" tabindex="-1" href="javascript:void(0);">确认参加</a></li>
                                    <li role="presentation" op="batch_delete"><a role="menuitem" tabindex="-1" href="javascript:void(0);">删除</a></li>
                                    <li role="presentation" op="batch_export"><a role="menuitem" tabindex="-1" href="javascript:void(0);" >导出Excel</a></li>
                                </ul>
                                <input type="hidden" name="batch_op" id="batch_op" />
                            </div>

                            <div class="inputinline pull-left">
                                <div class="input-group">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="请输入姓名或电话" value="<?php echo $keyword = urldecode($_GET['keyword']); ?>" />
                                    <a class="input-group-addon btn-default" id="btn_search" href="javascript:void(0);"><i class="fa fa-search"></i></a>
                                    <?php if(count($get) > 1): ?>
                                    <a class="input-group-addon btn-default" id="btn_search_reset" href="javascript:void(0);" onclick="javascript:window.location='<?php echo U('Activity/signup_userinfo', array('aid' => $activity_info['guid']))?>'">重置</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success pull-right radius0" data-toggle="modal" data-target="#modal_add_signup_user"><i class="fa fa-plus"></i> 添加</button>
                        </div>

                    </td>
                </tr>
                <tr class="tr-bgcolor">
                    <td class="width70" style="text-align: left; padding-left: 21px;">
    <!--                    <div class="dropdown">-->
    <!--                        <button class="btn dropdown-toggle dropdown-mybtn" type="button" id="dropdownmenu" data-toggle="dropdown">-->
                                <input type="checkbox" id="ckall">
    <!--                            <i class="fa fa-angle-down"></i>-->
    <!--                        </button>-->
    <!--                        <ul class="dropdown-menu radius0" role="menu" aria-labelledby="dropdownmenu">-->
    <!--                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">全选</a></li>-->
    <!--                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">反选</a></li>-->
    <!--                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">不选</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
                    </td>
                    <td class="width53">序号</td>
                    <td class="width90">姓名</td>
                    <td class="width110">电话</td>
                    <td class="width110">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle dropdown-mybtn" type="button" id="ticketmenu" data-toggle="dropdown">
                                全部票务 <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu radius0" role="menu" aria-labelledby="ticketmenu">
                                <li role="presentation">
                                    <?php $t_get = array_merge($get, array('t' => 'all')); ?>
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signup_userinfo', $t_get)?>'">全部票务</a></li>
                                <?php foreach($tickets as $k => $t): ?>
                                    <li role="presentation">
                                        <?php $t_get = array_merge($get, array('t' => $t['guid'])); ?>
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signup_userinfo', $t_get)?>'">
                                            <?php echo $t['name']?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                    <td class="width141">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle dropdown-mybtn" type="button" id="sourcetmenu" data-toggle="dropdown">
                                全部人员来源 <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu radius0" role="menu" aria-labelledby="sourcetmenu">
                                <li role="presentation">
                                    <?php $f_get = array_merge($get, array('f' => 'all')); ?>
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signup_userinfo', $f_get)?>'">全部</a>
                                </li>
                                <?php foreach(C('ACTIVITY_SIGNUP_FROM') as $k => $v): ?>
                                    <li role="presentation">
                                        <?php $f_get = array_merge($get, array('f' => $k)); ?>
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signup_userinfo', $f_get)?>'">
                                            <?php echo $v; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                    <td class="width141">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle dropdown-mybtn ml12" type="button" id="statemenu" data-toggle="dropdown">
                                电子票状态 <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu radius0" role="menu" aria-labelledby="statemenu">
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'all'))); ?>'" >全部</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'u0'))); ?>'">未发送</a></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'u1'))); ?>'">发送失败</a></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'u2'))); ?>'">已发送</a></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'u3'))); ?>'">对方已查看</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'u4'))); ?>'">已签到</a></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'no'))); ?>'">未签到</a></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'i1'))); ?>'">扫码签到</a></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'i2'))); ?>'">手动签到</a></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                       onclick="location.href='<?php echo U('Activity/signup_userinfo', array_merge($get, array('s' => 'i3'))); ?>'">现场报名</a></li>

                            </ul>
                        </div>
                    </td>
                    <td class="width53"></td>
                </tr>
                </thead>
                <tbody id="user_list_body">

                <?php if(empty($user_list)): ?>
                    <tr><td colspan="8">暂无人员报名</td></tr>
                <?php else: ?>
                    <?php $i = 1; foreach($user_list as $l): ?>
                        <tr>
                            <td class="checkbox-align"><input name="ck[]" type="checkbox" value="<?php echo $l['guid']?>" class="ck"></td>
                            <td><?php echo $i; $i++; ?></td>
                            <td><a href="<?php echo U('Activity/signup_userdetail', array('uid' => $l['guid']))?>" title="查看"><?php echo $l['real_name']; ?></a></td>
                            <td><?php echo $l['mobile']; ?></td>
                            <td><?php echo $l['ticket']['ticket_guid'] == 'nolimit' ? '' : $l['ticket']['ticket_name'];?></td>
                            <td><?php echo $l['from']?></td>
                            <td><<?php echo $l['ticket']['ticket_status_tag']?>><?php echo $l['ticket']['ticket_status']?></<?php echo $l['ticket']['ticket_status_tag']?>></td>
                            <td>
                                <a id="pop-<?php echo $l['guid']?>" title="详细资料" class="detailslayer" data-trigger="foucs"><i class="fa fa-info-circle fa-lg"></i></a>
                                <div class="hide" id="popopen-<?php echo $l['guid']?>">
                                    <div class="layer">
                                        <div class="pull-left"><p>
                                            <?php foreach($l['other'] as $o): $search = array("\r\n", "\n", "\r"); ?>
                                                <strong><?php echo $o['key'] ?>：</strong><?php echo str_replace($search, '<br />', $o['value']); ?><br>
                                            <?php endforeach; ?>
                                        </p></div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('#pop-<?php echo $l['guid']?>').popover({
                                            content: $('#popopen-<?php echo $l['guid']?>').html(),
                                            html: true,
                                            placement: 'left',
                                            trigger: 'hover'
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
                <?php if($user_count > C('NUM_PER_PAGE', null, 10)):?>
                <tfoot>
                    <tr>
                        <td colspan="8" class="text-center">
                            <a id="next_page" href="javascript:void(0);" title="下一页"><i class="fa fa-angle-double-down fa-2x"></i></a>
                            <input type="hidden" id="current_page_num" value="<?php echo I('get.p', 1);?>" />
                        </td>
                    </tr>
                </tfoot>
                <?php endif; ?>
            </table>
        </form>

    </div>
</div>

</div>


    <!-- Modal 发送电子票 -->
    <div class="modal fade" id="modal_send_ticket" tabindex="-1" role="dialog" aria-labelledby="export-import" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="export-import"><strong>发送电子票/通知</strong></h4>
                </div>
                <div class="modal-body">
                    <p>已选择联系人：<span class="num_choosed"></span> 人</p>
                    <!-- 标签页 -->
                    <ul class="nav nav-pills nav-tab" role="tablist" id="mytab">
                        <li role="presentation" class="active"><a href="#ticket" class="switch_send" type="ticket" aria-controls="ticket" role="tab" data-toggle="tab">电子票</a></li>
                        <li role="presentation"><a href="#ticket" class="switch_send" type="notice" aria-controls="ticket" role="tab" data-toggle="tab">通知</a></li>
                    </ul>


                    <div class="tab-content reg-tab-main">
                        <!-- 标签页1ticket -->
                        <div role="tabpanel" class="tab-pane active" id="ticket">
                            <form class="form-horizontal" id="form_send">
                                <input type="hidden" name="send_type" id="send_type" value="ticket" />

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p class="pdlf10">Tip: 选择形式为 ‘邮箱’ 时，请确保您的报名表单已经要求报名人员必须填写邮箱，否则，发送失败后果自负。或没有‘邮箱’选项，则表示
                                            您的报名表中没有设置邮箱选顶为必须。</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p class="pdlf10">发送设置：</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inlineCheckbox1" class="col-sm-2 control-label">形式：</label>
                                    <div class="col-sm-9">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="check_sms" name="send_way[]" value="sms" /> 短信
                                        </label>
                                        <?php if(!empty($is_send_mail)):?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="check_email" name="send_way[]" value="email" /> 邮件
                                            </label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-sm-9 col-sm-offset-2 tishinr"></div>
                                </div>

                                <div class="form-group">
                                    <label for="ticket-content" class="col-sm-2 control-label">内容：</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control noresize radius0"  id="ticket-content" rows="4" name="send_content"></textarea>
                                    </div>
                                    <div class="col-sm-9 col-sm-offset-2">
                                        <span class="tishinr"></span>
<!--                                        <div class="pull-right"><nameh1>7/140字</nameh1></div>-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ticket-signature" class="col-sm-2 control-label">签名：</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ticket-signature" name="send_sign" value="" placeholder="最多10个字" maxlength="10">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ticket-signature" class="col-sm-2 control-label">预览：</label>
                                    <div class="col-sm-3">
                                        <input type="button" class="form-control" id="send_preview" value="点击预览" />
                                    </div>
                                    <div class="col-sm-9 col-sm-offset-2 mt10" id="preview_place"></div>
                                </div>

                                <div class="page-header"></div>

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="col-sm-12">
                                            <input type="hidden" name="num_sms" value="" />
                                            <p class="pdlf10">本次预计发送短信：&nbsp;<nameo id="num_sms">0</nameo>&nbsp;条，余额&nbsp;<nameo><?php echo $org_info['num_sms']?></nameo>&nbsp;条</p>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="hidden" name="num_email" value="" />
                                            <p class="pdlf10">本次预计发送邮件：&nbsp;<nameo id="num_email">0</nameo>&nbsp;封，余额&nbsp;<nameo><?php echo $org_info['num_email']?></nameo>&nbsp;封</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 mt10">
                                        <a class="btn btn-success radius0" href="<?php echo U('Index/recharge'); ?>" target="_blank" role="button">充值</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="btn-group pdlf10 btn_ticket_op">
                                            <button type="submit" class="btn mybtn active" id="btn_send">发送</button>
                                            <button type="button" class="btn mybtn" data-dismiss="modal">取消</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- 标签页 -->
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 添加新人员 -->
    <!-- modal - 添加新报名人员 -->
<div class="modal fade bs-example-modal-lg" id="modal_add_signup_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="export-import"><strong>添加报名</strong></h4>
            </div>
            <div class="modal-body">
                <form id="signup_add_user_form" role="form" class="form-horizontal main-form" method="post">

                    <?php if(!empty($tickets)): ?>
                        <div class="form-group">
                            <label for="area" class="col-sm-2 control-label"><span>* </span>票务：</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="ticket">
                                    <?php foreach($tickets as $t): ?>
                                        <option value="<?php echo $t['guid']?>"><?php echo $t['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php foreach($build_info as $k => $b): ?>
                        <!-- 获取当前表单类型 -->
                        <?php if($b['is_info'] != 1):?>
                            <input type="hidden" name="<?php echo 'other['.$b['guid'].']'?>[ym_type]" value="<?php echo $b['ym_type']?>"/>
                            <input type="hidden" name="<?php echo 'other['.$b['guid'].']'?>[build_guid]" value="<?php echo $b['guid']; ?>" />
                        <?php endif; ?>

                        <!-- form 主题 -->
                        <div class="form-group">
                            <label for="contact" class="col-sm-2 control-label">
                                <?php if($b['is_required']):?><span>* </span><?php endif; echo $b['name']?>：
                            </label>
                            <div class="col-sm-6 form_field">
                                <!-- form -->
                                <?php $name = ($b['is_info']==1)?'info':'other'; ?>
                                <?php if($b['html_type'] == 'text'): ?>
                                    <?php if($b['is_info'] == 1):?>
                                        <input type="text" class="form-control <?php echo ($b['ym_type']=='date') ? 'ym_date' : ''; ?>" name="<?php echo $name.'['.$b['ym_type'].']'?>" placeholder="<?php echo $b['note']?>"  <?php echo ($b['ym_type']=='date') ? 'readonly' : ''; ?>/>
                                    <?php else: ?>
                                        <input type="text" class="form-control <?php echo ($b['ym_type']=='date') ? 'ym_date' : ''; ?>" name="<?php echo $name.'['.$b['guid'].']'?>[value]" placeholder="<?php echo $b['note']?>"  <?php echo ($b['ym_type']=='date') ? 'readonly' : ''; ?>/>
                                        <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>" />
                                    <?php endif; ?>

                                <?php elseif($b['html_type'] == 'textarea'):?>
                                    <textarea class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[value]" placeholder="<?php echo $b['note']?>"></textarea>
                                    <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>" />

                                <?php elseif($b['html_type'] == 'select'):?>
                                    <div class="select">
                                        <select name="<?php echo $name.'['.$b['guid'].']'?>[value]" class="form-control">
                                            <option value=""></option>
                                            <?php foreach($option_info[$b['guid']] as $ok => $ov): ?>
                                                <option value="<?php echo $ov['value']?>"><?php echo $ov['value']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>">

                                <?php elseif ($b['html_type'] == 'radio' || $b['html_type'] == 'checkbox'): ?>
                                    <?php foreach($option_info[$b['guid']] as $ok => $ov): ?>
                                        <?php if($b['is_info'] == 1):?>
                                            <div class="<?php echo $b['html_type']?>">
                                                <label>
                                                    <div class="activity-vote-options"><input type="<?php echo $b['html_type']?>" name="<?php echo $name.'['.$b['ym_type'].']'?>" class="" value="<?php echo $ov['value']?>"></div>
                                                    <?php echo $ov['value']?>
                                                </label>
                                            </div>
                                        <?php else: ?>
                                            <div class="<?php echo $b['html_type']?>">
                                                <label>
                                                    <div class="activity-vote-options"><input type="<?php echo $b['html_type']?>" name="<?php echo $name.'['.$b['guid'].']'?>[value][]" class="" value="<?php echo $ov['value']?>"></div>
                                                    <?php echo $ov['value']?>
                                                </label>
                                            </div>
                                            <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4 tishinr"></div>
                        </div>
                    <?php endforeach; ?>

                    <div class="row mt20 mb40">
                        <div class="col-xs-5 col-xs-offset-2">
                            <div class="btn-group ml-5">
                                <button type="submit" class="btn mybtn active">保存</button>
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

<!-- datetimepicker js 加载 -->
<script type="text/javascript" src="/Public/common/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/common/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script type="text/javascript">

    function export_signup_info() {
        <?php if($user_count > 0): ?>
        window.location.href="<?php echo U('Activity/signup_export', array('aid' => $activity_info['guid'])) ?>";
        <?php else: ?>
        alertTips($('#tips-modal'), '暂无人员报名，请稍后再试。');
        <?php endif; ?>
    }

    $(document).ready(function(){

        $('#ckall').on('change', function(){
            $("input.ck").prop('checked', $(this).prop("checked"));
        });

        // 短信预览
        function content_preview() {
            var content = $('#ticket-content').val(),
                sign = $('#ticket-signature').val(),
                check_sms = $('#check_sms').is(':checked'),
                send_type = $('#send_type').val();

            var app_sign = '';
            if(check_sms) {
                var app_sign = '【<?php echo C('APP_NAME') ?>】';
            }

            var ticket_address = '';
            if(send_type == 'ticket') {
                var ticket_address = ' 电子票地址：http://t.cn/xxxxxx ';
            }

            var preview = app_sign + content + ticket_address + sign;
            return preview;
        }
        $('#send_preview').click(function(){
            $('#preview_place').text(content_preview());
        });
        // 统计短信 & 邮件条数
        function send_static()
        {
            var preview = content_preview();
            var total_len = preview.length;
            var num_person = $('input.ck:checked').length;
            var num_sms = Math.ceil(total_len/67)*num_person;

            // 更新短信使用条数
            if($('#check_sms').is(':checked')){
                $('nameo#num_sms').text(num_sms);
                $('input[name=num_sms]').val(num_sms);
            } else {
                $('nameo#num_sms').text(0);
                $('input[name=num_sms]').val(0);
            }

            //更新邮件使用条数
            if($('#check_email').is(':checked')){
                $('nameo#num_email').text(num_person);
                $('input[name=num_email]').val(num_person);
            } else {
                $('nameo#num_email').text(0);
                $('input[name=num_email]').val(0);
            }
        }
        $('#ticket-content, #ticket-signature，#check_sms').keyup(function(){
            send_static();
        });
        $('#check_sms, #check_email').change(function(){
            send_static();
        });
        // 发送电子票/通知切换
        $('.switch_send').click(function(){
            $('input[name="send_type"]').val($(this).attr('type'));
        });
        // 发送电子票
        $('#mytab a:first').tab('show')
        $('#btn_send_ticket').click(function(){
            var num_person = $('input.ck:checked').length;
            if(num_person < 1) {
                alertTips($('#tips-modal'), '选择要操作的用户.');
                return false;
            }
            $('.num_choosed').text(num_person);
            $('#modal_send_ticket').modal();
        });


        // 发送电子票/通知 表单验证
        $('#form_send').validate({
            errorPlacement: function(error, element){
                element.parents('.form-group').find('.tishinr').html(error);
            },
            rules: {
                'send_way[]': {
                    required: true
                },
                'send_content': {
                    required: true
                },
                'send_sign': {
                    rangelength: [0, 10]
                }
            },
            messages: {
                'send_way[]': {
                    required: '您必须选择一项'
                },
                'send_content': {
                    required: '内容不能为空'
                },
                'send_sign': {
                    rangelength: '签名最大长度为10个字'
                }
            },
            submitHandler: function(form) { //通过之后回调
                var obj = $('#btn_send');
                var data = $("#signup_user_list_form, #form_send").serialize();
                $.ajax({
                    url: '<?php echo U('Activity/ajax_send_ticket', array('aid' => $activity_info['id'], 'aguid' => $activity_info['guid'])) ?>',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function(){
                        obj.attr('disabled', true);
                        obj.text('发送中...');
                        obj.parent().append('<i id="loading" class="fa fa-spinner fa-spin fa-2x" style="margin: 2px 5px;"></i>');
                    },
                    success: function(data){
                        if(data.status == 'ok'){
                            $('form#form_send')[0].reset();
                            alertTips($('#tips-modal'), data.msg, '<?php echo U('Activity/signup_userinfo', array('aid' => $activity_info['guid'])) ?>');
                        }else if(data.status == 'ko'){
                            alertTips($('#tips-modal'), data.msg);
                        }
                    },
                    complete: function(){
                        obj.attr('disabled', false);
                        obj.text('发送');
                        obj.parent().find('#loading').remove();
                    }
                });
            },
            invalidHandler: function(form, validator) { //不通过回调
                return false;
            }
        });
//        $('.btn_ticket_op button').click(function(){
//            $('form#form_send')[0].reset();
//        });

        //datetimepicker 时间样式
        $('.ym_date').datetimepicker({
            language: 'zh-CN',
            format: 'yyyy-mm-dd',
            autoclose: true,
            minView: 2
        });

        //表单验证
        $('#signup_add_user_form').validate({
            errorPlacement: function(error, element){
                element.parents('.form_field').next('.tishinr').html(error);
            },
            rules: {
                <?php foreach($build_info as $k => $b): ?>
                <?php $name = ($b['is_info']==1)?'info':'other'; ?>
                <?php  if($b['is_info']==1) { $whole_name = $name.'['.$b["ym_type"].']'; } else { if ($b['html_type'] == 'radio' || $b['html_type'] == 'checkbox') { $whole_name = $name.'['.$b["guid"].'][value][]'; } else { $whole_name = $name.'['.$b["guid"].'][value]'; } } ?>
                // jquery validate rules
                '<?php echo $whole_name?>': {
                    required: <?php echo ($b['is_required']==1)?'true':'false'; ?>
                    <?php if($b['ym_type'] == 'mobile'): ?>
                    ,digits: true,
                    rangelength: [11, 11],
                    remote: {
                        url:"<?php echo U('Activity/ajax_check_signup_user'); ?>",
                        type:'post',
                        dataType: 'json',
                        data: { aid: '<?php echo I('get.aid'); ?>' }
                    }
                    <?php else: ?>
                    <?php if(!in_array($b['html_type'], array('radio', 'select', 'checkbox'))): ?>
                    ,rangelength: [1, 50]
                    <?php endif; ?>
                    <?php if($b['html_type'] == 'textarea'): ?>
                    ,rangelength: [1, 200]
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($b['ym_type'] == 'email'): ?>
                    ,email: true
                    <?php endif; ?>
                },
                <?php endforeach; ?>
            },
            messages: {
                <?php foreach($build_info as $k => $b): ?>
                <?php $name = ($b['is_info']==1)?'info':'other'; ?>
                <?php  if($b['is_info']==1) { $whole_name = $name.'['.$b["ym_type"].']'; } else { if ($b['html_type'] == 'radio' || $b['html_type'] == 'checkbox') { $whole_name = $name.'['.$b["guid"].'][value][]'; } else { $whole_name = $name.'['.$b["guid"].'][value]'; } } ?>
                // jquery validate error message
                '<?php echo $whole_name ?>': {
                    required: "<?php echo $b['name']; ?>不能为空"
                    <?php if($b['ym_type'] == 'mobile'): ?>
                    ,digits: "手机号码必须为数字",
                    rangelength: "手机号码长度必须为11位",
                    remote: "该手机号码已经报名"
                    <?php else: ?>
                    <?php if(!in_array($b['html_type'], array('radio', 'select', 'checkbox'))): ?>
                    ,rangelength: "<?php echo $b['name']; ?>长度必须为1到50个字"
                    <?php endif; ?>
                    <?php if($b['html_type'] == 'textarea'): ?>
                    ,rangelength: "<?php echo $b['name']; ?>长度必须为1到200个字"
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($b['ym_type'] == 'email'): ?>
                    ,email: "邮箱格式不对"
                    <?php endif; ?>
                },
                <?php endforeach; ?>
            },
            submitHandler: function(form) { //通过之后回调
                var obj = $(this);
                var data = $("#signup_add_user_form").serialize();
                $.ajax({
                    url: '<?php echo U('Activity/ajax_signup_add_user', array('aid' => $activity_info['guid'])) ?>',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function(){
                        obj.button('loading');
                    },
                    success: function(data){
                        if(data.status == 'ok'){
                            alertTips($('#tips-modal'), data.msg, '<?php echo U('Activity/signup_userinfo', array('aid' => $activity_info['guid'])) ?>');
                        }else if(data.status == 'ko'){
                            alertTips($('#tips-modal'), data.msg);
                        }
                    },
                    complete: function(){
                        obj.button('reset');
                    }
                });
            },
            invalidHandler: function(form, validator) { //不通过回调
                return false;
            }
        });

        /**
         * 更多操作
         */
        $('#more_op li').click(function(){
            var num_person = $('input.ck:checked').length;
            if(num_person < 1) {
                alertTips($('#tips-modal'), '选择要操作的用户.');
                return false;
            }

            var op = $(this).attr('op');
            $('#batch_op').val(op);

            // 如果为导出Excel
            if(op == 'batch_export') {
                $('form#signup_user_list_form').attr('action', '<?php echo U('Activity/signup_export', array('aid' => $activity_info['guid'])) ?>');
                $('form#signup_user_list_form').submit();
                return false;
            }

            // 其它
            var obj = $(this);
            var data = $("#signup_user_list_form").serialize();
            $.ajax({
                url: '<?php echo U('Activity/ajax_signup_userlist_batch_op', array('aid' => $activity_info['guid'])) ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function(){
                    obj.parents('.dropdown').next('.inputinline').after('<i id="loading" class="fa fa-spinner fa-spin fa-2x" style="margin: 2px 5px;"></i>');
                },
                success: function(data){
                    $('#loading').remove();
                    if(data.status == 'ok'){
                        alertTips($('#tips-modal'), data.msg, '<?php echo U('Activity/signup_userinfo', array('aid' => $activity_info['guid'])) ?>');
                    }else if(data.status == 'ko'){
                        alertTips($('#tips-modal'), data.msg);
                    }
                }
            });
        });

        /**
         * 下一页
         */
        var i_num = <?php echo isset($i) ? $i : 0; ?>;
        $('#next_page').click(function(){
            var current_page = $('#current_page_num').val();
            var next_page = parseInt(current_page)+1;

            $.ajax({
                url: '<?php echo U('Activity/ajax_signup_user_next_page', array('aid' => $activity_info['guid'], 'keyword' => I('get.keyword'))) ?>/p/'+next_page,
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){
                    $('#next_page').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                },
                onError: function(){
                    alertTips($('#tips-modal'), '出错了，请稍后重试。');
                },
                success: function(data){
                    $('#next_page').html('<i class="fa fa-angle-double-down fa-2x"></i>');
                    if(data.status == 'ok'){
                        $('#current_page_num').val(next_page);
                        var html = '';
                        $.each(data.data, function(k, info){

                            var tip_content = "<div class='layer'><div class='pull-left'><p>";
                            if(info.other) {
                                $.each(info.other, function (other_key, o) {
                                    tip_content += "<strong>" + o.key + "：</strong>" + o.value + "<br>";
                                });
                            }else{
                                tip_content += "<strong>没有更多数据。</strong>";
                            }
                            tip_content += "</p></div></div>";
                            var reg = new RegExp("\r\n", "g");
                            tip_content = tip_content.replace(reg, "<br>");

                            var ticket_name = (info.ticket.ticket_guid == 'nolimit')?'':info.ticket.ticket_name;
                            html += '<tr>';
                            html += '<td class="checkbox-align"><input name="ck[]" type="checkbox" value="'+ info.guid +'" class="ck"></td>';
                            html += '<td>' + i_num + '</td>';
                            html += '<td><a href="<?php echo U('Activity/signup_userdetail')?>?uid='+ info.guid +'" title="查看">'+ info.real_name +'</a></td>';
                            html += '<td>'+ info.mobile +'</td>';
                            html += '<td>'+ ticket_name +'</td>';
                            html += '<td>'+ info.from +'</td>';
                            html += '<td><'+ info.ticket.ticket_status_tag +'>'+ info.ticket.ticket_status +'</'+ info.ticket.ticket_status_tag +'></td>';
                            html += '<td>';
                            html += '<a id="pop-'+ info.guid +'" title="详细资料" class="detailslayer" data-trigger="foucs"><i class="fa fa-info-circle fa-lg"></i></a>';

                             html += '<script type="text/javascript">';
                             html += '$(document).ready(function() {';
                                 html += '$("#pop-'+ info.guid+'" ).popover({';
                                     html += 'content: "'+tip_content+'",';
                                     html += 'html: true,';
                                     html += 'placement: "left",';
                                     html += 'trigger: "hover"';
                                 html += '});';
                             html += '});';
                             html += '<\/script>';
                            html += '</td>';
                            html += '</tr>';
                            i_num++;
                        });
                        $('#user_list_body').append(html);
                    }else if(data.status == 'ko'){
                        alertTips($('#tips-modal'), data.msg);
                    } else if(data.status == 'nomore') {
                        alertTips($('#tips-modal'), data.msg);
                        $('tfoot').hide();
                    }
                }
            });
        });

        // 搜索姓名或电话
        $('#btn_search').click(function(){
            var keyword = $('#search').val();
            if(keyword == '') {
                alertTips($('#tips-modal'), '请输入要搜索的姓名或电话');
                return false;
            }
            window.location = '<?php echo U('Activity/signup_userinfo', array('aid' => $activity_info['guid'])); ?>/keyword/'+keyword;
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