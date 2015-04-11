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
    <a href="<?php echo U('User/index');?>" class="list-group-item"><i class="fa fa-file-text-o"></i> 用户信息</a>
    <a href="<?php echo U('Task/index');?>" class="list-group-item"><i class="fa fa-tasks"></i> 任务管理</a>
    <a href="<?php echo U('App/index');?>" class="list-group-item"><i class="fa fa-download"></i>下载申请</a>
</div>

				</div>
				<div class="col-sm-9 col-md-10">
					<!--<script type="text/javascript" src="/Public/admin/js/orgAdd.js"></script>-->

<h2 class="page-header">
	<a href="<?php echo U('index');?>" type="button" class="pull-right btn btn-default"><span class="glyphicon glyphicon-share-alt"></span> 返回列表</a>
	创建社团
</h2>
<form class="form-horizontal" role="form" id="regorg">
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">登陆邮箱</label>
		<div class="col-sm-6">
			<input type="text" id="email" name="email" class="form-control" placeholder="输入用户邮箱">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<label for="passwd" class="col-sm-2 control-label">登陆密码</label>
		<div class="col-sm-6">
			<input type="password" id="passwd" name="password" class="form-control" placeholder="输入用户密码">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
<!--	<div class="form-group">-->
<!--		<label for="phone" class="col-sm-2 control-label">联系电话</label>-->
<!--		<div class="col-sm-6">-->
<!--			<input type="text" id="phone" name="mobile" class="form-control" placeholder="输入用户电话">-->
<!--		</div>-->
<!--		<div class="col-sm-4 error-wrap"></div>-->
<!--	</div>-->
	<div class="form-group">
		<label for="repasswd" class="col-sm-2 control-label">密码确认</label>
		<div class="col-sm-6">
			<input type="password" id="repasswd" name="repassword" class="form-control" placeholder="输入密码重复">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<label for="orgName" class="col-sm-2 control-label">社团名称</label>
		<div class="col-sm-6">
			<input type="text" id="orgName" name="name" class="form-control" placeholder="输入社团名称">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default js-submit">注册</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	var YM = {
		'regOrg' : "<?php echo U('regOrg');?>",
		'checkMail': "<?php echo U('checkMail');?>",
		'checkMobile': "<?php echo U('checkMobile');?>",
		'checkGroupName': "<?php echo U('checkGroupName');?>",
		'redirectPath':"<?php echo U('index');?>"
	};
	$(document).ready(function(){

		/**
		 * 验证保存社团信息
		 *
		 * CT: 2014-12-02 10:50 by QXL
		 */
		$('#regorg').validate({
			errorClass: "invalid",
			errorPlacement: function(error, element){
				element.parents('.form-group').find('.error-wrap').append(error);
			},
			rules: {
				email: {
					required: true,
					email: true,
					remote:{
						url: YM['checkMail'],
						type:'post'
					}
				},
				name: {
					required: true,
					rangelength: [2, 50],
					remote:{
						url: YM['checkGroupName'],
						type:'post'
					}
				},
				password: {
					required: true,
					rangelength: [6, 18]
				},
				repassword:{
					required: true,
					equalTo:"#passwd"
				}
			},
			messages: {
				email: {
					required: "电子邮箱地址不能为空",
					email: "电子邮箱格式不正确",
					remote:"该电子邮箱已存在"
				},
				name: {
					required: "社团名称不能为空",
					rangelength: "社团名称不得少于两个字，不得多于五十个字",
					remote:"该社团名称已存在"
				},
				password: {
					required: "用户密码不能为空",
					rangelength: "用户密码必须为6到18个字符"
				},
				repassword: {
					required: "密码确认不能为空",
					equalTo: "用户密码和密码确认必须一致"
				}
			},
			submitHandler: function(form) { //通过之后回调
				var obj=$(this);
				var data=$("#regorg").serialize();
				$.ajax({
					url:YM['regOrg'],
					type:'POST',
					data:data,
					dataType:'json',
					beforeSend:function(){
						obj.button('loading');
					},
					success:function(data){
						if(data.code=='200'){
							alertTips($('#tips-modal'),'注册成功',YM['redirectPath']);
						}else if(data.code=='201'){
							alertTips($('#tips-modal'),'注册失败');
						}
					},
					complete:function(){
						obj.button('reset');
					}
				});
			},
			invalidHandler: function(form, validator) { //不通过回调
				return false;
			}
		});
	});
</script>
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