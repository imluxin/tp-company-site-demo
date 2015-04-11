<?php
namespace Home\Controller;

use Think\Controller;

/**
 * 下载
 *
 * CT: 2014-11-03 11:00 by YLX
 *
 */
class DownloadController extends Controller
{

    /**
     * 下载操作
     *
     * CT: 2014-11-03 11:00 by YLX
     * UT: 2014-11-03 11:00 by YLX
     */
    public function index()
    {
        $file_info = M('AppUpload')->where(array('is_del' => '0'))->order('updated_at DESC')->find();
        $data      = array(
            'name'    => '云脉',
            'ut'      => date('Y-m-d H:i:s', time()),
            'url'     => UPLOAD_URL . "/ym/apk/yunmai.apk",
            'content' => isset($file_info['content']) ? $file_info['content'] : '',
            'version' => isset($file_info['version']) ? $file_info['version'] : 0
        );
        $this->ajaxReturn(array('code'=>'10000', 'data'=>$data));
    }
}
