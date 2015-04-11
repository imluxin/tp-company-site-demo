<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Org\Api\YmCurl;
use Org\Api\YmPush;
use Think\Controller;
use Think\Verify;

/**
 * 社团帐号注册登陆
 * CT: 2014-09-15 15:00 by YLX
 */
class AuthController extends BaseAuthController
{
    
    /**
     * 社团帐号登录
     * CT: 2014-09-15 15:00 by YLX
     * UT: 2014-10-13 10:40 by YLX
     */
    public function login()
    {

        $model_org = D('Org');
        if(IS_POST){
            $password = md5(I('post.password'));
            $username = trim(I('post.username'));

            $org_info = $model_org->where(array('email' => $username, 'password' => $password))->find();
            
            if($org_info){
                // 检查用户是否通过审核
                if ($org_info['is_verify'] != '1'){
                    set_flash_msg('error', '您的账号尚未通过审核.');
                    $this->redirect('Auth/relogin');
                }
                // 检查用户是否被锁定
                if ($org_info['is_lock'] == '1'){
                    set_flash_msg('error', '您的账号已锁定.');
                    $this->redirect('Auth/relogin');
                }

                // 登录后操作
                $this->opration_after_login($org_info);

                // 如果用户选择记住登录, 保存cookie
                $this->set_remember($org_info['guid']);

                $this->redirect('Index/index');
            }else{
                set_flash_msg('error', '邮箱或密码输入有误');
                $this->redirect('Auth/relogin');
            }
        }
        
        $this->assign('meta_title', '登陆');
    	$this->display();
    	
    }

    /**
     * 社团帐号登录出错返回页面
     *
     * CT: 2014-10-08 15:40 by YLX
     */
    public function relogin()
    {
        $this->assign('meta_title', '登陆');
    	$this->display();
    }

    /**
     * 注册时相关ajax检查
     * 
     * CT: 2014-09-17 17:07 by YLX
     */
    public function check()
    {
        $type = I('get.type');

        switch ($type){
        	case 'email':
        	    $email = I('post.email');
        	    $res = D('User')->getFieldByEmail($email, 'guid');
        	    echo empty($res)?'true':'false';
        	    break;
        	case 'mobile':
        	    $mobile = I('post.mobile');
        	    $res = D('User')->getFieldByMobile($mobile, 'guid');
        	    echo empty($res)?'true':'false';
        	    break;
        	case 'username':
        	    $username = I('post.username');
                $where = 'email="'.$username.'"  AND is_lock=0 AND is_del=0';
                $res = D('Org')->find_one($where);
        	    echo !empty($res)?'true':'false';
        	    break;
        	default:
        	    $this->ajaxReturn(array('status' => 'ko', 'msg'=>'参数不对.'));
        	    break;
        }
        exit;
    }
    
    /**
     * 社团帐号退出登录
     * 
     * CT: 2014-09-15 15:00 by YLX
     */
	public function logout()
	{
		if(session('auth')){
			$_SESSION['auth']=array();
			setcookie(C('REMEMBER_KEY'), 'DELETE!', time()-1);
			$this->redirect( 'Auth/login');
		}else{
			$this->error('您还未登录', U('Auth/login'));
		}
    }

    //密码找回
    public function find_password(){

        $this->display();
    }

    //社团注册
    public function register(){

        $area_model = D('Area');
        $area_1 =  $area_model->find_all('parent_id = 0','id, name');

        if($_POST){
            $verify = new Verify();
            if(!$verify->check($_POST['verify'])){
                $this->error('验证码不正确，请重新输入');
            }

            $levelData=M('grade_level')->order('sort ASC')->find();
            $org_model = D('Org');
            $time = time();
            $data['guid'] = create_guid();
            $data['email'] = trim($_POST['email']);
            $data['phone'] = trim($_POST['mobile']);
            $data['password'] = trim($_POST['password']);
            $data['repassword'] = trim($_POST['repassword']);
            $data['name'] = trim($_POST['org_name']);
            $data['areaid_1'] = $_POST['areaid_1'];
            $data['areaid_2'] = $_POST['areaid_2'];
            $data['address'] = trim($_POST['address']);
            $data['contact_name'] = trim($_POST['contact_name']);
            $data['description'] = htmlspecialchars(trim($_POST['description']));
//            $data['created_at'] = $time;
//            $data['updated_at'] = $time;
            $data['vip'] = $levelData['guid']; //社团等级
            $data['is_verify'] = 0;//审核状态  0为未审核   1为已通过   2为未通过

            $result = $org_model->create($data);

            if(!$result){
                $this->error($org_model->getError());
            }else{
                if($org_model->add()){
                    //组合社团认证信息
                    $Authentication = M("OrgAuthentication");
                    $authenticationData=array();
                    $authenticationData['guid']=create_guid();
                    $authenticationData['org_guid']=$data['guid'];
                    $authenticationData['status']='0';
                    $authenticationData['created_at']=$time;
                    $authenticationData['updated_at']=$time;

                    if($Authentication->add($authenticationData)){
                        $this->success("社团信息提交成功，<?php echo C('APP_NAME')?>审核人员会在七个工作日完成审核工作",U('Auth/succeed',array('org_guid' => $data['guid'])),8);
                        exit();
                    }else{
                        $org_model_delete = $org_model->where(array('guid'=>$data['guid']))->delete();
                        if($org_model_delete){
                            $this->error('数据错误，请重新提交');
                            exit();
                        }
                    }

                }else{
                    $this->error('数据提交失败，请重新填写');
                    exit();
                }
            }
        }

        $this->assign('area_1',$area_1);
        $this->display();
    }


    //验证码
    public function verify(){

        $config = array(
            'imageW' => 150,
            'imageH' => 40,
            'fontSize' => 20,
            'length' => 4,
        );
        $verify = new Verify($config);
        $verify->entry();
    }

    //ajax获取二级地区
    public function ajax_two_area(){

        $areaid = $_POST['area1_id'];
        if ($areaid < 1) {
            $this->ajaxReturn(array('status'=>'ok', 'data'=>false));
        }

        $area_model = D('Area');
//        $data =  $area_model->find_all('parent_id = "'.$_POST['area1_id'].'"','id, name');
        $data = $area_model->field('id, name')->where(array('parent_id'=>$areaid))->select();

        if (!empty($data)){
            $this->ajaxReturn(array('status'=>'ok', 'data'=>$data));
        } else {
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'参数错误, 请重试.'));
        }
    }

    //ajax验证邮箱是否重复
    public function ajax_check_email(){
        $userModel = M('Org');
        $res = $userModel->where('email = "'.I('post.email').'"')->find();
        if(empty($res)){
            echo 'true';
            exit();
        }else{
            echo 'false';
            exit();
        }
    }

    //ajax验证手机是否重复
    public function ajax_check_mobile(){

        $userModel = M('Org');

        $res = $userModel->where('phone = "'.I('post.mobile').'"')->find();

        if(empty($res)){
            echo 'true';
            exit();
        }else{
            echo 'false';
            exit();
        }

    }

    //条款
    public function terms() {
        $this->assign('meta_title', '云脉365服务条款');
        $this->display();
    }

    //社团注册成功跳转页
    public function succeed(){
        $userModel = M('Org');
        $org_guid = $_GET['org_guid'];
        $org_info = $userModel->where(array('guid'=>$org_guid))->find();

        $this->assign('org_info',$org_info);
        $this->display();
    }

}
