<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 *  报名模型
 *
 * CT: 2015-01-23 16:26 by ylx
 */

class ActivitySignupModel extends BaseModel{
    /**
     * 自动验证条件
     * CT: 2015-01-23 16:26 by ylx
     */
    protected $_validate = array(
        // CU时数据对像验证
        array('name','require','活动名称必须填写!', self::EXISTS_VALIDATE),
        array('name','2, 50','活动名称长度必须为2到50个字!', self::EXISTS_VALIDATE, 'length'),
        array('start_time','require','活动开始时间必须填写!', self::EXISTS_VALIDATE),

        array('end_time','require','活动结束时间必须填写!', self::EXISTS_VALIDATE),
        array('areaid_1','require','活动结束时间必须填写!', self::EXISTS_VALIDATE),
        array('areaid_2','require','活动结束时间必须填写!', self::EXISTS_VALIDATE),
        array('address','require','活动结束时间必须填写!', self::EXISTS_VALIDATE),

        array('subject_guid','require','创建失败, 请稍后重试.', self::EXISTS_VALIDATE),
    );
}
