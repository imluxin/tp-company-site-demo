<?php
namespace Common\Model;
use Common\Model\BaseModel;

/**
 * 主题 模型
 * 
 * CT: 2014-09-24 09:26 by RTH
 */
class ActivitySubjectModel extends BaseModel
{
    /**
     * 是否批量显示验证信息
     * CT: 2014-09-20 14:00 by YLX
     */
    protected $patchValidate = true;
    
    /**
     * 主题模型自动完成
     * 
     * CT: 2014-09-24 09:26 by RTH
     */
//    protected $_auto = array (
//            array('updated_at','time', self::MODEL_BOTH, 'function'), // 对updated_at字段在新增/更新的时候写入当前时间戳
//            array('created_at','time', self::MODEL_INSERT, 'function'), // 对created_at字段在新增的时候写入当前时间戳
//    );

    /**
     * 主题模型验证条件
     *
     * CT: 2014-09-24 09:26 by RTH
     * UT: 2014-11-19 16:26 by ylx
     */
    protected $_validate = array(
            
            // CU时数据对像验证
        array('name','require','主题名称必须填写!', self::EXISTS_VALIDATE),
        array('name','2, 50','主题名称长度必须为2到50个字!', self::EXISTS_VALIDATE, 'length'),

        array('start_time','require','主题开始时间必须填写!', self::EXISTS_VALIDATE),
//        array('start_time','check_start_time','主题开始时间必须晚于当前时间!', self::EXISTS_VALIDATE, 'callback'),

        array('end_time','require','主题结束时间必须填写!', self::EXISTS_VALIDATE),
        array('start_time','check_end_time','主题结束时间必须晚于开始时间!', self::EXISTS_VALIDATE, 'callback'),

        array('org_group_guid','require','参与人员必须先择!', self::EXISTS_VALIDATE),

            
            // RD等, 数据有效性验证
            // **** 最后一个(第六个)参数, 必须是 365 ****
            array('guid', 'require', '参数错误, 操作失败, 请重试.', 0, '', 365),
            array('guid', 32, '参数错误, 操作失败, 请重试.', 0, 'length', 365), 

    );

    /**
     * 主题模型验证方法
     *
     * CT: 2014-11-19 16:26 by ylx
     */
    protected function check_start_time()
    {
        $start_time = intval(strtotime(I('post.startTime')));

        return $start_time+60 > time();
    }
    protected function check_end_time()
    {
        $start_time = intval(strtotime(I('post.startTime')));
        $end_time = intval(strtotime(I('post.endTime')));

        return $end_time > $start_time;
    }
    /**
     * 根据GUID获取主题名称
     *
     *  CT: 2014-09-24 09:26 by RTH
     */
    public function getName($guid)
    {
    	$info = $this->where(array('guid'=>$guid))->find();
    	if (empty($info)) return false;
    	return $info['name'];
    }

    /**
     * 根据所给条件获取主题详情
     * @param $condition
     * @return mixed
     *  CT: 2014-11-19 14:26 by RTH
     */
    public function getInfo($condition)
    {
        return $this->where($condition)->find();
    }
    
    
}