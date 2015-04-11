<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo C('APP_NAME')?>后台管理<?php if(!empty($meta_title)): ?>- <?php echo ($meta_title); endif; ?></title>

		<?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
		<?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
		<link rel="stylesheet" type="text/css" href="/Public/admin/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/admin/css/manage.css" />
        <link rel="stylesheet" type="text/css" href="/Public/home/css/base.css" />
        
		<?php echo C('MEDIA_JS.JQUERY'); ?>
		<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
		<?php echo C('MEDIA_JS.JQUERY_VALIDATE'); ?>
		<?php echo C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL'); ?>
		<?php echo C('MEDIA_JS.JQUERY_FORM'); ?>
		<?php echo C('MEDIA_JS.JQUERY_AJAXUPLOAD'); ?>
		
		<script type="text/javascript" src="/Public/admin/js/common.js"></script>
		<!-- Ueditor js 加载 -->
        <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script>
   
    </head>
	<body>		
		<!-- Header Starting -->  
		<div class="header">
		  <div class="container">
		    <div class="row">
		      <div class="col-xs-3 col-md-2">
		        <h3 class="mt0" ><?php echo C('APP_NAME')?></h3>
		      </div>
		      <div class="col-xs-5 col-md-6"></div>
		      <div class="col-xs-4 col-md-4">
		        <div class="btn-group pull-right">
		           <!-- <a class="header-btn"><i class="fa fa-envelope fa-2x"></i></a> --> 
		           <a href="<?php echo U('Auth/loginout');?>" class="header-btn btn-exit"><i class="fa fa-power-off fa-2x"></i></a> 
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Header Ending --> 
		
		<div class="container mainbody">
			<div class="row">
				<div class="col-sm-3 col-md-2">
					<div class="list-group mt90">
	<a href="<?php echo U('Org/index');?>" class="list-group-item"><i class="fa fa-users"></i> 社团管理</a>
	<a href="<?php echo U('Opinion/index');?>" class="list-group-item"><i class="fa fa-twitch"></i> 反馈管理</a>
	<a href="<?php echo U('Authority/index');?>" class="list-group-item"><i class="fa fa-cogs"></i> 权限管理</a>
	<a href="<?php echo U('Level/index');?>" class="list-group-item"><i class="fa fa-signal"></i> 等级管理</a>
	<a href="<?php echo U('Upload/index');?>" class="list-group-item"><i class="fa fa-line-chart"></i> APP更新</a>
	<a href="<?php echo U('Config/index');?>" class="list-group-item"><i class="fa fa-cogs"></i> 网站设置</a>
    <a href="<?php echo U('Contact/index');?>" class="list-group-item"><i class="fa fa-fax"></i> 联系我们</a>
    <a href="<?php echo U('User/index');?>" class="list-group-item"><i class="fa fa-file-text-o"></i> 用户信息</a>
    <a href="<?php echo U('Task/index');?>" class="list-group-item"><i class="fa fa-tasks"></i> 任务管理</a>
    <a href="<?php echo U('App/index');?>" class="list-group-item"><i class="fa fa-download"></i>下载申请</a>
</div>

				</div>
				<div class="col-sm-9 col-md-10">
					<!DOCTYPE html>
<script type="text/javascript" src="/Public/admin/js/orgIndex.js"></script>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h2 class="page-header">
    <!--<a href="<?php echo U('add');?>" type="button" class="pull-right btn btn-default"><span class="glyphicon glyphicon-plus"></span> 创建社团</a>-->
    App下载管理
</h2>
<table class="table table-bordered">
    <tr>
        <th>申请人姓名</th>
        <th>申请人公司</th>
        <th>申请人职务</th>
        <th>申请原因</th>
        <th>申请时间</th>
        <th>审核操作</th>
    </tr>
    <?php foreach($app_application_list as $l):?>
    <tr>
        <td><?php echo $l['name'];?></td>
        <td><?php echo $l['company'];?></td>
        <td><?php echo $l['duties'];?></td>
        <td>
            <?php if(strlen($l['reason']) <= 10){ echo $l['reason']; }elseif(strlen($l['reason']) > 10){ echo mb_substr($l['reason'],0,10,'utf-8').'...'; }?>
        </td>
        <td><?php echo date('Y-m-d',$l['created_at']);?></td>
        <!--<td class="text-danger"><?php echo date('Y-m-d H:i',$l['created_at']);?></td>-->
        <!--<td><?php echo date('Y-m-d H:i',$l['created_at']);?></td>-->
        <!--&lt;!&ndash;<td class="text-info"><?php echo mb_substr($l['content'],0,9,'utf-8');?>...</td>&ndash;&gt;-->
        <!--<td><?php echo mb_substr($l['content'],0,9,'utf-8');?>...</td>-->
        <td >
            <a href="<?php echo U('App/content',array('user_guid' => $l['guid']));?>"><i class="fa fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if($l['status'] == 0):?><!--审核状态 0未审核 1已通过 2未通过-->
            <a href="<?php echo U('App/check_content', array('appliction_guid'=>$l['guid'],'type'=>'1'))?>"><i class="fa fa-check" style="font-size: 20px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="<?php echo U('App/check_content', array('appliction_guid'=>$l['guid'],'type'=>'2'))?>"><i class="fa fa-times" style="font-size: 20px;"></i></a>
            <?php elseif($l['status'] == 1):?>
            <i class="fa fa-chain" style="font-size: 20px;"></i>&nbsp;&nbsp;已通过
            <?php else:?>
            <i class="fa fa-chain-broken" style="font-size: 20px;"></i>&nbsp;&nbsp;已拒绝
            <?php endif;?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $page;?>
</body>
</html>
				</div>
			</div>
		</div>
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
		        <button type="button" class="btn btn-primary js-confirm" data-dismiss="modal">确定</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</body>
</html>