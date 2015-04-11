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
					<script type="text/javascript" src="/Public/admin/js/orgIndex.js"></script>
<script type="text/javascript">
	var YM = {
		'delOrg' : "<?php echo U('delOrg');?>",
		'lock' : "<?php echo U('lock');?>",
		'unlock' : "<?php echo U('unlock');?>"
	};
</script>
<h2 class="page-header">
	<a href="<?php echo U('add');?>" type="button" class="pull-right btn btn-success"><span class="glyphicon glyphicon-plus"></span> 创建社团</a>
	社团管理
</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>社团名称</th>
      <th>联系邮箱</th>
      <th>审核状态</th>
      <th>社团状态</th>
      <th>社团认证</th>
      <th>社团等级</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
  	<?php if(is_array($orgList)): foreach($orgList as $key=>$v): ?><tr data-guid="<?php echo ($v["guid"]); ?>">
          <td><?php echo ($v["name"]); ?></td>
          <th><?php echo ($v["mail"]); ?></th>
          <th><?php if($v['is_verify'] == 0):?>
              <a href = "<?php echo U('Org/verify', array('org_guid'=>$v['guid']))?>" >审核</a>
              <?php elseif($v['is_verify'] == 1):?>
              已通过
              <?php elseif($v['is_verify'] == 2):?>
              未通过
              <?php endif;?></th>
          <td class="lock"><?php if(($v["is_lock"]) == "0"): ?><span class="text-success">未锁定</span>（<a href="javascript:void(0);" class="js-lock">锁定</a>）<?php else: ?><span class="text-danger">已锁定</span> （<a href="javascript:void(0);" class="js-unlock">解锁</a>）<?php endif; ?></td>
          <td>
	          <?php switch($v["status"]): case "0": ?><span class="text-warning">未认证</span><?php break;?>
				    <?php case "2": ?><span class="text-danger">待认证</span>（<a href="<?php echo U('auth', array('guid'=>$v['guid']))?>">查看</a>）<?php break;?>
				    <?php case "3": ?><span class="text-success">已认证</span>（<a href="<?php echo U('auth', array('guid'=>$v['guid']))?>">查看</a>）<?php break;?>
				    <?php case "4": ?><span class="text-danger">认证失败</span><?php break; endswitch;?>
          </td>
          <td><?php echo ($v["vip_name"]); ?></td>
          <td><a href="javascript:void(0)"><i class="js-del glyphicon glyphicon-trash"></i></a>　
                <?php if($v['is_verify'] == 1):?>
                    <a href="<?php echo U('view', array('guid'=>$v['guid']))?>"><i class="glyphicon glyphicon-search"></i></a>
                <?php elseif($v['is_verify'] == 2):?>
                    <a href="<?php echo U('Org/content_verify', array('org_guid'=>$v['guid']))?>"><i class="glyphicon glyphicon-search"></i></a>
                <?php endif;?>
          </td>
        </tr><?php endforeach; endif; ?>
  </tbody>
</table>
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