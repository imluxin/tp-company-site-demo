<?php
namespace Common\Model;
use Think\Model;

class ProductModel extends Model
{
    /**
     * 自动完成
     */
    protected $_auto = array (
        array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在新增/更新的时候写入当前时间戳
        array('created_at','time', self::MODEL_INSERT, 'function'), // 对created_at字段在新增的时候写入当前时间戳
    );

    /**
     * 验证条件
     */
    protected $_validate = array(
        array('name', 'require', '名称必须填写!', self::EXISTS_VALIDATE),
        array('name', '1, 50', '名称必须为1到50个字！', self::EXISTS_VALIDATE, 'length'),

        array('content', 'require', '内容必须填写!', self::EXISTS_VALIDATE),
        array('content', '10, 10000', '内容必须为10到10000个字！', self::EXISTS_VALIDATE, 'length')
    );
}
