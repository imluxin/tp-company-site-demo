<?php
namespace Common\Model;
use Common\Model\BaseModel;

/**
 * 通知 模型
 * 
 * CT: 2014-09-24 09:26 by RTH
 */
class OrgGroupMsgBoxModel extends BaseModel 
{
    protected $patchValidate = true;
    
    /**
     * 通知模型自动完成
     * 
     * CT: 2014-09-24 09:26 by RTH
     */
    protected $_auto = array (
            array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
            array('created_at','time', self::MODEL_INSERT, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
    );

    /**
     * 通知模型验证条件
     * 
     * CT: 2014-09-24 09:26 by RTH
     */
    protected $_validate = array(

        array('name','require','通知标题必须填写!', 0),
        array('name','1, 50','通知标题最大长度为50个字符!', self::EXISTS_VALIDATE, 'length'),
        array('content','require','通知内容必须填写!', 0),

        array('guid','require','系统错误, 稍后重试.', 0),
        array('group_guid','require','系统错误, 稍后重试.', 0),
        array('org_guid','require','系统错误, 稍后重试.', 0),
            
            // RD等, 数据有效性验证
            // **** 最后一个(第六个)参数, 必须是 365 ****
            array('guid', 'require', '参数错误, 操作失败, 请重试.', 0, '', 365),
            array('guid', 32, '参数错误, 操作失败, 请重试.', 0, 'length', 365), 

    );
    
    
    
}