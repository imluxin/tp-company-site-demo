<?php
namespace Common\Model;
use Think\Model\ViewModel;

class TaskConditionViewModel extends ViewModel{
    public $viewFields = array(
        'TaskCondition'=>array(
            'id',
            'guid',
            'task_guid',
            'name',
            'sign'=>'signnum',
            'finish_num',
            'type',
            'webjs',
            'updated_at'
        ),
        'TaskSign'=>array(
            'id'=>'signid',
            'sign',
            'name'=>'signname',
            '_on'=>'TaskCondition.sign=TaskSign.id'
        )
    );
}