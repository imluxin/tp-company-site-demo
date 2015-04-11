<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 用户附加表  模型
 *
 * CT 2014-12-05 13:54 by RTH
 */
class UserAttributeModel extends BaseModel{

    /**
     * 记录
     * @param $user_guid 用户GUID
     * CT 2015-03-19 11:47 by QXL
     */
    public function create_attr($user_guid) {
        if(empty($user_guid)){
            return false;
        }
        $data = array(
            'guid'       => create_guid(),
            'user_guid'  => $user_guid, 
            'created_at' => time(),
            'updated_at' => time()
        );
        return $this->inserUp($data);
    }
}