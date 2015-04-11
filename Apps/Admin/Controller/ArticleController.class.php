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

        $article_model = D('Article');
        // 获取意见列表
        $list = $article_model
            ->order('created_at DESC')
            ->page(I('get.p', '1').','.$num_per_page)->select();

        // 使用page类,实现分类
        $count      = $article_model->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    //文章添加页
    public function add()
    {
        $ArticleSign = C('ARTICLE_SIGN');

        if($_POST){
            $title = I('post.title');
            $sign = I('SignId');
            $content = I('post.add_content');
            die($sign);
        }
        $this->assign('ArticleSign',$ArticleSign);
        $this->display();
    }

    //文章编辑页
    public function edit()
    {

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