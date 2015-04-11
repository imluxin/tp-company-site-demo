<?php if (!defined('THINK_PATH')) exit(); ?>

<!DOCTYPE html>
<html>
    <!-- head -->
    <?php  ?>
<head>
    <meta charset="UTF-8">
        
    <!-- css 文件 -->
    <?php
 echo C('MEDIA_CSS.JQUERYUI') .C('MEDIA_CSS.BOOTSTRAP') .C('MEDIA_CSS.FONT_AWESOME') .C('MEDIA_CSS.BASE') .C('MEDIA_CSS.MODAL') .C('MEDIA_CSS.ACTIVITY_VOTE'); ?>
    
    <title><?php echo C('APP_NAME'); if(!empty($meta_title)): ?>- <?php echo ($meta_title); endif; ?></title>
    <meta name="keywords" content="社团邦，云脉365，天津云脉三六五科技有限公司，即时通信，聊天APP，社团管理平台，人脉">
    <meta name="description" content="社团邦，社团管理平台">
    <meta name="Author" content="<?php echo C('APP_NAME')?>" />
    <?php echo C('MEDIA_FAVICON')?>

    <!-- 加载JS文件 -->
    <?php  ?>

<!-- js 文件 -->
<?php
echo C('MEDIA_JS.JQUERY') .C('MEDIA_JS.JQUERYUI') .C('MEDIA_JS.BOOTSTRAP') .C('MEDIA_JS.JQUERY_VALIDATE') .C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL') .C('MEDIA_JS.JQUERY_LAZYLOAD') .C('MEDIA_JS.JQUERY_AJAXUPLOAD') .C('MEDIA_JS.IFRAME_BOX') .C('MEDIA_JS.ZERO_CLIPBOARD') .C('MEDIA_JS.COMMON'); ?>

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
                    <a href="<?php echo U('Org/info')?>">
                        <img id="top_logo" data-original="<?php echo get_image_path($auth['org_logo'])?>" class="lazy headicon">
                    </a>
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

<link rel="stylesheet" type="text/css" href="/Public/common/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/create-theme.css" />

<!-- Ueditor js 加载 -->
<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script>

<!-- datetimepicker js 加载 -->
<script type="text/javascript" src="/Public/common/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/common/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

<script type="text/javascript">
    var YM = {
        'ueditor_server_url' : "<?php echo U('ueditor');?>"
    };
    var date_config = {
        language: 'zh-CN',
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        /*时间默认为5*/
        minuteStep: 1,
        showMeridian: 1
    };
    $(document).ready(function(){

        //datetimepicker 时间样式
        $('body').on('focus',".form_datetime", function(){
            $(this).datetimepicker(date_config);
        });

        //自定义表单验证
        $.validator.addMethod("afternow", function(value, element) {
            var start_time =  new Date($('#startTime').val().replace(/-/g,"/")).getTime();
            var now = new Date().getTime();

            return start_time+60*1000>now;
        }, "开始时间不得早于当前时间");
        $.validator.addMethod("afterstart", function(value, element) {
            var start_time =  new Date($('#startTime').val().replace(/-/g,"/")).getTime();
            var end_time = new Date($('#endTime').val().replace(/-/g,"/")).getTime();

            return end_time>start_time;
        }, "结束时间不得早于开始时间");

        $.validator.addMethod("after_subject_start", function(value, element) {
            var activity_start =  new Date($('#startTime').val().replace(/-/g,"/")).getTime();
            var subject_start = new Date('<?php echo date('Y/m/d, H:i:s', $subject_info['start_time']); ?>').getTime();

            return activity_start >= subject_start;
        }, "开始时间不得早于主题开始时间");

        $.validator.addMethod("before_subject_end", function(value, element) {
            var activity_end =  new Date($('#endTime').val().replace(/-/g,"/")).getTime();
            var subject_end = new Date('<?php echo date('Y/m/d, H:i:s', $subject_info['end_time']); ?>').getTime();

            return activity_end <= subject_end;
        }, "结束时间不得晚于主题结束时间");

    });
</script>

<!-- 导入面包屑 -->

<?php
$breadcrumbs = array( 'base' => '活动管理', 'list' => array( array('url'=>U('Activity/activity_list', array('sguid'=>$subject_info['guid'])), 'v'=>'活动列表'), array('url'=>'', 'v'=>'创建活动'), array('url'=>'', 'v'=>'创建报名') ) ); ?>
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

<div class="rightmain">

    <div class="pdlf10 mb40 ml12">
        <div class="row mt10">
            <div class="pull-left width80 mt7">活动主题：</div>
            <div class="pull-left width420 mt7"><?php echo $subject_info['name']?></div>
        </div>
        <div class="row mt10">
            <div class="pull-left width80 mt7">活动类型：</div>
            <div class="pull-left width420 mt7"><img width="23px" src="<?php echo PUBLIC_URL?>/home/images/activity2.png" alt="投票">投票</div>
        </div>


        <form id="actForm" method="post">
            <div class="row mt20">
                <div class="pull-left width80 mt7">活动时间：</div>
                <div class="pull-left width190">
                    <div class="input-group date form_datetime">
                        <ym><span><input class="form-control" size="16" type="text" value="<?php echo date('Y-m-d H:i',$activity_info['start_time']);?>" name="startTime" id="startTime" readonly></span></ym>
                        <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <div class="tswidth190 tishinr" id="conTimeS"></div>
                </div>
                <div class="pull-left width40 mt7 pdlf10">至</div>
                <div class="pull-left width190">
                    <div class="input-group date form_datetime">
                        <ym><span><input class="form-control" size="16" type="text" value="<?php echo date('Y-m-d H:i',$activity_info['end_time']);?>" name="endTime" id="endTime" readonly></span></ym>
                        <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <div class="tswidth190 tishinr" id="conTimeE"></div>
                </div>
            </div>

            <div class="row">
                <div class="pull-left width80">是否公开：</div>
                <div class="pull-left">
                    <label class="radio-inline">
                        <input type="radio" name="is_public" id="inlineRadio1" value="1" <?php echo ($activity_info['is_public']==1) ? 'checked' : ''; ?>> 是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="is_public" id="inlineRadio2" value="0"  <?php echo ($activity_info['is_public']==0) ? 'checked' : ''; ?>> 否
                    </label>
                </div>
            </div>
            <div class="row mb20">
                <div class="ml80"><nameh1>若设为公开，则‘参与人员’选项无效，该活动将对所有人（包括非本社团用户）开放。</nameh1></div>
            </div>

            <div class="row">
                <div class="pull-left width80 mt7">参与人员：</div>
                <div class="pull-left btn-group width190">
                    <?php $all = session('auth')['org_all_guid']; $other = session('auth')['org_other_guid'];?>
                    <select class="form-control radius0" name="OGGuid">
                        <option value="<?php echo $all; ?>" <?php if ($activity_info['org_group_guid'] == $all) {echo 'selected';}?>>全部成员</option>
                        <?php foreach ($group_list as $l): ?>
                            <option value="<?php echo $l['guid']?>" <?php if ($l['guid'] == $activity_info['org_group_guid']) {echo 'selected';}?>>
                                <?php echo $l['name']?></option>
                        <?php endforeach; ?>
                        <option value="<?php echo $other?>" <?php if ($activity_info['org_group_guid'] == $other) {echo 'selected';}?>>未分组</option>
                    </select>
                </div>
            </div>

            <div class="row mt30">
                <div class="pull-left width80 mt7">投票标题：</div>
                <div class="pull-left width420"><ym><input type="text" name="name" class="form-control" value="<?php echo $vote_info['name']?>"></ym></div>
            </div>
            <div class="row ml80 tishinr"></div>

            <div class="row">
                <div class="pull-left width80 mt7">投票描述：</div>
                <div class="pull-left width675"><ym><textarea class="form-control noresize radius0" rows="3" name="content"><?php echo $vote_info['content']?></textarea></ym></div>
            </div>
            <div class="row ml80 tishinr"><!--内容不能为空--></div>

            <div class="row">
                <div class="pull-left width80"><p style="text-indent: 2em;">类型：</p></div>
                <div class="pull-left">
                    <div class="radio mt0"><label><input type="radio" name="is_multiple" id="optionsRadios1" value="0" <?php echo ($vote_info['is_multiple']=='0')?'checked':''; ?>> 单选</label></div>
                    <div class="radio"><label><input type="radio" name="is_multiple" id="optionsRadios2" value="1"  <?php echo ($vote_info['is_multiple']=='1')?'checked':''; ?>> 多选</label></div>
                </div>
            </div>

            <div class="row mb30 hiden" id="max_choice">
                <div class="pull-left width92 mt7 ml-12">最多选几项：</div>
                <div class="pull-left width80"><input type="text" name="max_choice" class="form-control" value="<?php echo $vote_info['multiple_num']?>"></div>
                <div class="pull-left width400 mt7 ml5"><nameh1>设置最多选几项，0或留空为不限制</nameh1></div>
            </div>

            <div class="row">
                <div class="pull-left width80 mt7"><p style="text-indent: 2em;">选项：</p></div>
                <div class="pull-left width675">
                    <!--选项设置-->
                    <div id="option-list">
                        
                        <?php foreach($option_info as $key=>$o):?>
                            <div class="row m0 ym_option">
                                <div class="pull-left width420">
                                    <div class="input-group">
                                        <div class="input-group-addon radius0">.</div>
                                        <input type="text" name="options[]" class="op form-control radius0" value="<?php echo $o['content']?>">
                                        <input type="hidden" name="picurls[]"  class="picurl" value="<?php echo $o['pic_url']?>">
                                    </div>
                                </div>
                                <div class="pull-left ml-1"><button class="js_upload_thumb<?php echo $key;?> btn btn-default radius0" type="button"><nameb><i class="fa fa-picture-o"></i></nameb></button></div>
                                <div class="pull-left ml5"><button class="op_del btn btn-default radius0" type="button"><i class="fa fa-minus"></i></button></div>
                            </div>
                            <div class="thumb-wrap ml30 mt10">
                           		<div class="thumb-mask">
                           			<div class="func"><a class="js-del-thumb" href="javascript:void(0);"><i class="glyphicon glyphicon-trash"></i></a></div>
                           		</div>
	                          	<?php if($o['pic_url']){?>
	                           		<img src="/Upload<?php echo $o['pic_url']?>" class="pic-thumb img-thumbnail"  >
	                            <?php }else{ ?>
	                           		<img src="" class="pic-thumb img-thumbnail" style="display:none;">
	                            <?php } ?>
                          	</div>
                            <div class="row ml30 tishinr"></div>
                        <?php endforeach; ?>
                        
                    </div>

                    <div class="mb30"><button type="button" class="op_add btn btn-default radius0"><i class="fa fa-plus"></i> 添加选项</button> <nameh1>图片建议尺寸：640像素*350像素</nameh1></div>
                    <!--选项设置-->
                </div>
            </div>

            <div class="row">
                <div class="pull-left width80"><p style="text-indent: 2em;">发布：</p></div>
                <div class="pull-left">
                    <label class="radio-inline">
                        <input type="radio" name="status" id="inlineRadio1" value="1"> 是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="inlineRadio2" value="0" checked> 否
                    </label>
                </div>
            </div>

            <div class="row mt10">
                <div class="pull-left btn-group ml80">
                    <button type="submit" class="ym_save btn mybtn active">保存</button>
                    <button type="button" class="btn mybtn" onclick='history.go(-1);'>取消</button>
                </div>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
		//图片异步加载
		$("img").lazyload({    
			placeholder : "/Public/common/images/grey.gif",    
			effect : "fadeIn"   
		});   
		
        // 选择是否为多选, 显示最多选几项
        $('input[name="is_multiple"]').click(function(){
            var is_multiple = $(this).val();
            if(is_multiple == '1'){
                $('div#max_choice').show();
            }else{
                $('div#max_choice').hide();
            }
        });

        $('.ym_save').click(function(){
            var check_option = $('div.ym_option').length;
            if(check_option < 2){
                ym_alert('选项数量不得少于2个.');
                return false;
            }
            $('input.op').each(function(){
                var text_value=$(this).val();
                if(text_value =='') {
                    $(this).addClass('error');
                    $(this).parent().parent().parent().next().next('.tishinr').html('<b>选项不能为空</b>');
                }
            });
            $('#actForm').valid();
        });
        $('input.op').blur(function(){
            var text_value=$(this).val();
            if(text_value !='') {
                $(this).removeClass('error');
                $(this).parent().parent().parent().next().next('.tishinr').html('');
            }
        });

        //表单验证
        $('#actForm').validate({
            errorPlacement: function(error, element){
                element.parent().parent().parent().next('.tishinr').append(error);
            },
            rules: {
                name: {
                    required: true,
                    rangelength: [2, 50]
                },
                startTime: {
                    required: true,
                    after_subject_start: true
//                    afternow: true
                },
                endTime: {
                    required: true,
                    before_subject_end: true,
                    afterstart: true
                },
                content: {
                    maxlength: 200
                }
            },
            messages: {
                name: {
                    required: "投票标题不能为空",
                    rangelength: "投票标题不得少于两个字，不得多于五十个字"
                },
                startTime: {
                    required: "投票开始时间不能为空"
                },
                endTime: {
                    required: "投票结束时间不能为空"
                },
                content: {
                    maxlength: "投票内容不能多于二百个字"
                }
            }
        });

        var i=$('.ym_option').size();
        // 增加新的选项
        $('.op_add').on('click', function(){
        	 i++;
            html = '<div class="ym_option row m0">'
            +'<div class="pull-left width420">'
            +'<div class="input-group ">'
            +'<div class="input-group-addon radius0">.</div>'
            +'<input type="text" name="options[]" class="op form-control radius0" placeholder="">'
            +'<input type="hidden" name="picurls[]" class="picurl">'
            +'</div>'
            +'</div>'
            +'<div class="pull-left ml-1"><button class="js_upload_thumb'+i+' btn btn-default radius0" type="button"><nameb><i class="fa fa-picture-o"></i></nameb></button></div>'
            +'<div class="pull-left ml5"><button class="op_del btn btn-default radius0" type="button"><i class="fa fa-minus"></i></button></div>'
            +'</div>'
            +'<div class="thumb-wrap ml30 mt10">'
            +'<div class="thumb-mask">'
            +'<div class="func"><a class="js-del-thumb" href="javascript:void(0);"><i class="glyphicon glyphicon-trash"></i></a></div>'
            +' </div>'
            +'<img src="" class="img-thumbnail pic-thumb" style="display:none;">'
            +'</div>'
            +'<div class="row ml30 tishinr"></div>';

            $('#option-list').append(html);
            $("form#actForm").validate();
            $('.op').each(function(){
                $(this).rules("add",{ required: true, messages: { required: "选项内容不能为空"} });
            });
            $('input.op').blur(function(){
                var text_value=$(this).val();
                if(text_value !='') {
                    $(this).removeClass('error');
                    $(this).parent().parent().parent().next().next('.tishinr').html('');
                }
            });
            uploadPic($('.js_upload_thumb'+i));
        });

        $('body').on('click','.op_del', function(){
        	$(this).parents('.ym_option').next().next().remove();
        	$(this).parents('.ym_option').next().remove();
            $(this).parents('.ym_option').remove();
        });
        
        $('.ym_option').each(function(i){
        	uploadPic($('.js_upload_thumb'+i));
        })
        
        $('body').on('click','.js-del-thumb',function(){
        	$(this).parents('.thumb-wrap').find('img').hide();
        	$(this).parents('.thumb-wrap').prev('.ym_option').find('.picurl').val('');
        })
        
        function uploadPic(obj){
    		obj.ajaxUploadPrompt({
    			url : "<?php echo U('Common/ajax_upload', array('t'=>'vote')) ?>",
    			type: "POST",
    			dataType: "json",
    			data: { '<?php echo session_name()?>':'<?php echo session_id()?>', guid:'<?php echo ($_GET['sguid']); ?>' },
    			beforeSend : function () {
    				obj.parents('.ym_option').next('.thumb-wrap').append('<div id="loading-cover"><i id="loading" class="fa fa-spinner fa-spin"></i></div>');
    			},
    			error : function () {
    				alert('服务器出错, 请稍后重试!');
    			},
    			success : function (data) {
    				output = data.data;
    				if(data.status == 'ok') {
    					obj.parents('.ym_option').next('.thumb-wrap').find('#loading').remove();
    					obj.parents('.ym_option').find('.picurl').val(output.val);
    					obj.parents('.ym_option').next('.thumb-wrap').find('img').attr('src','/Upload'+output.val).show();
    				} else {
    					alert(data.msg);
    				}
    			}
    		});
        }
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
//        			placeholder : "http://www.yunmai365.com/Public/common/images/grey.gif",
        			effect : "show",
                    threshold: 200
        		});
        	})
       </script>
	</body>
</html>