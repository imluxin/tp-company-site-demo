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
<!--<script type="text/javascript" src="/Public/admin/js/orgIndex.js"></script>-->

<h2 class="page-header">
    <!--<a href="<?php echo U('add');?>" type="button" class="pull-right btn btn-default"><span class="glyphicon glyphicon-plus"></span> 创建社团</a>-->
    联系我们
</h2>
<form action="<?php echo U('Contact/delAll');?>" id="delForm" method="post" name="delForm">
<table class="table table-bordered">
    <tr>
        <th><input type="checkbox" name="ckAll" id="ckAll" value=""></th>
        <th>用户名</th>
        <th>创建时间</th>
        <th>简短内容</th>
        <th>操作</th>
    </tr>
    <?php foreach($list_site_contact as $l):?>
    <tr>
        <td><input type="checkbox" name="ckGuid[]" id="ckGuid[]" class="checkbox-u" value="<?php echo $l['guid'];?>"></td>
        <td><?php echo $l['name'];?></td>
        <td><?php echo date('Y-m-d H:i',$l['created_at']);?></td>
        <td><?php echo (strlen($l['content']) > 30) ? mb_substr($l['content'],0,30,'utf-8').'...' : $l['content'];?></td>
        <td><a href="<?php echo U('Contact/del/',array('contact_guid' => $l['guid']));?>" onclick="return confirm('确实要删除吗？')"><i class="js-del glyphicon glyphicon-trash"></i></a>　<a href="<?php echo U('Contact/content', array('contact_guid'=>$l['guid']))?>"><i class="glyphicon glyphicon-search"></i></a></td>
    </tr>
    <?php endforeach; ?>
    <tfoot>
    <input type="button" disabled='true' value="删除" id="del" name="del">
    </tfoot>
</table>
<?php echo $page;?>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        //复选框  全选js效果
        $('#ckAll').on('change', function () {
            $("input.checkbox-u").prop('checked', $(this).prop("checked"));
        });
        //多选删除,如果没有复选框被选中则不能点击删除按钮
        $('.checkbox-u').click(function(){
            var flag_one = false;
            $('.checkbox-u').each(function(){
                if($(this).is(":checked")){
                	flag_one = true;
                }
            })

            if(flag_one){
               $('#del').removeAttr('disabled'); 
            }else{
           	   $('#del').attr('disabled',true); 
            }
        })

        //全选删除,如果没有复选框被选中则不能点击删除按钮
        $('#ckAll').click(function() {
            var flag_two = false;
            if($('#ckAll').is(':checked')){
                flag_two = true;
            }

            if(flag_two){
                $('#del').removeAttr('disabled');
            }else{
                $('#del').attr('disabled',true);
            }
        });

        //删除弹出样式
        $('#del').click(function(){
            if(confirm('确实要删除选定项吗？')){
                $('#delForm').submit();
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