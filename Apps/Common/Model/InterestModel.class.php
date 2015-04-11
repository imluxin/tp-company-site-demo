<?php
namespace Common\Model;

use Common\Model\BaseModel;

/**
 * 兴趣 模型
 * 
 * CT: 2014-10-23 09:10 by YLX
 */
class InterestModel extends BaseModel 
{
    /**
     * 根据热门兴趣, 默认为10个, 并返回全部字段信息
     *
     * CT: 2014-10-23 09:15 by YLX
     */
    public function get_hot_interest($limit=9, $field='')
    {
//         return $this->field($field)->where(array('is_hot'=>'1', 'is_show'=>'1', 'is_del'=>'0'))->limit($limit)->select();
        return $this->field($field)->where(array('is_show'=>'1', 'is_del'=>'0'))->order('num DESC')->limit($limit)->select();
    }
    
    /**
     * 搜索
     * 根据关键字搜索, 默认为10个, 并返回全部字段信息
     * 
     * CT: 2014-10-23 09:18 by YLX
     */
    public function search($keyword, $limit=9, $field='')
    {
        $where = array('is_show'=>'1', 'is_del'=>'0',
                       'name' => array('LIKE', '%'.$keyword.'%')
                      );
        return $this->field($field)->where($where)->limit($limit)->select();
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