<?php
namespace Common\Model;

use Common\Model\BaseModel;

/**
 * 公司 模型
 * 
 * CT: 2014-09-28 14:00 by YLX
 */
class UserCompanyModel extends BaseModel 
{    

    /**
     * 用户模型验证条件
     * 
     * CT: 2014-09-07 15:00 by YLX
     */
    protected $_validate = array(
            
            // 参数有效性验证
            array('name','require','公司名称必须填写!', self::EXISTS_VALIDATE, '', 365), 
            array('position','require','职位必须填写!', self::EXISTS_VALIDATE, '', 365)

    );
    /**
     * 根据用户GUID获取公司信息
     *
     * CT: 2014-09-28 14:15 by YLX
     */
    public function getCompanyInfoByUser($u_guid)
    {
        return $this->where(array('user_guid'=>$u_guid))->select();
    }
    
    /**
     * 根据用户GUID获取公司信息, 并按照一定格式返回数组
     * $format: 1:name(position) 2为待定
     *
     * CT: 2014-09-28 14:15 by YLX
     */
    public function format($u_guid, $format='1')
    {
        $list = $this->getCompanyInfoByUser($u_guid);
        if (empty($list)) return false;
        
        $res = array();
        switch ($format)
        {
        	case '1':
        	default:
        	    foreach ($list as $l){
        	        $res[] = $l['name'].'('.$l['position'].')';
        	    }
        	    break;    
        }
        return $res;
    }
    
}