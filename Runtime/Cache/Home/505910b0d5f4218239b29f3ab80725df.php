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
<link rel="stylesheet" type="text/css" href="/Public/home/css/basic-information.css" />

<!-- 导入面包屑 -->
<?php
$breadcrumbs = array( 'base' => '基本信息', 'list' => array( array('url'=>'', 'v'=>'认证信息') ) ); ?>
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
        <li role="presentation"><a href="<?php echo U('Org/info')?>">基本信息</a></li>
        <li role="presentation" class="active"><a href="<?php echo U('Org/authentication')?>">认证信息</a></li>
        <li role="presentation"><a href="<?php echo U('Org/invite')?>">邀请设置</a></li>
    </ul>
</div>

<div class="rightmain">

    <?php $edit = true;?>
    <?php if ($info['status'] == '0' || $info['status'] == '1'):?>
        <div class="certification certification-warning"><strong>未认证</strong></div>
    <?php elseif ($info['status'] == '2'): $edit = false;?>
        <div class="certification certification-warning">已提交</div>
    <?php elseif ($info['status'] == '3'): $edit = false;?>
        <div class="certification certification-success"><strong>认证成功</strong></div>
    <?php elseif ($info['status'] == '4'):?>
        <div class="certification certification-danger"><strong>认证失败</strong></div>
    <?php endif;?>
           
    <div class="table mt10 mb40">
        <table class="table">
            <tbody>
              <tr class="base-tr1">
                <td class="wh140">法人姓名</td>
                <td class="wh570" id="legal_p_nameV"><?php echo $info['legal_p_name']?></td>
                <td class="wh78">
                    <?php if ($edit == true): ?>
                    <a href="<?php echo U('Org/editField', array('k'=>'legal_p_name', 't'=>'2'))?>" width="500" height="200" rel="FenBox" showspeed="200">修改</a>
                    <?php endif;?>
                </td>
              </tr>
              
              <tr>
                <td class="wh140">法人身份证</td>
                <td class="wh570"><img data-original="<?php echo get_image_path($info['legal_p_card'], 'placeholder.png');?>" class="lazy" alt="" style="height: 200px;" id="legal_p_cardV"></td>
                <td class="wh78">
                    <?php if ($edit == true): ?>
                    <a href="<?php echo U('Common/upload_pic', array('k'=>'legal_p_card', 't'=>'2'))?>" width="500" height="420" rel="FenBox" showspeed="200">修改</a>
                    <?php endif;?>
                </td>
              </tr>
              <tr>
                <td class="wh140">联系电话</td>
                <td class="wh570" id="legal_p_phoneV"><?php echo $info['legal_p_phone']?></td>
                <td class="wh78">
                    <?php if ($edit == true): ?>
                    <a href="<?php echo U('Org/editField', array('k'=>'legal_p_phone', 't'=>'2'))?>" width="500" height="200" rel="FenBox" showspeed="200">修改</a>
                    <?php endif;?>
                </td>
              </tr>
              <tr>
                <td class="wh140">营业执照</td>
                <td class="wh570"><img data-original="<?php echo get_image_path($info['yingye'], 'placeholder.png');?>" class="lazy" alt="" style="height: 200px;" id="yingyeV"></td>
                <td class="wh78">
                    <?php if ($edit == true): ?>
                    <a href="<?php echo U('Common/upload_pic', array('k'=>'yingye', 't'=>'2'))?>" width="500" height="420" rel="FenBox" showspeed="200">修改</a>
                    <?php endif;?>
                </td>
              </tr>
              <tr>
                <td class="wh140">组织机构代码证</td>
                <td class="wh570"><img data-original="<?php echo get_image_path($info['zuzhi'], 'placeholder.png');?>" class="lazy" alt="" style="height: 200px;" id="zuzhiV"></td>
                <td class="wh78">
                    <?php if ($edit == true): ?>
                    <a href="<?php echo U('Common/upload_pic', array('k'=>'zuzhi', 't'=>'2'))?>" width="500" height="420" rel="FenBox" showspeed="200">修改</a>
                    <?php endif;?>
                </td>
              </tr>
            </tbody>
        </table>
    </div>
    
    <div class="btn-group mb40">
      <?php if ($edit): ?>
          <form action="<?php echo U('Org/Authentication')?>" method="post">
                <button type="submit" class="btn mybtn active">提交认证</button>
          </form>
      <?php endif;?>
    </div>
</div>
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