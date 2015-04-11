<?php if (!defined('THINK_PATH')) exit();?>
<style>
#promptzone {position: relative;}
/*#upload-view:hover { background: rgba(36, 148, 242, 0.8); z-index: 1000; }*/
.thumb-mask {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 200px;
    background: #FFF;
    opacity: 0;
    cursor: pointer;
}
.thumb-mask:hover {
    filter: alpha(opacity=5);
    -moz-opacity: 0.05;
    opacity: 0.7; }
#upload-view { cursor: pointer; height: 200px; }
/* .logo{max-width:200px; } */
#loading-cover { position: absolute; top: 0; left: 0; width: 100%; height: 200px; background: #FFF;
filter: alpha(opacity=5);
-moz-opacity: 0.05;
opacity: 0.5; }
#loading {font-size: 90px; line-height: 200px;}
</style>
<?php  ?>

<!-- css 文件 -->
<link rel="stylesheet" type="text/css" href="/Public/common/css/redmond/jqueryui.css" />
<link rel="stylesheet" type="text/css" href="/Public/common/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/common/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/base.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/modal.css" />

<!-- js 文件 -->
<script type="text/javascript" src="/Public/common/js/jquery.js"></script>
<script type="text/javascript" src="/Public/common/js/jqueryui.js"></script>
<script type="text/javascript" src="/Public/common/js/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/common/js/additional-methods.js"></script>
<script type="text/javascript" src="/Public/common/js/showBox/FenBox.js"></script>
<script type="text/javascript" src="/Public/common/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/common/js/jquery.ajaxupload.js"></script>
<?php echo C('MEDIA_JS.ZERO_CLIPBOARD'); ?>
<script type="text/javascript" src="/Public/common/js/common.js"></script>
<script type="text/javascript" src="/Public/common/js/jquery.lazyload.js"></script>

  
  <div class="myform2">
  <form id="myForm">
    <h4 class="color0"><?php echo $title?>：</h4>

    <?php if ($val == 'error'): ?>
       <div class="alert alert-warning alert-dismissible" role="alert"><?php echo L('params_error')?></div>
    
    <?php else: ?>
    
        <div class="mb20 text-center" style="position: relative; height: 200px;">
            <?php
 if ($key == 'logo') $pl='noportrait.jpg'; if (in_array($key, array('legal_p_card', 'yingye', 'zuzhi'))) $pl = 'placeholder.png'; ?>
            <div id="promptzone" style="width:100%;height:200px;">
                <div class="thumb-mask"><span id="loading" class="glyphicon glyphicon-upload"></span></div>
                <img id="upload-view" class="<?php echo $key?>" src="<?php echo get_image_path($val, $pl); ?>">
            </div>
        </div>
        <span class="help-block mt-20">注：图片仅支持JPG，PNG格式，文件小于2M，以确保正常显示</span>
        <input type="hidden" name="savename" id="savename" />
        
        <div class="btn-group">
          <button type="button" class="btn mybtn active" id="save">保存</button>
          <button type="button" class="btn mybtn" onclick="$.closeBox();">取消</button>
        </div>
    <?php endif;?>
</form>
</div>

<!-- 提示信息 BEGIN -->
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
<script type="text/javascript">
	$(document).ready(function(){ 
		
		//图片异步加载
		$("img").lazyload({    
			placeholder : "/Public/common/images/grey.gif",    
			effect : "fadeIn"   
		});
        // 上传图片

		// Set fieldname
		$.ajaxUploadSettings.name = 'uploads[]';
		// Set promptzone
		$('#promptzone').ajaxUploadPrompt({
			url : "<?php echo U('Common/ajax_upload', array('t'=>$key)) ?>",
			type: "POST",
			dataType: "json",
			data: { '<?php echo session_name()?>':'<?php echo session_id()?>', guid:'<?php echo $guid?>' },
			beforeSend : function () {
                $('#promptzone').append('<div id="loading-cover"><i id="loading" class="fa fa-spinner fa-spin"></i></div>');
			},
			error : function () {
				alertTips($('#tips-modal'),'服务器出错, 请稍后重试!');
			},
			success : function (data) {
				$('#loading-cover').remove();
				output = data.data;
				if(data.status == 'ok') {
					$('img#upload-view').attr('src', output.path+'?'+$.now());
					$('input#savename').val(output.val);
				} else {
                    alertTips($('#tips-modal'), data.msg);
				}
			}
		});

		// 点击保存按钮
    	$('#save').click(function(){
            	// var val = $('#val').val();
            	var savename = $('#savename').val();
            	$.ajax({
                    type: "POST",
                    url: "<?php echo U('Org/ajax_edit_pic'); ?>",
                    data: { k:'<?php echo $key?>', savename:savename},
                    dataType: "json",
                    beforeSend: function(){
                        $('#myForm').append('<i id="loading" class="fa fa-spinner fa-spin"></i>');
                    }, 
                    success: function(data){                                          
                          if (data.status=='ok') {

                              <?php if($key == 'logo'): ?>
                                  $(parent.document).find('img#top_logo').attr('src', data.data.val+'?'+$.now());
                              <?php endif; ?>
                              $('#loading').remove();
                              <?php if(in_array($key, array('logo', 'legal_p_card', 'yingye', 'zuzhi'))): ?>
                              	$(parent.document).find('img#<?php echo $key?>V').attr('src', data.data.val+'?'+$.now());
                                $.closeBox();
                              <?php else: ?>
                              	alert('系统错误, 请稍后再试.');
                              <?php endif; ?>
                         	
                          } else if (data.status=='ko') {
                              $('#loading').remove();
                         	   alert(data.msg);
                          } else if (data.status == 'cancel') {
                      	     $.closeBox();
                          }
                   }
                });
    	});
	 });
</script>