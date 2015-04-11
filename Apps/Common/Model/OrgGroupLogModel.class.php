<?php
namespace Common\Model;

use Common\Model\BaseModel;

/**
 * 社团分组变动记录 模型
 * 
 * CT: 2014-12-05 14:00 by YLX
 */
class OrgGroupLogModel extends BaseModel
{
    /**
     * 增加记录
     *
     * @param $groups array array(guid=>name)
     * @param $action string 1为add, 2为delete
     * CT: 2014-12-05 14:00 by YLX
     */
    public function record($groups, $action)
    {
        $auth = session('auth');
        $time = time();
        foreach($groups as $guid => $name) {
            $data[] = array(
                'guid'       => create_guid(),
                'org_guid'   => $auth['org_guid'],
                'group_guid' => $guid,
                'group_name' => $name,
                'action'     => $action,
                'created_at' => $time,
                'updated_at' => $time
            );
        }
        $this->insert_all($data);
    }
}