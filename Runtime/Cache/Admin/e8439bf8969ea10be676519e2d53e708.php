<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo C('APP_NAME')?>后台管理<?php if(!empty($meta_title)): ?>- <?php echo ($meta_title); endif; ?></title>

		<?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
		<?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
		<link rel="stylesheet" type="text/css" href="/Public/admin/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/admin/css/manage.css" />
<!--        <link rel="stylesheet" type="text/css" href="/Public/home/css/base.css" />-->
        
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
		        <h3 class="mt0" ><img src="/Public/home/images/logo.png" alt="logo" /></h3>
		      </div>
		      <div class="col-xs-5 col-md-6"></div>
		      <div class="col-xs-4 col-md-4">
		        <div class="btn-group pull-right">
		            <span class="header-btn">欢迎您, <?php echo session('SUPERAUTH.username')?></span>
		           <a href="<?php echo U('Auth/logout');?>" class="header-btn btn-exit"><i class="fa fa-power-off fa-2x"></i></a>
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
    <a href="<?php echo U('User/index'); ?>" class="list-group-item"><i class="fa fa-file-text-o"></i> 用户信息</a>
    <a href="<?php echo U('Task/index');?>" class="list-group-item"><i class="fa fa-tasks"></i> 任务管理</a>
    <a href="<?php echo U('App/index');?>" class="list-group-item"><i class="fa fa-download"></i>下载申请</a>
</div>

				</div>
				<div class="col-sm-9 col-md-10">
					
<h2 class="page-header">
	<a href="javascript:history.go(-1);" type="button" class="pull-right btn btn-default">
        <span class="glyphicon glyphicon-share-alt"></span> 返回列表
    </a>
    <?php echo $meta_title; ?>
</h2>
<form class="form-horizontal" role="form" id="regorg" method="post">
	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-6">
			<input type="text" id="username" name="username" class="form-control" placeholder="输入用户名" value="<?php echo $user['username']?>">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">登陆密码</label>
		<div class="col-sm-6">
			<input type="password" id="password" name="password" class="form-control" placeholder="输入用户密码" />
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<label for="mobile" class="col-sm-2 control-label">手机号码</label>
		<div class="col-sm-6">
			<input type="number" id="mobile" name="mobile" class="form-control" placeholder="输入手机号码" value="<?php echo $user['mobile']?>">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-6">
			<input type="email" id="email" name="email" class="form-control" placeholder="输入邮箱" value="<?php echo $user['email']?>">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<label for="real_name" class="col-sm-2 control-label">真实姓名</label>
		<div class="col-sm-6">
			<input type="text" id="real_name" name="real_name" class="form-control" placeholder="输入真实姓名" value="<?php echo $user['real_name']?>">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default js-submit">确定</button>
            <button type="button" class="btn btn-default js-submit" onclick="javascript:history.go(-1);">返回</button>
		</div>
	</div>
</form>
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