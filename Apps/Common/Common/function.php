<?php

/**
 * 生成GUID
 * @return string
 * 
 * CT: 2014-09-13 15:00 by YLX
 * UT: 2014-09-17 10:30 by YLX
 */
function create_guid()
{
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
//         $hyphen = chr(45);// "-"real_name_verify
    $uuid = substr($charid, 0, 8)
            .substr($charid, 8, 4)
            .substr($charid,12, 4)
            .substr($charid,16, 4)
            .substr($charid,20,12);
    return $uuid;
}

function create_guid_with_dash()
{
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12);
    return $uuid;
}

/**
 * 生成基础票号，后续需要循环加1
 * @param $id 业务ID
 * @return int
 * ct: 2015-03-12 17:30 by ylx
 */
function generate_ticket_num($id) {
    return intval($id.date('YmdH').'0000');
}

/**
 *
 * 检查参数是否是一个大于等于$min且小于等于$max的字符串
 *
 * @access protected
 * @param string $str 要检查的字符串
 * @param int $min 字符串最小长度
 * @param int $max 字符串最大长度
 * @return 成功：true；失败：false
 * 
 * CT: 2014-09-19 11:33 by YLX
 *
 */
function check_string_len($str, $min, $max)
{
    if (is_string($str) && strlen($str) >= $min && strlen($str) <= $max) {
        return true;
    }
    return false;
}


/**
 * java hashcode
 *
 * @param $s
 * @return int
 * CT: 2014-11-05 15:33 by YLX
 */
function hashCode($s){
    $len = strlen($s);
    $hash = 0;
    for($i=0; $i<$len; $i++){
        //一定要转成整型
        $hash = (int)($hash*31 + ord($s[$i]));
        //64bit下判断符号位
        if(($hash & 0x80000000) == 0) {
            //正数取前31位即可
            $hash &= 0x7fffffff;
        }
        else{
            //负数取前31位后要根据最小负数值转换下
            $hash = ($hash & 0x7fffffff) - 2147483648;
        }
    }
    return $hash;
}

/**
 * php异步访问URL
 * 
 * $host: 要访问的域名
 * $url: 要访问的域名后部分
 * 
 * 如要访问http://example.com/home, $host=example.com, $url=/home
 * 
 * CT: 2014-09-28 09:33 by YLX
 */
function exec_url($host, $url) 
{
    $fp = fsockopen($host, 80, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } else {
        $out = "GET $url  / HTTP/1.1\r\n";
        $out .= "Host:$host\r\n";
        $out .= "Connection: Close\r\n\r\n";
    
        fwrite($fp, $out);
        fclose($fp);
    }
}

/**
 * 闪消息, 存储时间短, 用于提示成功或错误信息
 * $type : success:成功消息, error:失败消息, notice:通知消息
 * $msg: 消息内容
 * $name: 消息名称, 默认为flash
 * $expire: 消息存在时间, 默认为3秒
 * 
 * CT: 2014-10-08 14:33 by YLX
 */
function set_flash_msg($type, $msg, $name='flash', $expire=3)
{
    session($name, null);
    $data = array('type' => $type, 'msg'=>$msg);
    session($name, $data);
}

/**
 * 获取闪消息
 * $name: 消息名称, 默认为flash
 *
 * CT: 2014-10-08 16:43 by YLX
 */
function get_flash_msg($name='flash')
{
    $res = session($name);
    session($name, null);
    return $res;
}

/**
 * 获取头像地址
 * 
 * $name: 图片名称
 * $type: 头像类别: 1为社团LOGO, 2为社团认证图片, 3为普通手机用户头像, 4社团logo原始版, 5待续
 *
 * CT: 2014-10-10 16:43 by YLX
 */
function get_image_path($name, $placeholder='noportrait.jpg') {
    $path = get_placeholder($placeholder);

    if (empty($name)){
        return $path;
    }
    $file = UPLOAD_PATH.$name;
    if (file_exists($file)) {
        $path = '/Upload'.$name.'?'.time();
    }
    return $path;
}
/**
 * 获取placeholder
 * CT: 2014-10-16 10:43 by YLX
 * @return string
 */
function get_placeholder($filename = 'noportrait.jpg')
{
    if (file_exists(PUBLIC_PATH.'/common/images/'.$filename)){
        return PUBLIC_URL.'/common/images/'.$filename;
    } else{
        return PUBLIC_URL.'/common/images/placeholder.png';
    }
}

/**
 * 获取区域名称
 * @param unknown $areaid_1 一级区域id
 * @param unknown $areaid_2 二级区域id
 * 
 * CT: 2014-10-14 15:13 by YLX
 */
function get_full_area($areaid_1, $areaid_2)
{
    $area_1 = get_area($areaid_1);
    $area_2 = get_area($areaid_2);
    return $area_1.' '.$area_2;
}
function get_area($area_id)
{
    if (empty($area_id)) return '';
    $res = M('Area')->find($area_id);
    if (!empty($res['name'])){
        return $res['name'];
    }
    return '';
}
function api_get_full_area($area_id)
{
    return $area_id.','.get_area($area_id);
}

function get_sex($sex)
{
    $arr = array('0'=>'男', '1'=>'女');
    return $arr[$sex];
}

/**
 * 把APP端传来的json串转成数组
 * 
 * CT: 2014-10-16 17:53 by YLX
 */
function api_json_explode($json)
{
    $json = str_replace('&quot;', '"', $json);
    return json_decode($json, true);
}

/**
 * 生成绝对路径的地址
 *
 * @param $url
 * @param string $vars
 * @param bool $suffix
 * @return string
 *
 * CT: 2014-11-01 17:53 by YLX
 */
function u_abs($url, $vars='', $suffix=true)
{
    return U($url, $vars, $suffix, true);
}

/**
 * 时间格式 现实几分钟前 几秒前 几天前 
 *
 * CT: 2014-10-31 16:53 by Qiu
 */
function mdate($time = NULL) {
	
	$text = '';
	
	$time = $time === NULL || $time > time() ? time() : intval($time);
	
	$t = time() - $time; //时间差 （秒）
	
	$y = date('Y', $time)-date('Y', time());//是否跨年
	
	switch($t){
		
		case $t == 0:
			
			$text = '刚刚';
		
		break;
		
		case $t < 60:
			
			$text = $t . '秒前'; // 一分钟内
		
		break;
		
		case $t < 60 * 60:
			
			$text = floor($t / 60) . '分钟前'; //一小时内
		
		break;
		
		case $t < 60 * 60 * 24:
			
			$text = floor($t / (60 * 60)) . '小时前'; // 一天内
		
		break;
		
		case $t < 60 * 60 * 24 * 3:
			
			$text = floor($time/(60*60*24)) ==1 ?'昨天 ' . date('H:i', $time) : '前天 ' . date('H:i', $time) ; //昨天和前天
		
		break;
		
		case $t < 60 * 60 * 24 * 30:
			
			$text = date('m月d日 H:i', $time); //一个月内
		
		break;
		
		case $t < 60 * 60 * 24 * 365&&$y==0:
			
			$text = date('m月d日', $time); //一年内
		
		break;
		
		default:
			
			$text = date('Y年m月d日', $time); //一年以前
		
		break;
		
	}
	
	 
	
	return $text;
	
}

/**
 * 根据生日计算年龄
 *
 * @param $date format: yyyy-mm-dd
 * @return int
 *
 * CT: 2014-11-10 11:01 by YLX
 */
function calc_age($date)
{
    return date_diff(date_create($date), date_create('today'))->y;
}



/**
 * 格式化发送日期
 *
 * @param $timestamp timestamp 时间戳
 * @return string
 *
 * CT: 2014-11-17 18:41 by qxl
 */
function formatDate($timestamp){
	$callBackText='';
	$timeDifference=time() - $timestamp;
	if($timeDifference < 60){
		$callBackText=$timeDifference.'秒前';
	}elseif ($timeDifference >= 60 && $timeDifference < 60*60){
		$callBackText=floor(($timeDifference / 60)).'分钟前';
	}else if($timeDifference >= 60*60 && $timeDifference < 60*60*24){
		$callBackText=floor(($timeDifference / (60*60))).'小时前';
	}else if($timeDifference >= 60*60*24){
		$callBackText=floor(($timeDifference / (60*60*24))).'天前';
	}
	return $callBackText;
}

/**
 * 获取社团两个虚拟分组的GUID: 全部成员 & 未分组成员
 * @param $org_guid
 * @return string
 */
function get_org_all_member_group_guid($org_guid)
{
    return md5($org_guid.'asjdofnwer9023l4234');
}
function get_org_other_member_group_guid($org_guid)
{
    return md5($org_guid.'-0pomyu-tkup567567');
}

/**
 * JSON串化
 * @param mixd $arr
 * @return string
 */
function jsonEncode($arr) {
    $json = json_encode($arr);
    //return $json;
    $json = str_replace(array('\r','\n','\t'), '', $json);
    //$json = str_replace(array('"{','}"'), array('{','}'), $json);
    return preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $json);
}

/**
 * 获取HTTP REQUEST HEADERS
 * CT: 2014-12-19 09:21 BY YLX
 */
function get_request_headers() {
    if (!function_exists('getallheaders')){
        $headers = '';
        foreach ($_SERVER as $name => $value){
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
    return getallheaders();
}

/**
 * 获取手机验证码
 * CT: 2014-12-30 11:35 BY QXL
 */
function get_mobile_code(){
    $num='0123456789';
    return substr(str_shuffle($num), 0, 6);
}

function creat_QRcode($condition){
    return 'http://qr.liantu.com/api.php?'.http_build_query($condition);
}

/**
 * 生成二维码
 * @param $qr_path 二维码保存路径
 * @param $qr_name 二维码图片名称
 * @param string $text 二维码要转存的内容
 * @param bool $logo 二维码中间logo
 * @param string $size 图片每个黑点的像素,默认5
 * @param string $level //纠错级别， 纠错级别越高，生成图片会越大
                        //L水平    7%的字码可被修正
                        //M水平    15%的字码可被修正
                        //Q水平    25%的字码可被修正
                        //H水平    30%的字码可被修正
 * @param int $padding 图片外围空白大小，默认2
 * @return bool
 */
function qrcode($qr_path, $qr_name, $text='http://www.yunmai365.com', $logo=false, $size='5', $level='L', $padding=2)
{
    if (!is_dir($qr_path)) {
        $result = mkdir($qr_path, 0777, true);
        if(!$result){
            return false;
        }
    }
    $QR = $qr_path .'/'. $qr_name;
    if (!is_file($QR)) {
        vendor("phpqrcode.phpqrcode");
        \QRcode::png($text, $QR, $level, $size, $padding);
    }

    if($logo !== false){
        $QR = imagecreatefromstring(file_get_contents($QR));
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        $logo_qr_width = $QR_width / 5;
        $scale = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    } else {
        $QR = imagecreatefromstring(file_get_contents($QR));
    }
    header("Content-Type:image/jpg");
    return imagepng($QR);
}

/**
 * 通过查找元素值删除数组元素
 * @param $array
 * @param $value
 */
function unset_array_value($array, $value) {
    if(($key = array_search($value, $array)) !== false) {
       unset($array[$key]);
    }
}

/**
 * 获取短域名
 * @param $url
 */
function get_short_url($url){
    $api = "http://api.t.sina.com.cn/short_url/shorten.json?source=3180327085&url_long=$url";
    $res = file_get_contents($api);
    $url_data = json_decode($res,true);
    return $url_data[0]['url_short'];
}

/**
 * 检查是否为正确格式邮箱
 * @param $email
 * @return mixed
 * CT: 2015-03-24 10:34 by ylx
 */
function is_valid_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * 发送电子邮箱
 * @param $to_emails 邮件地址数组
 * @param $from_name 发送人姓名
 * @param $subject 邮件标题
 * @param $content 邮件内容
 * @return mixed
 * CT: 2015-03-24 10:34 by ylx
 */
function send_email($to_emails, $from_name, $subject, $content)
{
    vendor('submail.lib.mailsend');
    $submail = new \MAILSend(C('SUBMAIL_CONFIG'));
    if(!is_array($to_emails)) {
        $submail->AddTo($to_emails);
    } else {
        foreach($to_emails as $email) {
            $submail->AddTo($email);
        }
    }
    $submail->SetSender('service@mail.yunmai365.com', $from_name);
    $submail->SetSubject($subject);
    $submail->SetText($content);
    $submail->SetHtml($content);
    return $submail->send();
}