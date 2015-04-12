<?php
namespace Admin\Controller;

use Think\Upload;

class ProductController extends BaseController
{
    //列表页面
    public function index()
    {
        //         每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');

        $model = D('Product');
        // 获取意见列表
        $list = $model
            ->order('updated_at DESC')
            ->page(I('get.p', '1').','.$num_per_page)->select();

        // 使用page类,实现分类
        $count      = $model->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('meta_title', '图片列表');
        $this->display();
    }

    //添加页
    public function add()
    {
        if(IS_POST) {
            $data = I('post.');

            //上传
            if(!empty($_FILES['photo']['name'])) {
                $config = array(
                    'maxSize'  => C('MAX_UPLOAD_SIZE'),
                    'exts'     => C('ALLOWED_EXTS'),
                    'rootPath' => UPLOAD_PATH,
                    'savePath' => '/pic/',
                    'saveName' => create_guid(),
                    'replace'  => true
                );
                $upload = new Upload($config);// 实例化上传类
                // 上传文件
                $info = $upload->upload();
                if (!$info) {// 上传错误提示错误信息
                    $this->error('图片上传失败, 请重试.');
                } else {// 上传成功
                    $file_info = reset($info);
                    $savename  = $file_info['savename'];
                    $savepath  = $file_info['savepath'];
                    $val       = $savepath . $savename;
                    $path      = '/Upload' . $val;
                    $data['photo'] = $path;
                }
            }

            $model = D('Product');
            if($model->create($data)) {
                if($id = $model->add()) {
                    $this->success('保存成功!', U('Product/edit', array('id' => $id)));
                } else {
                    $this->error('保存失败, 请重试.');
                }
            } else {
                $this->error($model->getError());
            }
            exit();
        }

        $this->assign('meta_title', '新增产品');
        $this->display();
    }

    //编辑页
    public function edit()
    {
        $id = I('get.id');
        $model = D('Product');
        $product = $model->find($id);
        if(empty($product)) {
            $this->error('目标不存在, 请重试.');
        }

        if(IS_POST) {
            $data = I('post.');

            //上传
            if(!empty($_FILES['photo']['name'])) {
                $config = array(
                    'maxSize'  => C('MAX_UPLOAD_SIZE'),
                    'exts'     => C('ALLOWED_EXTS'),
                    'rootPath' => UPLOAD_PATH,
                    'savePath' => '/pic/',
                    'saveName' => create_guid(),
                    'replace'  => true
                );
                $upload = new Upload($config);// 实例化上传类
                // 上传文件
                $info = $upload->upload();
                if (!$info) {// 上传错误提示错误信息
                    $this->error('图片上传失败, 请重试.');
                } else {// 上传成功
                    $file_info     = reset($info);
                    $savename      = $file_info['savename'];
                    $savepath      = $file_info['savepath'];
                    $val           = $savepath . $savename;
                    $path          = '/Upload' . $val;
                    $data['photo'] = $path;
                }
            }

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

        $this->assign('product', $product);
        $this->assign('meta_title', '编辑产品');
        $this->display('add');
    }

    //删除
    public function delete()
    {
        $id = I('get.id');
        $delete = M('Product')->delete($id);
        if(empty($delete)) {
            $this->error('删除失败, 请重试.');exit();
        }
        $this->success('删除成功!');
    }
}