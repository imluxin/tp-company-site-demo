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
                    <!-- 
 * 创建新社员页面
 *
 * CT: 2014-09-18 11:00 by QY
 */
 -->
<link rel="stylesheet" type="text/css" href="/Public/home/css/member-list.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/basic-information.css" />
<script type="text/javascript">
	var YM = {
		'agree' : "<?php echo U('examine_agree');?>",
		'refuse' : "<?php echo U('examine_refuse');?>",
		'pull_black' : "<?php echo U('examine_pull_black');?>",
	};
</script>


<!-- 导入面包屑 -->
<?php
$breadcrumbs = array( 'base' => '社员管理', 'list' => array( array('url'=>U('Member/index'), 'v'=>'社员列表'), array('url'=>'', 'v'=>'审核社员') ) ); ?>
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
        <li role="presentation" class="active"><a href="<?php echo U('Member/index')?>">社员列表</a></li>
        <li role="presentation"><a href="<?php echo U('Member/ogm')?>">分组管理</a></li>
    </ul>
</div>

<!--右侧主体开始-->
<div class="rightmain">
 	<div class="pull-right mt20"><a href="<?php echo U('Member/index')?>"><i class="fa fa-arrow-left"></i> 社员列表</a></div>
    <h4>审核社员</h4>
    <div class="mt20">
	  	<table class="table table-bordered">
			<thead>
				<tr>
				  <th>姓名</th>
				  <th>电话</th>
				  <th>邮箱</th>
				  <th>状态</th>
				</tr>
		    </thead>
			<tbody>
				<?php if(empty($examine_list)): ?><tr>
					  <td colspan="4">暂无任何数据</td>
					</tr>
				<?php else: ?> 
					<?php if(is_array($examine_list)): foreach($examine_list as $key=>$v): ?><tr>
						  <td><?php echo ($v["real_name"]); ?></td>
						  <td><?php echo ($v["mobile"]); ?></td>
						  <td><?php echo ($v["email"]); ?></td>
						  <td class="examine_state" data-guid="<?php echo ($v["user_guid"]); ?>">
							  <?php switch($v["status"]): case "1": ?><button class="btn mybtn js_agree" type="button">同意</button>
								  	<button class="btn mybtn js_refuse" type="button">拒绝</button>
								  	<button class="btn mybtn js_pull_black" type="button">拉黑</button><?php break;?>
							    <?php case "2": ?><span class="text-success">已经加入社团</span><?php break;?>
				    		    <?php case "3": ?><span class="text-danger">已拒绝加入社团</span><?php break; endswitch;?>
						  </td>
						</tr><?php endforeach; endif; endif; ?>
			</tbody>
		</table>
		<div class="btn-group mb40">
		  <ul class="pagination pagination-sm">
		  <?php echo ($page); ?>
		  </ul>
		</div>
	</div>
</div>
<!--右侧主体结束-->

<!-- Modal -->
<div class="modal fade" id="refuseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">拒绝申请</h4>
      </div>
      <div class="modal-body">
      	<textarea class="form-control" name="refuseMsg" style="resize:none;" rows="3"></textarea>
      </div>
      <div class="modal-footer">
     	<button type="button" id="sendRefuse" class="js_send btn btn-primary">发送</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/Public/home/js/examine.js"></script>
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