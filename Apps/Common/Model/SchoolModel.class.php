<?php
namespace Common\Model;

use Common\Model\BaseModel;

/**
 * 学校 模型
 * 
 * CT: 2014-11-01 11:10 by YLX
 */
class SchoolModel extends BaseModel
{
    public function getName($id)
    {
        $name = $this->where(array('id'=>$id))->getField('name');
        return trim($name);
    }
}