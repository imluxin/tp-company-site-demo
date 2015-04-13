<?php
namespace Common\Model;
use Think\Model;


class SiteContactModel extends Model
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
        array('name', 'require', '姓名必须填写!', self::EXISTS_VALIDATE),
        array('name', '1,15', '姓名必须为1到15位字符！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),

        array('phone','require','手机号码必须填写!'),
        array('phone','number','手机号码必须为数字!', self::EXISTS_VALIDATE),

        array('email','require','邮箱必须填写!', self::EXISTS_VALIDATE),
        array('email','email','邮箱格式不对!', self::EXISTS_VALIDATE),

        array('content', 'require', '消息内容必须填写!', self::EXISTS_VALIDATE),
        array('content', '10,200', '消息内容必须为10到200位字符！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
    );
}