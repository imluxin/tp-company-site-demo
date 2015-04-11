<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($meta_title) ? $meta_title.' - ' : ''; ?> <?php echo C('APP_NAME'); ?></title>
    <?php echo C('MEDIA_FAVICON')?>
    <!-- Bootstrap -->
    <?php
 echo C('MEDIA_CSS.BOOTSTRAP') .C('MEDIA_CSS.FONT_AWESOME'); ?>
    <link rel="stylesheet" type="text/css" href="/Public/home/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/sign-up.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/sign-in.css" />
<!--    <link rel="stylesheet" type="text/css" href="/Public/home/css/print_ticket.css" media="print"/>-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="noprint">
<div class="container sigin-in-main">
    <div class="row">
        <div class="sigin-in-nav">
            <a class="sigin-in-nav active" href="<?php echo U('Activity/signin', array('aid' => I('get.aid'))); ?>" title="在线签到">在线签到</a> |
            <a href="<?php echo U('Activity/signin_chart', array('aid' => I('get.aid'))); ?>" title="签到统计">签到统计</a>
        </div>
        <h2 class="text-center"><?php echo $activity_info['name']; ?></h2>
        <div class="col-xs-12">
            <!-- 标签页 -->
            <ul class="nav nav-sigin-in" role="tablist" id="signin-tab">
                <input type="hidden" id="signin_type" value="1" />
                <li role="presentation" class="active">
                    <a href="#byqrcode" aria-controls="byqrcode" role="tab" data-toggle="tab">扫码签到</a></li>
                <li role="presentation">
                    <a href="#byhand" aria-controls="byhand" role="tab" data-toggle="tab">手动签到</a></li>
                <button type="button" class="btn btn-success pull-right radius0" data-toggle="modal" data-target="#modal_add_signup_user"><i class="fa fa-plus"></i> 现场报名</button>
            </ul>
            <div class="row content-area">
                <div class="col-xs-4">
                    <!-- 电子票打印 -->
                    
<div id='ticket_preview' class="table">
    <style>
        #ticket_preview { width: 283px; height: 177px;border: 1px solid #000; margin: auto; padding: 10px;
            vertical-align: middle; display: none; position: relative; }
        #ticket_preview div{text-align: center;}
        #ticket_name { font-size: 24px; font-weight: bold; margin-bottom: 10px;}
        #ticket_company { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        #ticket_position { font-size: 18px; font-weight: bold;}
    </style>
    <div style="display: table; height: 100%; width: 100%;">
        <div style="vertical-align: middle; display: table-cell;">
            <div id="ticket_name"></div>
            <div id="ticket_company"></div>
            <div id="ticket_position"></div>
        </div>
    </div>
</div>
                </div>
            
                <div class="col-xs-8">
                    <div class="tab-content">
                        <!-- 标签页1ticket -->
                        <div role="tabpanel" class="tab-pane active" id="byqrcode">
                            <div class="form-group form-inline">
                                <label for="scanninginput">请扫描二维码</label>
                                <div>
                                    <input type="text" id="qrcode" name="qrcode" value="" style="width: 0;filter:alpha(opacity=0);opacity: 0;"/>
                                    <img src="/Public/home/images/scancode.jpg">
                                </div>
                            </div>
                        </div>
                        <!-- 标签页2notice -->
                        <div role="tabpanel" class="tab-pane" id="byhand">
                            <div class="form-group form-inline mt20">
                                <input type="text" value="" id="check_mobile" class="form-control input-lg" placeholder="请输入报名手机号"
                                       maxlength="11"/>
                                <button type="button" class="btn btn-default btn-lg" id="btn_check_mobile">确认</button>
                            </div>
                        </div>
                    </div>
                    <!-- 标签页 -->
                </div>
            </div>
        </div>

    </div>

    <!-- 用户信息显示 -->
    <div class="row sigin-in-other">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="sigin-in-table">
                <table class="table">
                    <thead>
                    <tr class="tr-bgcolor">
<!--                        <td>序号</td>-->
                        <td>姓名</td>
                        <td>电话</td>
                        <td>票务</td>
                        <td>人员来源</td>
                        <td>电子票状态</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody id="signin_user_list">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-3 col-xs-offset-2">
            <button type="button" class="btn btn-primary btn-lg btn-block" id="signin_print" is_print="1">签到并打印</button>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-default btn-lg btn-block" id="signin_only" is_print="0">仅签到</button>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-default btn-lg btn-block" id="signin_cancel">取消</button>
        </div>

    </div>
</div>

<!-- Modal - 现场添加人员 -->
<!-- modal - 添加新报名人员 -->
<div class="modal fade bs-example-modal-lg" id="modal_add_signup_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="export-import"><strong>添加报名</strong></h4>
            </div>
            <div class="modal-body">
                <form id="signup_add_user_form" role="form" class="form-horizontal main-form" method="post">

                    <?php if(!empty($tickets)): ?>
                        <div class="form-group">
                            <label for="area" class="col-sm-2 control-label"><span>* </span>票务：</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="ticket">
                                    <?php foreach($tickets as $t): ?>
                                        <option value="<?php echo $t['guid']?>"><?php echo $t['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php foreach($build_info as $k => $b): ?>
                        <!-- 获取当前表单类型 -->
                        <?php if($b['is_info'] != 1):?>
                            <input type="hidden" name="<?php echo 'other['.$b['guid'].']'?>[ym_type]" value="<?php echo $b['ym_type']?>"/>
                            <input type="hidden" name="<?php echo 'other['.$b['guid'].']'?>[build_guid]" value="<?php echo $b['guid']; ?>" />
                        <?php endif; ?>

                        <!-- form 主题 -->
                        <div class="form-group">
                            <label for="contact" class="col-sm-2 control-label">
                                <?php if($b['is_required']):?><span>* </span><?php endif; echo $b['name']?>：
                            </label>
                            <div class="col-sm-6 form_field">
                                <!-- form -->
                                <?php $name = ($b['is_info']==1)?'info':'other'; ?>
                                <?php if($b['html_type'] == 'text'): ?>
                                    <?php if($b['is_info'] == 1):?>
                                        <input type="text" class="form-control <?php echo ($b['ym_type']=='date') ? 'ym_date' : ''; ?>" name="<?php echo $name.'['.$b['ym_type'].']'?>" placeholder="<?php echo $b['note']?>"  <?php echo ($b['ym_type']=='date') ? 'readonly' : ''; ?>/>
                                    <?php else: ?>
                                        <?php
 if($b['ym_type'] == 'company') { $maxlength = 20; }elseif($b['ym_type'] == 'position') { $maxlength = 10; } else { $maxlength = 50; } ?>
                                        <input type="text" class="form-control <?php echo ($b['ym_type']=='date') ? 'ym_date' : ''; ?>"
                                               name="<?php echo $name.'['.$b['guid'].']'?>[value]" maxlength="<?php echo $maxlength; ?>"
                                               placeholder="<?php echo $b['note']?>"  <?php echo ($b['ym_type']=='date') ? 'readonly' : ''; ?>/>
                                        <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>" />
                                    <?php endif; ?>

                                <?php elseif($b['html_type'] == 'textarea'):?>
                                    <textarea class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[value]" placeholder="<?php echo $b['note']?>"></textarea>
                                    <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>" />

                                <?php elseif($b['html_type'] == 'select'):?>
                                    <div class="select">
                                        <select name="<?php echo $name.'['.$b['guid'].']'?>[value]" class="form-control">
                                            <option value=""></option>
                                            <?php foreach($option_info[$b['guid']] as $ok => $ov): ?>
                                                <option value="<?php echo $ov['value']?>"><?php echo $ov['value']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>">

                                <?php elseif ($b['html_type'] == 'radio' || $b['html_type'] == 'checkbox'): ?>
                                    <?php foreach($option_info[$b['guid']] as $ok => $ov): ?>
                                        <?php if($b['is_info'] == 1):?>
                                            <div class="<?php echo $b['html_type']?>">
                                                <label>
                                                    <div class="activity-vote-options"><input type="<?php echo $b['html_type']?>" name="<?php echo $name.'['.$b['ym_type'].']'?>" class="" value="<?php echo $ov['value']?>"></div>
                                                    <?php echo $ov['value']?>
                                                </label>
                                            </div>
                                        <?php else: ?>
                                            <div class="<?php echo $b['html_type']?>">
                                                <label>
                                                    <div class="activity-vote-options"><input type="<?php echo $b['html_type']?>" name="<?php echo $name.'['.$b['guid'].']'?>[value][]" class="" value="<?php echo $ov['value']?>"></div>
                                                    <?php echo $ov['value']?>
                                                </label>
                                            </div>
                                            <input type="hidden" class="form-control" name="<?php echo $name.'['.$b['guid'].']'?>[key]" value="<?php echo $b['name']?>">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4 tishinr"></div>
                        </div>
                    <?php endforeach; ?>

                    <div class="row mt20 mb40">
                        <div class="col-xs-5 col-xs-offset-2">
                            <div class="btn-group ml-5">
                                <button type="submit" class="btn mybtn active">保存</button>
                                <button type="button" class="btn mybtn" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<?php ?>
<?php echo C('MEDIA_JS.JQUERY172'); ?>
<?php echo C('MEDIA_JS.JQUERYUI'); ?>
<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
<?php echo C('MEDIA_JS.ZERO_CLIPBOARD'); ?>
<?php echo C('MEDIA_JS.JQUERY_VALIDATE').C('MEDIA_JS.JQUERY_VALIDATE_ADDITIONAL').C('MEDIA_JS.JQPRINT'); ?>
<link rel="stylesheet" type="text/css" href="/Public/common/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="/Public/common/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/common/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

<?php echo C('MEDIA_JS.COMMON'); ?>
<!-- Modal ending-->
<!--鼠标经过头像触发-->
<script type="text/javascript">
    $(document).ready(function(){

        // 自动定位到 #qrcode
        document.getElementById("qrcode").focus();
        $(document).click(function(e){
            if($(e.target).parents('#signup_add_user_form').length <= 0){ // 当进行现场报到时, 取消定位
                $('#qrcode').val('');
                document.getElementById("qrcode").focus();
            }
        });

        // 默认显示 扫码签到 页
        $('#signin-tab a:first').tab('show');
        $('#signin-tab a').click(function(){
            var type = $(this).attr('aria-controls');
            if(type == 'byqrcode') {
                $('#signin_type').val(1);
            } else if(type == 'byhand') {
                $('#signin_type').val(2);
            }
        });


        // ajax 查找用户
        function ajax_find_user(obj, value)
        {
            var aid = '<?php echo $activity_info['guid']; ?>';
            $.ajax({
                url: '<?php echo U('Activity/ajax_signin_check_user'); ?>',
                type: 'POST',
                data: { aid: aid, value: value, signin_type: $('#signin_type').val() },
                dataType: 'json',
                beforeSend: function(){
                    obj.attr('disabled', true);
                    obj.text('查找中...');
                },
                success: function(data){
                    if(data.status == 'ok'){
                        var info = data.data;
                        render_userinfo(info);
                        if(data.msg) {
                            alertTips($('#tips-modal'), data.msg);
                        }
                        $('#qrcode').val('');
                    }else if(data.status == 'ko'){
                        alertTips($('#tips-modal'), data.msg);
                    }
                },
                complete: function(){
                    obj.attr('disabled', false);
                    obj.text('确定');
                }
            });
        }
        // 组装用户信息
        function render_userinfo(info)
        {
            // 生成票预览
            $('#ticket_preview').show();
            $('#ticket_name').text(info.real_name);
            $('#ticket_company').text((info.company?info.company:''));
            $('#ticket_position').text((info.position?info.position:''));

            // 列表
            var tip_content = "<div class='layer'><div class='pull-left'><p>";
            if(info.other) {
                $.each(info.other, function (other_key, o) {
                    tip_content += "<strong>" + o.key + "：</strong>" + o.value + "<br>";
                });
            }else{
                tip_content += "<strong>没有更多数据。</strong>";
            }
            tip_content += "</p></div></div>";
            var reg = new RegExp("\r\n", "g");
            tip_content = tip_content.replace(reg, "<br>");

            var ticket_name = (info.ticket.ticket_guid == 'nolimit')?'':info.ticket.ticket_name;
            var html = '';
            html += '<tr class="sigin-in-other-bg">';
//                            html += '<td>' + info.id + '</td>';
            html += '<td><a href="<?php echo U('Activity/signup_userdetail')?>?uid='+ info.guid +'" title="查看" target="_blank">'+ info.real_name +'</a></td>';
            html += '<td>'+ info.mobile +'<input type="hidden" id="user_ticket_guid" value="'+info.ticket.user_ticket_guid+'" /></td>';
            html += '<td>'+ ticket_name +'</td>';
            html += '<td>'+ info.from +'</td>';
            html += '<td id="ticket_status"><'+ info.ticket.ticket_status_tag +'>'+ info.ticket.ticket_status +'</'+ info.ticket.ticket_status_tag +'></td>';
            html += '<td>';
            html += '<a id="pop-'+ info.guid +'" title="详细资料" class="detailslayer" data-trigger="foucs"><i class="fa fa-info-circle fa-lg"></i></a>';

            html += '<script type="text/javascript">';
            html += '$(document).ready(function() {';
            html += '$("#pop-'+ info.guid+'" ).popover({';
            html += 'content: "'+tip_content+'",';
            html += 'html: true,';
            html += 'placement: "left",';
            html += 'trigger: "hover"';
            html += '});';
            html += '});';
            html += '<\/script>';
            html += '</td>';
            html += '</tr>';

            $('#signin_user_list').html(html);

            // 打印
//            $('#ticket_preview').jqprint();
        }

        // 打印
        function ym_print()
        {
            $('#ticket_preview').css('border', 'none');
            $('#ticket_preview').jqprint();
            $('#ticket_preview').css('border', '1px solid #000');
        }

        // 扫描二维码
        $('#qrcode').keyup(function(){
            var ticket_code = $(this).val();
            if(ticket_code.length == 22) {
                ajax_find_user($(this), ticket_code);
            }
        });

        // 手动签到 - 查找用户
        $('#btn_check_mobile').click(function(){
            var obj = $(this);
            var mobile = $('#check_mobile').val();
            if(mobile == '' || mobile.length != 11) {
                alertTips($('#tips-modal'), '手机号码为空，或者格式不对。');
                return false;
            }
            ajax_find_user(obj, mobile);
        });

        // 取消签到
        $('#signin_cancel').click(function(){
//            ym_print();
            $('#signin_user_list').text('');
            $('#qrcode').val('');
            $('#check_mobile').val('');
            $('#ticket_preview').hide();
        });

        // 仅签到
        $('#signin_only, #signin_print').click(function(){
            var user_ticket_guid = $('#user_ticket_guid').val();
            if(user_ticket_guid == '' || !user_ticket_guid) {
                alertTips($('#tips-modal'), '参数错误, 请刷新页面后重试.');
            }
            var obj = $(this);
            var is_print = obj.attr('is_print');
            var ori_text = obj.text();
            var signin_type = $('#signin_type').val();
            $.ajax({
                url: '<?php echo U('Activity/ajax_signin'); ?>',
                type: 'POST',
                data: { user_ticket_guid: user_ticket_guid, signin_type : signin_type },
                dataType: 'json',
                beforeSend: function(){
                    obj.attr('disabled', true);
                    obj.text('签到中...');
                },
                success: function(data){
                    alertTips($('#tips-modal'), data.msg);
                    if(data.status == 'ok') {
                        $('#ticket_status').html('<nameb>已签到</nameb>');
                        $('#qrcode').val('');
                        if(is_print == '1'){
                            ym_print();
                        }
                    }
                },
                complete: function(){
                    obj.attr('disabled', false);
                    obj.text(ori_text);
                }
            });
        });

        //datetimepicker 时间样式
        $('.ym_date').datetimepicker({
            language: 'zh-CN',
            format: 'yyyy-mm-dd',
            autoclose: true,
            minView: 2
        });


        // 现场签到
        $('#signup_add_user_form').validate({
            errorPlacement: function(error, element){
                element.parents('.form_field').next('.tishinr').html(error);
            },
            rules: {
                <?php foreach($build_info as $k => $b): ?>
                <?php $name = ($b['is_info']==1)?'info':'other'; ?>
                <?php  if($b['is_info']==1) { $whole_name = $name.'['.$b["ym_type"].']'; } else { if ($b['html_type'] == 'radio' || $b['html_type'] == 'checkbox') { $whole_name = $name.'['.$b["guid"].'][value][]'; } else { $whole_name = $name.'['.$b["guid"].'][value]'; } } ?>
                // jquery validate rules
                '<?php echo $whole_name?>': {
                    required: <?php echo ($b['is_required']==1)?'true':'false'; ?>
                    <?php if($b['ym_type'] == 'mobile'): ?>
                    ,digits: true,
                    rangelength: [11, 11],
                    remote: {
                        url:"<?php echo U('Activity/ajax_check_signup_user'); ?>",
                        type:'post',
                        dataType: 'json',
                        data: { aid: '<?php echo I('get.aid'); ?>' }
                    }
                    <?php else: ?>
                    <?php if(!in_array($b['html_type'], array('radio', 'select', 'checkbox'))): ?>
                        <?php if($b['ym_type'] == 'company'): ?>
                        ,rangelength: [1, 20]
                        <?php elseif($b['ym_type'] == 'position'): ?>
                        ,rangelength: [1, 10]
                        <?php else: ?>
                        ,rangelength: [1, 50]
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if($b['html_type'] == 'textarea'): ?>
                    ,rangelength: [1, 200]
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($b['ym_type'] == 'email'): ?>
                    ,email: true
                    <?php endif; ?>
                },
                <?php endforeach; ?>
            },
            messages: {
                <?php foreach($build_info as $k => $b): ?>
                <?php $name = ($b['is_info']==1)?'info':'other'; ?>
                <?php  if($b['is_info']==1) { $whole_name = $name.'['.$b["ym_type"].']'; } else { if ($b['html_type'] == 'radio' || $b['html_type'] == 'checkbox') { $whole_name = $name.'['.$b["guid"].'][value][]'; } else { $whole_name = $name.'['.$b["guid"].'][value]'; } } ?>
                // jquery validate error message
                '<?php echo $whole_name ?>': {
                    required: "<?php echo $b['name']; ?>不能为空"
                    <?php if($b['ym_type'] == 'mobile'): ?>
                    ,digits: "手机号码必须为数字",
                    rangelength: "手机号码长度必须为11位",
                    remote: "该手机号码已经报名"
                    <?php else: ?>
                    <?php if(!in_array($b['html_type'], array('radio', 'select', 'checkbox'))): ?>
                        <?php if($b['ym_type'] == 'company'): ?>
                            ,rangelength: "<?php echo $b['name']; ?>长度必须为1到20个字"
                        <?php elseif($b['ym_type'] == 'position'): ?>
                            ,rangelength: "<?php echo $b['name']; ?>长度必须为1到10个字"
                        <?php else: ?>
                            ,rangelength: "<?php echo $b['name']; ?>长度必须为1到50个字"
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if($b['html_type'] == 'textarea'): ?>
                    ,rangelength: "<?php echo $b['name']; ?>长度必须为1到200个字"
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($b['ym_type'] == 'email'): ?>
                    ,email: "邮箱格式不对"
                    <?php endif; ?>
                },
                <?php endforeach; ?>
            },
            submitHandler: function(form) { //通过之后回调
                var obj = $(this);
                var data = $("#signup_add_user_form").serialize();
                $.ajax({
                    url: '<?php echo U('Activity/ajax_signup_add_user', array('aid' => $activity_info['guid'], 'signin' => 'true')); ?>',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function(){
                        obj.button('loading');
                    },
                    success: function(data){
                        if(data.status == 'ok'){
                            alertTips($('#tips-modal'), data.msg);
                            $('#modal_add_signup_user').modal('hide');
                            var obj = $('#btn_check_mobile');
                            var mobile = data.data.mobile;
                            $('#signin_type').val(2);
                            $('form#signup_add_user_form')[0].reset();
                            ajax_find_user(obj, mobile);
                        }else if(data.status == 'ko'){
                            alertTips($('#tips-modal'), data.msg);
                        }
                    },
                    complete: function(){
                        obj.button('reset');
                    }
                });
            },
            invalidHandler: function(form, validator) { //不通过回调
                return false;
            }
        });

    });
</script>

<!--触发结束-->

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

</body>
</html>