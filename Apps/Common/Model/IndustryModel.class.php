<?php
namespace Common\Model;
use Common\Model\BaseModel;

/**
 * 行业 模型
 * 
 * CT: 2014-09-18 11:26 by YLX
 */
class IndustryModel extends BaseModel 
{
    protected $patchValidate = true;
    
    /**
     * 行业模型自动完成
     * 
     * CT: 2014-09-18 11:26 by YLX
     */
    protected $_auto = array (
            array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
            array('created_at','time', self::MODEL_INSERT, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
    );

    /**
     * 行业模型验证条件
     * 
     * CT: 2014-09-18 11:26 by YLX
     */
    protected $_validate = array(
            
            // CU时数据对像验证
            array('name','require','行业名称必须填写!', 0), 
            array('name','1, 50','行业名称最大长度为50个字符!', self::EXISTS_VALIDATE, 'length'),             
            
            
            // RD等, 数据有效性验证
            // **** 最后一个(第六个)参数, 必须是 365 ****
            array('guid', 'require', '参数错误, 操作失败, 请重试.', 0, '', 365),
            array('guid', 32, '参数错误, 操作失败, 请重试.', 0, 'length', 365), 

    );

    /**
     * 根据GUID获取行业名称
     *
     * CT: 2014-09-28 14:07 by YLX
     */
    public function getName($guid)
    {
        $info = $this->where(array('guid'=>$guid))->find();
        if (empty($info)) return false;
        return $info['name'];
    }
    
    /**
     * 获取行业列表
     * 
     * CT: 2014-10-17 11:02 by YLX
     */
    public function get_active_list()
    {
//        $list = $this->field('guid, name')->where(array('is_del'=>'0', 'is_show'=>'1'))->select();
        return $this->find_all(array('is_del'=>'0', 'is_show'=>'1'), 'guid, name');
//        return $list;
    }
    
}