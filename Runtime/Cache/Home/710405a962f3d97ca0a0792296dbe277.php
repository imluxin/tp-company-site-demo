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


<link rel="stylesheet" type="text/css" href="/Public/home/css/member-list.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/modal-geren.css" />


<!-- 导入面包屑 -->
<?php
$breadcrumbs = array( 'base' => '社员管理', 'list' => array( array('url'=>'', 'v'=>'社员列表') ) ); ?>
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
        <li role="presentation" class="active"><a href="<?php echo U('Member/index')?>">社员列表</a></li>
        <li role="presentation"><a href="<?php echo U('Member/ogm')?>">分组管理</a></li>
    </ul>
</div>

<!--右侧主体开始-->
<div class="rightmain">
    <div class="btn-group width798 pdlf10">
        <div class="pull-left"><h5>当前分组 <?php echo $current_group_name; ?></h5></div>
        <div class="pull-right">
            <a href="<?php echo U('Member/add');?>">
                <button type="button" class="btn mybtn"><i class="fa fa-plus"></i> 添加社员</button>
            </a>
        </div>
        <div class="pull-right">
            <a href="<?php echo U('Member/invite');?>">
                <button type="button" class="btn mybtn"><i class="fa fa-star"></i> 邀请社员</button>
            </a>
        </div>
        <div class="pull-right">
            <a href="<?php echo U('Member/examine');?>">
                <button type="button" class="btn mybtn"><i class="fa fa-user"></i> 审核社员</button>
            </a>
        </div>
        <div class="pull-right">
            <a href="<?php echo U('Member/black_list');?>">
                <button type="button" class="btn mybtn"><i class="fa fa-recycle"></i> 黑名单</button>
            </a>
        </div>
    </div>

    <div class="width798 heightlist mt10 mb10">
        <div class="pull-left heightlistsm list-left">

            <div class="tableme44">
                <div class="pull-left  mt9 ml12"><input type="checkbox" id="ckAll"></div>
                <div class="pull-left  mt9 ml12"><p class="blacknm">全部</p></div>

                <div class="dropdown pull-left mt4 ml12">
                    <button class="btn btn-default dropdown-toggle dropdown-mybtn" type="button" id="dropdownMenu1" data-toggle="dropdown">
                        添加到
                        <span class="caret ml12"></span>
                    </button>
                    <ul class="dropdown-menu radius0" role="menu" aria-labelledby="dropdownMenu1">
                        <?php foreach ($group_list as $g): ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" class="add-to" guid="<?php echo $g['guid']?>"><?php echo $g['name']?></a>
                            </li>
                        <?php endforeach; ?>
                        <!--<li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">黑名单</a></li>-->
                    </ul>
                </div>
                <div class="pull-left mt4 ml12">
                    <?php if (!in_array(I('get.group'), array('all', null, '', 'other'))): ?>
                        <button class="del_u btn btn-default dropdown-mybtn" type="button" id="del_from_group">从该分组移除</button>
                    <?php endif; ?>
                    <!-- <button class="del_u btn btn-default radius0 mr10" type="button" id="del_member">开除该社员</button> -->
                </div>
            </div>

            <?php if(empty($list)): ?>
                <div class="ml30 mt13">该分组下有0位成员.</div>
            <?php else: ?>
                <form id="form1" method="post" action="<?php echo U('Member/ogm_operate');?>" style="height: 100%">
                    <input id="batch_act" type="hidden" name="batch_act" value=""/>
                    <input id="group2" type="hidden" name="group2" value="no-guid" />
                    <?php foreach ($list as $u): ?>

                        <div class="tableme59">
                            <div class="pull-left mt10 ml12">
                                <input class="checkbox-u" type="checkbox" name="ckguid[]" value="<?php echo $u['gid'].'|'.$u['uid']?>" />
                                <a href="<?php echo U('Member/member_info', array('guid'=>$u['uid']))?>" style="color: #000;">
                                    <img data-original="<?php echo get_image_path($u['photo'])?>" alt="" class="lazy img45 ml12 photo" id="example<?php echo $u['uid']?>">
                                </a>
                            </div>
                            <!--鼠标经过头像触发-->
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $("#example<?php echo $u['uid']?>").popover({
                                        content: '<div class="portrait-form2 height90">'
                                        +'<div class="pull-left"><h4>详细资料</h4><h5><?php echo $u['real_name'] ?></h5></div>'
                                        +'<div class="pull-right mt10"><img src="<?php echo get_image_path($u['photo'])?>" class="img70"></a></div>'
                                        +'</div>'
                                        +'<div class="myform">'
                                        +'<table class="table"><tbody>'
                                        +'<tr><td class="wh50">公司</td><td class="wh150"><?php echo D('User')->getCompanyNames($u['uid']); ?></td></tr>'
                                        +'<tr><td class="wh50">区域</td><td class="wh150"><?php echo get_full_area($u['areaid_1'], $u['areaid_2']); ?></td></tr>'
                                        +'<tr><td class="wh50">签名</td><td class="wh150"><?php echo $u['remark'] ?></td></tr>'
                                        +'</tbody></table>'
                                        +'</div>',
                                        html: true,
                                        trigger: 'hover'
                                    });
                                });
                            </script>
                            <!--触发结束-->
                            <div class="pull-left mt10 ml12">
                                <a href="<?php echo U('Message/history', array('guid'=>$u['uid']))?>" class="blacknm"><?php echo $u['real_name'] ?></a>
                                <p class="signature"><?php echo $u['remark'] ?></p>
                            </div>
                            <div class="pull-right mt16">
                                <!--<a class="send_msg" href="javascript:void(0);" url="<?php echo U('Message/reply', array('guid'=>$u['uid']))?>">发送消息</a>-->
                                <?php if ($u['is_active'] == '0') : ?>
                                    <!--								<label>激活</label>-->
                                    <!--								--><?php ?>
                                    <label class="color0">未激活</label>
                                <?php endif; ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-default radius0 mr10 send_msg" url="<?php echo U('Message/reply', array('to_guid'=>$u['uid']))?>">发送消息</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>
            <?php endif; ?>
        </div>

        <div class="pull-right list-right">
            <ul class="nav nav-pills nav-stacked right-menu" role="tablist">
                <li role="presentation" class="<?php echo (in_array(I('get.group'), array('all', null, '')))?'active':'' ?>">
                    <a href="<?php echo U('Member/index', array('group'=>'all'))?>">
                        <label>全部成员(<?php echo $num_all?>)</label>
                    </a>
                </li>
                <li role="presentation" class="<?php echo (I('get.group')=='other')?'active':'' ?>">
                    <a href="<?php echo U('Member/index', array('group'=>'other'))?>">
                        <label class="ml12">未分组(<?php echo $num_other?>)</label>
                    </a>
                </li>
                <?php foreach ($group_list as $g): ?>
                    <li role="presentation" class="<?php echo (I('get.group')==$g['guid'])?'active':'' ?>">
                        <a href="<?php echo U('Member/index', array('group'=>$g['guid']))?>">
                            <label class="ml12"><?php echo $g['name'] ?>(<?php echo !empty($group_list_stat[$g['guid']])?$group_list_stat[$g['guid']]:'0'; ?>)</label>
                        </a>
                    </li>
                <?php endforeach; ?>
                <!--<li role="presentation">
                    <a href="#">
                        <label>黑名单(0)</label>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>

    <div class="btn-group mb40">
        <?php echo $page; ?>
    </div>

</div>
<!--右侧主体结束-->

<script type="text/javascript">
    $(document).ready(function(){

        $('#ckAll').on('change', function(){
            $("input.checkbox-u").prop('checked', $(this).prop("checked"));
        });

//	$('#g_name').change(function(){
        $('.add-to').on('click', function(){
            if ($(this).val()!='no')
            {
                //alert($(this).val());
                var len = $('input.checkbox-u:checked').length;
                if (len < 1){ alert('请选择要分组的社员。'); return false; }
                $('#batch_act').val("op");

                $('#group2').val($(this).attr('guid'));
                $('form#form1').submit();
            }
        });

        //批量从该组删除
        $('.del_u').click(function(){
            var len = $('input.checkbox-u:checked').length;
            if (len < 1){ alert('请选择要删除的社员。'); return false; }
            if (confirm('确定要删除所选项吗？')){
                $('#batch_act').val($(this).attr('id'));//增加删除标志位
                $('#group2').val('<?php echo I('get.group') ?>');
                $('form#form1').submit();
            }
        });

        // 发送消息
        $(".send_msg").click(function(){
            $.showBox({
                'src': $(this).attr('url'),
                'width': 680,
                'height': 400,
                // 'data'  : "Say hello to your father",
                'success': function(data){
                    alert(data);
                }
            });
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