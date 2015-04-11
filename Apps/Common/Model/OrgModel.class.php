<?php
namespace Common\Model;
use Common\Model\BaseModel;

/**
 * 社团模型
 * 
 * CT: 2014-11-07 15:50 by YLX
 */
class OrgModel extends BaseModel
{
	/**
     * 社团模型自动完成
     * 
     * CT: 2014-11-28 15:00 by QXL
     */
    protected $_auto = array (
        array('num_sms', '500', self::MODEL_INSERT) , // 对password字段在新增和编辑的时候使md5函数处理
        array('num_email', '1000', self::MODEL_INSERT) , // 对password字段在新增和编辑的时候使md5函数处理
        array('password', 'md5', self::MODEL_BOTH, 'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
        array('created_at','time', self::MODEL_INSERT, 'function'), // 对updated_at字段在更新的时候写入当前时间戳
    );

    protected $_validate = array(

        // form验证
        array('email','require','邮箱必须填写!', self::EXISTS_VALIDATE),
        array('email','email','邮箱格式不对!', self::EXISTS_VALIDATE),

//        array('phone','','手机号码已经存在!',self::EXISTS_VALIDATE,'unique',1),
        array('phone','require','手机号码必须填写!'),
        array('phone','number','手机号码必须为数字!', self::EXISTS_VALIDATE),
        array('phone',11,'手机号码必须为11位数字!', self::EXISTS_VALIDATE, 'length'),

        array('name', 'require', '社团名称必须填写!', self::EXISTS_VALIDATE),
        array('name', '2,10', '社团名称必须为2到10位字符！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),

        array('password', 'require', '密码必须填写!', self::EXISTS_VALIDATE),
        array('password', '6,18', '密码必须为6到18位数字！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),

        array('repassword','require','确认密码必须填写!', self::EXISTS_VALIDATE, '', self::MODEL_BOTH),
        array('repassword','password','确认密码与密码不一致!',1,'confirm', self::MODEL_BOTH),

        array('areaid_1', 'require', '地域必须填写!', self::EXISTS_VALIDATE),
        array('areaid_2', 'require', '地域必须填写!', self::EXISTS_VALIDATE),

//        array('address', 'require', '社团地址不能为空!', self::EXISTS_VALIDATE),
        array('address', '0,50', '社团地址不得多于50字！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),

        array('contact_name', 'require', '联系人姓名不能为空!', self::EXISTS_VALIDATE),

        array('description', 'require', '社团简介不能为空!', self::EXISTS_VALIDATE),
        array('description', '0,200', '社团简介不得多于200字！', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),

//        array('new_password', 'require', '密码必须填写!', self::EXISTS_VALIDATE),
//        array('new_password', '6,18', '密码必须为6到18位数字！', self::EXISTS_VALIDATE, 'length'),

        array('agree','on','请选择同意条款', self::EXISTS_VALIDATE, 'equal'),

        // 参数有效性验证
        array('username','require','手机号码必须填写!', self::EXISTS_VALIDATE, '', 365),
        array('pass','require','密码必须填写!', self::EXISTS_VALIDATE, '', 365),
        array('pass', '6,18', '密码必须为6到18位数字！', self::EXISTS_VALIDATE, 'length', 365),
        array('sdk_uid','require','SDK UID不能为空!', self::EXISTS_VALIDATE, '', 365),
        array('mac','require','用户设备MAC不能为空!', self::EXISTS_VALIDATE, '', 365),
        array('imei','require','用户设备IMEI不能为空!', self::EXISTS_VALIDATE, '', 365)

    );

    /**
     * 按分组获取对应分组成员的GUID
     *
     * @param $org_guid
     * @param $group_guid
     * @return array
     *
     * CT: 2014-11-07 15:50 by YLX
     */
	public function get_member_guid_by_group($org_guid, $group_guid)
    {
        $where = array('org_guid'=>$org_guid, 'is_del'=>'0');

        if (empty($group_guid) || $group_guid==get_org_all_member_group_guid($org_guid)){
            return $this->get_all_member_guids($org_guid);
        }else if ($group_guid == get_org_other_member_group_guid($org_guid)) {
            $where['org_group_guid'] = array('exp', 'IS NULL');
        } else {
            $current_group_name = M('OrgGroup')->where('guid="' . $group_guid . '"')->getField('name');
            if (empty($current_group_name)){
                return array();
            }
            $where['org_group_guid'] = $group_guid;
        }

        // 社员列表
        $r = M('OrgGroupMembers')->where($where)->group('user_guid')->getField('user_guid', true);

        return $r;
    }

    /**
     * 获取社团信息
     * @param $guid
     * @return mixed
     *
     * CT: 2014-11-11 12:10 by YLX
     */
    public function getInfo($guid)
    {
        return $this->where(array('guid'=>$guid))->find();
    }

    public function get_all_member_guids($guid)
    {
        return M('OrgGroupMembers')->where(array('org_guid'=>$guid, 'is_del'=>'0'))->group('user_guid')->getField('user_guid', true);
    }

    /**
     * 获取社员总数
     * @param $guid
     * @return mixed
     * CT: 2014-11-11 12:20 by YLX
     */
    public function get_total_member($guid)
    {
        $r = $this->get_all_member_guids($guid);
        return count($r);
    }

    /**
     * 统计字段更新
     * @param $org_guid 社团GUID
     * @param $field 字段名
     * @param int $num 增减数量 默认为1
     * @param int $mode 模式 1为增， 2为减， 默认为1
     * @return bool
     * CT: 2015-03-30 15:46 BY YLX
     */
    public function inc_and_dec($org_guid, $field, $num = 1, $mode = 1)
    {
        if($mode == 1){
            return $this->where(array('guid' => $org_guid))->setInc($field, $num);
        } else if($mode == 2) {
            return $this->where(array('guid' => $org_guid))->setDec($field, $num);
        } else {
            return false;
        }
    }
}