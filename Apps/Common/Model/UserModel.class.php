<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户模型
 */
class UserModel extends Model
{
    /**
     * 用户模型自动完成
     */
    protected $_auto = array (
            array('password', 'md5', self::MODEL_BOTH, 'function') , // 对password字段在新增和编辑的时候使md5函数处理
    );

    /**
     * 用户模型验证条件
     */
    protected $_validate = array(
        array('username', 'require', '用户名必须填写!', self::EXISTS_VALIDATE),
        array('username', '5,15', '用户名必须为5到15位字符！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),

        array('password', 'require', '密码必须填写!', self::EXISTS_VALIDATE),
        array('password', '6,18', '密码必须为6到18位字符！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),

        array('mobile','require','手机号码必须填写!'),
        array('mobile','number','手机号码必须为数字!', self::EXISTS_VALIDATE),
        array('mobile',11,'手机号码必须为11位数字!', self::EXISTS_VALIDATE, 'length'),

        array('email','require','邮箱必须填写!', self::EXISTS_VALIDATE),
        array('email','email','邮箱格式不对!', self::EXISTS_VALIDATE),

        array('real_name', 'require', '真实姓名必须填写!', self::EXISTS_VALIDATE),
        array('real_name', '2,10', '真实姓名必须为2到10位字符！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
    );
}