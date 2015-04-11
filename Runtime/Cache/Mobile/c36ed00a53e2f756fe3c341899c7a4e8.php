<?php if (!defined('THINK_PATH')) exit(); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<?php echo C('MEDIA_CSS.BOOTSTRAP'); ?>
        <link rel="stylesheet" type="text/css" href="/Public/common/css/results.css" />

		<?php echo C('MEDIA_JS.JQUERY'); ?>
      	<script type="text/javascript" src="/Public/common/js/date.js"></script>
        <title>提示</title>
    </head>
    <body class="bodybg">

        <div class="main">
            <div class="imgmb"><img src="<?php echo PUBLIC_URL ?>/common/images/<?php echo $status ?>.png" width="150" height="150"></div>
            <?php if(!empty($title)){ ?>
                <h3 class="<?php echo ($status=='error')?'error':''; ?>"><strong><?php echo $title ?></strong></h3>
            <?php } ?>
            
         <?php if(isset($countdown)){ ?>
            	<div id="CountMsg" class="HotDate">
				    <span class="time_wrap" id="t_d">0<br />天</span>
				    <span class="time_wrap" id="t_h">0<br />时</span>
				    <span class="time_wrap" id="t_m">0<br />分</span>
				    <span class="time_wrap" id="t_s">0<br />秒</span>
				</div>
				<script type="text/javascript">
					$(function(){
						var now_time = '<?php echo time(); ?>'
					    function getRTime(){
							now_time++;
					        var EndTime= new Date('<?php echo ($countdown); ?>');
					        var NowTime = new Date(php_date('Y/m/d H:i:s',now_time));
					        var t =EndTime.getTime() - NowTime.getTime();
	
					        var d=Math.floor(t/1000/60/60/24);
					        var h=Math.floor(t/1000/60/60%24);
					        var m=Math.floor(t/1000/60%60);
					        var s=Math.floor(t/1000%60);
							
							if(d<0){d=0;}
							if(h<0){h=0;}
							if(m<0){m=0;}
							if(s<0){s=0;}
							
							if(d <='0' && h <='0' && m <='0' && s <='0'){
								time = window.clearInterval(time);
								location.replace(location);
							}
							
					        document.getElementById("t_d").innerHTML = d + "<br />天";
					        document.getElementById("t_h").innerHTML = h + "<br />时";
					        document.getElementById("t_m").innerHTML = m + "<br />分";
					        document.getElementById("t_s").innerHTML = s + "<br />秒";
					    }
					    var time = setInterval(getRTime,1000);
					})
				</script>
            <?php } ?>
            
            <h5><?php echo $msg ?></h5>
        </div>
    </body>
</html>