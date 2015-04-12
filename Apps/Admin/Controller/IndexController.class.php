<?php
namespace Admin\Controller;

use Org\Util\Ueditor;

class IndexController extends BaseController {

    /**
     * 首页
     */
    public function index(){
        $this->assign('meta_title', '首页');
        $this->display();
    }

    /**
     * ueditor配置
     */
    public function ueditor()
    {
        $data = new Ueditor();
        echo $data->output();
    }


    /**
     *  文件上传操作
     *
     * CT 2014-10-15 11:30 by YLX
     */
    public function ajax_upload(){
        $session_name = session_name();
        if (!isset($_POST[$session_name])) {
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'服务器错误, 请重试.'));
            exit;
        } else {
            session_id($_POST[$session_name]);
            session_start();
        }

        $type = I('get.t');
        $guid = I('post.guid');
        $time_dir = date('Y_m_d', time());
        switch ($type){
            case 'task':
                $image_info = getimagesize($_FILES['uploads']['tmp_name']['0']);
                if ($image_info[0] != $image_info[1]){
                    $this->ajaxReturn(array('status'=>'ko', 'msg'=>'请上传正方形的图片.'));
                }
                $config = array(
                    'maxSize' => C('MAX_UPLOAD_SIZE'),
                    'exts'    => C('ALLOWED_EXTS'),
                    'rootPath' => UPLOAD_PATH,
                    'savePath' => '/task/',
                    'subName'  => '',
                    'saveName' => md5(uniqid()),
                    'replace'  => true
                );
                break;
            default:
                $this->ajaxReturn(array('status'=>'ko', 'msg'=>'参数错误, 请重试.'));
                break;
        }

        $upload = new Upload($config);// 实例化上传类
        // 上传文件
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>$upload->getError()));
        }else{// 上传成功
            $file_info = reset($info);
            $savename = $file_info['savename'];
            $savepath = $file_info['savepath'];
            $val = $savepath.$savename;
            $path = '/Upload'.$val;
            $this->ajaxReturn(array('status'=>'ok', 'data'=>array('val'=>$val, 'path'=>$path)));
        }
        exit();
    }
}