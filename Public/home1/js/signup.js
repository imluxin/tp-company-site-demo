/**
 * Created by Admin on 2015/1/29.
 */
var formCommonItems = [];
// 常用表单
formCommonItems[0] = {
    "html_type": "text",
    "ym_type": "email",
    "is_info": 0, // 是否为报名必填项
    "is_required": false, // 该表单是否必填
    "multiple": false,
    "title": "电子邮箱",
    "subitems": [],
    "placeholder": '',
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "单行文本框"};
formCommonItems[1] = {
    "html_type": "text",
    "ym_type": "company",
    "is_info": 0,
    "is_required": false,
    "multiple": false,
    "title": "公司",
    "placeholder": '',
    "subitems": null,
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "单行多文本框"};
formCommonItems[2] = {
    "html_type": "text",
    "ym_type": "position",
    "is_info": 0,
    "is_required": false,
    "multiple": false,
    "title": "职位",
    "subitems": null,
    "placeholder": '',
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "单行文本框"};
formCommonItems[3] = {
    "html_type": "radio",
    "ym_type": "sex",
    "is_info": 0,
    "is_required": false,
    "multiple": false,
    "title": "性别",
    "subitems": ["男", "女"],
    "placeholder": '',
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "单选按钮框"};
// 自定义表单
formCommonItems[100] = {
    "html_type": "text",
    "ym_type": "text",
    "is_info": 0, // 是否为报名必填项
    "is_required": false, // 该表单是否必填
    "multiple": false,
    "title": "",
    "placeholder": '单行文本框',
    "subitems": [],
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "单行文本框"};
formCommonItems[101] = {
    "html_type": "textarea",
    "ym_type": "textarea",
    "is_info": 0, // 是否为报名必填项
    "is_required": false, // 该表单是否必填
    "multiple": false,
    "title": "",
    "placeholder": '多行文本框',
    "subitems": [],
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "多行文本框"};
formCommonItems[102] = {
    "html_type": "radio",
    "ym_type": "radio",
    "is_info": 0, // 是否为报名必填项
    "is_required": false, // 该表单是否必填
    "multiple": false,
    "title": "",
    "placeholder": '单选按钮框',
    "subitems": ['', ''],
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "单选框"};
formCommonItems[103] = {
    "html_type": "checkbox",
    "ym_type": "checkbox",
    "is_info": 0, // 是否为报名必填项
    "is_required": false, // 该表单是否必填
    "multiple": false,
    "title": "",
    "placeholder": '复选按钮框',
    "subitems": ['', '', ''],
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "复选框"};
formCommonItems[104] = {
    "html_type": "text",
    "ym_type": "date",
    "is_info": 0, // 是否为报名必填项
    "is_required": false, // 该表单是否必填
    "multiple": false,
    "title": "",
    "placeholder": '日期选择框',
    "subitems": [],
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "日期选择框"};
formCommonItems[105] = {
    "html_type": "select",
    "ym_type": "select",
    "is_info": 0, // 是否为报名必填项
    "is_required": false, // 该表单是否必填
    "multiple": false,
    "title": "",
    "placeholder": '下拉选择框',
    "subitems": ['',''],
    "note": null,
    "is_hide": false,
    "value": null,
    "type_title": "下拉选择框"};

// 生成相应栏位
function renderFormItemTemplate(commonItem) {
    var itemHtml = '';
    if(commonItem){
        itemHtml =  '<div id="fi_'+item_key+'" class="row"> <div>';
        itemHtml +=     '<input type="hidden" name="items['+item_key+'][ym_type]" value="'+commonItem.ym_type+'" />';
        itemHtml +=     '<input type="hidden" name="items['+item_key+'][html_type]" value="'+commonItem.html_type+'" />';
        itemHtml +=     '<input type="hidden" name="items['+item_key+'][is_info]" value="'+commonItem.is_info+'" />';
        itemHtml +=     '<div class="pull-left checkbox ml12">';
        itemHtml +=         '<label><input type="checkbox" value="1" name="items['+item_key+'][is_required]" /> 必填 </label>';
        itemHtml +=     '</div>';
        itemHtml +=     '<div class="pull-left width110 ml12">';
        itemHtml +=         '<input type="text" class="form_required form-control" placeholder="'+commonItem.placeholder+'" name="items['+item_key+'][name]" value="'+commonItem.title+'">';
        itemHtml +=     '</div>';
        itemHtml +=     '<div class="pull-left width320 ml12">';
        itemHtml +=         '<input type="text" class="form-control" name="items['+item_key+'][note]" placeholder="提示信息在这儿写！">';
        itemHtml +=     '</div>';
        itemHtml +=     '<div class="pull-left"><button type="button" class="btn btn-delete" onclick="javascript:removeFormItem('+item_key+');" title="删除栏位"><i class="glyphicon glyphicon-trash"></i></button></div>';
        itemHtml +=     '</div>';

        if (commonItem.html_type == "radio" || commonItem.html_type == "checkbox" || commonItem.html_type == "select") {
            itemHtml += '<div class="create-options-list">选项列表<div class="options-list" id="fio_' + item_key + '">';
            itemHtml += renderFormItemOptions(item_key, commonItem);
            itemHtml += '</div></div><div style="clear:both;"></div>';
        }
        itemHtml += '</div>';

        item_key++;
    }
    $("#other_form_items").append(itemHtml);
}
// 生成相应栏位选项
function renderFormItemOptions(i, commonItem) {
    itemsHtml = ''
    if (commonItem.subitems != null && commonItem.subitems.length > 0) {
        for (var j = 0; j < commonItem.subitems.length; j++) {
            itemsHtml += '<div id="'+i+'_'+j+'"><input type="text" class="form_required form-control width110" placeholder="选项" name="items[' + i + '][options][' + j + ']" value="' + (commonItem.subitems[j] == null ? "" : commonItem.subitems[j].replace("\"", "\\\"").replace("\n", " ")) + '" />';
            if(j>1) {
                itemsHtml += '<span name="event_form_item_ctrl" class="btn-delete-options" onclick="javascript:removeFormItemOption(' + i + ',' + j + ');"></span>';
            }
            itemsHtml += '</div>';
        }
    }
    if(commonItem.ym_type != 'sex') {
        itemsHtml += '<button type="button" class="btn-add-options" onclick="javascript:addFormItemOption(' + i + ');return false;"><span class="" name="event_form_item_ctrl"></span></button>'
    }
    return itemsHtml;
}
// 删除一个选项
function removeFormItemOption(index, subIndex) {
    if (index >= 0 && subIndex >= 0) {
        $('#'+index+'_'+subIndex).remove();
    }
}
// 增加一个选顶
function addFormItemOption(index) {
    if (index >= 0) {
        var efis = $('#fio_' + index);
        if (efis != null) {
            j = Math.floor(Math.random() * (10000 - 1000 + 1)) + 1000;

            optionHtml = '<div id="'+index+'_'+j+'"><input type="text" class="form_required form-control width110" placeholder="选项" name="items[' + index + '][options]['+j+']" value="" />';
            optionHtml += '<span name="event_form_item_ctrl" class="btn-delete-options" onclick="javascript:removeFormItemOption(' + index + ', '+j+');"></span></div>';
            $('#fio_' + index + ' .btn-add-options').before(optionHtml);
        }
    }
}
// 增加常用和自定义栏位
function addFormCommonItem(index) {
    if (formCommonItems != null && formCommonItems.length > index && index >= 0) {
        var commonItem = formCommonItems[index];
        if (commonItem != null) {
            renderFormItemTemplate(commonItem);
        }
    }
}
// 删除栏位
function removeFormItem(index) {
    $('#fi_'+index).remove();
}

$(document).ready(function () {


    $('body').on('click', '.ym_remove', function(){
        $(this).parents('.ym_remove').remove();
    });

    var ue = UE.getEditor('ym_editor',{
        initialFrameHeight:450,
        serverUrl : ueditor_server_url
    });

    $.validator.addMethod("before_signup_start", function(value, element) {
        var signup_start =  new Date($('#start').val().replace(/-/g,"/")).getTime();
        var signup_end =  new Date($('#end').val().replace(/-/g,"/")).getTime();
        if(!signup_end || !signup_start) return true;
        return signup_start < signup_end;
    }, "报名结束时间不得早于开始时间");

    /**
     * 活动流程 操作
     */
    var i_flow = $('.op_flow').size();
    $('body').on('click', '#btn-flow-add', function(){
        html = '<div class="row op_flow ym_remove mb20">';
            html += '<div class="pull-left mt7 pdlf10">名称：</div>';
            html += '<div class="pull-left width200 ml12">';
            html += '<input type="text" class="form-control" name="op_flow['+i_flow+'][title]" placeholder="名称限20字" maxlength="20">';
            html += '</div>';

            html += '<div class="pull-left mt7 pdlf10">时间：</div>';
            html += '<div class="pull-left width190">';
            html += '<div class="input-group date form_datetime">';
            html += '<input type="text" readonly="" name="op_flow['+i_flow+'][start_time]" value="" size="16" class="form-control valid" aria-required="true" aria-invalid="false">';
            html += '<span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>';
            html += '</div>';
            html += '</div>';
            html += '<div class="pull-left mt7 mr10 pdlf10">至</div>';
            html += '<div class="pull-left width190">';
            html += '<div class="input-group date form_datetime">';
            html += '<input type="text" readonly="" name="op_flow['+i_flow+'][end_time]" value="" size="16" class="form-control">';
            html += '<span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>';
            html += '</div>';
            html += '</div>';

            html += '<div class="pull-left"><button type="button" class="ym_remove btn btn-delete"><i class="glyphicon glyphicon-trash"></i></button></div>';

            html += '<div class="pull-left mt16 pdlf10">内容：</div>';
            html += '<div class="pull-left width500 mt9 ml12">';
            html += '<input type="text" name="op_flow['+i_flow+'][content]" class="form-control" placeholder="内容限50字" maxlength="50">';
            html += '</div>';
        html += '</div>';
        //html += '<div class="pull-left ml80 tishinr"></div>';
        i_flow++;
        $('#flow_list').append(html);
    });
    // 生成工作流
    function renderFlowTemplate(items) {
        if(items.length > 0) {
            html = '';
            $.each(items, function(k, v){
                html += '<div class="row op_flow ym_remove mb20">';
                html += '<div class="pull-left mt7 pdlf10">名称：</div>';
                html += '<div class="pull-left width200 ml12">';
                html += '<input type="text" class="form-control" name="op_flow['+k+'][title]" placeholder="名称限20字" maxlength="20" value="'+ v.title+'">';
                html += '</div>';

                html += '<div class="pull-left mt7 pdlf10">时间：</div>';
                html += '<div class="pull-left width190">';
                html += '<div class="input-group date form_datetime">';
                html += '<input type="text" readonly="" name="op_flow['+k+'][start_time]" value="'+ v.start_time+'" size="16" class="form-control valid" aria-required="true" aria-invalid="false">';
                html += '<span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>';
                html += '</div>';
                html += '</div>';
                html += '<div class="pull-left mt7 mr10 pdlf10">至</div>';
                html += '<div class="pull-left width190">';
                html += '<div class="input-group date form_datetime">';
                html += '<input type="text" readonly="" name="op_flow['+k+'][end_time]" value="'+ v.end_time+'" size="16" class="form-control">';
                html += '<span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>';
                html += '</div>';
                html += '</div>';

                html += '<div class="pull-left"><button type="button" class="ym_remove btn btn-delete"><i class="glyphicon glyphicon-trash"></i></button></div>';

                html += '<div class="pull-left mt16 pdlf10">内容：</div>';
                html += '<div class="pull-left width500 mt9 ml12">';
                html += '<input type="text" name="op_flow['+k+'][content]" class="form-control" placeholder="内容限50字" maxlength="50" value="'+ v.content+'">';
                html += '</div>';
                html += '</div>';
            });
            $('#flow_list').append(html);
        }
    }
    renderFlowTemplate(flow_items);

    /**
     * 承办机构 操作
     * @type {*|jQuery}
     */
    var i_undertaker = $('.op_undertaker').size();
    $('body').on('click', '#btn-undertaker-add', function(){
        html = '<div class="row op_undertaker ym_remove mb20">';
        html += '<div class="pull-left width420 ml12">';
        html += '<input type="text" class="form-control op_undertaker" name="op_undertaker['+i_undertaker+'][name]" placeholder="" maxlength="50">';
        html += '</div>';
        html += '<div class="pull-left btn-group width150 ml12">';
        html += '<select class="form-control" name="op_undertaker['+i_undertaker+'][type]">';
        html += '<option value="1">主办方</option>';
        html += '<option value="2">承办方</option>';
        html += '<option value="3">协办方</option>';
        html += '</select>';
        html += '</div>';
        html += '<div class="pull-left"><button type="button" class="btn btn-delete ym_remove"><i class="glyphicon glyphicon-trash"></i></button></div>';
        html += '</div>';
        //html += '<div class="pull-left ml80 tishinr"></div>';
        i_undertaker++;

        $('#undertaker_list').append(html);
        //$("form#actForm").validate();
        //$('.op_undertaker').each(function(){
        //    $(this).rules("add",{ required: true, messages: { required: "名称不能为空"}});
        //});
        //$('input.op_undertaker').blur(function(){
        //    var text_value=$(this).val();
        //    if(text_value !='') {
        //        $(this).removeClass('error');
        //        $(this).parent().parent().parent().next().next('.tishinr').html('');
        //    }
        //});
    });
    // 生成承办机构
    function renderUndertakerTemplate(items) {
        if(items.length > 0) {
            html = '';
            $.each(items, function(k, v){
                html += '<div class="row op_undertaker ym_remove mb20">';
                html += '<div class="pull-left width420 ml12">';
                html += '<input type="text" class="form-control op_undertaker" name="op_undertaker['+k+'][name]" placeholder="" value="'+ v.name +'" maxlength="50">';
                html += '</div>';
                html += '<div class="pull-left btn-group width150 ml12">';
                html += '<select class="form-control" name="op_undertaker['+k+'][type]">';
                html += '<option value="1" '+(v.type=='1'?'selected':'')+'>主办方</option>';
                html += '<option value="2" '+(v.type=='2'?'selected':'')+'>承办方</option>';
                html += '<option value="3" '+(v.type=='3'?'selected':'')+'>协办方</option>';
                html += '</select>';
                html += '</div>';
                html += '<div class="pull-left"><button type="button" class="btn btn-delete ym_remove"><i class="glyphicon glyphicon-trash"></i></button></div>';
                html += '</div>';
            });
            $('#undertaker_list').append(html);
        }
    }
    renderUndertakerTemplate(undertaker_items);

    // 报名活动表单提交
    $('form#actForm').submit(function(){

        UE.getEditor('ym_editor').sync();

        var is_empty = false;
        $.each($('.form_required'), function(k, v){
            if($(v).val() == '') {
                alertTips($('#tips-modal'), '表单名称和选项均不能为空。');
                is_empty = true;
            }
        });
        if(is_empty == true) {
            return false;
        }
    }).validate({
        ignore: '',
        errorPlacement: function(error, element){
            element.parent().parent().next('.tishinr').html(error);
        },
        rules: {
            name: {
                required: true,
                rangelength: [2, 50]
            },
            startTime: {
                required: true,
                after_subject_start: true
            },
            endTime: {
                required: true,
                before_subject_end: true,
                afterstart: true
            },
            areaid_1: {
                required: true
            },
            areaid_2: {
                required: true
            },
            address: {
                required: true,
                rangelength: [5, 100]
            },
            content: {
                required: true,
                rangelength:[2,200000]
            },
            end : {
                before_signup_start: true
            }
        },
        messages: {
            name: {
                required: "文章名称不能为空",
                rangelength: "文章名称不得少于两个字，不得多于五十个字"
            },
            startTime: {
                required: "文章开始时间不能为空"
            },
            endTime: {
                required: "文章结束时间不能为空"
            },
            areaid_1: {
                required: "区域/详细地址不能为空"
            },
            areaid_2: {
                required: "区域/详细地址不能为空"
            },
            address: {
                required: "区域/详细地址不能为空",
                rangelength: "详细地址不得少于5个字，不得多于100个字"
            },
            content: {
                required: "文章内容不能为空",
                rangelength: "文章内容不能少于两个字或不能多于一万个字"
            }
        }
    }).focusInvalid = function(){
        if( this.settings.focusInvalid ) {
            try {
                var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
                if (toFocus.is("textarea")) {
                    UE.getEditor('ym_editor').focus()
                } else {
                    toFocus.filter(":visible").focus();
                }
            } catch(e) {
            }
        }
    };

    // 区域触发
    $('#area1').change(function(){
        var id1 = $(this).val();
        if(id1 == '') {
            $('#area2').html('<option value="">市/区</option>');
            return false;
        }
        $('#val').val(id1);
        $.ajax({
            type: 'POST',
            url: ajax_area_url,
            data: {id: id1},
            dataType: "json",
            beforeSend: function(){
                $('#myForm').append('<i id="loading" class="fa fa-spinner fa-spin"></i>');
            },
            success: function(data){
                if(data.status=='ok'){
                    $('#loading').remove();
                    //                    var html = '<option value=""></option>';
                    var html = '';
                    $.each(data.data, function(k, v){
                        html += '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                    $('#area2').html(html);

                    $('#area2').on('change', function(){
                        var id2 = $(this).val();
                        $('#val').val(id1+','+id2);
                    });
                }else{
                    $('#loading').remove();
                    alert(data.msg);
                }
            }
        });
    });


});