<?php
namespace Common\Model;

/**
 * 人脉 模型
 * 
 * CT: 2014-09-28 11:26 by YLX
 */
class ContactsModel extends BaseModel 
{
    /**
     * 自动完成
     * CT: 2014-09-28 11:26 by YLX
     */
    protected $_auto = array (
            array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
            array('created_at','time', self::MODEL_INSERT, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
    );

    /**
     * 获取所有一度人脉GUID
     * @param $mid
     * @param int $ut 更新时间
     * @return array
     * CT: 2014-10-24 11:26 by YLX
     * UT: 2015-03-23 12:06 by YLX
     */
    public function getOneGuid($mid, $ut = 0)
    {
        $where_b2a = 'user_guid_2="'.$mid.'" AND status=2 and is_del=0 and updated_at>="'.$ut.'"';
        $b2a = $this->where($where_b2a)->getField('user_guid_1', true);//->select();

        if (empty($b2a)) {
            return array();
        }
        return array_unique($b2a);
    }
    
    /**
     * 获取用户的一度人脉
     * @param $mid 用户GUID
     * @param int $updated_at 默认为0, 表示取所有好友; 不为0是表示取update_at之后更新的好友
     * @return array|bool
     * CT: 2014-09-28 11:26 by YLX
     * UT: 2015-03-23 12:06 by YLX
     */
    public function getOnceContactsByUser($mid, $updated_at = 0)
    {
        $updated_at = intval($updated_at);
        // 获取新增的或者全部好友的GUID
        $one_guids = $this->getOneGuid($mid, $updated_at);
        // 获取所有一度人脉详细信息
        $m = M('User');
        if(empty($one_guids)){
            $list_c = null;
        } else {
            $list_c = $m->field('guid, real_name, photo, remark, real_name_verify')
                ->where(array('guid' => array('IN', array_unique($one_guids))))
                ->select();
        }

        // 获取更新信息的用户GUID
        $list_u = $m->field('guid, real_name, photo, remark, real_name_verify')
            ->where(array('guid' => array('in', array_unique($one_guids)), 'updated_at' => array('egt', $updated_at), 'is_del' => 0))
            ->select();

        if(empty($list_c) && empty($list_u)) return false;
        return array('list_c' => $list_c, 'list_u' => $list_u, 'list_d' => null);
    }

    /**
     * 获取$him和$her的共同好友列表
     * TODO: 优化SQL
     * @param  [string] $him    当前用户的GUID
     * @param  [string] $her    目标好友的GUID
     * @param  [int]    $limit  显示数量
     * @param  [string] $field  显示内容
     * @return mixed|null $list  共同好友列表
     * CT: 2014-10-20 11:26 by YLX
     */
    public function get_related_friends($mid, $tid, $limit=null, $field=null)
    {
        $tf = $this->getOneGuid($tid);
        $mf = $this->getOneGuid($mid);
        $cf = array_intersect($tf, $mf);
        $list = M('User')->field($field)->where(array('guid'=>array('IN', $cf), 'is_del'=>'0'))->limit($limit)->select();
        if(empty($list)) return null;
        return $list;
    }

    /**
     * 检查他相对我的关系
     * @param $mid 'user_guid_1'
     * @param $tid 'user_guid_2'
     * @return string $mid对$tid: 0为无任何好友关系, 10为两人好友关系已删除, 1 已发申请, 2 同意申请, 3 拒绝申请, 4 user2为user1的黑名单
     * CT: 2014-10-28 11:16 by YLX
     */
    public function check_user_relation($mid, $tid)
    {
        $where = array('user_guid_1'=>$mid, 'user_guid_2'=>$tid);
        $a2b = $this->field('is_del, status')->where($where)->find();

        $where = array('user_guid_2'=>$mid, 'user_guid_1'=>$tid);
        $b2a = $this->field('is_del, status')->where($where)->find();

        if (empty($a2b) || empty($b2a)) return '0';
        else if ($a2b['is_del'] == '1' || $b2a['is_del'] == '1') return '10';
        else return $a2b['status'];
    }
    
}
