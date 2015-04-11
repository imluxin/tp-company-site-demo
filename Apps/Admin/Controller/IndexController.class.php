<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->redirect(U('auth/login'));
        $this->assign('meta_title', '后台首页');
        $this->display();
    }
    
    /**
     * 显示数据库表
     *
     * CT: 2014-11-20 09:09 BY YLX
     */
    public function show_table()
    {
        $table = I('get.table');

        $list = M($table)->select();
        $keys = array_keys($list[0]);
//        var_dump($list, $keys);
        $this->assign('keys', $keys);
        $this->assign('list', $list);
        $this->display();
    }
}