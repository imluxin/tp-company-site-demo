<?php
namespace Admin\Controller;

use Think\Controller;
/**
 * 配置表管理
 *
 * CT: 2014-09-15 10:00 by RTH
 * UT: 2014-09-17 10:00 by RTH
 */
class ConfigController extends BaseController
{
    /**
     * 配置
     * CT: 2015-01-09 12:00 by ylx
     */
    public function index() {
        $common = D('Config')->get_config_by_module('common');
        $admin  = D('Config')->get_config_by_module('admin');
        $home   = D('Config')->get_config_by_module('home');
        $api    = D('Config')->get_config_by_module('api');
        $mobile = D('Config')->get_config_by_module('mobile');
        $site   = D('Config')->get_config_by_module('site');
        $this->assign('common', $common);
        $this->assign('admin', $admin);
        $this->assign('home', $home);
        $this->assign('api', $api);
        $this->assign('mobile', $mobile);
        $this->assign('site', $site);
        $this->assign('meta_title', '网站配置管理');
        $this->display();
    }

    /**
     * 更新配置
     * CT: 2015-01-09 12:00 by ylx
     */
    public function ajax_update_config() {
        if(IS_AJAX) {
            $data = I('post.');
            foreach($data as $guid => $value) {
                $r = D('Config')->set_field(array('guid' => $guid), array('value' => $value));
                if(!isset($r)) {
                    $this->ajaxReturn(array('status'=>'ko','msg'=>'保存失败, 请稍后重试.'));
                }
            }
            $this->ajaxReturn(array('status'=>'ok','msg'=>'保存成功, 请生成配置文件.'));
        }
    }

    /**
     * ajax生成配置文件
     *
     * CT: 2015-01-09 12:00 by ylx
     */
    public function ajax_create_config_file(){
        if(IS_AJAX){
            $module = I('post.module');

            $data = D('Config')->where(array('module' => $module))->select();
            $config = array();
            foreach($data as $d) {
                if(isset($d['value'])) {
                    $config[$d['key']] = $d['value'];
                }
            }

            if(file_put_contents(APP_PATH.'/'.ucfirst($module).'/Conf/custom.php', "<?php \n return".' '.var_export($config ,true) .';') > 0){
                $this->ajaxReturn(array('status'=>'ok','msg'=>'生成成功'));
            }else{
                $this->ajaxReturn(array('status'=>'ko','msg'=>'生成失败'));
            }
        }else{
            $this->ajaxReturn(array('status'=>'ko','msg'=>'非法请求'));
        }
    }

	/**
	 * 添加配置
	 *
	 * CT: 2014-09-15 10:00 by RTH
	 * UT: 2014-09-17 10:00 by RTH
	 */
    public function add()
    {
        if (IS_POST){
            $data = array();
            $data['guid'] = create_guid();
            //$data['key'] = $_POST['cName'];   测试
            $data['key'] = I('post.key');
            $data['value'] = I('post.value');
            $data['description'] = I('post.description');
            $time = time();
            $data['created_at'] = $time;
            $data['updated_at'] = $time;
            
            $model = M("Config");
            
            if (!$model->validate($this->validator)->create($data)) {
                $this->error($model->getError());
            }
            
            $res = $model->add();
            if($res){
                $this->success('配置 添加成功', U('Config/index'));
            }else{
                $this->error('配置 添加失败');
            }
            exit;
        }
        
        $this->assign('meta_title', '新增配置');
        $this->display();
    }
    /**
     * 编辑配置
     *
     * CT: 2014-09-15 10:00 by RTH
     * UT: 2014-09-17 10:00 by RTH
     */    
    public function edit()
    {
        $model = M("Config");
        
        if(IS_POST){            
            $data = array();
            $data['key'] = I('post.key');
            $data['value'] = I('post.value');
            $data['description'] = I('post.description');
            $data['updated_at'] = time();
            
            if (!$model->validate($this->validator)->create($data)) {
                $this->error($model->getError());
            }
            
            $res = $model->where(array('guid'=>I('post.guid')))->save($data);
            if($res){
                $this->success('编辑成功', U('Config/index'));
            }else{
                $this->error('编辑失败', U('Config/index'));
            }
        }
        
        $guid = I('get.guid');
        
        if(empty($guid)){
            $this->error("参数错误", U('Config/index'));
        }
        
        $info = $model->getByGuid($guid);
        $this->assign('info',$info);
        $this->assign('meta_title', '编辑配置');
        $this->display();
    }
    /**
     * 单个删除配置
     *
     * CT: 2014-09-15 10:00 by RTH
     * UT: 2014-09-17 10:00 by RTH
     */    
    public function del()
    {
        $this->assign('meta_title', '删除配置');
        $guid = I('get.guid');
        if (!empty($guid)){
            $m = M('Config');
            $i = $m->where(array('guid'=>$guid))->find();
            if (!empty($i)){
                $i = $m->where(array('guid'=>$guid))->delete();
                $this->success('配置删除成功！', U('Config/index'));
            } else {
                $this->error('未找到相关配置，请重试。', U('Config/index'));
            }
        } else {
            $this->error('未找到相关配置，请重试。', U('Config/index'));
        }
        exit();
    }
    /**
     * 批量添加配置
     *
     * CT: 2014-09-15 10:00 by RTH
     * UT: 2014-09-17 10:00 by RTH
     */    
    public function batch()
    {
        if (IS_POST){
            $batch_act = I('post.batch_act');
            $guids = I('post.ckguid');
            
            if (empty($guids)){
                $this->error('删除失败，请重试。', U('Config/index'));
            }
            $m = M('Config');
            switch ($batch_act){
            	case 'del':
            	    $res = $m->where(array('guid'=> array('IN', $guids)))->delete();
                    $this->success('配置删除成功！', U('Config/index'));
            	    break;
            	default:
            	    $this->error('非法操作。');
            	    break;
            }
            exit();
        }
        
        $this->error('非法操作。');
    }
    
    
}