<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($meta_title) ? $meta_title.' - ' : ''; ?> <?php echo C('APP_NAME'); ?></title>
    <?php echo C('MEDIA_FAVICON')?>
    <!-- Bootstrap -->
    <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
    <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
    <link rel="stylesheet" type="text/css" href="/Public/home/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/sign-up.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/sign-in.css" />
    <?php echo C('MEDIA_JS.JQUERY'); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container sigin-in-main">
    <div class="row">
        <div class="sigin-in-nav">
            <a href="<?php echo U('Activity/signin', array('aid' => I('get.aid'))); ?>" title="在线签到">在线签到</a> |
            <a class="sigin-in-nav active" href="<?php echo U('Activity/signin_chart', array('aid' => I('get.aid'))); ?>" title="签到统计">签到统计</a>
        </div>
        <h2 class="text-center"><?php echo $activity_info['name']; ?></h2>
    </div>

    <div class="row">
        <div class="col-xs-12 mb10"><h4>签到统计:</h4></div>
        <div class="col-xs-6" id="chart_signin_status" style="height: 300px;"></div>
        <div class="col-xs-6" id="chart_signin_type" style="height: 300px;"></div>
    </div>

    <div class="row sigin-in-other">
        <div class="col-xs-12">
            <div class="sigin-in-table mt20">
                <form id="signup_user_list_form" method="post">
                    <?php $get = I('get.'); unset($get['token']); unset($get['p']);?>
                <table class="table table-hover">
                    <thead>
                    <tr class="functionbar">
                        <td colspan="8">
                            <div class="list-btn-group">
                                <div class="inputinline pull-left">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control" placeholder="请输入姓名或电话" value="<?php echo $keyword = urldecode($_GET['keyword']); ?>"/>
                                        <a id="btn_search" class="input-group-addon btn-default" href="javascript:void(0);"><i class="fa fa-search"></i></a>
                                        <?php if(count($get) > 1): ?>
                                            <style>a#btn_search_reset:hover{text-decoration: none !important;}</style>
                                            <a class="input-group-addon btn-default" id="btn_search_reset" href="javascript:void(0);"
                                               onclick="javascript:window.location='<?php echo U('Activity/signin_chart', array('aid' => $activity_info['guid']))?>'">重置</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <button id="export" type="button" class="btn btn-success pull-right radius0"><i class="fa fa-download"></i> 导出数据</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="tr-bgcolor">
                        <td class="width70" style="text-align: left; padding-left: 21px;">
                            <input type="checkbox" id="ckall">
                        </td>
                        <td>序号</td>
                        <td>姓名</td>
                        <td>电话</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle dropdown-mybtn" type="button" id="ticketmenu" data-toggle="dropdown">
                                    全部票务 <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu radius0" role="menu" aria-labelledby="ticketmenu">
                                    <li role="presentation">
                                        <?php $t_get = array_merge($get, array('t' => 'all')); ?>
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signin_chart', $t_get)?>'">全部票务</a></li>
                                    <?php foreach($tickets as $k => $t): ?>
                                        <li role="presentation">
                                            <?php $t_get = array_merge($get, array('t' => $t['guid'])); ?>
                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signin_chart', $t_get)?>'">
                                                <?php echo $t['name']?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle dropdown-mybtn" type="button" id="sourcetmenu" data-toggle="dropdown">
                                    全部人员来源 <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu radius0" role="menu" aria-labelledby="sourcetmenu">
                                    <li role="presentation">
                                        <?php $f_get = array_merge($get, array('f' => 'all')); ?>
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signin_chart', $f_get)?>'">全部</a>
                                    </li>
                                    <?php foreach(C('ACTIVITY_SIGNUP_FROM') as $k => $v): ?>
                                        <li role="presentation">
                                            <?php $f_get = array_merge($get, array('f' => $k)); ?>
                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="location.href='<?php echo U('Activity/signin_chart', $f_get)?>'">
                                                <?php echo $v; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle dropdown-mybtn ml12" type="button" id="statemenu" data-toggle="dropdown">
                                    签到状态 <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu radius0" role="menu" aria-labelledby="statemenu">
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                           onclick="location.href='<?php echo U('Activity/signin_chart', array_merge($get, array('s' => 'all'))); ?>'" >全部</a></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                           onclick="location.href='<?php echo U('Activity/signin_chart', array_merge($get, array('s' => 'u4'))); ?>'">已签到</a></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                           onclick="location.href='<?php echo U('Activity/signin_chart', array_merge($get, array('s' => 'no'))); ?>'">未签到</a></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                           onclick="location.href='<?php echo U('Activity/signin_chart', array_merge($get, array('s' => 'i1'))); ?>'">扫码签到</a></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                           onclick="location.href='<?php echo U('Activity/signin_chart', array_merge($get, array('s' => 'i2'))); ?>'">手动签到</a></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                           onclick="location.href='<?php echo U('Activity/signin_chart', array_merge($get, array('s' => 'i3'))); ?>'">现场报名</a></li>
                                </ul>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody id="user_list_body">
                    <?php if(empty($user_list)): ?>
                        <tr class="sigin-in-other-bg"><td colspan="8">暂无人员报名</td></tr>
                    <?php else: ?>
                        <?php $i = 1; foreach($user_list as $l): ?>
                            <tr class="sigin-in-other-bg">
                                <td class="checkbox-align"><input name="ck[]" type="checkbox" value="<?php echo $l['guid']?>" class="ck"></td>
                                <td><?php echo $i; $i++; ?></td>
                                <td><a href="<?php echo U('Activity/signup_userdetail', array('uid' => $l['guid']))?>" title="查看"><?php echo $l['real_name']; ?></a></td>
                                <td><?php echo $l['mobile']; ?></td>
                                <td><?php echo $l['ticket']['ticket_guid'] == 'nolimit' ? '' : $l['ticket']['ticket_name'];?></td>
                                <td><?php echo $l['from']?></td>
                                <td><<?php echo $l['ticket']['ticket_status_tag']?>><?php echo $l['ticket']['ticket_status']?></<?php echo $l['ticket']['ticket_status_tag']?>></td>
                                <td>
                                    <a id="pop-<?php echo $l['guid']?>" title="详细资料" class="detailslayer" data-trigger="foucs"><i class="fa fa-info-circle fa-lg"></i></a>
                                    <div class="hide" id="popopen-<?php echo $l['guid']?>">
                                        <div class="layer">
                                            <div class="pull-left"><p>
                                                    <?php foreach($l['other'] as $o): $search = array("\r\n", "\n", "\r"); ?>
                                                        <strong><?php echo $o['key'] ?>：</strong><?php echo str_replace($search, '<br />', $o['value']); ?><br>
                                                    <?php endforeach; ?>
                                                </p></div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $('#pop-<?php echo $l['guid']?>').popover({
                                                content: $('#popopen-<?php echo $l['guid']?>').html(),
                                                html: true,
                                                placement: 'left',
                                                trigger: 'hover'
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <?php if($user_count > C('NUM_PER_PAGE', null, 10)):?>
                        <tfoot>
                        <tr>
                            <td colspan="8" class="text-center">
                                <a id="next_page" href="javascript:void(0);" title="下一页"><i class="fa fa-angle-double-down fa-2x"></i></a>
                                <input type="hidden" id="current_page_num" value="<?php echo I('get.p', 1);?>" />
                            </td>
                        </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
                </form>
            </div>
        </div>

    </div>

</div>
<?php echo C('MEDIA_JS.JQUERYUI'); ?>
<?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
<?php echo C('MEDIA_JS.ZERO_CLIPBOARD')?>
<?php echo C('MEDIA_JS.COMMON'); ?>
<script type="text/javascript" src="/Public/common/echart/echarts-all.js"></script>
<!-- Modal ending-->
<!--鼠标经过头像触发-->
<script type="text/javascript">

    // 签到状况统计
    var chart_signin_status = echarts.init(document.getElementById('chart_signin_status'));
    var option_chart_signin_status = {
        title : {
            text: '签到状况统计',
            subtext: '总人数为: <?php echo $status_statistic['total']; ?>',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient : 'vertical',
            x : 'left',
            data:['已签到','未签到']
        },
        toolbox: {
            show : true,
            feature : {
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        series : [
            {
                name:'签到状况',
                type:'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    <?php foreach($status_statistic['data'] as $d): ?>
                    {value:<?php echo $d['value'] ?>, name:'<?php echo $d['name'] ?>'},
                    <?php endforeach; ?>
                ]
            }
        ]
    };
    chart_signin_status.setOption(option_chart_signin_status);

    // 签到方式统计
    var chart_signin_type = echarts.init(document.getElementById('chart_signin_type'));
    var option_chart_signin_type = {
        title : {
            text: '签到方式统计',
            subtext: '总人数为: <?php echo $status_statistic['data'][1]['value']; ?>',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient : 'vertical',
            x : 'left',
            data:['扫码签到','手动签到', '现场报名']
        },
        toolbox: {
            show : true,
            feature : {
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        series : [
            {
                name:'签到方式',
                type:'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    <?php $types = C('ACTIVITY_TICKET_SIGNIN_STATUS'); foreach($type_statistic as $d): ?>
                    {value:<?php echo $d['sum'] ?>, name:'<?php echo $types[$d['signin_status']]; ?>'},
                    <?php endforeach; ?>
                ]
            }
        ]
    };
    chart_signin_type.setOption(option_chart_signin_type);

    $(document).ready(function(){

        // 全选反选
        $('#ckall').on('change', function(){
            $("input.ck").prop('checked', $(this).prop("checked"));
        });

        // 搜索姓名或电话
        $('#btn_search').click(function(){
            var keyword = $('#search').val();
            console.log(keyword);
            if(keyword == '') {
                alertTips($('#tips-modal'), '请输入要搜索的姓名或电话');
                return false;
            }
            window.location = '<?php echo U('Activity/signin_chart', array('aid' => $activity_info['guid'])); ?>/keyword/'+keyword;
        });

        /**
         * 导出
         */
        $('#export').click(function(){
            var num_person = $('input.ck:checked').length;
            if(num_person < 1) {
                alertTips($('#tips-modal'), '选择要操作的用户.');
                return false;
            }

            $('form#signup_user_list_form').attr('action', '<?php echo U('Activity/signup_export', array('aid' => $activity_info['guid'])) ?>');
            $('form#signup_user_list_form').submit();
            return false;
        });

        /**
         * 下一页
         */
        var i_num = <?php echo isset($i) ? $i : 0; ?>;
        $('#next_page').click(function(){
            var current_page = $('#current_page_num').val();
            var next_page = parseInt(current_page)+1;
            $.ajax({
                url: '<?php echo U('Activity/ajax_signup_user_next_page', array_merge($get, array('action'=>'signin_chart'))) ?>/p/'+next_page,
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){
                    $('#next_page').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                },
                onError: function(){
                    alertTips($('#tips-modal'), '出错了，请稍后重试。');
                },
                success: function(data){
                    $('#next_page').html('<i class="fa fa-angle-double-down fa-2x"></i>');
                    if(data.status == 'ok'){
                        $('#current_page_num').val(next_page);
                        var html = '';
                        $.each(data.data, function(k, info){

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
                            html += '<tr class="sigin-in-other-bg">';
                            html += '<td class="checkbox-align"><input name="ck[]" type="checkbox" value="'+ info.guid +'" class="ck"></td>';
                            html += '<td>' + i_num + '</td>';
                            html += '<td><a href="<?php echo U('Activity/signup_userdetail')?>?uid='+ info.guid +'" title="查看">'+ info.real_name +'</a></td>';
                            html += '<td>'+ info.mobile +'</td>';
                            html += '<td>'+ ticket_name +'</td>';
                            html += '<td>'+ info.from +'</td>';
                            html += '<td><'+ info.ticket.ticket_status_tag +'>'+ info.ticket.ticket_status +'</'+ info.ticket.ticket_status_tag +'></td>';
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
                            i_num++;
                        });
                        $('#user_list_body').append(html);
                    }else if(data.status == 'ko'){
                        alertTips($('#tips-modal'), data.msg);
                    } else if(data.status == 'nomore') {
                        alertTips($('#tips-modal'), data.msg);
                        $('tfoot').hide();
                    }
                }
            });
        });

    });

</script>

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