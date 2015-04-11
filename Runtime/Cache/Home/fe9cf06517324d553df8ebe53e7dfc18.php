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

      <div class="rightmain">
      
        <div class="btn-group width798 pdlf10">
            <div class="pull-left"><h4>活动详情</h4></div>
          <div class="pull-right mt20"><a href="<?php echo U('Activity/activity_list', array('sguid'=>$subject_info['guid']));?>"><i class="fa fa-arrow-left"></i> 活动列表</a></div>
        </div>

        <div class="pdlf10 ml12 mb40">
            <div class="row"><div class="page-header mt10"></div></div>

            <div class="row mb10">
                <div class="pull-right">
                    
    <div class="pull-right">
        <?php if($activity_info['status']==0):?>
            <button type="button" class="btn mybtn" onclick="location.href='<?php echo U('Activity/activity_edit', array('guid'=>$activity_info['guid']))?>'">编辑</button>
            <button type="button" class="ym_del btn mybtn" url="<?php echo U('Activity/activity_del', array('guid'=>$activity_info['guid']))?>">删除</button>
        <?php endif; ?>

        <?php if($activity_info['status']==1):?>
            <button type="button" class="ym_del btn mybtn" url="<?php echo U('Activity/close', array('guid'=>$activity_info['guid']))?>">关闭活动</button>
        <?php endif; ?>
    </div>



                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-success pull-left mr10 radius0" data-toggle="modal" data-target="#previewmodal">活动预览</button>
                    <!-- Modal -->
                    <div class="modal fade" id="previewmodal" tabindex="-1" role="dialog" aria-labelledby="export-import" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="export-import"><strong>活动预览</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="pre-activities-lt">
                                            <iframe src="<?php echo U('Mobile/activity/preview', array('aid' => $activity_info['guid']), true, true); ?>" frameborder="1"></iframe>
                                        </div>
                                        <div class="pre-activities-rt">
                                            <img src="<?php echo U('Mobile/activity/qrcode', array('aid' => $activity_info['guid']), true, true); ?>">
                                            <a class="btn mybtn active" download="" href="<?php echo U('Mobile/activity/qrcode', array('aid' => $activity_info['guid']), true, true); ?>">下载png</a>
                                            <a class="text-center"><nameh1>手机微信扫码后可分享<br>到您的微信朋友圈，邀请更多人<br>报名参加您的活动。</nameh1></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-group pdlf10">
                                        <button type="button" class="btn mybtn" data-dismiss="modal">关闭</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
            </div>

            <div class="row">
                <div class="pull-left width80">活动状态：</div>
                <div class="pull-left width675"><?php echo $status; ?></div>
            </div>
            <?php if ($activity_info['is_public'] == '1'): ?>
                <div class="row mt10">
                    <div class="pull-left width80">活动地址：</div>
                    <?php $signup_address = U('Mobile/activity/view', array('aid' => $activity_info['guid']), true, true); ?>
                    <div class="pull-left width675">
                        <a target="_blank" href="<?php echo $signup_address; ?>" title="活动地址" class="word-wrap"><?php echo $signup_address; ?></a>
                        <a href="javascript:void(0);" title="复制地址" class="copy-button pull-right" data-clipboard-text="<?php echo $signup_address?>">复制地址</a>
                    </div>
                </div>
                <div class="row mt10">
                    <div class="pull-left width92 ml-12">活动二维码：</div>
                    <div class="pull-left">
                        <img src="<?php echo U('Mobile/activity/qrcode', array('aid' => $activity_info['guid']), true, true); ?>" alt="活动二维码" class="registration-code">
                    </div>
                </div>
            <?php endif; ?>
            <div class="row"><div class="page-header mt10"></div></div>

          <div class="row mt10">
            <div class="pull-left width80">活动主题：</div>
            <div class="pull-left width420"><?php echo $subject_info['name'];?></div>
          </div>
          <div class="row mt10">
            <div class="pull-left width80">活动类型：</div>
            <div class="pull-left width420"><img width="23px" src="<?php echo PUBLIC_URL;?>/home/images/activity<?php echo $activity_info['type']?>.png">
                <?php
 $type = array('1'=>'文章', '3'=>'讨论'); echo $type[$activity_info['type']]; ?>
            </div>
          </div>

          <div class="row mt10">
                <div class="pull-left width80">活动状态：</div>
                <div class="pull-left width420"><?php echo $status;?></div>
          </div>

          <div class="row mt10">
            <div class="pull-left width80">活动时间：</div>
            <div class="pull-left width420"><span><?php echo date('Y-m-d H:i',$activity_info['start_time']);?></span><span class="ml12">至</span><span class="ml12"><?php echo date('Y-m-d H:i',$activity_info['end_time']);?></span></div>
          </div>
            <div class="row mt10">
                <div class="pull-left width80">是否公开：</div>
                <div class="pull-left width675"><?php echo ($activity_info['is_public'] == '1') ? '是' : '否'; ?></div>
            </div>
          <div class="row mt10">
            <div class="pull-left width80">参与人员：</div>
            <div class="pull-left width420"><?php echo $group_name;?></div>
          </div>  
          <div class="row mt10">
            <div class="pull-left width80">活动标题：</div>
            <div class="pull-left width675"><?php echo $activity_info['name']?></div>
          </div>
          <div class="row mt10">
            <div class="pull-left width80">活动内容：</div>
            <div class="pull-left width675"><?php echo htmlspecialchars_decode($article_info['content']);?></div>
          </div>

<!--          
<?php if($activity_info['status']==0):?>
    <div class="row mt30">
        <div class="pull-left btn-group">
            <button type="button" class="btn mybtn" onclick="location.href='<?php echo U('Activity/activity_edit', array('guid'=>$activity_info['guid']))?>'">编辑</button>
            <button type="button" class="ym_del btn mybtn" url="<?php echo U('Activity/activity_del', array('guid'=>$activity_info['guid']))?>">删除</button>
        </div>
    </div>
<?php endif; ?>

<?php if($activity_info['status']==1):?>
    <div class="row mt30">
        <div class="pull-left btn-group">
            <button type="button" class="ym_del btn mybtn" url="<?php echo U('Activity/close', array('guid'=>$activity_info['guid']))?>">关闭活动</button>
        </div>
    </div>
<?php endif; ?>

-->

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
//        			placeholder : "http://www.yunmai365.com/Public/common/images/grey.gif",
        			effect : "show",
                    threshold: 200
        		});
        	})
       </script>
	</body>
</html>