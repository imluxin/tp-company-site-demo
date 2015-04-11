<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Org\Api\YmChat;
/**
 * 社团控制器
 * CT: 2014-11-27 15:00 by QXL
 *
 */
class OrgController extends BaseController{
    /**
     * 获取社团列表
     *
     * CT: 2014-12-03 09:46 by QXL
     */
	public function index(){
		$this->assign('orgList',D('OrgView')->getOrgList());
		$this->display();
	}
	
	/**
	 * 新增社团
	 *
	 * CT: 2014-12-03 09:46 by QXL
	 */
	public function add(){
		$this->display();
	}
	
	/**
	 * 获取社团详细信息
	 *
	 * CT: 2014-12-03 09:46 by QXL
	 */
	public function view(){
	    $orgData=D('OrgView')->getOrgData(array('guid'=>I('get.guid')));
	    $levelList=D('GradeLevel')->field(array('guid','name'))->order('sort ASC')->select();
	    $orgData['logo']=get_image_path($orgData['logo']);
	    $orgData['areaid_1']=M('area')->field('name')->getById($orgData['areaid_1'])['name'];
	    $orgData['areaid_2']=M('area')->field('name')->getById($orgData['areaid_2'])['name'];
	    $this->assign('orgData',$orgData);
	    $this->assign('levelList',$levelList);
	    $this->display();
	}
	
	/**
	 * 获取社团认证信息
	 *
	 * CT: 2014-12-03 13:50 by QXL
	 */
	public function auth(){
	    $orgData=D('OrgView')->getOrgData(array('guid'=>I('get.guid')));
	    $orgData['legal_p_card']=get_image_path($orgData['legal_p_card'],'placeholder.png');
	    $orgData['yingye']=get_image_path($orgData['yingye'],'placeholder.png');
	    $orgData['zuzhi']=get_image_path($orgData['zuzhi'],'placeholder.png');
	    $this->assign('orgData',$orgData);
	    $this->display();
	}
	
	/**
	 * 同意认证
	 *
	 * CT: 2014-12-03 13:50 by QXL
	 */
	public function agree_auth(){
	    if(IS_AJAX){
	        $guid=I('post.key');
	        if(M('OrgAuthentication')->where(array('org_guid'=>$guid))->save(array('status'=>'3'))){
	            $this->ajaxReturn(array('code'=>'200','Msg'=>'提交成功'));
	        }else{
	            $this->ajaxReturn(array('code'=>'201','Msg'=>'提交失败'));
	        }
	    }else{
	        $this->error('非法请求');
	    }
	}
	
	/**
	 * 拒绝认证
	 *
	 * CT: 2014-12-03 13:50 by QXL
	 */
	public function refuse_auth(){
	    if(IS_AJAX){
	        $guid=I('post.key');
	        $refuse_msg=I('post.refuseMsg');
	        if(M('OrgAuthentication')->where(array('org_guid'=>$guid))->save(array('status'=>'4','refuse_msg'=>$refuse_msg))){
	            $this->ajaxReturn(array('code'=>'200','Msg'=>'发送成功'));
	        }else{
	            $this->ajaxReturn(array('code'=>'201','Msg'=>'发送失败'));
	        }
	    }else{
	        $this->error('非法请求');
	    }
	}
	/**
	 * 注册社团 有问题待查
	 *
	 * CT: 2014-11-28 17:00 by QXL
	 */
	public function regOrg(){
	    if(IS_AJAX){
	    	//组合社团信息
	    	$levelData=M('grade_level')->order('sort ASC')->find();
	    	$Org = D("Org");
	    	$orgData=array();
	    	$orgData['guid']=create_guid();
	    	$orgData['name']=I('post.name');
	    	$orgData['vip']=$levelData['guid'];
	    	$orgData['all_group_guid']=get_org_all_member_group_guid($orgData['guid']);
	    	$orgData['other_group_guid']=get_org_other_member_group_guid($orgData['guid']);
			$orgData['password'] = I('post.password');
			$orgData['repassword'] = I('post.repassword');
			$orgData['email'] = I('post.email');

			$chat = new YmChat();
			$res = $chat->accreditRegister(array('username'=>$orgData['guid'],'password'=>hashCode($orgData['password'])));
            if($res['status'] != 200) {
                $this->ajaxReturn(array('code'=>'201','Msg'=>'环信注册失败: 社团帐户, 请重试.'));
            }
			$all_chat_group_id = $chat->createGroups(array('groupname'=>$orgData['name'],'desc'=>'全部成员','public'=>false,'owner'=>$orgData['guid']));
            if($all_chat_group_id['status'] != 200) {
                $this->ajaxReturn(array('code'=>'201','Msg'=>'环信注册失败: 社团全部成员群组, 请重试.'));
            }
			$other_chat_group_id = $chat->createGroups(array('groupname'=>$orgData['name'],'desc'=>'未分组成员','public'=>false,'owner'=>$orgData['guid']));
            if($other_chat_group_id['status'] != 200) {
                $this->ajaxReturn(array('code'=>'201','Msg'=>'环信注册失败: 社团未分组成员群组, 请重试.'));
            }
	    	$orgData['all_chat_group_id']=$all_chat_group_id['data']['groupid'];
	    	$orgData['other_chat_group_id']=$other_chat_group_id['data']['groupid'];

	    	//组合社团认证信息
	    	$Authentication = M("OrgAuthentication");
	    	$authenticationData=array();
	    	$authenticationData['guid']=create_guid();
	    	$authenticationData['org_guid']=$orgData['guid'];
	    	$authenticationData['status']='0';
            $authenticationData['created_at']=time();
            $authenticationData['updated_at']=time();

			if($Org->create($orgData)){
				if ($Org->add()){
					if($Authentication->add($authenticationData)){
						$this->ajaxReturn(array('code'=>'200'));
					}else{
						$this->ajaxReturn(array('code'=>'201','Msg'=>'社团认证信息创建失败'));
					}
				}else{
					$this->ajaxReturn(array('code'=>'201','Msg'=>'社团注册失败'));
				}
			}else{
				$this->ajaxReturn(array('code'=>'201','Msg'=>$Org->getError()));
			}
    	}else{
    		 $this->error('非法请求');
    	}
	}
	
	/**
	 * 修改社团等级
	 *
	 * CT: 2014-12-04 14:14 by QXL
	 */
	public function change_level(){
	    if(IS_AJAX){
	        $guid=I('post.key');
	        if(M('org')->where(array('guid'=>$guid))->save(array('updated_at'=>time(),'vip'=>I('post.vip')))){
	            $this->ajaxReturn(array('code'=>'200','Msg'=>'保存成功'));
	        }else{
	            $this->ajaxReturn(array('code'=>'201','Msg'=>'保存失败'));
	        }
	    }else{
	        $this->error('非法请求');
	    }
	}
	
	/**
	 * 删除社团
	 *
	 * CT: 2014-11-28 17:00 by QXL
	 */
	public function delOrg(){
	    if(IS_AJAX){
	        $guid=I('post.key');
	        if(M('org')->where(array('guid'=>$guid))->save(array('is_del'=>'1', 'updated_at'=>time()))){
	            $this->ajaxReturn(array('code'=>'200','Msg'=>'删除成功'));
	        }else{
	            $this->ajaxReturn(array('code'=>'201','Msg'=>'删除失败'));
	        }
	    }else{
	        $this->error('非法请求');
	    }
	}
	
	/**
	 * 锁定社团
	 *
	 * CT: 2014-11-28 17:00 by QXL
	 */
	public function lock(){
	    if(IS_AJAX){
	        $guid=I('post.key');
	        if(M('org')->where(array('guid'=>$guid))->save(array('is_lock'=>'1', 'updated_at'=>time()))){
	            $this->ajaxReturn(array('code'=>'200','Msg'=>'锁定成功'));
	        }else{
	            $this->ajaxReturn(array('code'=>'201','Msg'=>'锁定失败'));
	        }
	    }else{
	        $this->error('非法请求');
	    }
	}
	
	/**
	 * 解锁社团
	 *
	 * CT: 2014-11-28 17:00 by QXL
	 */
	public function unlock(){
	    if(IS_AJAX){
	        $guid=I('post.key');
	        if(M('org')->where(array('guid'=>$guid))->save(array('is_lock'=>'0', 'updated_at'=>time()))){
	            $this->ajaxReturn(array('code'=>'200','Msg'=>'解锁成功'));
	        }else{
	            $this->ajaxReturn(array('code'=>'201','Msg'=>'解锁失败'));
	        }
	    }else{
	        $this->error('非法请求');
	    }
	}
	
	/**
	 * 检查是否存在用户Email
	 *
	 * CT: 2014-11-28 17:00 by QXL
	 */
	public function checkMail(){
		$userInfo=M('Org')->getByEmail(I('post.email'));
		if(empty($userInfo)){
			echo 'true';
			exit();
		}else{
			echo 'false';
			exit();
		}
	}
	
	/**
	 * 检查是否存在用户手机
	 *
	 * CT: 2014-11-28 17:00 by QXL
	 */
	public function checkMobile(){
		$userInfo=M('Org')->getByPhone(I('post.mobile'));
		if(empty($userInfo)){
			echo 'true';
			exit();
		}else{
			echo 'false';
			exit();
		}
	}
	
	/**
	 * 检查是否存在群组名称
	 *
	 * CT: 2014-11-28 17:00 by QXL
	 */
	public function checkGroupName(){
		$OrgInfo=M('Org')->getByName(I('post.name'));
		if(empty($OrgInfo)){
			echo 'true';
			exit();
		}else{
			echo 'false';
			exit();
		}
	}

    //内容审核页
    public function verify(){ // verify
        $org_guid = I('get.org_guid');
        $org_model = D('Org');
        $org_info = $org_model->where(array('guid'=>$org_guid))->find();

        $area = D('Area');
        $area_1 = $area->field('name')->where(array('id'=>$org_info['areaid_1']))->find();
        $area_2 = $area->field('name')->where(array('id'=>$org_info['areaid_2']))->find();

        $this->assign('area_1',$area_1);
        $this->assign('area_2',$area_2);
        $this->assign('org_info',$org_info);
        $this->display();
    }

    //社团审核通过
    public function verify_pass(){

        $org_guid = $_GET['org_guid'];
        $org_model = D('Org');
        $orgData = $org_model->where(array('guid'=>$org_guid))->find();

        $chat = new YmChat();
        $res = $chat->accreditRegister(array('username'=>$orgData['guid'],'password'=>hashCode($orgData['password'])));
        if($res['status'] != 200) {
            $this->error('社团审核失败.');
        }
        $all_chat_group_id = $chat->createGroups(array('groupname'=>$orgData['name'],'desc'=>'全部成员','public'=>false,'owner'=>$orgData['guid']));
        if($all_chat_group_id['status'] != 200) {
            $this->error('社团审核失败..');
        }
        $other_chat_group_id = $chat->createGroups(array('groupname'=>$orgData['name'],'desc'=>'未分组成员','public'=>false,'owner'=>$orgData['guid']));
        if($other_chat_group_id['status'] != 200) {
            $this->error('社团审核失败...');;
        }

        $orgData['all_chat_group_id']=$all_chat_group_id['data']['groupid'];
        $orgData['other_chat_group_id']=$other_chat_group_id['data']['groupid'];
        $orgData['all_group_guid']=get_org_all_member_group_guid($orgData['guid']);
        $orgData['other_group_guid']=get_org_other_member_group_guid($orgData['guid']);
        $orgData['is_verify'] = 1;

        $verify_org_res = $org_model->data($orgData)->save();

        if($verify_org_res){
            $this->success('社团审核成功',U('org/index'));
        }else{
            $this->error('社团审核失败....');
        }
    }

    //社团审核不通过
    public function verify_refuse(){
        $org_model = D('Org');
        $guid = $_POST['org_guid'];
        $data['is_verify'] = 2;
        $data['verify_refuse_reason'] = htmlspecialchars($_POST['verify_refuse_reason']);
        $data['updated_at'] = time();

        $org_res = $org_model->where(array('guid'=>$guid))->data($data)->save();
        if($org_res){
            $this->success('拒绝通过成功',U('Org/index'));
        }else{
            $this->error('拒绝通过失败',U('Org/index'));
        }
    }

    //社团审核内容查看
    public function content_verify(){
        $org_guid = I('get.org_guid');
        $org_model = D('Org');
        $org_info = $org_model->where(array('guid'=>$org_guid))->find();

        $area = D('Area');
        $area_1 = $area->field('name')->where(array('id'=>$org_info['areaid_1']))->find();
        $area_2 = $area->field('name')->where(array('id'=>$org_info['areaid_2']))->find();

        $this->assign('area_1',$area_1);
        $this->assign('area_2',$area_2);
        $this->assign('org_info',$org_info);
        $this->display();
    }
}
