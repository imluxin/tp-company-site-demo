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
					<?php
 ?>


<h2 class="page-header">
    网站配置
</h2>

<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#common" role="tab" data-toggle="tab">公共</a></li>
        <li role="presentation"><a href="#admin" role="tab" data-toggle="tab">超级管理后台</a></li>
        <li role="presentation"><a href="#home" role="tab" data-toggle="tab">社团管理后台</a></li>
        <li role="presentation"><a href="#api" role="tab" data-toggle="tab">API</a></li>
        <li role="presentation"><a href="#mobile" role="tab" data-toggle="tab">3G Web</a></li>
        <li role="presentation"><a href="#site" role="tab" data-toggle="tab">APP网站</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content mt20">
        <!-- common -->
        <div role="tabpanel" class="tab-pane active" id="common">
            <form class="form-horizontal" role="form" id="common_form" method="post">
                <?php foreach($common as $c): ?>
                <div class="form-group">
                    <label for="name" class="col-xs-3 control-label"><?php echo $c['name']; ?></label>
                    <div class="col-xs-6">
                        <input type="text" id="name" name="<?php echo $c['guid']; ?>" class="form-control"  value="<?php echo $c['value']; ?>" placeholder="输入值">
                    </div>
                    <div class="col-xs-3 error-wrap"></div>
                </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-10">
                        <button type="button" form="common_form" class="btn btn-default js-submit">保存</button>
                        <a href="javascript:void(0);" type="button" module="common" class="js-creat-file btn btn-danger ml10"><span class="glyphicon glyphicon-open"></span> 生成配置文件</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- admin -->
        <div role="tabpanel" class="tab-pane" id="admin">
            <form class="form-horizontal" role="form" id="admin_form" method="post">
                <?php foreach($admin as $c): ?>
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"><?php echo $c['name']; ?></label>
                        <div class="col-sm-6">
                            <input type="text" id="name" name="<?php echo $c['guid']; ?>" class="form-control"  value="<?php echo $c['value']; ?>" placeholder="输入值">
                        </div>
                        <div class="col-sm-4 error-wrap"></div>
                    </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="button" form="admin_form" class="btn btn-default js-submit">保存</button>
                        <a href="javascript:void(0);" type="button" module="admin" class="js-creat-file btn btn-danger ml10"><span class="glyphicon glyphicon-open"></span> 生成配置文件</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- home -->
        <div role="tabpanel" class="tab-pane" id="home">
            <form class="form-horizontal" role="form" id="home_form" method="post">
                <?php foreach($home as $c): ?>
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"><?php echo $c['name']; ?></label>
                        <div class="col-sm-6">
                            <input type="text" id="name" name="<?php echo $c['guid']; ?>" class="form-control"  value="<?php echo $c['value']; ?>" placeholder="输入值">
                        </div>
                        <div class="col-sm-4 error-wrap"></div>
                    </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="button" form="home_form" class="btn btn-default js-submit">保存</button>
                        <a href="javascript:void(0);" type="button" module="home" class="js-creat-file btn btn-danger ml10"><span class="glyphicon glyphicon-open"></span> 生成配置文件</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- api -->
        <div role="tabpanel" class="tab-pane" id="api">
            <form class="form-horizontal" role="form" id="api_form" method="post">
                <?php foreach($api as $c): ?>
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"><?php echo $c['name']; ?></label>
                        <div class="col-sm-6">
                            <input type="text" id="name" name="<?php echo $c['guid']; ?>" class="form-control"  value="<?php echo $c['value']; ?>" placeholder="输入值">
                        </div>
                        <div class="col-sm-4 error-wrap"></div>
                    </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="button" form="api_form" class="btn btn-default js-submit">保存</button>
                        <a href="javascript:void(0);" type="button" module="api" class="js-creat-file btn btn-danger ml10"><span class="glyphicon glyphicon-open"></span> 生成配置文件</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- mobile -->
        <div role="tabpanel" class="tab-pane" id="mobile">
            <form class="form-horizontal" role="form" id="mobile_form" method="post">
                <?php foreach($mobile as $c): ?>
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"><?php echo $c['name']; ?></label>
                        <div class="col-sm-6">
                            <input type="text" id="name" name="<?php echo $c['guid']; ?>" class="form-control"  value="<?php echo $c['value']; ?>" placeholder="输入值">
                        </div>
                        <div class="col-sm-4 error-wrap"></div>
                    </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="button" form="mobile_form" class="btn btn-default js-submit">保存</button>
                        <a href="javascript:void(0);" type="button" module="mobile" class="js-creat-file btn btn-danger ml10"><span class="glyphicon glyphicon-open"></span> 生成配置文件</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- site -->
        <div role="tabpanel" class="tab-pane" id="site">
            <form class="form-horizontal" role="form" id="site_form" method="post">
                <?php foreach($site as $c): ?>
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"><?php echo $c['name']; ?></label>
                        <div class="col-sm-6">
                            <input type="text" id="name" name="<?php echo $c['guid']; ?>" class="form-control"  value="<?php echo $c['value']; ?>" placeholder="输入值">
                        </div>
                        <div class="col-sm-4 error-wrap"></div>
                    </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="button" form="site_form" class="btn btn-default js-submit">保存</button>
                        <a href="javascript:void(0);" type="button" module="site" class="js-creat-file btn btn-danger ml10"><span class="glyphicon glyphicon-open"></span> 生成配置文件</a>
                    </div>
                </div>
            </form></div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#flash_msg').fadeOut(2000);


    $('.js-creat-file').click(function(){
        var obj=$(this);
        var module = obj.attr('module');
        $.ajax({
            url: '<?php echo U('Config/ajax_create_config_file') ?>',
            type:'POST',
            dataType:'json',
            data: { module: module },
            beforeSend:function(){
                obj.button('loading');
            },
            success:function(data){
                if(data.status=='ok'){
                    alertTips($('#tips-modal'),data.msg);
                }else if(data.status=='ko'){
                    alertTips($('#tips-modal'),data.msg);
                }
            },
            complete:function(){
                obj.button('reset');
            }
        });
    })

    $('.js-submit').click(function(){
        var obj=$(this);
        var form_id = $(this).attr('form');
        var data=$("#"+form_id).serialize();
        $.ajax({
            url: '<?php echo U('Config/ajax_update_config'); ?>',
            type:'POST',
            data:data,
            dataType:'json',
            beforeSend:function(){
                obj.button('loading');
            },
            success:function(data){
                alertTips($('#tips-modal'), data.msg);
            },
            complete:function(){
                obj.button('reset');
            }
        })
    })
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