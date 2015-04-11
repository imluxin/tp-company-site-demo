<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Org\Api\YmChat;

/**
 * 社团群发通知
 *
 * CT 2014-09-23 11:40 by RTH
 * UT 2014-09-23 11:40 by RTH
 */
class NoticeController extends BaseHomeController
{

    /**
     * 验证今天剩余可发送的通知条数
     */
    private function _check_send_num()
    {
        $session_auth = $this->get_auth_session();

        //获取当天时间
        $begin = strtotime('today');
        $end = $begin+3600*24;

        //获取当天发送的通知条数
        $s_count = D('OrgGroupMsgBox')
                ->where('status = 1 and org_guid = "'.$session_auth['org_guid'].'" and is_activity_notice=0 and updated_at >= '.$begin.' and updated_at < '.$end)
                ->count();
        $vip_config=$this->get_vip_info();
        $can_send_num = $vip_config['NUM_NOTICE_PER_DAY']-$s_count;
        $this->assign('can_send_num', $can_send_num);

        //判断截止到当前时间，可以发送通知的条数。配置表定义 每天三条
        return $can_send_num;
    }

    /**
     * 通知管理首页
     *
     * UT 2014-11-26 10:40 by ylx
     */
    public function index()
    {
    	//获取用户的session数据
        $session_auth = $this->get_auth_session();
        
        //每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');
        
        // 实例化模型
        $model = D('OrgGroupMsgBox');
        
        // 获取通知列表
        $where = array('is_del'=>0, 'org_guid'=>$session_auth['org_guid'], 'is_activity_notice'=>'0');
        $list = $model->where($where)
                      ->order('created_at desc')
                      ->page(I('get.p', '1').','.$num_per_page)->select();
        
        // 使用page类,实现分类
        $count      = $model->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        // 渲染模板
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list', $list);
        $this->assign('meta_title', '通知管理');
        $this->display();
    }
    
    public function callback_error($can_send_num){
        if ($can_send_num < 1) {
            $vip_config=$this->get_vip_info();
            $this->error('当天发送的通知已超过限额(' . $vip_config['NUM_NOTICE_PER_DAY'] . '条), 请明天再发.');
        }
    }
    
    /**
     * 增加
     *
     * CT 2014-09-23 11:40 by RTH
     * UT 2014-11-26 11:40 by ylx
     */
    public function add()
    {
        $can_send_num = $this->_check_send_num();
    	//获取用户的session数据
        $session_auth = $this->get_auth_session();
        $time = time();

        // 检查是否为POST
        if (IS_POST){
            if (I('post.status') == '1') {
                $this->callback_error($can_send_num);
            }
            
            // 获取数据
            $data = array();
            $data['guid'] = create_guid();
            $data['name'] = I('post.t_name');
            $data['group_guid'] = I('post.g_name');
            $data['org_guid'] = $session_auth['org_guid'];
            $data['status'] = I('post.status');
            $data['content'] = I('post.content');
            $data['created_at'] = $time;
            $data['updataed_at'] = $time;

            // 实例化模型
            $model = D("OrgGroupMsgBox");
            
            // 创建数据对像
            if (!$model->create($data)) {
                exit($this->error($model->getError()));
            }
            
            // 保存到数据库
            $res = $model->add();
            if($res){
                
                // 判断status是否为1, 若为1则发送通知
                if ($data['status'] == '1'){
                    $this->_process_send($data);
                }
                
                $this->success('添加成功', U('Notice/content', array('guid'=>$data['guid'])));
            }else{
                $this->error(' 添加失败',U('Notice/index', array('guid'=>$data['guid'])));
            }
            exit;
        }

		//获取全部分组数据
        $g_model = D('OrgGroup');
        $where = 'is_del = 0 AND org_guid = "' . $session_auth['org_guid'] . '"';
        $res = $g_model->where($where)->select();
        //dump($a);
       // dump($res);
        
        // 渲染模板
        $this->assign('res',$res);
        $this->assign('meta_title', '新增通知');
        $this->display();
    }
    
    /**
     * 编辑
     * 
     * CT 2014-09-23 11:40 by RTH
     * UT 2014-11-26 17:30 by ylx
     */
    public function edit()
    {
        // 获取guid
        $guid= I('get.guid');
        if(empty($guid)){
            $this->error('通知不存在.');
        }
        $can_send_num = $this->_check_send_num();
        // 实例化模型
        $model = D("OrgGroupMsgBox");
        
        // 检查是否为POST
        if(IS_POST){
            if (I('post.status') == '1') {
                $this->callback_error($can_send_num);
            }
            // 创建数据对像
            $data = array();
            $data['name'] = I('post.name');
            $data['content'] = I('post.content');
            $data['group_guid'] = I('post.g_name');
            $data['status'] = I('post.status');
		    $data['updated_at'] = time();
            // 创建数据对像
            if (!$model->create($data)) {
                exit($this->error($model->getError()));
            }

            // 如果数据对像创建成功, 执行保存操作
            $res = $model->where(array('guid'=>$guid))->save();
            
            if($res){
                // 判断status是否为1, 若为1则发送通知
                if ($data['status'] == '1'){
                    $this->callback_error($can_send_num);
                    $box = $model->where(array('guid'=>$guid))->find();
                    $this->_process_send($box);
                }
                $this->success('编辑成功', U('Notice/content', array('guid'=>$guid)));
            }else{
                $this->error('编辑失败', U('Notice/content', array('guid'=>$guid)));
            }
            exit();
        }

       //获取要编辑通知的信息
       	$MsgBox = $model->where(array('guid'=>$guid))->find();
        if(empty($MsgBox)){
            $this->error('通知不存在.');
        }
       	
       	if ($MsgBox['status'] == 1){
       		exit($this->error('已发送内容，不能重新编辑。'));
       	}

        $group_list = D('OrgGroup')
            ->where(array(
                'org_guid' => $MsgBox['org_guid'],
                'is_del' => '0'
                ))
            ->select();
        
        
        // 渲染模板
        $this->assign('MsgBox',$MsgBox);
        $this->assign('group_list',$group_list);
        $this->assign('meta_title', '编辑通知');
        $this->display();
    }

    /**
     * 内容展示页
     *
     * CT 2014-09-23 11:40 by RTH
     * UT 2014-11-26 17:30 by ylx
     */
    public function content()
    {
    	$guid = I('get.guid');
        if(empty($guid)){
            $this->error('通知不存在.');
        }

        // 获取通知信息
        $info = D("OrgGroupMsgBox")->getByGuid($guid);
        if(empty($info)){
            $this->error('通知不存在.');
        }

        $auth = $this->get_auth_session();
        if ($info['group_guid'] == $auth['org_all_guid']){
        	$group_name = "全部成员";
        	
        }else if ($info['group_guid'] == $auth['org_other_guid']){
            $group_name = "未分组";
        }else{
            $group_name = M('OrgGroup')->where(array('guid'=>$info['group_guid']))->getField('name');
        }
        
        // 渲染模板
        $this->assign('group_name',$group_name);
        $this->assign('info',$info);
        $this->assign('meta_title', '编辑通知');
        $this->display();
    }


    /**
     * 删除
     *
     * CT 2014-09-23 11:40 by RTH
     * UT 2014-11-26 17:30 by ylx
     */
    public function del()
    {
        // 获取数据
        $guid = I('get.guid');
        if(empty($guid)){
            $this->error('通知不存在.');
        }
        
        // 实例化模型
        $mAll = D('OrgGroupMsgBox');

        $res = $mAll->where(array('guid ' => $guid))->find();
        if(empty($res)){
            $this->error('通知不存在.');
        }
        
        //判断数据是否可以删除
        if ($res['status'] == 0){
            // 若存在, 执行删操作
            $res = $mAll->where(array('guid'=>$guid))->delete();
            if (!empty($res)){
                $this->success('删除成功！', U('Notice/index'));
            } else {
                $this->error('删除失败, 请稍后重试.');
            }
       } else {
        	$this->error('已发送通知不可删除.');
       }
        exit();
    }

    /**
     * 批量删除操作
     *
     * CT 2014-09-23 11:40 by RTH
     * UT 2014-09-23 11:40 by RTH
     */
    public function batch()
    {
        // 此操作必须为POST
        if (IS_POST){
            // 获取数据
            $batch_act = I('post.batch_act');
            $guids = I('post.ckguid');
            
            // 验证数据
            if (empty($guids) || empty($batch_act)){
                exit($this->error('操作失败，请重试。', U('Notice/index')));
            }
            
            // 实例化模型
            $m = D('Org_group_msg_box');
            
            switch ($batch_act){
                // 若为删除操作, 执行相关删除操作
            	case 'del':
            	    $res = $m->where(array('guid'=> array('IN', $guids)))->delete();
            	    if ($res > 0){
                        $this->success('删除成功.', U('Notice/index'));
            	    } else {
            	        $this->error('参数错误, 请重试.', U('Notice/index'));
            	    }
            	    exit();
            	    break;
            	default:
            	    exit($this->error('非法操作。'));
            	    break;
            }
            exit();
        }
        
        $this->error('非法操作。');
    }

    /**
     * 发送通知
     * $message: from_id	from_name	from_iconID	to_id	to_name	to_iconID	content	send_time	msg_type	type
     * 
     * CT: 2014-09-25 12:00 by YLX
     *
     */
    public function send()
    {
        $can_send_num = $this->_check_send_num();
        if($can_send_num < 1){
           $this->callback_error($can_send_num);
        }

        $box_guid = I('get.guid');
        if (empty($box_guid)) return $this->error('参数错误');
        $box = D('OrgGroupMsgBox')->where(array('guid'=>$box_guid))->find();
        if (empty($box['group_guid'])) return $this->error('参数错误');

        // 发送通知
        $this->_process_send($box);
        $this->success('发送成功.', U('Notice/index'));
    }

    private function _process_send($box) {
        $auth = $this->get_auth_session();
        $time = time();
        $content  = '通知: '.$box['content'];
        // 通过SDK发送消息
        $msg = array(
            'from_id'  => $box['org_guid'],
            'from_name'  => $auth['org_name'],
            'from_iconID' => $auth['org_logo'],
            'to_id'    => '',
            'to_name'    => '',
            'to_iconID'    => '',
            'content'    => htmlspecialchars_decode($content),
            'send_time'  => $time,
            'msg_type'  => '11101',
            'type' => '11002',
            'is_read' => 0
        );
        $to_user = D('OrgGroup')->get_chat_group_id($box['org_guid'], $box['group_guid']);

        if (empty($to_user)){
            $this->error('该分组下没有成员, 请重新分组.');exit();
        }
        $chat = new YmChat();
        $res = $chat->sendMsg($box['org_guid'], array($to_user), 'txt', $msg['content'], "chatgroups", array('content' => $msg));
        if($res['status'] != 200){
            $this->error('消息发送失败, 请稍候重试.');exit();
        }

        //保存聊天记录
        $data_msg = array(
            'guid'       => create_guid(),
            'org_group_guid' => $box['group_guid'],
            'msg_box_guid' => $box['guid'],
            'from_guid'  => $box['org_guid'],
            'from_name'  => $auth['org_name'],
            'from_photo' => $auth['org_logo'],
            'to_guid'    => $box['guid'],
            'to_name'    => '',
            'to_photo'   => '',
            'content'    => $box['content'],
            'sdk_msg_status'    => '1',
            'sent_time'  => $time,
            'created_at' => $time,
            'updated_at' => $time,
            'type'   => '2'
        );
        D('OrgMsg')->insert($data_msg);

        // 更改发送消息发送状态为1
        D('OrgGroupMsgBox')->where(array('guid'=>$box['guid']))->setField('status', '1');
    }


    /**
     * 异步保存聊天记录
     *
     * CT: 2014-09-26 10:00 by YLX
     *
     */
    public function add_msg_history()
    { 
        // 获取消息内容
        $model_box = D('OrgGroupMsgBox');
        $box = $model_box->where(array('guid'=>I('get.box_guid')))->find();
        
        //本操作要异步执行, 无法获取session, 所以需要获取org
        $org = D('Org')->field('name, logo')->where(array('guid'=>$box['org_guid']))->find();
        
        // 获取所有用户
        $model_user = d('User');
        $user_list = $model_user->alias('u')
                                ->join('ym_org_group_members og ON og.user_guid = u.guid')
                                ->where(array('og.org_group_guid'=>$box['group_guid']))
                                ->field('u.guid, u.real_name, u.photo')
                                ->select();
        // 创建聊天记录数组
        $msg_list = array();
        $time = I('get.st');
        foreach ($user_list as $u) {
            $msg_list[] = array(
        	    	    'guid'       => create_guid(),
                        'org_group_guid' => $box['group_guid'],
                        'msg_box_guid' => $box['guid'],
        	            'from_guid'  => $box['org_guid'],
        	            'from_name'  => $org['name'],
        	            'from_photo' => isset($org['logo'])?$org['logo']:'0',
        	            'to_guid'    => $u['guid'],
        	            'to_name'    => $u['real_name'],
        	            'to_photo'   => isset($u['photo'])?$u['photo']:'0',
        	            'content'    => $box['content'],
                        'sdk_msg_id'    => '1',
        	            'sent_time'  => $time,
        	            'created_at' => $time,
        	            'updated_at' => $time
        	            
        	    );
        }

        $model_org_msg = M('OrgMsg');
        $res = $model_org_msg->addAll($msg_list);
        exit();
    }
    
    
}