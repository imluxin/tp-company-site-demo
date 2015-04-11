<?php
namespace Common\Model;
use Think\Model\ViewModel;
/**
 * 视图层拼接问卷等关联Model
 *
 * CT: 2015-03-10 16:50 by QXL
 */
class ActivityQuestionCollectViewModel extends ViewModel{
    public $viewFields = array(
    	'ActivityQuestionCollect'=>array('id','guid'=>'collect_guid','user_guid','activity_guid','created_at','_type'=>'LEFT'),
    	'User'=>array('guid'=>'uid','email', 'mobile', 'real_name', '_on'=>'ActivityQuestionCollect.user_guid=User.guid')
    );
}
?>