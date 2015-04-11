<?php
namespace Common\Model;
use Common\Model\BaseModel;

/**
 * 组织成员模型 关系
 * 
 * CT: 2014-09-18 11:00 by QY
 */
class OrgGroupMembersModel extends BaseModel
{
	protected $patchValidate = true;
	
	/**
	 * 组织成员模型自动完成
	 *
	 * CT: 2014-09-18 11:00 by QY
	 */
	protected $_auto = array (
			
			array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
			array('created_at','time', self::MODEL_INSERT, 'function') // 对updated_at字段在更新的时候写入当前时间戳
			
	);
	
	/**
	 * 组织成员模型验证条件
	 *
	 * CT: 2014-09-18 11:00 by QY
	*/
	protected $_validate = array(
			array('user_guid', 'require', '必须填写!', self::EXISTS_VALIDATE),
			array('user_guid', 32, '格式错误！', self::EXISTS_VALIDATE, 'length'),
	
			array('org_guid', 'require', '必须填写!', self::EXISTS_VALIDATE),
			array('org_guid', 32, '格式错误！', self::EXISTS_VALIDATE, 'length')
				
	
	);

    /**
     * 根据成员guid 获取在某社团下的group guid
     * @param $member_guid
     */
    public function get_group_guid_by_member_guid($org_guid, $member_guid)
    {
        // 检查用户是否在该社团下
        $check_user_org = $this->where(array('org_guid'=>$org_guid, 'user_guid'=>$member_guid))->find();
        if(empty($check_user_org)){
            return false;
        }

        // 检查用户是否在该活动的讨论组下
        $user_group_guids = $this->where(array('user_guid'=>$member_guid, 'org_guid'=>$org_guid))->getField('org_group_guid', true);
        if($user_group_guids[0] == null){
            $user_group_guids[0] = get_org_other_member_group_guid($org_guid);
        }
        $user_group_guids[] = get_org_all_member_group_guid($org_guid);
        return $user_group_guids;
    }

    /**
     * 检查用户是否存在于某社团
     * @param $org_guid 社团GUID
     * @param $uid 用户GUID
     * @return bool
     */
    public function check_user_exist($org_guid, $uid) {
        $result = $this->where(array('org_guid' => $org_guid, 'user_guid' => $uid, 'is_del' => '0'))->find();
        return empty($result) ? false : true;
    }
	
	
}