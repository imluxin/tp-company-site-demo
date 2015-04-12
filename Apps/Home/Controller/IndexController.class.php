<?php
namespace Home\Controller;
use Org\Util\Ueditor;
use Home\Controller\BaseController;

/**
 * 首页
 */
class IndexController extends BaseController
{

    /**
     * 首页操作
     */
    public function index()
    {
        $top_pic = M('Picture')->where(array('category' => 'top'))->select();
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
}
