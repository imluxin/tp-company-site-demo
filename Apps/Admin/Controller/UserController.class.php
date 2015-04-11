<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends BaseController{

    /**
     * 用户列表
     */
    public function index(){
        //         每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');
        $user_model = D('User');

        $user_list = $user_model
            ->order('id asc')
            ->page(I('get.p', '1').','.$num_per_page)->select();

        // 使用page类,实现分类
        $count      = $user_model->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $this->assign('user_list',$user_list);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 增加新用户
     */
    public function add()
    {
        if(IS_POST) {
            $model = D('User');

            $check_username = $model->where(array('username' => I('post.username')))->find();
            if($check_username){
                $this->error('用户名已存在.');
            }

            $check = $model->create(I('post.'));
            if(!$check){
                $this->error($model->getError());
            }
            $result = $model->add();
            if($result) {
                $this->success('创建新用户成功!', U('User/index'));
            } else {
                $this->error('创建失败, 请重试.');
            }
            exit();
        }
        $this->assign('meta_title', '创建新用户');
        $this->display();
    }

    /**
     * 用户编辑
     */
    public function edit()
    {
        $id = I('get.id');
        $userinfo = M('User')->find($id);
        if(empty($userinfo)) {
            $this->error('用户不存在, 请重试.');exit();
        }

        if(IS_POST) {
            $data = I('post.');
            if(empty($data['password'])){
                unset($data['password']);
            }

            $model = D('User');
            $check = $model->create($data);
            if(!$check){
                $this->error($model->getError());
            }
            $result = $model->where(array('id'=>$id))->save();
            if($result) {
                $this->success('编辑用户成功!', U('User/index'));
            } else {
                $this->error('编辑失败, 请重试.');
            }
            exit();
        }

        $this->assign('user', $userinfo);
        $this->assign('meta_title', '编辑用户');
        $this->display('add');
    }

    /**
     * 用户编辑
     */
    public function delete()
    {
        $id = I('get.id');
        $userinfo = M('User')->delete($id);
        if(empty($userinfo)) {
            $this->error('删除失败, 请重试.');exit();
        }
        $this->success('删除成功!');
    }

}