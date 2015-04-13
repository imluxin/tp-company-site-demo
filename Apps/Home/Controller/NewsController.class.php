<?php
namespace Home\Controller;

class NewsController extends BaseController
{

    public function index()
    {
        $article_model = D('Article');
        $num_per_page = C('NUM_PER_PAGE', null, 10);
        // 获取意见列表
        $where = array('category' => '2', 'status' => '1');
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
        $this->assign('meta_title', '公司新闻');
    	$this->display();
    }

    public function view()
    {
        $id = I('get.id');
        $news = M('Article')->find($id);
        if(empty($news)) {
            $this->redirect('Index/index');
        }

        $this->assign('news', $news);
        $this->assign('meta_title', $news['title']);
        $this->display();
    }
}
