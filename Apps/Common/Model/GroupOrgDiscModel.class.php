<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 用户讨论组 模型
 *
 * CT: 2014-11-7 10:26 by qiu
 */
class GroupOrgDiscModel extends BaseModel
{
	protected $_auto = array (
			
			array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
			array('created_at','time', self::MODEL_INSERT, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
	);
	
	protected $_validate = array(
	
			// form验证
			array('name','require','邮箱必须填写!', self::EXISTS_VALIDATE),
				
	);

    /**
     * 根据用户列表讨论组guid
     * @param $u_guid
     * @return mixed
     *
     * CT: 2014-11-14 10:02 by ylx
     */
	public function list_guids_by_user($u_guid)
    {
        return M('GroupOrgDiscMembers')->where(array('user_guid'=>$u_guid))
                                        ->group('group_disc_guid')
                                        ->getField('group_disc_guid', true);
    }
}