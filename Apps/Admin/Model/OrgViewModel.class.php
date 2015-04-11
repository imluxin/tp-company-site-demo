<?php
namespace Admin\Model;
use Think\Model\ViewModel;
/**
 * 视图层拼接社团信息等关联Model
 *
 * CT: 2014-12-04 15:00 by QXL
 */
class OrgViewModel extends ViewModel{
		public $viewFields = array(
			'Org'=>array(
			                         'guid',
			                         'name',
			                         'logo',
			                         'description',
			                         'phone',
			                         'mail',
			                         'areaid_1',
			                         'areaid_2',
			                         'address',
			                         'url',
			                         'weibo',
			                         'wx',
			                         'created_at',
			                         'is_del',
			                         'is_lock',
			                         'vip',
									 'email',
                                     'is_verify',
                                     'contact_name'
			),
 		    'OrgAuthentication'=>array('status','legal_p_name','legal_p_phone','legal_p_card','yingye','zuzhi','_on'=>'OrgAuthentication.org_guid=Org.guid', '_type'=>'LEFT'),
		    'GradeLevel'=>array('name'=>'vip_name','_on'=>'Org.vip=GradeLevel.guid','_type'=>'LEFT')
		);

	public function getOrgList(){
		return $this->where(array('is_del'=>'0'))->order('created_at DESC')->select();
	}
	
	public function getOrgData($option){
	    return $this->where($option)->find();
	}
}
?>