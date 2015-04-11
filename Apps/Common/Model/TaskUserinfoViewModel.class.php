<?php
namespace Common\Model;
use Think\Model\ViewModel;

class TaskUserinfoViewModel extends ViewModel{
    public $viewFields = array(
        'User'=>array(
            'guid',
            'birthday',
            'home_areaid_1',
            'home_areaid_2',
            'interest',
            'edu',
            'areaid_1',
            'areaid_2',
            'main_industry_guid',
            'remark'
        ),
        'UserCompany'=>array(
            'guid'=>'user_company_guid',
            'name'=>'companyname',
            'position'=>'position',
            '_on'=>'User.guid=UserCompany.user_guid'
        )
    );
}