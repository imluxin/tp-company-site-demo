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
    <link rel="stylesheet" type="text/css" href="/Public/home/css/basic-information.css" />


    <!-- 导入面包屑 -->
<?php
$breadcrumbs = array( 'base' => '社员管理', 'list' => array( array('url'=>U('Member/index'), 'v'=>'社员列表'), array('url'=>'', 'v'=>'创建新社员') ) ); ?>
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

<div class="rightmain">


<?php if(empty($exist)) :?>
    <div class="pull-right mt20"><a href="<?php echo U('Member/index')?>"><i class="fa fa-arrow-left"></i> 社员列表</a></div>
    <h4>创建新社员</h4>
    <div class="width500 mt20 ml80">
        <form class="form-horizontal" id="addMember_form" method="post" action="<?php echo U('Member/add');?>">
            <div>
                <div class="form-group mb0">
                    <label for="inputEmail3" class="col-xs-2 mt7">邮箱</label>
                    <div class="col-xs-9 ml-5">
                        <input type="email" name="email" class="form-control" id="email" placeholder="邮箱">
                    </div>
                    <div class="col-xs-1 add-options">*</div>
                </div>
                <div class="row ml80 tishinr pdlf10"></div>
            </div>

            <div>
                <div class="form-group mb0">
                    <label for="inputEmail3" class="col-xs-2 mt7">手机</label>
                    <div class="col-xs-9 ml-5">
                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="手机">
                    </div>
                    <div class="col-xs-1 add-options">*</div>
                </div>
                <div class="row ml80 tishinr pdlf10"></div>
            </div>

            <div>
                <div class="form-group mb0">
                    <label for="inputEmail3" class="col-xs-2 mt7">姓名</label>
                    <div class="col-xs-9 ml-5">
                        <input type="text" name="xname" class="form-control" id="xname" placeholder="姓名">
                    </div>
                    <div class="col-xs-1 add-options">*</div>
                </div>
                <div class="row ml80 tishinr pdlf10"></div>
            </div>

            <div>
                <div class="form-group mb0">
                    <label for="inputPassword3" class="col-xs-2 mt7">密码</label>
                    <div class="col-xs-9 ml-5">
                        <input type="password" name="password" class="form-control" id="password" placeholder="限6-18位">
                    </div>
                    <div class="col-xs-1 add-options">*</div>
                </div>
                <div class="row ml80 tishinr pdlf10"></div>
            </div>

            <div class="form-group mt-15">
                <div class="col-xs-offset-2 col-xs-10">
                    <div class="checkbox ml-5 pd0">
                        <label>
                            <input type="checkbox" name="save_and_add">继续添加
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <div class="btn-group ml-5">
                        <button type="submit" class="btn mybtn active">保存</button>
                        <button type="button" class="btn mybtn" onclick="location.href='<?php echo U('Member/index'); ?>'">取消</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

            // 注册FORM验证
            $("form").validate({
                errorClass: "invalid",
                errorPlacement: function(error, element){
                    element.parent().parent().parent().find('.tishinr').append(error);
                },
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    mobile:  {
                        required: true,
                        digits: true,
                        rangelength: [11, 11]
                    },
                    xname:  {
                        required: true,
                        rangelength: [2, 10]
                    },
                    password: {
                        required: true,
                        rangelength: [6, 18]
                    }
                },
                messages: {
                    email: {
                        required: "电子邮箱地址不能为空.",
                        email: "电子邮箱格式不正确."

                    },
                    mobile: {
                        required: "手机号码不能为空.",
                        digits: "手机号码必须为数字.",
                        rangelength: "手机号码必须为11位数字"

                    },
                    xname:  {
                        required: "姓名不能为空.",
                        rangelength: "姓名必须为2到10个字符"
                    },
                    password: {
                        required: "密码不能为空",
                        rangelength: "密码必须为6到18个字符"
                    }

                }
            });
        });
    </script>

<?php else: ?>
    <div class="pull-right mt20"><a href="<?php echo U('Member/add')?>"><i class="fa fa-arrow-left"></i> 添加成员</a></div>

    <?php if(!empty($e)): ?>
        <div class="width798 mt20 pdlf30 mb40">
            <div class="pdlf10">
                <h4 class="mt30"><name0>创建未成功，
                        <?php if($t == 1 || $t==4): ?>该邮箱 <nameb><?php echo $e['email']?></nameb>
                        <?php elseif($t == 2): ?>该手机 <nameb><?php echo $e['mobile']?></nameb>
                        <?php else: ?>该 邮箱和手机<?php endif;?>
                        已注册</name0>
                </h4>
                <!--                <h5 class="mb30">社员已存在于 <nameb>华商校友会</nameb> 无法重复创建账号，您可以直接邀请该社员加入社团。</h5>-->
                <h5 class="mb30">无法重复创建账号，您可以直接邀请该社员加入社团。</h5>
            </div>
            <div class="pdlf30 mt10">
                <div class="row"><img src="<?php echo get_image_path($e['photo'])?>" alt="" class="img70"></div>
                <div class="row mt10">
                    <div class="col-xs-2">姓名</div>
                    <div class="col-xs-5"><?php echo $e['real_name']?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">邮箱</div>
                    <div class="col-xs-5"><?php echo $e['email']; ?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">手机</div>
                    <div class="col-xs-5"><?php echo $e['mobile']; ?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">公司</div>
                    <div class="col-xs-5"><?php echo $e['company']?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">区域</div>
                    <div class="col-xs-5"><?php echo get_full_area($e['areaid_1'], $e['areaid_2'])?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">社团</div>
                    <div class="col-xs-5"><?php echo $e['org']?></div>
                    <div class="col-xs-5 pull-right btn-group mt-15">
                        <!--                        <button type="button" class="btn mybtn active">邀请</button>-->
                        <button type="button" class="btn mybtn" onclick="location.href='<?php echo U('Member/index'); ?>'">取消</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(!empty($m)): ?>
        <div class="width798 mt20 pdlf30 mb40">
            <div class="pdlf10">
                <h4 class="mt30"><name0>创建未成功，该手机 <nameb><?php echo $m['mobile']?></nameb> 已注册</name0></h4>
                <!--                <h5 class="mb30">社员已存在于 <nameb>华商校友会</nameb> 无法重复创建账号，您可以直接邀请该社员加入社团。</h5>-->
                <h5 class="mb30">无法重复创建账号，您可以直接邀请该社员加入社团。</h5>
            </div>
            <div class="pdlf30 mt10">
                <div class="row"><img src="<?php echo get_image_path($m['photo'])?>" alt="" class="img70"></div>
                <div class="row mt10">
                    <div class="col-xs-2">姓名</div>
                    <div class="col-xs-5"><?php echo $m['real_name']?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">邮箱</div>
                    <div class="col-xs-5"><?php echo $m['email']; ?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">手机</div>
                    <div class="col-xs-5"><?php echo $m['mobile']; ?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">公司</div>
                    <div class="col-xs-5"><?php echo $m['company']?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">区域</div>
                    <div class="col-xs-5"><?php echo get_full_area($m['areaid_1'], $m['areaid_2'])?></div>
                </div>
                <div class="row mt10">
                    <div class="col-xs-2">社团</div>
                    <div class="col-xs-5"><?php echo $m['org']?></div>
                    <div class="col-xs-5 pull-right btn-group mt-15">
                        <!--                        <button type="button" class="btn mybtn active">邀请</button>-->
                        <button type="button" class="btn mybtn" onclick="location.href='<?php echo U('Member/index'); ?>'">取消</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    </div>
<?php endif;?>
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