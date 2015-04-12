<?php
namespace Common\Model;
use Think\Model;

/**
 *  文章 模型
 */

class ArticleModel extends Model
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
        array('title', 'require', '文章名称必须填写!', self::EXISTS_VALIDATE),
        array('title', '1, 50', '文章名称必须为1到50个字！', self::EXISTS_VALIDATE, 'length'),

        array('content', 'require', '文章内容必须填写!', self::EXISTS_VALIDATE),
        array('content', '10, 10000', '文章内容必须为10到10000个字！', self::EXISTS_VALIDATE, 'length')
    );
}
