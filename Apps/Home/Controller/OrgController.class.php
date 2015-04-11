<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Org\Api\PictureCut;
use Think\Image;
/**
 * 社团基本信息页面管理
 *
 * CT 2014-10-09 10:20 by  RTH
 */

class OrgController extends BaseHomeController{
	
	/**
	 *  社团基本信息页
	 *
	 * CT 2014-10-09 10:20 by  RTH
	 * UT 2014-10-14 12:00 by YLX
	 */
	public function info()
	{
	    $session_auth = $this->get_auth_session();
		// 获取org指定guid全部数据
		$info = D('Org')->find_one(array('guid'=>$session_auth['org_guid']));
		$this->assign('auth', $session_auth);
		$this->assign('info', $info);
		$this->assign('meta_title', '基本信息');
		$this->display();
	}
	
	/**
	 *  社团认证信息页
	 *
	 * CT: 2014-10-16 14:00 by YLX
	 */
	public function authentication()
	{
	    $session_auth = $this->get_auth_session();
	    $info = D('OrgAuthentication')->find_one(array('org_guid'=>$session_auth['org_guid']));
	    
	    if (IS_POST){
	        if (empty($info) || empty($info['org_guid']) || empty($info['legal_p_card']) || empty($info['legal_p_name']) || empty($info['legal_p_phone']) 
	                || empty($info['org_guid']) || empty($info['yingye']) || empty($info['zuzhi'])) {
	            $this->error('请填写所有的认证选项再提交.');exit();
	        }
	        if ($info['status'] == '2' || $info['status'] == '3'){
	            $this->error('您已经提交或者已经通过认证, 请勿再次提交.');
	        }
	        $data = array('status'=>'2', 'updated_at'=>time());
            $org_where = 'org_guid="'.$session_auth['org_guid'].'"';
	        D('OrgAuthentication')->update($org_where,$data);
	        $info['status'] = '2';
	    }
	    
	    if (empty($info)){
	        $data = array('guid'=>create_guid(), 'org_guid'=>$session_auth['org_guid'], 'created_at'=>time());
	        D('OrgAuthentication')->insert($data);
	    }
		
		$this->assign('auth', $session_auth);
		$this->assign('info', $info);
		$this->assign('meta_title', '认证信息');
		$this->display();
	}
	
	/**
	 * 修改电话
	 *
	 * CT 2014-10-4 14:20 by  YLX
	 */
	public function editField()
	{
	    $key = I('get.k');
	    $type = I('get.t');
	    
	    if ($key == 'area'){
	    	if(I('get.areaid_2')){
	    		$area_2= D('Area')->find_all(array('parent_id'=>I('get.areaid_1')), 'id, name');
//	    		$areaUrl=U("Org/editField?k=$key&t=$type");
	    		$this->assign('area_2', $area_2);
	    	}
			$this->assign('areaUrl', U("Org/editField?k=$key&t=$type"));
	        $area_1 = D('Area')->find_all('deep=1', 'id, name');
	        $this->assign('area_1', $area_1);
	    }
	    
		//获取session数据（包括社团GUID）
		$session_auth = $this->get_auth_session();
		
		//获取社团电话
		// $type 1社团基本信息, 2为社团认证信息
		if ($type == '1'){
		    $val = D('Org')->get_field('guid="'.$session_auth['org_guid'].'"',$key);
		} elseif ($type == '2') {
		    $val = M('OrgAuthentication')->where('org_guid="'.$session_auth['org_guid'].'"')->getField($key);
		}
		
		$titles = array('phone'=>'联系手机', 'description'=>'社团简介', 'address'=>'社团地址', 'url'=>'社团网址', 'weibo'=>'社团微博', 'wx'=>'社团微信号',
		                  'mail'=>'联系邮箱', 'password'=>'密码', 'area'=>'区域', 'logo'=>'Logo', 'contact_name' => '联系人',
		                  'legal_p_name' => '法人名称', 'legal_p_card' => '法人身份证', 'legal_p_phone'=>'法人联系电话', 'yingye'=>'营业执照', 'zuzhi'=>'组织机构代码证'
		);
		
		//页面渲染
	    $this->assign('title', $titles[$key]);
	    $this->assign('key', $key);
		$this->assign('val',$val);
		$this->assign('guid', $session_auth['org_guid']);
		$this->assign('meta_title','编辑');
		$this->display();
	}

	/**
	 * 获取子地区
	 *
	 * CT 2014-10-14 17:40 by YLX
	 */
	public function ajax_get_child_area_list()
	{
	    $areaid = I('post.id');
	    if ($areaid < 1) {
	        $this->ajaxReturn(array('status'=>'ok', 'data'=>false));
	    }
	    
	    $res = D('Area')->find_all('parent_id="'.$areaid.'"','id, name');
	    if (!empty($res)){
	        $this->ajaxReturn(array('status'=>'ok', 'data'=>$res));
	    } else {
	        $this->ajaxReturn(array('status'=>'ko', 'msg'=>'参数错误, 请重试.'));
	    }
		        
	}

	/**
	 * 信息修改
	 *
	 * CT 2014-10-14 12:00 by YLX
	 */
	public function ajax_edit_info()
	{
		//页面数据处理
		if (IS_POST){
		    $session_auth = $this->get_auth_session();
		    $org_guid = $session_auth['org_guid'];
		    $key = I('post.k');
		    $val = I('post.v');
		    if (empty($org_guid)) {
		        $this->ajaxReturn(array('status'=>'ko', 'msg'=>'参数错误, 请重试.'));
		    }
		    if (empty($key)){
		        $this->ajaxReturn(array('status'=>'cancel'));
		    }
		    
		    switch ($key) {
		    	case 'phone':
		    	case 'description':
		    	case 'address':
		    	case 'url':
		    	case 'weibo':
		    	case 'wx':
		    	case 'mail':
				case 'password':
				case 'contact_name':
					if($key == 'password') { $val = md5($val); }
		    	    $data = array($key=>$val, 'updated_at'=>time());
		    	    $res = D('Org')->where(array('guid' => $org_guid))->save($data);
		    	    break;
//		    	case 'logo':
//		    	    rename(UPLOAD_PATH.'/org/'.$org_guid.'/logo/'.$org_guid.'-temp.'.C('SAVE_EXT'), UPLOAD_PATH.'/org/'.$org_guid.'/logo/'.$val);
//		    	    $data = array($key=>$val, 'updated_at'=>time());
//		    	    $res = M('Org')->where('guid="'.$org_guid.'"')->save($data);
//		    	    $val = UPLOAD_URL.'/org/'.$org_guid.'/logo/'.$val;
//		    	    break;
		    	case 'area':
		    	    list($areaid_1, $areaid_2) = explode(',', $val);
		    	    $data = array('areaid_1'=>$areaid_1, 'areaid_2'=>$areaid_2, 'updated_at'=>time());
		    	    $res = D('Org')->where(array('guid' => $org_guid))->save($data);
		    	    $val = get_full_area($areaid_1, $areaid_2);
		    	    break;
		    	case 'legal_p_name':
		    	case 'legal_p_phone':
		    	    $data = array($key=>$val, 'updated_at'=>time(), 'status'=>'1');
		    	    $res = D('OrgAuthentication')->where('org_guid="'.$org_guid.'"')->save($data);
		    	    break;
//		    	case 'legal_p_card':
//		    	case 'yingye':
//		    	case 'zuzhi':
//		    	    $dest_name = $org_guid.'_'.$key.'.'.C('SAVE_EXT');
//		    	    rename(UPLOAD_PATH.'/org/'.$org_guid.'/auth/'.$org_guid.'-'.$key.'.'.C('SAVE_EXT'), UPLOAD_PATH.'/org/'.$org_guid.'/auth/'.$dest_name);
//		    	    $data = array($key=>$dest_name, 'updated_at'=>time());
//		    	    $res = M('OrgAuthentication')->where('org_guid="'.$org_guid.'"')->save($data);
//		    	    $val = UPLOAD_URL.'/org/'.$org_guid.'/auth/'.$dest_name;
//		    	    break;
		        default:
		            $res = false;
		            break;
		    }
			
			if ($res){ //成功
    			$this->ajaxReturn(array('status'=>'ok', 'data'=>array('val'=>$val)));
			}else {
    			$this->ajaxReturn(array('status'=>'ko', 'msg'=>'数据保存错误, 请重试.'));
			}
		}
		$this->ajaxReturn(array('status'=>'ko', 'msg'=>'提交失败, 请重试.'));
	}

	public function ajax_edit_pic()
	{
		//页面数据处理
		if (IS_POST){
		    $session_auth = $this->get_auth_session();
		    $org_guid = $session_auth['org_guid'];
		    $key = I('post.k');
		    $savename = I('post.savename');
		    
		    if (empty($org_guid)) {
		        $this->ajaxReturn(array('status'=>'ko', 'msg'=>'参数错误, 请重试.'));
		    }
		    if (empty($key)){
		        $this->ajaxReturn(array('status'=>'cancel'));
		    }

            $time_dir = date('Y_m_d', time());
		    switch ($key) {
		    	case 'logo':
		    		$temp_path = UPLOAD_PATH.$savename;
		    		// 获取临时图片信息
		    		$image = new Image();
		    		$image->open($temp_path);
		    		$ext = $image->type();
                    $dest_dir = '/org/'.$time_dir.'/'.$org_guid.'/logo/';
                    $dest_path = UPLOAD_PATH.$dest_dir;
                    if(!is_dir($dest_path)) mkdir($dest_path, 0777);
		    		// 生成logo file
                    $logo_name = $org_guid.'-70x70.'.$ext;
		    		$image->thumb('70', '70')->save($dest_path.$logo_name);
		    		// rename temp file
                    $original_name = $org_guid.'-original.'.$ext;
		    		$orig_path = $dest_path.$original_name;
		    		rename($temp_path, $orig_path);
                    // save to db
		    	    $data = array($key=>$dest_dir.$logo_name, 'logo_orginal'=>$dest_dir.$original_name, 'updated_at'=>time(), 'logo_ext'=>$ext);
//		    	    $res = D('Org')->update('guid="'.$org_guid.'"',$data);
                    $res = D('Org')->where('guid="'.$org_guid.'"')->save($data);
		    	    $val = '/Upload'.$dest_dir.$logo_name;

                    // 重置Session中的org_logo
                    $session_auth['org_logo'] = $dest_dir.$logo_name;
                    session('auth', $session_auth);

		    	    break;
		    	case 'legal_p_card':
		    	case 'yingye':
		    	case 'zuzhi':
		    		$temp_path = UPLOAD_PATH.$savename;
		    		
		    		$image = new Image();
		    		$image->open($temp_path);
		    		$ext = $image->type();
                    $dest_dir = '/org/'.$time_dir.'/'.$org_guid.'/auth/';
                    $dest_path = UPLOAD_PATH.$dest_dir;
                    if(!is_dir($dest_path)) mkdir($dest_path);
		    	    
		    		$dest_name = $org_guid.'-'.$key.'.'.$ext;
		    		$dest_path = $dest_path.$dest_name;
		    		rename($temp_path, $dest_path);
		    		
		    	    $data = array($key=>$dest_dir.$dest_name, 'updated_at'=>time());
		    	    $res = D('OrgAuthentication')->update('org_guid="'.$org_guid.'"',$data);
		    	    $val = '/Upload'.$dest_dir.$dest_name;
		    	    break;
		        default:
		            $res = false;
		            break;
		    }
			
			if ($res){ //成功
    			$this->ajaxReturn(array('status'=>'ok', 'data'=>array('val'=>$val)));
			}else {
    			$this->ajaxReturn(array('status'=>'ko', 'msg'=>'数据保存错误, 请重试.'));
			}
		}
		$this->ajaxReturn(array('status'=>'ko', 'msg'=>'提交失败, 请重试.'));
	}
	
	/**
	 * ajax检查操作
	 * 
	 * CT 2014-10-14 17:00 by YLX
	 */
	public function check()
	{
	    $type = I('get.type');
	    $field = I('post.field');
	    $auth = $this->get_auth_session();
	    switch ($type){
	    	case 'old_pass':
	    	    $res = D('Org')->find_one(array('guid'=>$auth['org_guid'], 'password'=>md5($field)));
        	    echo empty($res)?'false':'true';
        	    break;
        	default:
        	    echo 'false';
        	    break;
	    }
	    exit();
	}

	/**
	 * 邀请设置
	 */
	public function invite(){
		$session_auth = $this->get_auth_session();
		// 获取org指定guid全部数据
		$info = D('Org')->find_one(array('guid'=>$session_auth['org_guid']));
		$register_url = 'http://www.yunmai365.com/register/fill_mobile/oid/'.$session_auth['org_guid'];
		$this->assign('register_url', $register_url);
		$this->assign('info', $info);
		$this->assign('meta_title','邀请设置');
		$this->display();
	}

	/**
	 * 社团邀请二维码生成
	 * CT: 2015.02.04 10:58 BY YLX
	 */
	public function invite_qr() {
		$session_auth = $this->get_auth_session();
		$register_url = 'http://www.yunmai365.com/register/fill_mobile/oid/'.$session_auth['org_guid'];
		$logo = SITE_URL.get_image_path($session_auth['org_logo']);
		$qr_path = UPLOAD_PATH . '/org/qrcode/org';
		$qr_name = $session_auth['org_guid'].'_invite.png';
		echo qrcode($qr_path, $qr_name, $register_url, $logo);die();
	}
	
	/**
	 *  设置审核开关
	 *
	 * CT 2015-01-09 13:49 by QXL
	 */
	public function setting_examine(){
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        $status = I('post.status')== 1 ? 0 : 1;
        if(M('Org')->where(array('guid'=>$org_guid))->save(array('reg_examine'=>$status))){
            $this->ajaxReturn(array('status'=>'ok'));
        }else{
            $this->ajaxReturn(array('status'=>'ko'));
        }
	}
	
	/**
	 *  设置邀请开关
	 *
	 * CT 2015-01-09 13:49 by QXL
	 */
	public function setting_invite(){
	    $auth = $this->get_auth_session();
	    $org_guid = $auth['org_guid'];
	    $status = I('post.status')== 1 ? 0 : 1;
	    if(M('Org')->where(array('guid'=>$org_guid))->save(array('reg_url'=>$status))){
	        $this->ajaxReturn(array('status'=>'ok'));
	    }else{
	        $this->ajaxReturn(array('status'=>'ko'));
	    }
	}
}