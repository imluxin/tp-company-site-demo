<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Org\Util\Ueditor;
use Think\Upload;
/**
 * 公共操作控制器
 *
 * CT 2014-10-09 10:20 by  RTH
 */

class CommonController extends BaseHomeController
{

    /**
     * 图片上传页
     */
    public function upload_pic()
    {
	    $key = I('get.k'); // 字段名称
	    $type = I('get.t'); // 1为社团logo, 2为社团认证相关图片
		//获取session数据（包括社团GUID）
		$session_auth = $this->get_auth_session();
		
		//获取val相信
		switch ($type) {
			case '1':
		        $val = D('Org')->get_field('guid="'.$session_auth['org_guid'].'"','logo_orginal');
		        break;
			case '2':
		        $val = D('OrgAuthentication')->get_field('org_guid="'.$session_auth['org_guid'].'"',$key);
			    break;
			default:
			    $val = 'error';
			    break;
		}
		
		$titles = array('logo'=>'Logo', 'legal_p_card' => '法人身份证', 'yingye'=>'营业执照', 'zuzhi'=>'组织机构代码证');
		//页面渲染
	    $this->assign('title', $titles[$key]);
	    $this->assign('key', $key);
		$this->assign('val',$val);
		$this->assign('guid', $session_auth['org_guid']);
		$this->display();
    }
    
    
	/**
	 *  文件上传操作
	 *
	 * CT 2014-10-15 11:30 by YLX
	 */
	public function ajax_upload()
	{
	    $session_name = session_name();
	    if (!isset($_POST[$session_name])) {
	    	$this->ajaxReturn(array('status'=>'ko', 'msg'=>'服务器错误, 请重试.'));
	        exit;
	    } else {
	        session_id($_POST[$session_name]);
	        session_start();
	    }
	    
	    $type = I('get.t');
	    $guid = I('post.guid');
        $time_dir = date('Y_m_d', time());
	    switch ($type){
	    	case 'logo':
                $image_info = getimagesize($_FILES['uploads']['tmp_name']['0']);
                if ($image_info[0] != $image_info[1]){
                    $this->ajaxReturn(array('status'=>'ko', 'msg'=>'请上传正方形的图片.'));
                }
	    	    $config = array(
        	            'maxSize' => C('MAX_UPLOAD_SIZE'),
        	            'exts'    => C('ALLOWED_EXTS'),
	    	            'rootPath' => UPLOAD_PATH,
	    	            'savePath' => '/org/'.$time_dir.'/'.$guid.'/logo/',
	    	            'subName'  => '',
	    	            'saveName' => $guid.'-temp',
	    	            'replace'  => true
	    	    );
	    	    break;
	    	case 'legal_p_card':
	    	case 'yingye':
	    	case 'zuzhi':
	    	    $config = array(
        	            'maxSize' => C('MAX_UPLOAD_SIZE'),
        	            'exts'    => C('ALLOWED_EXTS'),
	    	            'rootPath' => UPLOAD_PATH,
	    	            'savePath' => '/org/'.$time_dir.'/'.$guid.'/auth/',
	    	            'subName'  => '',
	    	            'saveName' => $guid.'-'.$type.'-temp',
	    	            'replace'  => true
	    	    );
	    	    break;
            case 'vote':
                $config = array(
                    'maxSize' => C('MAX_UPLOAD_SIZE'),
                    'exts'    => C('ALLOWED_EXTS'),
                    'rootPath' => UPLOAD_PATH,
                    'savePath' => '/org/'.$time_dir.'/'.$guid.'/activity/',
                    'subName'  => '',
                    'saveName' => $guid.'-'.$type.'-'.time().'-temp',
                    'replace'  => true
                );
                break;
            case 'activity_poster':
                $aid = I('post.aid');
                $activity_guid = !empty($aid) ? $aid : create_guid();
                $config = array(
                    'maxSize' => 500*1024,
                    'exts'    => array('jpg', 'png', 'gif', 'bmp'),
                    'rootPath' => UPLOAD_PATH,
                    'savePath' => '/org/'.$time_dir.'/'.$guid.'/activity/poster/',
                    'subName'  => '',
                    'saveName' => $activity_guid.'-temp',
                    'replace'  => true
                );
                break;
	    	default:
	    	    $this->ajaxReturn(array('status'=>'ko', 'msg'=>'参数错误, 请重试.'));
	    	    break;
	    }
	       
	    $upload = new Upload($config);// 实例化上传类
	    // 上传文件
	    $info = $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	        $this->ajaxReturn(array('status'=>'ko', 'msg'=>$upload->getError()));
	    }else{// 上传成功
			$file_info = reset($info);
	        $savename = $file_info['savename'];
            $savepath = $file_info['savepath'];
            $val = $savepath.$savename;
            $path = '/Upload'.$val;
	        $this->ajaxReturn(array('status'=>'ok', 'data'=>array('val'=>$val, 'path'=>$path)));
	    }
	    exit();
	}

    public function ueditor()
    {
        $data = new Ueditor();
        echo $data->output();
    }
	
}