<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>举报</title>
        <!-- css -->
        <?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
        <?php echo C('MEDIA_CSS.FONT_AWESOME'); ?>
        <?php echo C('MEDIA_CSS.ICHECK_SKIN_ALL'); ?>
        <link rel="stylesheet" type="text/css" href="/Public/home/css/article.css" />
        <style>
            .main img{display:block;max-width:100%;}
            #flash_msg { line-height: 34px; }
        </style>

        <!--JS-->
        <?php echo C('MEDIA_JS.JQUERY'); ?>
        <?php echo C('MEDIA_JS.BOOTSTRAP'); ?>
        <?php echo C('MEDIA_JS.ICHECK'); ?>
        <?php echo C('MEDIA_JS.ICHECK_CUSTOM'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]-->
        <!--<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
        <!--<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>-->
        <!--[endif]-->
    </head>

    <body class="bodybg">
        <div class="container">
            <!--举报-->
            <p class="f1 mt20">请选择举报原因</p>
            <form id="report_form" method="post">
                <div class="ichecklist">
                    <?php foreach($reason as $guid => $content): ?>
                        <div class="row report-options">
                            <label><?php echo $content; ?>
                                <div class="pull-right"><input type="checkbox" value="<?php echo $guid; ?>" name="reason[]"/></div>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row"><textarea class="form-control report-input" name="more_reason" rows="2" placeholder="其它原因"></textarea></div>

                <div id="error" class="row mt20" style="display: none;">
                    <div class="alert alert-danger"></div>
                </div>
                <div class="row mt20">
                    <div class="col-xs-7 text-right">
                        <span id="flash_msg">
                            <?php $flash = get_flash_msg('report'); if(!empty($flash)) echo $flash['msg']; ?>
                        </span>
                    </div>
                    <div class="col-xs-5">
                        <button type="button" class="ym_submit btn btn-primary btn-block" placeholder="Text input">提交</button>
                    </div>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.ichecklist input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%'
                });

                $('#flash_msg').fadeOut(2000);

                $('.ym_submit').click(function(){
                    var check_num = $('input[type=checkbox]:checked').length;
                    var more_reason = $('textarea[name=more_reason]').val();
                    if(check_num < 1 && more_reason==''){
                        $('div#error').show();
                        $('div#error div').text('您必须至少选择一个选项, 或者填写其它原因.');
                        return false;
                    }
                    $('div#error').hide();
                    $('form#report_form').submit();
                });
            });
        </script>
    </body>
</html>