<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Org\Api\YmChat;

/**
 * 消息

 * CT: 2014-09-25 15:50 by YLX
 *
 */
class MessageController extends BaseHomeController
{
    
    /**
     * 聊天列表
     *
     * CT: 2014-09-28 18:00 by YLX
     * UT: 2014-10-31 11:00 by Qiu
     *
     */
    public function index()
    {
        $auth = $this->get_auth_session();
    	$org_guid = $auth['org_guid'];
    
    	$m = M('OrgMsg');
    	$num_per_page = C('NUM_PER_PAGE', null, '10');
//    	$where = 'to_guid = "'.$org_guid.'" and is_del=0 and type=1';

//        $list = $m->where($where)->order('sent_time desc')
//                    ->page(I('get.p', '1').','.$num_per_page)
//                    ->order('sent_time desc')
//                    ->select();
//        $count      = $m->where($where)->count();// 查询满足要求的总记录数
        $list = $m->query("SELECT * FROM (select * from `ym_org_msg` where `to_guid`='$org_guid' and `is_del`='0' and `type`='1' order by sent_time desc) t GROUP BY t.from_guid order by t.sent_time desc limit ".(I('get.p', '1')-1).",".$num_per_page.";");
//        $count      = count($m->where($where)->field('guid')->group('from_guid')->select());//->count();// 查询满足要求的总记录数
        $count = count($m->query("SELECT * FROM (select * from `ym_org_msg` where `to_guid`='$org_guid' and `is_del`='0' and `type`='1' order by sent_time desc) t GROUP BY t.from_guid order by t.sent_time desc ;"));
    	// 使用page类,实现分类
    	$page       = new \Think\Page($count, $num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show       = $page->show();// 分页显示输出

        //判断该用户下是否有未读消息
        foreach($list as $k => $l) {
            if($m->where(array('from_guid'=>$l['from_guid'], 'is_read'=>'0'))->find()) {
                $list[$k]['is_read'] = '0';
            } else {
                $list[$k]['is_read'] = '1';
            }
        }

    	$this->assign('page', $show);
    	$this->assign('list', $list);
    	$this->assign('meta_title', '消息管理');
    	$this->display();
    }

    /**
     * 和某人聊天记录
     *
     * CT: 2014-09-28 18:00 by YLX
     * UT: 2014-11-03 10:00 by QIU
     *
     */
    public function history()
    {
    	$user_guid = I('get.guid');
    	if (empty($user_guid)) $this->error('用户没有找到.', $this->getReferer());
    
    	$auth = $this->get_auth_session();
    	$org_guid = $auth['org_guid'];
    
    	$m = M('OrgMsg');
    	$num_per_page = C('NUM_PER_PAGE', null, '10');
    	$where = '((from_guid = "'.$user_guid.'" AND to_guid = "'.$org_guid.'") OR (from_guid = "'.$org_guid.'" AND to_guid = "'.$user_guid.'")) AND is_del=0 and type=1';
    	$list = $m->where($where)->order('created_at desc')->page(I('get.p', '1').','.$num_per_page)->select();
    
    	// 使用page类,实现分类
    	$count      = $m->alias('g')->where($where)->count();// 查询满足要求的总记录数
    	$page       = new \Think\Page($count, $num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show       = $page->show();// 分页显示输出

        // 设置已读
        $current_page_guids = array();
        foreach($list as $l) {
            $current_page_guids[] = $l['guid'];
        }
        if($current_page_guids) {
            $m->where(array('guid' => array('in', $current_page_guids)))->setField('is_read', '1');
        }
    
    	$this->assign('u_info', D('User')->getUserInfo($user_guid));
    	$this->assign('page', $show);
    	$this->assign('list', $list);
    	$this->assign('meta_title', '消息管理');
    	$this->display();
    	 
    }
    /**
     * 删除
     *
     * CT: 2014-10-08 17:30 by YLX
     */
    public function del() {
        $msg_guid = I('get.guid');
        $res = D('OrgMsg')->soft_delete(array('guid'=>$msg_guid));
        if ($res){
            $this->success('删除成功', $this->getReferer());
        }else {
            $this->error('删除失败, 请重试', $this->getReferer());
        }
    }


    /**
     * 回复
     *
     * CT: 2014-09-29 11:00 by YLX
     *
     */
    public function reply()
    {
        $to_guid = I('get.to_guid');
        $to_info = M('User')->where('guid="'.$to_guid.'"')->find();

        $auth = $this->get_auth_session();
        
        if (IS_POST){
            // 获取所需信息
            $content = I('post.content');
            if (empty($content)){
                $this->ajaxReturn(array('status'=>'ko', 'msg'=>'消息内容不能为空'));
            }
            $time = time();
            // 发送消息
            $msg = array(
                'from_id'     => $auth['org_guid'],
                'from_name'   => $auth['org_name'],
                'from_iconID' => $auth['org_logo'],
                'to_id'       => $to_info['guid'],
                'to_name'     => isset($to_info['real_name']) ? $to_info['real_name'] : $to_info['email'],
                'to_iconID'   => isset($to_info['photo']) ? $to_info['photo'] : '0',
                'content'     => '留言: ' . htmlspecialchars_decode($content),
                'send_time'   => $time,
                'msg_type'    => '11101', // 消息类型
                'type'        => '11002' // 发送类型
            );
            $chat = new YmChat();
            $res = $chat->sendMsg($auth['org_guid'], array($to_info['guid']), 'txt', $msg['content'], 'users', array('content' => $msg));

            // 判断结果
            if ($res['status'] == 200){
                // 保存数据
                $msg_guid = create_guid();
                $model_org_msg = M('OrgMsg');
                $data = array(
                        'guid'       => $msg_guid,
                        'from_guid'  => $auth['org_guid'],
                        'from_name'  => $auth['org_name'],
                        'from_photo' => isset($auth['org_logo'])?$auth['org_logo']:'0',
                        'to_guid'    => $to_info['guid'],
                        'to_name'    => isset($to_info['real_name'])?$to_info['real_name']:$to_info['email'],
                        'to_photo'   => isset($to_info['photo'])?$to_info['photo']:'0',
                        'content'    => '留言: '.$content,
                        'sdk_msg_status' => '0',
                        'sdk_msg_status' => '1',
                        'sent_time'  => $time,
                        'created_at' => $time,
                        'updated_at' => $time
                );
                $model_org_msg->data($data)->add();
                $this->ajaxReturn(array('status'=>'ok', 'msg'=>'消息发送成功.'));
            }else {
                $this->ajaxReturn(array('status'=>'ko', 'msg'=>'消息发送失败, 请稍后重试.'));
            }
        }
        
        $this->assign('to_info', $to_info);
        $this->display();
    }

    /**
     * 重发消息
     *
     * CT: 2014-12-05 09:27 by ylx
     */
    public function resend()
    {
        $msg_guid = I('get.guid');
        if(empty($msg_guid)){
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'消息发送失败, 请重试.'));
        }

        $model_org_msg = D('OrgMsg');
        $msg_info = $model_org_msg->find_one(array('guid'=>$msg_guid));
        if(empty($msg_info)){
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'消息发送失败, 请重试.'));
        }

        $auth = $this->get_auth_session();
        $time = time();

        $msg = array(
            'from_id'  => $auth['org_guid'],
            'from_name'  => $auth['org_name'],
            'from_iconID' => $msg_info['from_photo'],
            'to_id'    => $msg_info['to_guid'],
            'to_name'    => $msg_info['to_name'],
            'to_iconID'   => $msg_info['to_photo'],
            'content'    => htmlspecialchars_decode($msg_info['content']),
            'send_time'  => $time,
            'msg_type'  => '11101',
            'type'      => '11002'
        );

        // 发送消息
        $chat = new YmChat();
        $res = $chat->sendMsg($auth['org_guid'], array($msg_info['to_guid']), 'txt', $msg['content'], 'users', array('content' => $msg));

        if ($res['status'] == 200){
            $model_org_msg->where(array('guid'=>$msg_guid))->setField('sdk_msg_status', '1');
            $this->ajaxReturn(array('status'=>'ok', 'msg'=>'消息发送成功.'));
        }else {
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'消息发送失败, 请稍后重试.'));
        }
    }
}
