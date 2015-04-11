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
					<!DOCTYPE html>
<h2 class="page-header">
    用户详细信息
</h2>
<table class="table table-bordered">
    <tr>
        <th>真实姓名</th>
        <td><?php echo $user_info['real_name'];?></td>
    </tr>
    <tr>
        <th>性别</th>
        <td><?php if($user_info['sex'] == 0){echo '男';}else{echo '女';}?>
        </td>
    </tr>
    <tr>
        <th>头像</th>
        <td><img src="<?php echo get_image_path($user_info['photo']);?>"></td>
    </tr>
    <tr>
        <th>手机</th>
        <td><?php echo $user_info['mobile'];?></td>
    </tr>
    <tr>
        <th>邮箱</th>
        <td><?php echo $user_info['email'];?></td>
    </tr>
    <tr>
        <th>生日</th>
        <td><?php echo $user_info['birthday'];?></td>
    </tr>
    <tr>
        <th>老家</th>
        <td><?php echo $user_info['home_area'];?></td>
    </tr>
    <tr>
        <th>区域</th>
        <td><?php echo $user_info['area'];?></td>
    </tr>
    <tr>
        <th>兴趣</th>
        <td><?php foreach($user_info['interest'] as $v){ echo $v['name'].' ';};?></td>
    </tr>
    <tr>
        <th>教育</th>
        <td><?php echo $user_info['edu'];?></td>
    </tr>
    <tr>
        <th>行业</th>
        <td><?php echo $user_info['industry'];?></td>
    </tr>
    <tr>
        <th>公司</th>
        <td>
        <?php foreach($user_info['company'] as $v){ echo $v['name'].'('.$v['position'].') ';}?>
        </td>
        </td>
    </tr>
    <tr>
        <th>所属社团</th>
        <td><?php echo $user_info['org'];?></td>
    </tr>
    <tr>
        <th>个人签名</th>
        <td><?php echo $user_info['remark'];?></td>
    </tr>
    <tr>
        <th>创建时间</th>
        <td><?php echo date('Y-m-d H:i:s',$user_info['created_at']);?></td>
    </tr>
    <tr>
        <th>更新时间</th>
        <td><?php echo date('Y-m-d H:i:s',$user_info['updated_at']);?></td>
    </tr>
    <tr>
        <th>手机认证</th>
        <td>
            <?php if($user_info['moblie_verify'] == 0):?>
            未认证
            <?php else:?>
            已认证&nbsp<i class="fa fa-angellist"></i>
            <?php endif;?>
        </td>
    </tr>
    <tr>
        <th>邮箱认证</th>
        <td>
            <?php if($user_info['email_verify'] == 0):?>
            未认证
            <?php else:?>
            已认证&nbsp<i class="fa fa-angellist"></i>
            <?php endif;?>
        </td>
    </tr>
    <tr>
        <th>实名认证</th>
        <td>
            <?php if($user_info['real_name_verify'] == 0):?>
            未认证
            <?php elseif($user_info['real_name_verify'] == 1):?>
            已认证&nbsp<i class="fa fa-angellist"></i>
            <?php elseif($user_info['real_name_verify'] == 2):?>
            已提交
            <?php elseif($user_info['real_name_verify'] == 3):?>
            已拒绝<span><p>拒绝理由：<?php echo $user_attribute_info['identity_refuse_reason']?></p></span>
            <?php endif;?>
        </td>
    </tr>
</table>
<tfoot>
<input type="button" value="返回" id="return_index" name="return_index" onclick="return_index()">
</tfoot>
<script type="text/javascript">
    function return_index(){
        location.href = "<?php echo U('User/index');?>";
    }
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