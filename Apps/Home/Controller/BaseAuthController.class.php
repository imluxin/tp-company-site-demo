<?php
namespace Home\Controller;

use Think\Controller;
use Org\Api\YmPush;

/**
 * Home模块基控制器

 * CT: 2014-09-19 15:00 by YLX
 *
 */
class BaseAuthController extends BaseController
{
    
    /**
     * 魔术方法
     *
     * CT: 2014-09-28 15:37 by YLX
     */
    public function __construct()
    {
        parent::__construct();

        // 检查是否已登陆
        $session_auth = $this->get_auth_session();
        if (!empty($session_auth) && ACTION_NAME != 'logout'){
            $this->success('您已登陆, 马上跳转到首页.', U('Index/index'));
            exit();
        }
    }
    
    /**
     * 保存remember me cookie信息
     * 
     * CT: 2014-10-13 11:35 by YLX
     */
    public function set_remember($guid)
    {
        if (I('post.remember') == 'yes') {
            $token = md5(uniqid(rand(), TRUE));
            $expire = time() + C('REMEMBER_EXPIRE', null, '2592000');
            $ip = get_client_ip();
            // 保存cookie
            setcookie(C('REMEMBER_KEY'), $token.':'.$guid.':'.md5($ip), $expire, '/');
            // 保存cookie信息到数据库
            $data = array('remember_token'=>$token, 'remember_expire'=>$expire, 'remember_ip'=>$ip);
            $res = M('Org')->where(array('guid'=>$guid))->data($data)->save();
        }
    }
}