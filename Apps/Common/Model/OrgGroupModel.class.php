<?php
namespace Common\Model;
use Common\Model\BaseModel;

/**
 * 社团分组
 * 
 * CT: 2014-12-04 16:40 by ylx
 */
class OrgGroupModel extends BaseModel
{
	protected $patchValidate = true;
	
	/**
	 * 自动完成
	 *
     * CT: 2014-12-04 16:40 by ylx
	 */
	protected $_auto = array (
			
			array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
			array('created_at','time', self::MODEL_INSERT, 'function') // 对updated_at字段在更新的时候写入当前时间戳
			
	);
	
	/**
	 * 验证条件
	 *
     * CT: 2014-12-04 16:40 by ylx
	*/
	protected $_validate = array(
			array('user_guid', 'require', '必须填写!', self::EXISTS_VALIDATE),
			array('user_guid', 32, '格式错误！', self::EXISTS_VALIDATE, 'length'),
	
			array('org_guid', 'require', '必须填写!', self::EXISTS_VALIDATE),
			array('org_guid', 32, '格式错误！', self::EXISTS_VALIDATE, 'length')
				
	
	);

    /**
     * 根据分组ID获取对应的chat_group_id
     */
    public function get_chat_group_id($org_guid, $group_guid)
    {
        $org_info = M('Org')->where(array('guid'=>$org_guid))->find();
        if(!$org_info) return false;

        if($group_guid == $org_info['all_group_guid']) return $org_info['all_chat_group_id'];
        if($group_guid == $org_info['other_group_guid']) return $org_info['other_chat_group_id'];

        return $this->where(array('guid'=>$group_guid))->getField('chat_group_id');

    }
	
	
}