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
        $client = M('Picture')->where(array('category' => 'client'))->select();
        $product = M('Product')->select();
        $news = M('Article')->where(array('category' => '2', 'status' => '1'))
            ->order('updated_at DESC')
            ->limit(12)
            ->select();

        $this->assign('news', $news);
        $this->assign('product', $product);
        $this->assign('top_pic', $top_pic);
        $this->assign('client', $client);
        $this->assign('meta_title', '首页');
    	$this->display();
    }

    /**
     * 联系我们
     */
    public function contact()
    {
        if(IS_POST) {
            $data = I('post.');
            $model = D('SiteContact');
            if($model->create($data)){
                if($model->add()) {
                    $this->success('提交成功');
                } else {
                    $this->error('提交失败, 请重试.');
                }
            } else {
                $this->error($model->getError());
            }
            exit();
        }
        $this->assign('article', M('Article')->where(array('category' => 4, 'status' => 1))->find());
        $this->assign('meta_title', '联系我们');
        $this->display();
    }

    /**
     * 公司简介
     */
    public function about()
    {
        $this->assign('last_news', M('Article')->where(array('category' => '2', 'status' => '1'))->order('updated_at DESC')->limit(8)->select());
        $this->assign('article', M('Article')->where(array('category' => 1, 'status' => 1))->find());
        $this->assign('meta_title', '企业简介');
        $this->display();
    }

    /**
     * 公司招聘
     */
    public function employee()
    {
        $article_model = D('Article');
        $num_per_page = C('NUM_PER_PAGE', null, 10);
        // 获取意见列表
        $where = array('category' => '3', 'status' => '1');
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

        $this->assign('meta_title', '企业招聘');
        $this->display();
    }

    /**
     * 公司产品
     */
    public function product()
    {
        $id = I('get.id');
        $product = M('Product')->find($id);
        if(empty($product)){
            $this->error('目标不存在.');
        }

        $pics = M('Picture')->where(array('category' => $id))->select();

        $this->assign('product', $product);
        $this->assign('pics', $pics);
        $this->assign('meta_title', '企业产品');
        $this->display();
    }
}
