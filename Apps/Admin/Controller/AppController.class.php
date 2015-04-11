<?php
/**
 * Created by PhpStorm.
 * User: T430
 * Date: 2015-3-26
 * Time: 10:24
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;

class AppController extends BaseController {
    //APP下载申请审核管理
    public function index(){

        //         每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');

        $app_application_model = D('AppApplication');
        // 获取意见列表
        $app_application_list = $app_application_model->where('is_del = 0')
                                      ->order('created_at DESC')
                                      ->page(I('get.p', '1').','.$num_per_page)->select();

        // 使用page类,实现分类
        $count      = $app_application_model->where('is_del = 0')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $this->assign('app_application_list',$app_application_list);
        $this->assign('page',$show);
        $this->display();
    }

    //APP申请人内容页
    public function content(){
        $user_guid = I('get.user_guid');//APP申请人用户ID
        $app_application_model = D('AppApplication');
        $app_application_info = $app_application_model->where(array('guid' => $user_guid))->find();

        $this->assign('app_application_info',$app_application_info);
        $this->display();
    }
    //App审核内容检查
    public function check_content(){
        $applictino_guid = I('get.appliction_guid');
        $app_appliction_model = D('AppApplication');
        if(I('get.type') == 1){
            $data['status'] = 1;//审核状态 0未审核 1已通过 2未通过
        }else{
            $data['status'] = 2;
        }
        $data['updated_at'] = time();
        $app_res = $app_appliction_model->data($data)->where(array('guid' => $applictino_guid))->save();
        $app_info = $app_appliction_model->where(array('guid' => $applictino_guid))->find();
        if($app_res){
            //function.php
            $appliction_status = send_email($app_info['email'],'社团邦','社团邦APP下载审核状态',"您的App下载申请已经通过审核，请点击下面的链接下载社团邦APP<br><a href='http://www.yunmai365.com/Upload/ym/apk/yunmai.apk'>下载</a>");
            if($appliction_status){
                $this->success('申请人信息审核成功',U('App/index'));
            }else{
                $this->error('申请人审核信息发送失败',U('App/index'));
            }
        }else{
            $this->error('申请人信息审核失败',U('App/index'));
        }
    }
}