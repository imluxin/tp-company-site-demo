<?php
namespace Common\Model;
use Think\Model\ViewModel;
/**
 * 视图层拼接问卷等关联Model
 *
 * CT: 2015-03-10 16:50 by QXL
 */
class ActivityQuestionCollectDetailViewModel extends ViewModel{
    public $viewFields = array(
    	'ActivityQuestionCollectDetail'=>array('guid'=>'detail_guid','activity_guid','topic_guid','collect_guid','type','answer','_type'=>'LEFT'),
    	'ActivityQuestionTopic'=>array('guid'=>'topic_guid','name','_on'=>'ActivityQuestionTopic.guid=ActivityQuestionCollectDetail.topic_guid')
    );
}
?>