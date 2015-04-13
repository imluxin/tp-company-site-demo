<?php
/**
 * 大后台文章管理
 */
namespace Admin\Controller;

class ArticleController extends BaseController
{
    //文章列表页面
    public function index()
    {
        //         每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');

        $where = '';
        if(I('get.category') && I('get.category') != 'all') {
            $where = array('category'=>I('get.category'));
        }

        $article_model = D('Article');
        // 获取意见列表
        $list = $article_model
            ->where($where)
            ->order('updated_at DESC')
            ->page(I('get.p', '1').','.$num_per_page)->select();

        // 使用page类,实现分类
        $count      = $article_model->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('meta_title', '文章列表');
        $this->display();
    }

    //文章添加页
    public function add()
    {
        if(IS_POST) {
            $model = D('Article');
            $data = I('post.');
            if($model->create($data)) {
                if($id = $model->add()) {
                    $this->success('保存成功!', U('Article/edit', array('id' => $id)));
                } else {
                    $this->error('保存失败, 请重试.');
                }
            } else {
                $this->error($model->getError());
            }
            exit();
        }

        $this->assign('meta_title', '新增文章');
        $this->display();
    }

    //文章编辑页
    public function edit()
    {
        $id = I('get.id');
        $model = D('Article');
        $article = $model->find($id);
        if(empty($article)) {
            $this->error('文章不存在, 请重试.');
        }

        if(IS_POST) {
            $data = I('post.');
            if($model->create($data)) {
                if($model->where(array('id'=>$id))->save()) {
                    $this->success('保存成功!');
                } else {
                    $this->error('保存失败, 请重试.');
                }
            } else {
                $this->error($model->getError());
            }
            exit();
        }

        $this->assign('article', $article);
        $this->assign('meta_title', '编辑文章');
        $this->display('add');
    }

    //文章删除
    public function delete()
    {
        $id = I('get.id');
        $delete = M('Article')->delete($id);
        if(empty($delete)) {
            $this->error('删除失败, 请重试.');exit();
        }
        $this->success('删除成功!');
    }
}