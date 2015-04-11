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
					<script type="text/javascript" src="/Public/Admin/js/orgIndex.js"></script>

<h2 class="page-header">
    <?php if(!$app_status_info):?>
	<a href="<?php echo U('upload/upload');?>" type="button" class="pull-right btn btn-success"><span class="glyphicon glyphicon-plus"></span> 版本更新</a>
    <?php endif;?>
    APP版本更新
</h2>
<form id="form" method="post" action="<?php echo U('Upload/index')?>">
    <table border="1" cellspacing="0" cellpadding="10" class="table table-bordered">
        <thead>
        <tr>
            <td class="w80 tc">文件版本</td>
            <td>更新内容</td>
            <td>上传时间</td>
            <td>更新时间</td>
            <td>文件状态</td>
            <td class="w120 tc">文件操作</td>
        </tr>
        </thead>

        <tbody>
        <?php if(!empty($app_upload_list)): if(is_array($app_upload_list)): $i = 0; $__LIST__ = $app_upload_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr style="height: 30px;">
                    <td><?php echo ($vo['version']); ?></td>
                    <td><?php echo str_replace("&lt;br/&gt;","\n",$vo['content'])?></td>
                    <td><?php echo date('Y-m-d H:i', $vo['created_at']);?></td>
                    <td><?php echo date('Y-m-d H:i', $vo['updated_at']);?></td>
                    <td><?php echo ($vo['status'] == 0) ? '未发布' : '已发布'; ?></td>
                    <td>
                        <?php if($vo['status'] == 0){echo '<a href = "'.U('Upload/edit', array('guid'=>$vo[guid])).'" >编辑</a>';}?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
            <tr>
                <td colspan="10">记录没有找到！</td>
            </tr><?php endif; ?>
        </tbody>
    </table>
    <?php echo ($page); ?>
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