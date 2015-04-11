<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;

/**
 * 行业 控制器

 * CT: 2014-09-12 15:00 by YLX
 *
 */
class IndustryController extends BaseController 
{
    /**
     * 行业例表
     *
     * CT 2014-09-12 15:00 by YLX
     * UT 2014-09-18 14:00 by YLX
     */
    public function index()
    {
        // 每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');
        
        // 实例化模型
        $model = D('Industry');
        
        // 获取行业列表
        $list = $model->where('is_del=0')->order('name')->page(I('get.p', '1').','.$num_per_page)->select();
        
        // 使用page类,实现分类
        $count      = $model->where('is_del=0')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        
        // 渲染模板
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list', $list);
        $this->assign('meta_title', '行业管理');
        $this->display();
    }

    /**
     * 增加
     *
     * CT 2014-09-12 15:00 by YLX
     * UT 2014-09-18 14:00 by YLX
     */
    public function add()
    {
        // 检查是否为POST
        if (IS_POST){
            
            // 获取数据
            $data = array();
            $data['name'] = I('post.name');
            $data['is_show'] = I('post.is_show');
            $data['guid'] = create_guid();

            // 实例化模型
            $model = D("Industry");
            
            // 创建数据对像
            if (!$model->create($data)) {
                exit($this->error($model->getError()));
            }
            
            // 保存到数据库
            $res = $model->add();
            if($res){
                $this->success('添加成功', U('Industry/index'));
            }else{
                $this->error(' 添加失败');
            }
            exit;
        }
        
        // 渲染模板
        $this->assign('meta_title', '新增行业');
        $this->display();
    }
    
    /**
     * 编辑
     * 
     * CT 2014-09-12 15:00 by YLX 
     * UT 2014-09-18 14:00 by YLX
     */
    public function edit()
    {
        // 实例化模型
        $model = D("Industry");
        
        // 检查是否为POST
        if(IS_POST){

            // 创建数据对像
            $data = array();
            $data['name'] = I('post.name');
            $data['is_show'] = I('post.is_show');
            $res = $model->validate($this->validator)->create($data);
            
            // 如果数据对像创建失败, 返回错误信息
            if (!$res) {
                exit($this->error($model->getError()));
            }
            
            // 如果数据对像创建成功, 执行保存操作
            $res = $model->where(array('guid'=>I('post.guid')))->save();
            if($res){
                $this->success('编辑成功', U('Industry/index'));
            }else{
                $this->error('编辑失败', U('Industry/index'));
            }
            exit();
        }
        
        // 获取guid
        $guid = I('get.guid');
        
        // 验证GUID有效性
        $res = $model->is_valid(array('guid'=>$guid));
        if (!$res) {
            exit($this->error($model->getError(), U('Industry/index')));
        }        
        
        // 获取行业信息
        $info = $model->getByGuid($guid);
        
        // 渲染模板
        $this->assign('info',$info);
        $this->assign('meta_title', '编辑行业');
        $this->display();
    }


    /**
     * 删除
     *
     * CT 2014-09-12 15:00 by YLX
     * UT 2014-09-18 14:15 by YLX
     */
    public function del()
    {
        // 获取数据
        $guid = I('get.guid');
        
        // 实例化模型
        $m = D('Industry');
        
        // 验证数据有效性
        $res = $m->is_valid(array('guid'=>$guid));
        if (!$res) exit($this->error($m->getError()));
        
        // 验证数据是否存在
        $res = $m->where(array('guid'=>$guid))->find();
        if (!empty($res)){
            // 若存在, 执行删操作
            $res = $m->where(array('guid'=>$guid))->delete();
            if ($res == intval('1')){
                $this->success('删除成功！', U('Industry/index'));
            } else {
                $this->error('参数错误, 操作失败, 请重试.', U('Industry/index'));
            }
        } else {
            $this->error('未找到相关行业，请重试。', U('Industry/index'));
        }
        exit();
    }

    /**
     * 批量操作
     *
     * CT 2014-09-12 15:00 by YLX
     * UT 2014-09-18 14:43 by YLX
     */
    public function batch()
    {
        // 此操作必须为POST
        if (IS_POST){
            // 获取数据
            $batch_act = I('post.batch_act');
            $guids = I('post.ckguid');
            
            // 验证数据
            if (empty($guids) || empty($batch_act)){
                exit($this->error('操作失败，请重试。', U('Industry/index')));
            }
            
            // 实例化模型
            $m = D('Industry');
            
            switch ($batch_act){
                // 若为删除操作, 执行相关删除操作
            	case 'del':
            	    $res = $m->where(array('guid'=> array('IN', $guids)))->delete();
            	    if ($res > 0){
                        $this->success('删除成功.', U('Industry/index'));
            	    } else {
            	        $this->error('参数错误, 请重试.', U('Industry/index'));
            	    }
            	    exit();
            	    break;
            	default:
            	    exit($this->error('非法操作。'));
            	    break;
            }
            exit();
        }
        
        $this->error('非法操作。');
    }
    
    
}