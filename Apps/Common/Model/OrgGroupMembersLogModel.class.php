<?php
namespace Common\Model;

use Common\Model\BaseModel;

/**
 * 社团分组成员进入记录 模型
 * 
 * CT: 2015-01-07 14:00 by YLX
 */
class OrgGroupMembersLogModel extends BaseModel
{
    /**
     * 增加记录
     *
     * @param $group_guids array
     * @param $user_guids array
     * @param $action string 1为add, 2为delete
     * CT: 2015-01-07 14:00 by YLX
     */
    public function record($group_guids, $user_guids, $action, $org_guid='')
    {
        if(empty($org_guid)){
            $auth = session('auth');
            $org_guid = $auth['org_guid'];
        }
		
        $time = time();
        foreach($group_guids as $g) {
            foreach ($user_guids as $u) {
                $data = array(
                    'guid'       => create_guid(),
                    'org_guid'   => $org_guid,
                    'group_guid' => $g,
                    'user_guid'  => $u,
                    'action'     => $action,
                    'created_at' => $time,
                    'updated_at' => $time
                );
				$this->add($data);
            }
        }
    }
}