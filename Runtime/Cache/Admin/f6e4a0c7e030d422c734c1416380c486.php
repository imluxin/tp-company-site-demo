<?php if (!defined('THINK_PATH')) exit();?>
<html>
<head>
<meta charset="UTF-8">
<title>后台登录</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
	<link rel="stylesheet" type="text/css" href="/Public/admin/css/common.css" />
	<link rel="stylesheet" type="text/css" href="/Public/admin/css/login.css" />

	<?php echo C('MEDIA_JS.JQUERY'); ?>
	<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
	<script type="text/javascript" src="/Public/admin/js/auth.js"></script>
	<script type="text/javascript" src="/Public/admin/js/common.js"></script>
	<script type="text/javascript">
		var YM = {
			'authLogin' : "<?php echo U('ajaxLogin');?>",
			'redirectPath':"<?php echo U('Org/index');?>"
		};
	</script>
</head>

<body>

<div class="login_main">
	<div class="container">
		<h1 class="text-center">云脉三六五后台管理系统</h1>
		<h4 class="text-center"><small>Adminstrator Management System</small></h4>
		<div class="login_form">
			<div class="login_logo "></div>
			<form role="form" class="form-signin" id="regorg">

				<input type="email" name="account" autofocus="" required="" placeholder="账号" class="form-control">
				<input type="password" name="password" required="" placeholder="密码" class="form-control">
		        <div class="checkbox">
		            <label>
		            	<input type="checkbox" value="remember-me"> 记住账号
		            </label>
		        </div>
				<button type="button" class="btn btn-lg btn-primary btn-block js-login">登录</button>
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
</body>
</html>