<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

/**
 * APP 管理列表页
 *
 * CT: 2015-01-06 10:00 by RTH
 *
 */
class UploadController extends BaseController
{

    public function index(){
        //每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE', null, 10);

        $app_upload_model = M('app_upload');
        $app_upload_where = 'is_del = 0';
        $app_upload_list = $app_upload_model->where($app_upload_where)->order('updated_at DESC')->page(I('get.p', '1'), $num_per_page)->select();

        // 使用page类,实现分类
        $count      = $app_upload_model->where($app_upload_where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        //获取数据库里面数据的状态是否有未发布
        $app_status_info = $app_upload_model->where(array('is_del'=>'0','status'=>'0'))->field('status')->find();

        $this->assign('app_status_info',$app_status_info);
        $this->assign('page',$show);
        $this->assign('app_upload_list',$app_upload_list);
        $this->display();
    }

    /**
     * 文件上传
     *
     * CT： 2015-01-04 13:00 by RTH
     * UT： 2015-01-04 13:00 by RTH
     */

    public function upload()
    {
        $app_upload_model = M('AppUpload');
        $old_info = $app_upload_model->where(array('is_del'=>'0','status'=>'1'))->order('created_at DESC')->find();

        if($_POST){
//            var_dump(htmlspecialchars($_POST['content']));die();
            if(!$_FILES){
                $this->error('没有文件被上传');
            }
            //将原来文件名称改为固定样式
            $config = array(
                'exts' => array('apk'),
                'rootPath' => UPLOAD_PATH,   //文件上传保存的根路径
                'savePath' => "/ym/apk/",    //文件上传的保存路径（相对于根路径）
                'subName' => '',             //
                'saveName' => 'yunmai-temp',    //文件上传的名字
                'saveExt' => 'apk',         //文件的后缀名
                'replace' => true,          //可以覆盖原文件
            );
            $upload = new Upload($config);
            $info = $upload->upload();
            if($info){
                //数据存储到数据库
                $data['guid'] = create_guid();
                $data['version'] = $_POST['version'];
                $data['content'] = htmlspecialchars($_POST['content']);
                $data['status'] = $_POST['status'];
                $data['created_at'] = time();
                $data['updated_at'] = time();
                $res = $app_upload_model->data($data)->add();

                if(!$res){
                    $this->error('数据提交错误');
                    exit();
                }else{
                    rename(UPLOAD_PATH."/ym/apk/yunmai.apk", UPLOAD_PATH."/ym/apk/yunmai_".$old_info['version'].'_'.date('Y_m_d_H_i_s',time()).".apk");
                    rename(UPLOAD_PATH."/ym/apk/yunmai-temp.apk", UPLOAD_PATH."/ym/apk/yunmai.apk");
                    $this->success('文件更新成功',U('Upload/index'));
                    exit();
                }
            }else{
                $this->error($upload->getError());
                exit();
            }
        }

        $this->assign('old_info',$old_info);
        $this->display();

    }

    /**
     *
     * 文件上传记录存储到数据库
     *
     * CT： 2015-01-04 13:00 by RTH
     * UT： 2015-01-04 13:00 by RTH
     */

    public function upload_to_db(){

        $app_upload_model = M('AppUpload');

        //数据存储到数据库
        $data['guid'] = create_guid();
        $data['version'] = $_POST['version'];
        $data['content'] = $_POST['content'];
        $data['status'] = $_POST['status'];
        $data['created_at'] = time();
        $data['updated_at'] = time();

        $res = $app_upload_model->data($data)->add();

        if(!$res){
            $this->error('数据提交错误');
            exit();
        }else{
            $this->success('文件更新成功',U('Upload/index'));
            exit();
        }
    }

    /**
     * 文件更新编辑页
     *
     * CT： 2015-01-07 14:30 by RTH
     * UT： 2015-01-09 10:00 by RTH
     *
     */

    public function edit(){

        $app_upload_guid = I('get.guid');
        $app_upload_model = M('app_upload');
        $time = time();


        if($_POST){
            if($_FILES['apkFile']['name']){
                //文件上传
                $config = array(
                    'exts'     => array('apk'),
                    'rootPath' => UPLOAD_PATH,   //文件上传保存的根路径
                    'savePath' => "/ym/apk/",    //文件上传的保存路径（相对于根路径）
                    'subName'  => '',             //
                    'saveName' => 'yunmai-temp',    //文件上传的名字
                    'saveExt'  => 'apk',         //文件的后缀名
                    'replace'  => true,          //可以覆盖原文件
                );
                $upload = new Upload($config);
                $info = $upload->upload();
                //文件上传
                if(!$info) {
                    $this->error($upload->getError());
                    exit();
                }
            }

            //如果没有文件上传  直接进行更新数据库操作
            $data['version'] = $_POST['version'];
            $data['content'] = htmlspecialchars($_POST['content']);
            $data['status'] = $_POST['status'];
            $data['updated_at'] = $time;

            $edit_where = 'guid = "'.$app_upload_guid.'"';
            $res = $app_upload_model->where($edit_where)->data($data)->save();

            if($res){
                //删除旧文件
                unlink(UPLOAD_PATH."/ym/apk/yunmai.apk");
                rename(UPLOAD_PATH."/ym/apk/yunmai-temp.apk", UPLOAD_PATH."/ym/apk/yunmai.apk");
                $this->success('内容修改成功',U('upload/index'));
                exit();
            }else{
                $this->error('内容修改失败');
                exit();
            }


        }

        $app_upload_where = 'is_del = 0 and guid = "'.$app_upload_guid.'"';
        $app_upload_info = $app_upload_model->where($app_upload_where)->find();

        $this->assign('app_upload_info',$app_upload_info);
        $this->display();
    }



}
