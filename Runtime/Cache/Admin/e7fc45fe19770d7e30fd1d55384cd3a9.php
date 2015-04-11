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
					<link rel="stylesheet" type="text/css" href="/Public/common/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/css/task.css" />
<script type="text/javascript" src="/Public/common/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">
	var YM = {
		'saveTask' : "<?php echo U('save_task');?>",
		'redirectPath':"<?php echo U('index');?>",
		'task_info_description':'<?php echo ($task_info["description"]); ?>',
		'task_condition_guid':'<?php echo ($task_condition_guid); ?>'
	};
</script>

<h2 class="page-header">
	<a href="<?php echo U('index');?>" type="button" class="pull-right btn btn-default"><span class="glyphicon glyphicon-share-alt"></span> 返回列表</a>
	新增任务
</h2>
<form class="form-horizontal" role="form" id="regorg">
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">任务名称</label>
		<div class="col-sm-6">
		    <input type="hidden" name="guid" value="<?php echo ($_GET['guid']); ?>" />
			<input type="text" id="name" name="name" class="form-control"  value="<?php echo ($task_info["name"]); ?>" placeholder="输入任务名称">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	
    <div class="form-group">
        <label for="type" class="col-sm-2 control-label">任务类型</label>
        <div class="col-sm-6">
            <select class="form-control" name="type" >
                <option>请选择任务类型</option>
                <option value="1" <?php if(($task_info["type"]) == "1"): ?>selected=true<?php endif; ?> >普通</option>
                <option value="2" <?php if(($task_info["type"]) == "2"): ?>selected=true<?php endif; ?> >日常</option>
            </select>
        </div>
        <div class="col-sm-4 error-wrap"></div>
    </div>
    
    <?php if(($task_info["type"]) == "2"): ?><div class="form-group time-wrap">
            <label for="type" class="col-sm-2 control-label">任务时间</label>
            <div class="col-sm-3">
                <div class="input-group date form_datetime">
                    <div>
                        <input class="form-control" size="16" type="text" value="<?php echo ($task_info["startime"]); ?>" name="startTime" id="startTime" readonly>
                    </div>
                    <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                </div>
            </div>
            <div class="col-sm-1 time-center-text">至</div>
            <div class="col-sm-3">
                <div class="input-group date form_datetime">
                    <div>
                        <input class="form-control" size="16"  type="text" value="<?php echo ($task_info["endtime"]); ?>" name="endTime" id="endTime" readonly>
                    </div>
                    <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                </div>
            </div>
            <div class="col-sm-4 error-wrap"></div>
        </div>
    <?php else: ?>
        <div class="form-group time-wrap hiden">
            <label for="type" class="col-sm-2 control-label">任务时间</label>
            <div class="col-sm-3">
                <div class="input-group date form_datetime">
                    <div>
                        <input class="form-control" size="16" type="text" value="" name="startTime" id="startTime" readonly>
                    </div>
                    <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                </div>
            </div>
            <div class="col-sm-1 time-center-text">至</div>
            <div class="col-sm-3">
                <div class="input-group date form_datetime">
                    <div>
                        <input class="form-control" size="16"  type="text" value="" name="endTime" id="endTime" readonly>
                    </div>
                    <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                </div>
            </div>
            <div class="col-sm-4 error-wrap"></div>
        </div><?php endif; ?>
	
	<div class="form-group">
		<label for="sign" class="col-sm-2 control-label">任务缩略图</label>
		<div class="col-sm-6">
			<button type="button" id="promptzone" class="btn btn-default"><i class="fa fa-upload"></i> 上传缩略图</button>
			<?php if(isset($task_info["thumb"])): ?><div class="mt10 task_thumb">
		          <img style="width:200px;" src="/Upload<?php echo ($task_info["thumb"]); ?>" id="task_thumb" class="img-thumbnail" />
		          <input type="hidden" name="thumb" value="<?php echo ($task_info["thumb"]); ?>" />
    			</div>
            <?php else: ?> 
    			<div class="mt10 task_thumb" style="display:none;">
		          <img style="width:200px;" src="" id="task_thumb" class="img-thumbnail" />
		          <input type="hidden" name="thumb" value="" />
    			</div><?php endif; ?>
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	
	<div class="form-group">
		<label for="integral" class="col-sm-2 control-label">奖励积分</label>
		<div class="col-sm-6">
			<input type="text" id="integral" name="integral" class="form-control"  value="<?php echo ($task_info["integral"]); ?>" placeholder="输入奖励积分">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	
	<div class="form-group">
		<label for="exp" class="col-sm-2 control-label">奖励经验</label>
		<div class="col-sm-6">
			<input type="text" id="exp" name="exp" class="form-control"  value="<?php echo ($task_info["exp"]); ?>" placeholder="输入奖励经验">
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	
	
	<div class="form-group">
		<label for="exp" class="col-sm-2 control-label">任务条件</label>
		<div class="col-sm-9">
			<button type="button" class="js_add_condition btn btn-default"><i class="fa fa-plus"></i> 添加条件</button>
       	    <div class="condition_wrap">
       	        <?php if(is_array($task_condition)): foreach($task_condition as $key=>$vo): ?><div class="row mt10 condition_item">
                       <input type="hidden" class="form-control" value="<?php echo ($vo["guid"]); ?>" name="condition_guid" />
                       <div class="col-sm-3 condition_name_wrap"><input type="text" class="form-control" value="<?php echo ($vo["name"]); ?>" name="condition_name" placeholder="条件说明" /><div class="error-wrap"></div></div>
                       <div class="col-sm-3 condition_type_wrap">
                           <select name="task_sign" class="form-control">
                               <option value="0">任务类型</option>
                               <?php if(is_array($task_type_list)): foreach($task_type_list as $key=>$type): ?><option value="<?php echo ($type["id"]); ?>" <?php if(($vo["sign"]) == $type["id"]): ?>selected=true<?php endif; ?> ><?php echo ($type["name"]); ?></option><?php endforeach; endif; ?>
                           </select>
                           <div class="error-wrap"></div>
                       </div>
                       <?php switch($vo["sign"]): case "4": ?><div class="col-sm-3 condition_type finish_num_wrap">
                        	    	<select name="info_type" class="form-control">';
                            	    	<option value="1" <?php if(($vo["type"]) == "1"): ?>selected=true<?php endif; ?> >生日</option>
                            	    	<option value="2" <?php if(($vo["type"]) == "2"): ?>selected=true<?php endif; ?> >家乡</option>
                            	    	<option value="3" <?php if(($vo["type"]) == "3"): ?>selected=true<?php endif; ?> >兴趣</option>
                            	    	<option value="4" <?php if(($vo["type"]) == "4"): ?>selected=true<?php endif; ?> >教育</option>
                            	    	<option value="5" <?php if(($vo["type"]) == "5"): ?>selected=true<?php endif; ?> >现居</option>
                            	    	<option value="6" <?php if(($vo["type"]) == "6"): ?>selected=true<?php endif; ?> >行业</option>
                            	    	<option value="7" <?php if(($vo["type"]) == "7"): ?>selected=true<?php endif; ?> >公司</option>
                            	    	<option value="8" <?php if(($vo["type"]) == "8"): ?>selected=true<?php endif; ?> >签名</option>
                					</select>
            					</div><?php break;?>
                            <?php default: ?>
                            <div class="col-sm-3 condition_type finish_num_wrap"><input type="text" class="form-control" value="<?php echo ($vo["finish_num"]); ?>" name="condition_finish_num" placeholder="数量" /><div class="error-wrap"></div></div><?php endswitch;?>
                       <div class="col-sm-3 condition_webjs_wrap">
                            <select name="ym_js" class="form-control">
                              <option value="0">任务指向</option>
                              <?php if(is_array($ym_js)): foreach($ym_js as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if(($vo["webjs"]) == $v["id"]): ?>selected=true<?php endif; ?> ><?php echo ($v["description"]); ?></option><?php endforeach; endif; ?>
                            </select>
                            <div class="error-wrap"></div>
                       </div>
                       <div class="col-sm-1 del-icon"><i class="fa fa-trash-o js_del_condition"></i></div>
                    </div><?php endforeach; endif; ?>
	        </div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="content" class="col-sm-2 control-label">任务描述</label>
		<div class="col-sm-9">
			 <textarea id="content" name="content"></textarea>
			 <div class="col-sm-12 error-wrap" style="padding:0 2px;"></div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="ym_editor" class="col-sm-2 control-label">任务状态<?php echo ($task_flow_info["is_del"]); ?></label>
		<div class="col-sm-6">
			<label class="radio-inline">
              <input type="radio" name="is_del" value="0" class="flow_state" <?php if(($task_flow_info["is_del"]) == "0"): ?>checked=true<?php endif; ?>> 开启
            </label>
            <label class="radio-inline">
              <input type="radio" name="is_del" value="1" class="flow_state" <?php if(($task_flow_info["is_del"]) == "1"): ?>checked=true<?php endif; ?>> 关闭
            </label>
		</div>
		<div class="col-sm-4 error-wrap"></div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default js-submit">保存</button>
		</div>
	</div>
</form>

<script type="text/javascript">
    $(function(){
    	$('body').on('click','.js_add_condition',function(){
    		var html='';
    		html += '<div class="row mt10 condition_item">';
    		html += '<div class="col-sm-3 condition_name_wrap"><input type="text" class="form-control" name="condition_name" placeholder="条件说明" /><div class="error-wrap"></div></div>';
    		html += '<div class="col-sm-3 condition_type_wrap">';
			html += '<select name="task_sign" class="form-control">';
			html += '<option value="0">任务类型</option>';
			<?php if(is_array($task_type_list)): foreach($task_type_list as $key=>$type): ?>html += '<option value="<?php echo ($type["id"]); ?>"><?php echo ($type["name"]); ?></option>';<?php endforeach; endif; ?>
			html += '</select>';
			html += '<div class="error-wrap"></div>';
			html += '</div>';
    		html += '<div class="col-sm-3 condition_type finish_num_wrap"><input type="text" class="form-control" name="condition_finish_num" placeholder="数量" /><div class="error-wrap"></div></div>';
    		html += '<div class="col-sm-3 condition_webjs_wrap">';
    		html += '<select name="ym_js" class="form-control">';
    		html += '<option value="0">任务指向</option>';
    		<?php if(is_array($ym_js)): foreach($ym_js as $key=>$v): ?>html += '<option value="<?php echo ($v["id"]); ?>"><?php echo ($v["description"]); ?></option>';<?php endforeach; endif; ?>
    		html += '</select>';
    		html += '<div class="error-wrap"></div>';
    		html += '</div>';
    		html += '<div class="col-sm-1 del-icon"><i class="js_del_condition fa fa-trash-o"></i></div>';
    		html += '</div>';
    		$('.condition_wrap').append(html);
    	})
    	
    	$('body').on('change','select[name=task_sign]',function(){
    	    var type = $(this).val();
    	    var html = '';
    	    switch(type){
        	    case '4':
        	    	html += '<select name="info_type" class="form-control">';
        	    	html += '<option value="1">生日</option>';
        	    	html += '<option value="2">家乡</option>';
        	    	html += '<option value="3">兴趣</option>';
        	    	html += '<option value="4">教育</option>';
        	    	html += '<option value="5">现居</option>';
        	    	html += '<option value="6">行业</option>';
        	    	html += '<option value="7">公司</option>';
        	    	html += '<option value="8">签名</option>';
					html += '</select>';
        	      break;
        	    default:
        	    	html = '<input type="text" class="form-control" name="condition_finish_num" placeholder="数量" /><div class="error-wrap"></div>'
    	    	  break;
    	    }
    	    $(this).parents('.condition_item').find('.condition_type').html(html);
    	})
    	
    	$('body').on('change','select[name=type]',function(){
    	    var type = $(this).val();
    	    switch(type){
        	    case '2':
     	    	   $('.time-wrap').show();
        	      break;
        	    default:
      	    	   $('.time-wrap').hide();
    	    }
    	})
    	
		$('#promptzone').ajaxUploadPrompt({
			url : "<?php echo U('Common/ajax_upload', array('t'=>'task')) ?>",
			type: "POST",
			dataType: "json",
			data: { '<?php echo session_name();?>':'<?php echo session_id();?>' },
			beforeSend : function () {
                $('#promptzone').after('<div id="loading-cover"><i id="loading" class="fa fa-spinner fa-spin"></i></div>');
			},
			error : function () {
				alertTips($('#tips-modal'),'服务器出错, 请稍后重试!');
			},
			success : function (data) {
 				$('#loading-cover').remove();
				output = data.data;
				if(data.status == 'ok') {
					$('img#task_thumb').attr('src', output.path+'?'+$.now());
					$('input[name=thumb]').val(output.val);
					$('.task_thumb').show();
				} else {
                    alertTips($('#tips-modal'), data.msg);
				}
			}
		});
    })
</script>

<script type="text/javascript" src="/Public/admin/js/taskedit.js"></script>
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