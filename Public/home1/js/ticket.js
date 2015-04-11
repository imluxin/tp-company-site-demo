
$(document).ready(function(){
    /**
     * 票务相关
     * @type {*|jQuery}
     */
    // 打开新增票务窗口
    $('body').on('click', '#btn-ticket-add', function(){
        $('#modal_ticket_form')[0].reset();
        $('#is_new').val('1'); // 新增
        $('#modal_ticket').modal();
    });
    // 确认票务已填信息
    $('body').on('click', '#modal_ticket_save', function(){
        var i_ticket = $.now();
        //$('form#modal_ticket_form').validate({
        //    ignore: '',
        //    rules: {
        //        'modal_ticket_name': true
        //    },
        //    messages:{
        //        'modal_ticket_name': '票种名称不能为空'
        //    }
        //});
        var t_name = $('#ticket-name').val(),
            t_num = $('#ticket-num').val(),
            t_verifynum = $('#ticket-verifynum').val(),
            t_forsale =  ($('#ticket-forsale:checked').val() == '1' ? 1 : 0),
            is_new = $('#is_new').val(),
            ticket_key = $('#ticket_key').val();
        var t_forsale_text = (t_forsale==1?'是':'否');

        if(is_new == '2' && ticket_key != ''){ // 若为编辑，则更换值
            $('span.ticket_'+ticket_key+'_name').text(t_name);
            $('span.ticket_'+ticket_key+'_name').next().val(t_name);
            $('span.ticket_'+ticket_key+'_num').text(t_num);
            $('span.ticket_'+ticket_key+'_num').next().val(t_num);
            $('span.ticket_'+ticket_key+'_verifynum').text(t_verifynum);
            $('span.ticket_'+ticket_key+'_verifynum').next().val(t_verifynum);
            $('span.ticket_'+ticket_key+'_forsale').text(t_forsale_text);
            $('span.ticket_'+ticket_key+'_forsale').next().val(t_forsale);
            //$('input.ticket_'+ticket_key+'_forsale').prop('checked', t_forsale);
        } else if(is_new == '1') { // 若为新增， 则新添一行
            html = '<tr class="op_ticket">';
            html += '<td><span class="ticket_' + i_ticket + '_name">' + t_name + '</span><input type="hidden" name="op_ticket[new][' + i_ticket + '][name]" class="t_name" value="' + t_name + '"/></td>';
            html += '<td><span class="num_used">0</span>/<span class="ticket_' + i_ticket + '_num">' + t_num + '</span><input type="hidden" name="op_ticket[new][' + i_ticket + '][num]" class="t_num" value="' + t_num + '"/></td>';
            html += '<td><span class="ticket_' + i_ticket + '_verifynum">' + t_verifynum + '</span><input type="hidden" name="op_ticket[new][' + i_ticket + '][verify_num]" class="t_verifynum" value="' + t_verifynum + '"/></td>';
            //html += '<td><input id="switch-offText" data-on-color="success" type="checkbox" name="op_ticket[new][' + i_ticket + '][is_for_sale]" class="t_forsale ticket_' + i_ticket + '_forsale" value="1" data-size="small" data-on-text="是" data-off-text="否" ' + (t_forsale == 1 ? 'checked' : '') + ' /></td>';
            html += '<td><span class="ticket_' + i_ticket + '_forsale">' + t_forsale_text + '</span><input name="op_ticket[new][' + i_ticket + '][is_for_sale]" class="t_forsale ticket_' + i_ticket + '_forsale" type="hidden" value="' + t_forsale +'"  /></td>';
            html += '<td><input type="hidden" name="op_ticket[new][' + i_ticket + '][guid]" value="" /><button type="button" class="btn bg-white radius0 btn-ticket-edit" ticket_key="' + i_ticket + '" title="设置"><i class="fa fa-cog fa-lg"></i></button><button type="button" class="btn bg-white btn-ticket-del"><i class="glyphicon glyphicon-trash"></i></button></td>';
            html += '</tr>';
            html += '<div class="pull-left ml80 tishinr"></div>';
            i_ticket++;
            $('#ticket_list').append(html);
        }
        $('#modal_ticket').modal('hide');
        $('#modal_ticket_form')[0].reset();
    });
    // 打开票务编辑窗口
    $('body').on('click', '.btn-ticket-edit', function(){
        parent = $(this).parents('tr');
        var t_name = parent.find('.t_name').val(),
            t_num = parent.find('.t_num').val(),
            t_verifynum = parent.find('.t_verifynum').val(),
            //t_forsale =  (parent.find('.t_forsale:checked').val() == '1' ? true : false),
            t_forsale = (parent.find('.t_forsale').val() == '1' ? true : false);

        // 为模态窗内容赋值
        $('#ticket-name').val(t_name);
        $('#ticket-num').val(t_num);
        $('#ticket-verifynum').val(t_verifynum),
        $('#ticket-forsale').prop('checked', t_forsale);

        $('#is_new').val('2'); // 编辑
        $('#ticket_key').val($(this).attr('ticket_key')); // 编辑

        // open modal
        $('#modal_ticket').modal();
    });
    $('body').on('click', '.btn-ticket-del', function () {
        var obj = $(this);
        $.ajax({
            url: ticket_del_url,
            type: 'POST',
            dataType: 'json',
            data: { tid: obj.attr('guid') },
            beforeSend: function(){obj.after('<i id="del_ticket_loading" class="fa fa-spinner fa-spin"></i>');
                },
            success: function(data){
                $('#del_ticket_loading').remove();
                if(data.status == 'ok') {
                    obj.parents('tr').remove();
                } else {
                    alertTips($('#tips-modal'), data.msg);
                }
            }
        });
    });
    // 生成票务列表
    function renderTicketTemplate(items) {
        if(items.length > 0) {
            html = '';
            $.each(items, function(k, v){
                html += '<tr class="op_ticket">';
                html += '<td><span class="ticket_' + k + '_name">' + v['name'] + '</span><input type="hidden" name="op_ticket[old][' + k + '][name]" class="t_name" value="' + v['name'] + '"/></td>';
                html += '<td><span class="num_used">' + v['num_used'] + '</span>/<span class="ticket_' + k + '_num">' + v['num'] + '</span><input type="hidden" name="op_ticket[old][' + k + '][num]" class="t_num" value="' + v['num'] + '"/></td>';
                html += '<td><span class="ticket_' + k + '_verifynum">' + v['verify_num'] + '</span><input type="hidden" name="op_ticket[old][' + k + '][verify_num]" class="t_verifynum" value="' + v['verify_num'] + '"/></td>';
                //html += '<td><input id="switch-offText" data-on-color="success" type="checkbox" name="op_ticket[old][' + k + '][is_for_sale]" class="t_forsale ticket_' + k + '_forsale" value="1" data-size="small" data-on-text="是" data-off-text="否" ' + (v['is_for_sale'] == 1 ? 'checked' : '') + ' readonly /></td>';
                html += '<td><span class="ticket_' + k + '_forsale">' + (v['is_for_sale'] == 1 ? '是' : '否') + '</span><input name="op_ticket[old][' + k + '][is_for_sale]" class="t_forsale ticket_' + k + '_forsale" type="hidden" value="' + (v['is_for_sale'] == 1 ? 1 : 0)+'"  /></td>';
                html += '<td><input type="hidden" name="op_ticket[old][' + k + '][guid]" value="'+v['guid']+'" /><button type="button" class="btn bg-white radius0 btn-ticket-edit" ticket_key="' + k + '" title="设置"><i class="fa fa-cog fa-lg"></i></button><button type="button" class="btn bg-white btn-ticket-del" guid="'+v['guid']+'"><i class="glyphicon glyphicon-trash"></i></button></td>';
                html += '</tr>';
                html += '<div class="pull-left ml80 tishinr"></div>';
            });
            $('#ticket_list').append(html);
        }
    }
    renderTicketTemplate(ticket_items);

});

