<?php
namespace Admin\Controller;

use Think\Controller;

class ContactController extends BaseController{

    public function index(){

        //         每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');

        $model = D('SiteContact');
        // 获取意见列表
        $list = $model
            ->order('created_at DESC')
            ->page(I('get.p', '1').','.$num_per_page)->select();


        // 使用page类,实现分类
        $count      = $model->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出


        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    //删除单条
    public function delete(){
        $id = I('get.id');
        if(empty($id)) {
            $this->error('数据删除失败, 请重试.');
        }
        $res = D('SiteContact')->delete($id);
        if($res){
            $this->success('数据成功!');
        }else{
            $this->error('数据删除失败, 请重试.');
        }
    }

    //内容详情页
    public function view()
    {
        $id = I('get.id');
        $info = D('SiteContact')->find($id);
        if(empty($info)) {
            $this->error('内容不存在, 请重试.');exit();
        }

        $this->assign('info',$info);
        $this->display();
    }

}