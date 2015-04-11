<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>云脉365后台管理<?php if(!empty($meta_title)): ?>- <?php echo ($meta_title); endif; ?></title>

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
		        <h3 class="mt0" >云脉365</h3>
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
					<script type="text/javascript">
	var YM = {
		'saveFlow' : "<?php echo U('save_flow');?>",
		'redirectPath':"<?php echo U('flow');?>",
		'guid':"<?php echo ($_GET['guid']); ?>"
	};
</script>

<h2 class="page-header">
	<a href="<?php echo U('index');?>" type="button" class="pull-right btn btn-default"><span class="glyphicon glyphicon-share-alt"></span> 返回列表</a>
	新增任务流
</h2>
<form class="form-horizontal" role="form" id="regorg">
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">任务流名称</label>
		<div class="col-sm-6">
		    <input type="hidden" name="guid" value="<?php echo ($_GET['guid']); ?>" />
			<input type="text" id="name" name="flowname" class="form-control"  value="<?php echo ($task_flow_info["name"]); ?>" placeholder="输入任务名称">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	
	<div class="form-group">
	    <label for="name" class="col-sm-2 control-label">任务列表</label>
	    <div class="col-sm-10">
            <table id="example" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>任务编号</th>
                        <th>任务名称</th>
                        <th>操作</th>
                    </tr>
                </thead>             
                <tbody>
                    <?php if(is_array($task_list)): foreach($task_list as $key=>$vo): ?><tr class="task_flow_item" data-guid="<?php echo ($vo["guid"]); ?>">
                            <td><?php echo ($vo["id"]); ?></td>
                            <td class="task_flow_name"><?php echo ($vo["name"]); ?></td>
                            <td><a class="js_add_flow" href="javascript:void(0);">添加</a></td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">已选任务</label>
		<div class="col-sm-6">
		    <ul class="selected_task_list list-group" style="margin-top:0;">
                <!-- 已选任务列表 -->
                <?php if(is_array($selected_task_list)): foreach($selected_task_list as $key=>$vo): ?><li class="list-group-item"><input type="hidden" name="selected_guid" value="<?php echo ($vo["guid"]); ?>" /><i class="fa fa-trash-o pull-right js_del_task"></i><span class="selected_task_name"><?php echo ($vo["name"]); ?></span></li><?php endforeach; endif; ?>
            </ul>
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default js-submit">保存</button>
		</div>
	</div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').dataTable({
     	        "info": false,
                "language": {
                	"processing": "玩命加载中...",
                	"lengthMenu": "显示 _MENU_ 项结果",
                	"zeroRecords": "没有匹配结果",
                	"info": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                	"infoEmpty": "显示第 0 至 0 项结果，共 0 项",
                	"infoFiltered": "(由 _MAX_ 项结果过滤)",
                	"infoPostFix": "",
                	"search": "",
                	"url": "",
                	"paginate": {
                		"first":    "首页",
                		"previous": "上页",
                		"next":     "下页",
                		"last":     "末页"
                	}
                }
            });
        $('#example_length').hide();
        $('#example_filter').addClass('pull-left');
        $('#example_filter').find('input').addClass('form-control');
        $('#example_filter').find('input').css({'margin-left':'0','font-weight':'normal'});
        $('#example_filter').find('input').attr('placeholder','查找任务信息');
    } );
</script>

<script type="text/javascript" src="/Public/common/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/common/css/datatables/jquery.dataTables.css" />
<script type="text/javascript" src="/Public/admin/js/taskflow.js"></script>
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