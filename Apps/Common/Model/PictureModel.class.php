<?php
namespace Common\Model;
use Think\Model;

class PictureModel extends Model
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
        array('path', 'require', '必须上传图片!', self::EXISTS_VALIDATE)
    );
}
