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
        $this->assign('meta_title', '首页');
    	$this->display();
    }
}
