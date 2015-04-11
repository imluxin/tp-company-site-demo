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
                     <!-- 
 	//创建文章页
  -->

 
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
 <link rel="stylesheet" type="text/css" href="/Public/home/css/create-registration.css" />
 <?php
 ?>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo C('BAIDU_MAP_AK', null, '382dfe7f0b7663c1c579ba8cf85e8791')?>"></script>
<!--[if IE 6]>
<script type="text/javascript" src="http://dev.baidu.com/wiki/static/map/tuan/js/DD_belatedPNG_0.0.8a-min.js"></script>
<![endif]-->
<style>
    #map_preview { border: 1px solid #bfd2e1; }
    #map_container { height: 368px; }
</style>

<div class="modal fade" id="baidu-map" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">地图位置</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="map-error" role="alert" style="display: none;"></div>
                <div id="map_preview">
                    <div id="map_container"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    function show_map(address) {
        $('#map-error').hide();
        $('#map-error').text('');
        $('#map_preview').show();
        if(address == '') {
            alertTips($('#tips-modal'), '未找到该地址.');
            return false;
        }
        local.search(address);
        $('#baidu-map').modal('show');
    }

//    var address = "天津市河东区十一径路78号万隆太平洋大厦1202室";
    var marker_trick = false;
    var map = new BMap.Map("map_container");
    map.enableScrollWheelZoom();

    var marker = new BMap.Marker(new BMap.Point(), {
        enableMassClear: false,
        raiseOnDrag: true
    });
    marker.enableDragging();
    map.addOverlay(marker);

    marker.addEventListener("dragend", function(e){
        setResult(e.point.lng, e.point.lat);
    });

    var local = new BMap.LocalSearch(map, {
        renderOptions:{map: map},
        pageCapacity: 1
    });
    local.setSearchCompleteCallback(function(results){
        if(local.getStatus() !== BMAP_STATUS_SUCCESS){
            $('#map_preview').hide();
            $('#map-error').show();
            $('#map-error').text('地址无效, 无法找到地图位置.');
        } else {
            marker.hide();
        }
    });
</script>

 <script type="text/javascript">
     var item_key = 0, //增加表单键
         token = '<?php echo I('get.token'); ?>',
         ajax_area_url = '<?php echo U('Org/ajax_get_child_area_list')?>',
         ueditor_server_url = '<?php echo U('ueditor'); ?>',
         undertaker_items = [],
         flow_items = [],
         ticket_items = [];
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
      
        <div class="btn-group width798 pdlf10">
          <div class="pull-left steps_act mt10">
            <ul class="ulgeticon pd0">
              <li class="done"><span>1.创建主题</span></li>
              <li class="current_prev"><span>2.选择类型</span></li>
              <li class="last_current"><span>3.创建活动</span></li>
            </ul>      
          </div>
          <div class="pull-right mt20"><a href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> 选择类型</a></div>
        </div>

        <div class="pdlf10 mb40 ml12">
          <div class="row mt10">
            <div class="pull-left width80 mt7">活动主题：</div>
            <div class="pull-left width420 mt7"><?php echo $subject_info['name']?></div>
          </div>
          <div class="row mt10">
            <div class="pull-left width80 mt7">活动类型：</div>
            <div class="pull-left width420 mt7"><img width="23px" src="/Public/home/images/activity4.png" alt="报名">报名</div>
          </div> 
          <!-- form -->
          <form id="actForm" method="post" action="<?php echo U('Activity/activity_add', array('type'=>'4', 'sguid'=>$subject_info['guid']))?>">
          <input type="hidden" id="token" value="<?php echo I('get.token'); ?>" />
              <div class="row mt10">
                  <div class="pull-left width80 mt7">活动时间：</div>
                  <div class="pull-left width190">
                    <div class="input-group date form_datetime">
                        <input class="form-control" size="16" type="text" value="<?php echo date('Y-m-d H:i',$subject_info['start_time']);?>" name="startTime" id="startTime" readonly>
                        <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <div class="tswidth190 tishinr" id="conTimeS"></div>
                  </div>
                  <div class="pull-left width40 mt7 pdlf10">至</div>
                  <div class="pull-left width190">
                    <div class="input-group date form_datetime">
                        <input class="form-control" size="16" type="text" value="<?php echo date('Y-m-d H:i',$subject_info['end_time']);?>" name="endTime" id="endTime" readonly>
                        <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <div class="tswidth190 tishinr" id="conTimeE"></div>
                  </div>
              </div>

              <div class="row">
                  <div class="pull-left width104 mt7 ml-24">报名开始时间：</div>
                  <div class="pull-left width190">
                      <div class="input-group date form_datetime">
                          <input type="text" readonly="" id="start" name="start" value="" size="16" class="form-control valid" aria-required="true" aria-invalid="false">
                          <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                      </div>
                      <div id="conTimeS" class="tswidth200 tishinr"></div>
                  </div>
                  <div class="pull-left width420 mt7 ml12"><nameh1>若不填，则默认活动发布成功即可报名</nameh1></div>
              </div>

              <div class="row">
                  <div class="pull-left width104 mt7 ml-24">报名结束时间：</div>
                  <div class="pull-left width190">
                      <div class="input-group date form_datetime">
                          <input type="text" readonly="" id="end" name="end" value="" size="16" class="form-control">
                          <span class="input-group-addon radius0"><span class="glyphicon glyphicon-th"></span></span>
                      </div>
                      <div id="conTimeE" class="tswidth200 tishinr"></div>
                  </div>
                  <div class="pull-left width420 mt7 ml12"><nameh1>若不填，则默认活动结束前1小时即停止报名</nameh1></div>
              </div>

              <div class="row">
                <div class="pull-left width80 mt7">参与人员：</div>
                <div class="pull-left btn-group width190">
                    <?php $all = session('auth')['org_all_guid']; $other = session('auth')['org_other_guid'];?>
                    <select class="form-control radius0" name="OGGuid">
                        <option value="<?php echo $all; ?>" <?php if ($subject_info['org_group_guid'] == $all) {echo 'selected';}?>>全部成员</option>
                        <?php foreach ($group_list as $l): ?>
                            <option value="<?php echo $l['guid']?>" <?php if ($l['guid'] == $subject_info['org_group_guid']) {echo 'selected';}?>>
                                <?php echo $l['name']?></option>
                        <?php endforeach; ?>
                        <option value="<?php echo $other?>" <?php if ($subject_info['org_group_guid'] == $other) {echo 'selected';}?>>未分组</option>
                    </select>
                </div>
              </div>

              <div class="row mt30">
                  <div class="pull-left width80">是否公开：</div>
                  <div class="pull-left">
                      <label class="radio-inline">
                          <input type="radio" name="is_public" id="inlineRadio1" value="1"> 是
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="is_public" id="inlineRadio2" value="0" checked> 否
                      </label>
                  </div>
              </div>
              <div class="row mb20">
                  <div class="ml80"><nameh1>若设为公开，则‘参与人员’选项无效，该活动将对所有人（包括非本社团用户）开放。</nameh1></div>
              </div>

              <div class="row mt30">
                  <div class="pull-left width80 mt7">填写标题：</div>
                  <div class="pull-left width420 "><input type="text" class="form-control" name="name"></div>
              </div>
              <div class="row ml80 tishinr"></div>

              <div class="row">
                  <div class="pull-left width80 mt7">选择地点：</div>
                  <div class="form-inline" role="form">
                      <input type="hidden" id="val" value="<?php echo $_GET['areaid_1'].','.$_GET['areaid_2'];?>" />
                      <select class="form-control" name="areaid_1" id="area1">
                          <option value=''>省份/直辖市</option>
                          <?php foreach ($area_1 as $v): ?>
                              <option value="<?php echo $v['id']?>" <?php if($_GET['areaid_1']==$v['id']){echo "selected=true";}?> ><?php echo $v['name']?></option>
                          <?php endforeach;?>
                      </select>
                      <select class="form-control ml12" name="areaid_2" id="area2">
                          <option value="">市/区</option>
                          <?php if (isset($_GET['areaid_2'])){ ?>
                              <?php foreach ($area_2 as $v): ?>
                                  <option value="<?php echo $v['id']?>" <?php if($_GET['areaid_2']==$v['id']){echo "selected=true";}?> ><?php echo $v['name']?></option>
                              <?php endforeach;?>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="pull-left ml80 width420 mt10">
                      <input type="text" class="form-control" name="address" id="address" placeholder="详细地址">
                  </div>
              </div>
              <div class="row ml80 tishinr"></div>
              
              <div class="row">
                  <div class="pull-left width80 mt7">选择坐标：</div>
                  <div class="pull-left width420">
                      <div class="input-group">
                          <div>
                              <input type="text" class="form-control" placeholder="搜索目的地坐标 " value="" name="keyword" />
                          </div>
                          <span class="pointer input-group-addon radius0 js-search-map"><span class="glyphicon glyphicon-search"></span></span>
                      </div>
                  </div>
                  <div class="clear"></div>
                  <div class="ml80 width420 mt10">
                      <div id="mapzoom" class="width420" style="height:360px;"></div>
                  </div>
                  <div class="ml80 width420 mt10">
                        <div class="col-md-6 pdlf0"><input type="text" class="form-control" name="lat" placeholder="维度坐标" value=""></div>
                        <div class="col-md-6 pdlf0"><input type="text" class="form-control" name="lng" placeholder="经度坐标" value=""></div>
                  </div>
              </div>
              <div class="row ml80 tishinr"></div>
              
              <div class="row">
                  <div class="pull-left width80 mt7">上传海报：</div>
                  <div class="pull-left width675">
                      <div class="col-sm-6">
                          <img id="poster_preview" src="/Public/common/images/upload-postersimg.png" class="upload-posters" style="width: 320px;">
                      </div>
                      <div class="col-sm-6 ml-20">
                          <input type="hidden" name="poster" />
                          <div id="poster"><button type="button" class="btn mybtn">上传海报</button></div>
                          <p class="help-block"><nameh1>图片小于500k (jpg、gif、png、bmp)推荐尺寸 1080*675 px的图片（不小于 472*295 px的图片）！<br><br></nameh1></p>
                          <p class="help-block"><nameh1>温馨提示：一张漂亮的海报，会起到意想不到的效果，它会让你的活动显得更加有吸引力，更有品质；<br>
                                  这将会为您的活动带来更多的用户报名哦！</nameh1></p>
                      </div>
                  </div>
              </div>
              <div class="row ml80 tishinr"></div>

              <div class="row">
                  <div class="pull-left width80 mt7">参与人数：</div>
                  <div class="pull-left width190"><input type="text" class="form-control" name="num_person" value="0"></div>
              </div>
              <div class="row mb20">
                  <div class="ml80"><nameh1>0或留空为不限制报名人数。<strong>注意：</strong>如果在页面底部您设置了票务，则此项设置失效，报名人数限制改为通过票务控制。</nameh1></div>
              </div>

              <div class="row">
                  <div class="pull-left width80 mt7">详细内容：</div>
                  <div class="pull-left width675">
                      <textarea id="ym_editor" class="content" name="content"></textarea>
                  </div>
              </div>
              <div class="row ml80 tishinr"></div>

              <!-- ========================== 活动流程 ========================== -->
              <div class="row">
                  <div class="col-sm-12 bg-collapse-btn"><button class="btn btn-primary radius0" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                          活动流程（非必填项） <i class="fa fa-angle-down"></i>
                      </button></div>
                  <div class="collapse" id="collapseExample">
                      <div class="well">

                          <div id="flow_list"></div>

                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="button" id="btn-flow-add" class="btn btn-default radius0 pull-right"><i class="fa fa-plus"></i> 添加</button>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-2 col-sm-offset-5">
                                  <button class="btn radius0" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                      收起表单 <i class="fa fa-angle-up"></i>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- ========================== 承办机构 ========================== -->
              <div class="row">
                  <div class="col-sm-12 bg-collapse-btn">
                      <button class="btn btn-success radius0" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                          承办机构设置 <i class="fa fa-angle-down"></i>
                      </button></div>
                  <div class="collapse in" id="collapseExample3">
                      <div class="well">
                          <div class="row">
                              <div class="alert alert-warning mt10">
                                  <strong>注意：</strong>此项必填，第一项必须为主办方。
                              </div>
                          </div>

                          <div id="undertaker_list">
                              <div class="row op_undertaker ym_remove mb20">
                                  <div class="pull-left width420 ml12">
                                      <input type="text" class="form-control op_undertaker" name="op_undertaker[0][name]" placeholder="" maxlength="50" value="<?php echo $auth['org_name']; ?>">
                                  </div>
                                  <div class="pull-left btn-group width150 ml12">
                                      <input type="type" class="form-control" name="useless" value="主办方" disabled />
                                      <input type="hidden" name="op_undertaker[0][type]" value="1" />
                                  </div>
                                  <div class="pull-left"><button type="button" class="btn btn-delete ym_remove"><i class="glyphicon glyphicon-trash"></i></button></div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="button" id="btn-undertaker-add" class="btn btn-default radius0 pull-right"><i class="fa fa-plus"></i> 添加</button>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-2 col-sm-offset-5">
                                  <button class="btn radius0" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                                      收起表单 <i class="fa fa-angle-up"></i>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- ========================== 报名表单 ========================== -->
              <div class="row">
                  <div class="col-sm-12 bg-collapse-btn">
                      <button class="btn btn-success radius0" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                          设置报名表单 <i class="fa fa-angle-down"></i>
                      </button></div>
                  <div class="collapse in" id="collapseExample1">
                      <div class="well">
                          <div class="row sign-form">
                              <div class="options-content">
                                  <div class="form-header"><h4>默认项</h4></div>
                                  <div class="row"><!-- 默认项 -->
                                      <div class="pull-left checkbox ml12">
                                          <label>
                                              <input type="checkbox" disabled="disabled" checked="checked"> 必填
                                          </label>
                                      </div>
                                      <div class="pull-left mandatory"><input type="hidden" name="real_name" value="姓名" readonly/>姓名</div>
                                      <div class="pull-left width360 ml12"><input type="text" name="real_name_note" class="form-control" value="报名用户的姓名" readonly /></div>
                                  </div>
                                  <div class="row"><!-- 默认项 -->
                                      <div class="pull-left checkbox ml12">
                                          <label>
                                              <input type="checkbox" disabled="disabled" checked="checked"> 必填
                                          </label>
                                      </div>
                                      <div class="pull-left mandatory"><input type="hidden" name="mobile" value="手机号码" readonly/>手机号码</div>
                                      <div class="pull-left width360 ml12"><input type="text" name="mobile_note" class="form-control" value="报名用户的手机号码" readonly /></div>
                                  </div>

                                  <div class="form-header"><h4>其他</h4></div>
                                  <div id="other_form_items"></div>

                              </div>
                              <div class="options-column">
                                  <h5>常用栏位</h5>
                                  <button type="button" onclick="javascript:addFormCommonItem(0);" class="btn btn-default btn-half">邮箱</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(1);" class="btn btn-default btn-half">公司</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(2);" class="btn btn-default btn-half">职位</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(3);" class="btn btn-default btn-half">性别</button>
                                  <h5>自定义栏位</h5>
                                  <button type="button" onclick="javascript:addFormCommonItem(100);" class="btn btn-default btn-all">单行文本框</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(101);" class="btn btn-default btn-all">多行文本框</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(102);" class="btn btn-default btn-all">单选按钮框</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(103);" class="btn btn-default btn-all">复选按钮框</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(104);" class="btn btn-default btn-all">日期选择框</button>
                                  <button type="button" onclick="javascript:addFormCommonItem(105);" class="btn btn-default btn-all">下拉选择框</button>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-2 col-sm-offset-5">
                                  <button class="btn radius0" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                                      收起表单 <i class="fa fa-angle-up"></i>
                                  </button>
                              </div>
                          </div>
                          <!-- 表单结束 -->
                      </div>
                  </div>
              </div>

              <!-- ========================== 票务 ========================== -->
              <div class="row">
                  <div class="col-sm-12 bg-collapse-btn">
                      <button class="btn btn-primary radius0" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                          设置票务（非必填项） <i class="fa fa-angle-down"></i>
                      </button>
                  </div>
                  <div class="collapse" id="collapseExample2">
                      <div class="well">

                          <div class="row">
                              <div class="alert alert-warning mt10">
                                  <strong>注意：</strong>如果您设置了票务，则‘参与人数’项设置将失效，报名人数限制改为通过票务控制。
                              </div>
                          </div>

                          <table class="table tickettable">
                              <thead>
                                  <tr class="tr-bgcolor">
                                      <td>票种名称</td>
                                      <td>票数</td>
                                      <td>可验证次数</td>
                                      <td>是否售票</td>
                                      <td>操作</td>
                                  </tr>
                              </thead>
                              <tbody id="ticket_list" class="ticketbody">
                              </tbody>
                          </table>
                          <div class="row">
                              <div class="col-sm-12">
                                  <button type="button" id="btn-ticket-add" class="btn btn-default radius0 pull-right"><i class="fa fa-plus"></i> 添加</button>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-2 col-sm-offset-5">
                                  <button class="btn radius0" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                      收起表单 <i class="fa fa-angle-up"></i>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row"><div class="page-header"></div></div>

          
              <div class="row">
                <div class="pull-left width80" style="text-indent: 2em;">发布：</div>
                <div class="pull-left">
                  <label class="radio-inline">
                    <input type="radio" name="status" value="1"> 是
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="status" value="0" checked> 否
                  </label>
                </div>
              </div>
           
              <div class="row">
                <div class="checkbox pd0 ml80"><label><input type="checkbox" name="add_again" value="yes">继续创建活动</label></div>
              </div>

              <div class="row mt10">
                <div class="pull-left btn-group ml80">
                    <button type="button" class="btn mybtn" onclick="history.go(-1);">上一步</button>
                    <button type="submit" id="submit" class="btn mybtn active">保存</button>
                    <?php
 if(I('get.sguid')){ $cancel_url = U('Activity/activity_list', array('sguid'=>I('get.sguid'))); } else if(I('get.guid')){ $cancel_url = U('Activity/activity_view', array('guid'=>I('get.guid'))); } else { $cancel_url = U('Activity/index'); } ?>
                    <button type="button" class="btn mybtn" onclick="location.href='<?php echo $cancel_url?>'">取消</button>
                </div>
              </div>
            </form>
        </div>
        
      </div>

 
<!-- modal 票务 -->
<div class="modal fade bs-example-modal-lg" id="modal_ticket" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-tk-position">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="export-import"><strong>票务设置</strong></h4>
            </div>
            <div class="modal-body">
                <form id="modal_ticket_form" class="form-horizontal">
                    <div class="form-group">
                        <label for="ticket-name" class="col-sm-2 control-label">票种名称：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" maxlength="8" id="ticket-name" name="modal_ticket_name" placeholder="最多8个字">
                        </div>
                        <!-- <div class="col-sm-4 error-pr">这里是错误信息！</div> -->
                    </div>

                    <div class="form-group">
                        <label for="ticket-number" class="col-sm-2 control-label">该票数量：</label>
                        <div class="col-sm-3">
                            <input type="number" name="points" min="1" max="10000" value="100" class="form-control" maxLength="8" name="modal_ticket_num" id="ticket-num" placeholder="">
                        </div>
                        <!-- <div class="col-sm-4 error-pr">这里是错误信息！</div> -->
                    </div>

                    <div class="form-group">
                        <label for="ticket-number2" class="col-sm-2 control-label">验证次数：</label>
                        <div class="col-sm-1">
                            <input type="text" min="1" max="30" value="10"  class="form-control" id="ticket-verifynum" name="modal_ticket_verifynum" placeholder="" />
                        </div>
                        <!--                         <div class="col-sm-4">-->
                        <!--                             <input type="range"  name="points" min="1" max="30" value="10"  class="form-control" id="ticket-number2" placeholder="最多30次">-->
                        <!--                         </div>-->
                        <div class="col-sm-3 text-left mt13 ml-12"><nameh1>最多30次</nameh1></div>
                    </div>

                    <div class="form-group">
                        <label for="ticket-number" class="col-sm-2 control-label">是否售票：</label>
                        <div class="col-sm-1">
                            <input id="ticket-forsale" data-on-color="success" value="1" type="checkbox" data-size="small" name="modal_ticket_forsale" data-on-text="是" data-off-text="否" checked>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 text-left">
                            <nameh1>用户报名后不能自动获取参会二维码，需要在参会人员中审核后发送二维码电子凭证</nameh1>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="btn-group pdlf10">
                                <input type="hidden" id="is_new" value="1" />
                                <input type="hidden" id="ticket_key" value="" /> <!-- 票编号 -->
                                <button type="button" id="modal_ticket_save" class="btn mybtn active">确定</button>
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

 <script type="text/javascript" src="/Public/home/js/signup.js"></script>
 <script type="text/javascript" src="/Public/home/js/ticket.js"></script>
 <script type="text/javascript" src="/Public/common/js/map.js"></script>
 <script type="text/javascript">
     $(document).ready(function(){
         addFormCommonItem(1);
         addFormCommonItem(2);


         // 上传海报
         $('#poster').ajaxUploadPrompt({
             url : '<?php echo U('Common/ajax_upload', array('t'=>'activity_poster')) ?>',
             type: "POST",
             dataType: "json",
             data: { '<?php echo session_name()?>':'<?php echo session_id()?>', guid:'<?php echo session('auth')['org_guid']?>' },
             beforeSend : function () {
                 $('#poster').append('<i id="loading" class="fa fa-spinner fa-spin"></i>');
//                $('img#poster_preview').after('<div id="loading-cover"><i id="loading" class="fa fa-spinner fa-spin"></i></div>');
             },
             error : function () {
                 alertTips($('#tips-modal'),'服务器出错, 请稍后重试!');
             },
             success : function (data) {
                 $('#loading').remove();
                 output = data.data;
                 if(data.status == 'ok') {
                     $('img#poster_preview').attr('src', output.path+'?'+$.now());
                     $('input[name=poster]').val(output.val);
                 } else {
                     alertTips($('#tips-modal'), data.msg);
                 }
             }
         });
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