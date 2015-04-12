<?php
namespace Home\Controller;

class NewsController extends BaseController
{

    public function index()
    {
        $top_pic = M('Picture')->where(array('category' => '1'))->select();
        $product = M('Product')->select();
        $news = M('Article')->where(array('category' => '2', 'status' => '1'))
            ->order('updated_at DESC')
            ->limit(12)
            ->select();

        $this->assign('news', $news);
        $this->assign('product', $product);
        $this->assign('top_pic', $top_pic);
        $this->assign('meta_title', '首页');
    	$this->display();
    }

    public function view()
    {
        $id = I('get.id');
        $news = M('Article')->find($id);
        if(empty($news)) {
            $this->redirect('Index/index');
        }

        $last_news = M('Article')->where(array('category' => '2', 'status' => '1'))
            ->order('updated_at DESC')
            ->limit(8)->select();

        $this->assign('news', $news);
        $this->assign('last_news', $last_news);
        $this->assign('meta_title', $news['title']);
        $this->display();
    }
}
