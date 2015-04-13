<?php
namespace Home\Controller;

use Think\Controller;

/**
 * Home模块基控制器
 */
class BaseController extends Controller 
{
    
    /**
     * 魔术方法
     */
    public function __construct()
    {
        parent::__construct();
        $this->assign('product_menu', M('Product')->select());
        $this->assign('last_news', M('Article')->where(array('category' => '2', 'status' => '1'))->order('updated_at DESC')->limit(8)->select());
    }

    public function _empty() {
        header('HTTP/1.0 404 Not Found');
        $this->display('Common@Tpl/404');
    }
    
    /**
     * 获取上一页面URL
     */
    public function getReferer()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}