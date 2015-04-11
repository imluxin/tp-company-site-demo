<?php
namespace Common\Model;

class AppApplicationModel extends BaseModel{
    /**
     * App申请模型自动完成
     *
     * CT: 2015-03-25 16:00 by RTH
     */
    protected $_auto = array (
        array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
        array('created_at','time', self::MODEL_INSERT, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
    );

    protected $_validate = array(
        array('email','require','邮箱不能为空', self::MUST_VALIDATE),
        array('email','email','邮箱格式不对',2),
//        array('email','','邮箱已经存在!',0,'unique',1),

        array('mobile','require','手机号码不能为空'),
        array('mobile','number','手机号码必须为数字!',0),
        array('mobile',11,'手机号码必须为11位数字!',0, 'length'),
//        array('mobile','','手机号码已经存在!',0,'unique',1),

        array('company', 'require', '公司必须填写!',0),
        array('company', '1,30', '公司名字不得超过30',0, 'length'),

        array('duties','require','职务必须填写!',0),
        array('duties','1,15','职务长度不得超过15',0,'length'),

        array('reason','require','申请原因必须填写!',0),
        array('reason','1,60','职务长度不得超过15',0,'length'),

        array('name','require','名称不能为空'),
        array('name','1,15','名字长度不得超过50',0,'length'),

        array('agree','on','请选择同意条款',0, 'equal'),
    );
}