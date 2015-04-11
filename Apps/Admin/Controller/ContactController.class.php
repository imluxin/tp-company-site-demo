<?php
namespace Admin\Controller;

use Think\Controller;

class ContactController extends BaseController{

    public function index(){

        //         每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');

        $model_site_contact = D('SiteContact');
        // 获取意见列表
        $list_site_contact = $model_site_contact
            ->order('created_at DESC')
            ->page(I('get.p', '1').','.$num_per_page)->select();


        // 使用page类,实现分类
        $count      = $model_site_contact->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出


        $this->assign('list_site_contact',$list_site_contact);
        $this->assign('page',$show);
        $this->display();
    }


    //删除全部
    public function delAll(){

        $model_site_contact = D('SiteContact');

        if($_POST){
            $del_guid = I('post.ckGuid');
            $res = $model_site_contact->where(array('guid' => array('in',$del_guid)))->delete();

            if($res){
                $this->success('数据删除成功');
            }else{
                $this->error('数据删除失败');
            }
        }
    }

    //删除单条
    public function del(){
        $model_site_contact = D('SiteContact');

        if($_GET) {

            $del_guid = I('get.contact_guid');
            $contact_we_del_where = 'guid ="'.$del_guid.'"';
            $res = $model_site_contact->where($contact_we_del_where)->delete();
            if($res){
                $this->success('数据删除成功',U('Contact/index'));
            }else{
                $this->error('数据删除失败');
            }

        }
    }

    //内容详情页
    public function content(){

        $site_contact_guid = I('get.contact_guid');
        $model_site_contact = D('SiteContact');

        $site_contact_where = array('is_del' => 0,'guid' => $site_contact_guid);
        $list_site_contact = $model_site_contact->where($site_contact_where)->find();

        $this->assign('list_site_contact',$list_site_contact);
        $this->display();
    }

}