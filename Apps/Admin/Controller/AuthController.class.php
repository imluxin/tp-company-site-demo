<?php
/**
 * 大后台登录
 */
namespace Admin\Controller;
use Think\Controller;
class AuthController extends Controller {
    /**
     * show登录页面
     */
    public function login(){
        if(IS_POST) {
            $username=I('post.account');
            $password=md5(I('post.password'));
            $user_info = M('User')->where(array('username' => $username, 'password' => $password, 'is_del' => '0'))
                ->find();

            if(empty($user_info)){
                $this->error('帐号或密码错误, 请重试.');
            }else{
                session('SUPERAUTH',array('username'=>$username,'password'=>$password));
                $this->success('登陆成功', U('User/index'));
            }
            exit();
        }
        $this->display();
    }
    
    
    /**
     * 退出登录
     */
    public function logout(){
        if(session('auth')){
            session('SUPERAUTH', null);
            $this->success('退出成功.', U('Auth/login'));
        }else{
            $this->error('您还未登录', U('Auth/login'));
        }
    }
}