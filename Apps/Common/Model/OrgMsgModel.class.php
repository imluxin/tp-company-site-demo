<?php
namespace Common\Model;
use Common\Model\BaseModel;

/**
 * 社团对个人聊天记录模型
 * 
 * CT: 2014-09-25 13:26 by YLX
 */
class OrgMsgModel extends BaseModel 
{    
    public function getHistory($u_guid_1, $u_guid_2)
    {
        $where = '(from_id = "'.$u_guid_1.'" AND to_id = "'.$u_guid_2.'") OR (from_id = "'.$u_guid_2.'" AND to_id = "'.$u_guid_1.'") ';
        return $this->where($where)->page(I('get.p', '1').','.$num_per_page)->select();
    }
}