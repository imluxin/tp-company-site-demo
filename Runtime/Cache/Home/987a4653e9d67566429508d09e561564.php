<?php if (!defined('THINK_PATH')) exit(); ?>

<!DOCTYPE html>
<html>
    <!-- head -->
    <?php  ?>
<head>
    <meta charset="UTF-8">
        
    <!-- css 文件 -->
    <?php echo C('MEDIA_CSS.JQUERYUI'); ?>
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
    <?php echo C('MEDIA_CSS.BASE'); ?>
    <?php echo C('MEDIA_CSS.MODAL'); ?>
    <?php echo C('MEDIA_CSS.ACTIVITY_VOTE'); ?>
    
    <title><?php echo C('APP_NAME'); if(!empty($meta_title)): ?>- <?php echo ($meta_title); endif; ?></title>
    <meta name="keywords" content="社团邦，云脉365，天津云脉三六五科技有限公司，即时通信，聊天APP，社团管理平台，人脉">
    <meta name="description" content="社团邦，社团管理平台">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <?php echo C('MEDIA_FAVICON')?>

    <!-- 加载JS文件 -->
    <?php  ?>

<!-- js 文件 -->
<?php echo C('MEDIA_JS.JQUERY'); ?>
<?php echo C('MEDIA_JS.JQUERYUI'); ?>
<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
<?php echo C('MEDIA_JS.JQUERY_VALIDATE'); ?>
<?php echo C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL'); ?>
<?php echo C('MEDIA_JS.JQUERY_LAZYLOAD'); ?>
<?php echo C('MEDIA_JS.JQUERY_AJAXUPLOAD'); ?>
<?php echo C('MEDIA_JS.IFRAME_BOX'); ?>
<?php echo C('MEDIA_JS.ZERO_CLIPBOARD'); ?>
<?php echo C('MEDIA_JS.COMMON'); ?>
<script type="text/javascript" src="/Public/common/js/jquery.lazyload.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
    
	<body class="bodybg">
       <!-- 顶部导航栏 -->
	   <?php  ?>

<!-- Head Starting -->   
<div class="header">
  <div class="container">
    <div class="row">
      <div class="col-xs-7">
        <p class="topwd">社团邦 | 社团管理平台 <small style="color: #ccc;">Preview 1.0</small></p>
      </div>
      <div class="col-xs-5">
        <div class="pull-right">
            <div class="row">
                <div class="headicon">
                    <a href="<?php echo U('Org/info')?>"><img id="top_logo" src="<?php echo get_image_path($auth['org_logo'])?>" class="headicon"></a>
                </div>
                <div class="ligeticon">
                    <a href="<?php echo U('Message/index')?>" class="pull-left" title="消息管理"><i class="fa fa-comment"></i></a>
                    <span class="mybadge"><?php echo !empty($new_msg_count)?'1':null; ?></span>
                </div>
                <div class="ligeticon mt3 mr5">
                    <a class="user_logout" href="<?php echo U('Auth/logout')?>" title="退出登陆"><i class="fa fa-power-off"></i></a>
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- Head Ending --> 
         
       
       <!-- 主体 -->
	   <div class="container">
	       <div class="row main">
	           <div class="col-xs-2 main-left">
	               <?php  ?>

<!-- 左边导航 -->
<div class="row">
    <ul class="nav nav-pills nav-stacked left-menu" role="tablist">
      <li role="presentation" class="left-menu-home <?php echo in_array(CONTROLLER_NAME, array('Index'))?'left-menu-home-active':''?>">
        <a href="<?php echo U('Index/index')?>"><i class="fa fa-home fa-4x"></i></a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Org'))?'active':''?>">
        <a href="<?php echo U('Org/info')?>">
          <i class="fa fa-cog fa-2x"></i><br>
          <label class="mt10">基本信息</label>
        </a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Message'))?'active':''?>">
        <a href="<?php echo U('Message/index')?>">
          <i class="fa fa-comments fa-2x"></i><br>
          <label class="mt10">消息管理</label>
        </a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Member'))?'active':''?>">
        <a href="<?php echo U('Member/index')?>">
          <i class="fa fa-user fa-2x"></i><br>
          <label class="mt10">社员管理</label>
        </a>
      </li>
      <li role="presentation" class="<?php echo in_array(CONTROLLER_NAME, array('Activity'))?'active':''?>">
        <a href="<?php echo U('Activity/index')?>">
          <i class="fa fa-flag fa-2x"></i><br>
          <label class="mt10">活动管理</label>
        </a>
      </li>
    </ul>
</div>
<div class="leftbarlast"></div>

	           </div>
	           <div class="col-xs-10 main-right">
                    <?php
 ?>
<link rel="stylesheet" type="text/css" href="/Public/home/css/member-list.css" />

<!-- 导入面包屑 -->
<?php
$breadcrumbs = array( 'base' => '社员管理', 'list' => array( array('url'=>'', 'v'=>'分组管理') ) ); ?>
<?php if (!empty($breadcrumbs)): ?>
    <div class="ymtitle">
        <?php echo $breadcrumbs['base']?>
        <?php foreach ($breadcrumbs['list'] as $l): ?>
            >>
            <?php
 if(mb_strlen($l['v'], 'UTF-8') > 18){ $v = mb_substr($l['v'], 0, 18, 'UTF-8').'...'; } else { $v = $l['v']; } ?>
            <?php if(!empty($l['url'])): ?>
                <a href="<?php echo $l['url']?>" class="h5title" title="<?php echo $l['v']?>"><?php echo $v;?></a>
            <?php else: ?>
                <span class="h5title"><?php echo $v;?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif;?>

    <div class="ymnaw">
        <ul class="nav nav-tabs ymbtn" role="tablist">
            <li role="presentation"><a href="<?php echo U('Member/index')?>">社员列表</a></li>
            <li role="presentation" class="active"><a href="javascript:void(0);">分组管理</a></li>
        </ul>
    </div>

    <!--右侧主体开始-->
    <div class="rightmain">
    	<div class="alert alert-dismissible tips-box" role="alert" style="display:none;">
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <span class="tips-msg"></span>
		</div>
		
        <div class="btn-group pdlf30">
            <h4>组别：</h4>
            <form id="ogm_form_edit" name='ogm_form_edit' method="post" action="">
                <?php if(!empty($list)): ?>
                    <?php foreach ($list as $l): ?>
                        <?php
 ?>
<div class="form-group">
    <div class="input-group">
    	<div class="txt-wrap pull-left radius0 groupwidth form-control"><?php echo $l['name']?></div>
    	<input type="text" style="display:none;" class="txt form-control radius0 groupwidth" data-name="<?php echo $l['name']?>" data-guid="<?php echo $l['guid']?>" name="group_name" value="<?php echo $l['name']?>">
       	<span class="input-group-btn group_btn_dlt pull-left" data-guid="<?php echo $l['guid']?>">
        	<button class="btn btn-default radius0 js_edit"  type="button"><i class="glyphicon glyphicon-edit"></i></button>
        	<button class="btn btn-default radius0 g_del" type="button"><i class="glyphicon glyphicon-trash"></i></button>
        </span>
    </div>
</div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-message" id="org_no_group">
                        暂无分组，请点击“添加分组”按钮，为您的社团添加分组
                    </div>
                <?php endif; ?>
            </form>

            <div class="mb40">
                <button type="button" class="btn  btn-default radius0" id="g_add"><i class="fa fa-plus"></i> 添加分组</button>
            </div>
        </div>
    </div>

<script type="text/javascript">
$(document).ready(function(){
	var NUM_ORG_GROUP="<?php echo ($NUM_ORG_GROUP); ?>"
	$('body').on('click','.js_edit',function(){
		edit_ogm($(this));
	})
	
	/*
	$('body').on('focus','.txt',function(){
		edit_ogm($(this).parents('.input-group').find('.input-group-btn'));
	})
	*/
	
	$('body').on('click','.js_close',function(){
		var group_name = $(this).parents('.input-group').find('.txt').attr('data-name');
		$(this).parents('.form-group').find('.txt').val(group_name).hide();
		$(this).parents('.form-group').find('.txt-wrap').html(group_name).show();
		var html = "<button class='btn btn-default radius0 js_edit' type='button'><i class='glyphicon glyphicon-edit'></i></button>";
			html+= "<button class='btn btn-default radius0 g_del' type='button'><i class='glyphicon glyphicon-trash'></i></button>";
		if(group_name){
			$(this).parents('.input-group-btn').html(html);
		}else{
			$(this).parents('.form-group').remove();
		}
		
	})
	
	$('body').on('click','.js_save',function(){
		var obj = $(this);
		var group_name = $(this).parents('.input-group').find('.txt').val();
		var guid = $(this).parents('.input-group').find('.txt').attr('data-guid');
		var data = {group_name:group_name, guid:guid}
		
		if(group_name == ''){
			tips_info('alert-warning', '分组名称不能为空');
			return false;
		}
		
        $.ajax({
            type: "POST",
            url: "<?php echo U('Member/ogm_save'); ?>",
            data: data,
            dataType: "json",
            beforeSend: function(){
                
            },
            success: function(data){
                if (data.status=='ok') {
                	if(data.attach){
                		obj.parents('.input-group-btn').attr('data-guid',data.attach.guid);
                		obj.parents('.input-group').find('.txt').attr('data-guid',data.attach.guid);
                	}
                	obj.parents('.input-group').find('.txt').attr('data-name',group_name).hide();
                	obj.parents('.input-group').find('.txt-wrap').html(group_name).show();
                	var html = "<button class='btn btn-default radius0 js_edit' type='button'><i class='glyphicon glyphicon-edit'></i></button>";
    				html+= "<button class='btn btn-default radius0 g_del' type='button'><i class='glyphicon glyphicon-trash'></i></button>";
   					obj.parents('.input-group-btn').html(html);
   					tips_info('alert-success', data.msg);
                } else if (data.status=='ko') {
                	tips_info('alert-warning', data.msg);
                }
            }
        });
		
	})
	
	
    $('#g_add').on('click', function(){
    	if($('.form-group').size() > NUM_ORG_GROUP){
    		tips_info('alert-warning', '社团分组数量不得超过限制');
    		return false;
    	}
    	
   	 	html = '<div class="form-group">'
   			 + '<div class="input-group">'
   			 + '<div style="display:none;" class="txt-wrap pull-left radius0 groupwidth form-control"></div>'
   			 + '<input type="text" class="txt form-control radius0 groupwidth" data-name="" data-guid="" name="group_name">'
   			 + '<span class="input-group-btn group_btn_dlt pull-left" data-guid="">'
   			 + '<button class="btn btn-default radius0 js_save" type="button"><i class="glyphicon glyphicon-ok"></i></button>'
   			 + '<button class="btn btn-default radius0 js_close" type="button"><i class="glyphicon glyphicon-remove"></i></button>'
   			 + '</span>'
   			 + '</div>'
   			 + '</div>';	   
   	 	$('#ogm_form_edit').append(html);
   	 	$("form#ogm_form_edit").validate();
    });
	
    // 删除操作
    $('body').on('click', '.g_del',function(){
        if (!confirm('确认要删除? 删除后, 该分组下的成员如果没有在其它分组下, 将会移至未分组状态.')){
            return false;
        }
        var obj = $(this);
        guid = obj.parents('.input-group-btn').attr('data-guid');
        $.ajax({
            type: "POST",
            url: "<?php echo U('Member/ogm_del'); ?>",
            data: { guid:guid },
            dataType: "json",
            beforeSend: function(){
                
            },
            success: function(data){
                if (data.status=='ok') {
                	obj.parents('.form-group').remove();
                    var txt_length = $('.txt').length;
                    if(txt_length < 1){
                        var no_group = '<div class="no-message" id="org_no_group">暂无分组，请点击“添加分组”按钮，为您的社团添加分组</div>';
                        $('form#ogm_form_edit').append(no_group);
                    }

                } else if (data.status=='ko') {
                	tips_info('alert-warning', data.msg);
                }
            }
        });
    });
	
    function tips_info(type, msg){
    	$('.tips-box').addClass(type).show().find('.tips-msg').html(msg).parents('.tips-box').fadeOut(1800);
    	var t=setTimeout(function(){
    		$('.tips-box').removeClass(type);
    		clearTimeout(t);
    	},1800);
    }
    
	function edit_ogm(obj){
		obj.parents('.input-group').find('.txt-wrap').hide();
		obj.parents('.input-group').find('.txt').show();
		obj.parents('.input-group').find('.txt').focus();
		var html = "<button class='btn btn-default radius0 js_save' type='button'><i class='glyphicon glyphicon-ok'></i></button>";
			html+= "<button class='btn btn-default radius0 js_close' type='button'><i class='glyphicon glyphicon-remove'></i></button>";
		obj.parents('.input-group-btn').html(html);
	}
	
	/*-----------------------------------------	华丽的分割线 -----------------------------------------*/
});
</script>

               </div>
	       </div>
	       
	   </div>
	   <!-- 提示信息 -->
       
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
        <button type="button" id="confirm_yes" class="btn btn-primary js-confirm" data-dismiss="modal">确定</button>
        <button type="button" id="confirm_no" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 提示信息 END -->

       <!-- footer -->
	   <?php  ?>

<!-- Foot Starting -->    
<div class="footer">
  <div class="container">
    <p class="pull-right"><?php echo C('COPYRIGHT')?></p>
  </div>
</div>
<!-- Foot Ending -->
       

       <script type="text/javascript">
        	$(function(){
        		//图片异步加载
        		$("img").lazyload({    
        			placeholder : "http://www.yunmai365.com//Public/common/images/grey.gif",    
        			effect : "fadeIn"  
        		});   
        	})
       </script>
	</body>
</html>