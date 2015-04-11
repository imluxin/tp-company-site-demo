<?php
namespace Common\Model;

use Common\Model\BaseModel;

/**
 * 社团成员进出记录 模型
 * 
 * CT: 2015-01-07 14:00 by YLX
 */
class OrgMembersLogModel extends BaseModel
{
    /**
     * 增加记录
     * @param $org_guid string 社团guid
     * @param $user_guids array
     * @param $action string 1为add, 2为delete
     * CT: 2015-01-07 14:00 by YLX
     */
    public function record($org_guid, $user_guids, $action)
    {
        $time = time();
        foreach ($user_guids as $u) {
            $data[] = array(
                'guid'       => create_guid(),
                'org_guid'   => $org_guid,
                'user_guid'  => $u,
                'action'     => $action,
                'created_at' => $time,
                'updated_at' => $time
            );
        }
        $this->insert_all($data);
    }
}