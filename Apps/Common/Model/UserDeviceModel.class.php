<?php
namespace Common\Model;

use Common\Model\BaseModel;

/**
 * 用户设备 模型
 * 
 * CT: 2014-09-23 14:26 by YLX
 */
class UserDeviceModel extends BaseModel 
{
    protected $patchValidate = true;
    
    /**
     * 自动完成
     * 
     * CT: 2014-09-23 14:26 by YLX
     */
    protected $_auto = array (
            array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
            array('created_at','time', self::MODEL_INSERT, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
    );

    /**
     * 自动验证条件
     * 
     * CT: 2014-09-23 14:26 by YLX
     */
//     protected $_validate = array(
            
//             // CU时数据对像验证
//             array('guid', 32, 'guid长度不对.', 0, 'length'), 
//             array('mac','require','终端mac地址为空.', 0), 
//             array('sdk_uid','require','终端SDK UID为空.', 0), 
//             array('name','require','行业名称必须填写!', 0), 
//             array('name','require','行业名称必须填写!', 0), 
//             array('name','1, 50','行业名称最大长度为50个字符!', self::EXISTS_VALIDATE, 'length'),             
            
            
//             // RD等, 数据有效性验证
//             // **** 最后一个(第六个)参数, 必须是 365 ****
// //             array('guid', 'require', '参数错误, 操作失败, 请重试.', 0, '', 365),
// //             array('guid', 32, '参数错误, 操作失败, 请重试.', 0, 'length', 365), 

//     );
    
    public function logoutAll($user_guid)
    {
        $res = $this->editTokenInfo(array('user_guid'=>$user_guid), array('status'=>'0'));
        return $res;
    }


    /**
     * 查询
     *
     * @param array $condition 查询条件
     * @return array
     */
    public function getTokenInfo($condition) {
        return $this->where($condition)->find();
    }

    public function getTokenInfoByToken($token) {
        if(empty($token)) {
            return null;
        }
        return $this->getTokenInfo(array('token' => $token));
    }

    /**
     * 新增
     *
     */
    public function addTokenInfo($param){
        return $this->add($param);
    }

    /**
     * 编辑
     *
     */
    public function editTokenInfo($condition, $data){
        return $this->where($condition)->save($data);
    }

    /**
     * 删除
     *
     */
    public function delTokenInfo($condition){
        return $this->where($condition)->delete();
    }

}