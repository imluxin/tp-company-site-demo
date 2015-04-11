<?php
namespace Home\Controller;
use Org\Api\YmChat;
use Org\Api\YmSMS;
use Think\Image;

/**
 * 活动管理页面管理
 *
 * CT 2014-11-03 10:20 by  RTH
 */

class ActivityController extends BaseHomeController{

    const ACTIVITY_ARTICLE = 1; // 文章
    const ACTIVITY_VOTE = 2;    // 投票
    const ACTIVITY_DISCUSS = 3; // 讨论
    const ACTIVITY_SIGNUP = 4;  // 报名
    const ACTIVITY_QUESTIONNAIRE = 5; //问卷

    public function analyse_question(){
       header("Content-type:text/html;charset=utf-8");
       $param_topic = I('post.topic');
       $activity_data = $question_data = $topic_data = $option_data = array();
       $topic_data = array();
       $option_data = array();
       $time = time();
       
       $activity_data['guid'] = I('post.guid') ? I('post.guid') : create_guid();
       if(!I('post.guid')){
           $activity_data['subject_guid'] = I('post.sguid');
           $activity_data['created_at'] = $time;
           $activity_data['org_guid'] = I('post.oguid');
           $activity_data['type'] = I('post.type');
       }
       $activity_data['org_group_guid'] = I('post.OGGuid');
       $activity_data['name'] = I('post.name');
       $activity_data['start_time'] = I('post.startTime');
       $activity_data['end_time'] = I('post.endTime');
       $activity_data['status'] = I('post.status');
       $activity_data['is_public'] = I('post.is_public');
       $activity_data['updated_at'] = $time;
       if(I('post.is_public') == '1'){
           $activity_data['published_at'] = $time;
       }
       
       $question_data['guid'] = I('post.qguid') ? I('post.qguid') : create_guid();
       $question_data['name'] = I('post.name');
       $question_data['description'] = I('post.description');
       $question_data['conclusion'] = I('post.conclusion');
       if(!I('post.qguid')) $question_data['created_at'] = $time;
       $question_data['updated_at'] = $time;
       if(I('post.sguid')) $question_data['subject_guid'] = I('post.sguid');
       if(!I('post.guid')) $question_data['updated_at'] =  $activity_data['guid'];
       
       foreach($param_topic as $key=>$value){           
           $topic_data[$key]['guid'] = $value ['guid'] ? $topic_data ['guid'] : create_guid();
           $topic_data[$key]['name'] = $value ['topic_title'];
           $topic_data[$key]['type'] = $value ['topic_type'];
           $topic_data[$key]['sort'] = $value ['topic_sort'];
           if(empty($value ['guid'])) $topic_data [$key]['created_at'] = $time;
           $topic_data [$key]['updated_at'] = $time;
           $topic_data [$key]['question_guid'] = $question_data['guid'];
           foreach($value['option'] as $k=>$v){
               $option_data[$key][$k]['guid'] = $v['guid'] ? $v['guid'] : create_guid();
               $option_data[$key][$k]['option'] = $v['title'];
               $option_data[$key][$k]['sort'] = $v['sort'];
               if(empty($v['guid'])) $option_data[$key][$k]['created_at'] = $time;
               $option_data[$key][$k]['updated_at'] = $time;
               $option_data[$key][$k]['topic_guid'] =  $topic_data [$key]['guid'];
           }
       }
       $option_arrange_data = array();
       foreach($option_data as $key=>$value){
          foreach($value as $k=>$v){
              $option_arrange_data[] = $v;
          }
       }
       M('ActivityQuestionOption')->inserUpAll($option_arrange_data);
       //TODO开整
    }
    
    /**
     *  活动主题列表页
     *
     * CT 2014-11-03 10:20 by  RTH
     * UT 2014-11-03 10:20 by  RTH
     */

    public function index()
    {
        session('session_subject', null);
        //         每页显示数量, 从配置文件中获取
        $num_per_page = C('NUM_PER_PAGE');

        // 实例化模型
        $model_subject = D('ActivitySubject');
        $session_Auth  = $this->get_auth_session();
        $org_guid      = $session_Auth['org_guid'];
        // 获取主题列表
        $activity_subject_where = 'org_guid = "'.$org_guid.'" and is_del=0';
        $activity_subject_list = $model_subject->where($activity_subject_where)->order('updated_at desc')->page(I('get.p', '1').','.$num_per_page)->select();

        //遍历主题获取相关的数据状态
        foreach ($activity_subject_list as $k=>$l){
            $time = time();
            if ($l['end_time'] < $time) {
                $activity_subject_list[$k]['status'] = '已结束';
            } elseif($l['start_time'] < $time && $l['end_time'] > $time){
                $activity_subject_list[$k]['status'] = '进行中';
            } else {
                $activity_subject_list[$k]['status'] = '未发布';
            }
        }

        // 使用page类,实现分类
        $count      = $model_subject->get_count($activity_subject_where);// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        // 渲染模板
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list', $activity_subject_list);
        $this->assign('meta_title', '主题管理');
        $this->display();
    }

    /**
     * 检查当关发布主题次数是否超限
     *
     * @return 返回剩余次数
     * CT 2014-11-17 15:20 by ylx
     * UT 2014-12-12 16:33 by QXL
     */
    private function check_subject_num_left()
    {
        $auth = $this->get_auth_session();
        //获取今天的零点时间
        $today = strtotime(today);
        //当天还可以创建多少主题
        $where = 'created_at > "'.$today.'" and org_guid="'.$auth['org_guid'].'"';
        //当天创建主题总条数
        $count = count(D('ActivitySubject')->where($where)->select());
        //权限-社团每天可创建的主题数量
        $vip_config=$this->get_vip_info();
        $num_per_day = $vip_config['NUM_SUBJECT_PER_DAY'];
        //<---------------------------------------->
        if ($count >= $num_per_day){
            return 0;
        } else {
            return $num_per_day-$count;
        }
    }

    /**
     *  添加主题页
     *
     * CT 2014-11-03 10:20 by  RTH
     * UT 2014-11-19 10:07 by  ylx
     */
    public function subject_add()
    {
        //检查当关发布主题次数是否超限
        $num_left = $this->check_subject_num_left();
        if($num_left <= 0){
            $this->error('今天已经不能新建更多主题了',U('Activity/index'));
        }

        if (IS_POST){
            $time = time();
            //实例化数据，名称应为驼峰名。
            $data['guid'] = create_guid();
            $data['name'] = I('post.name');
            //strtotime() 将用户设定的时间转成时间戳存储
            $data['start_time']     = strtotime(I('post.startTime'));
            $data['end_time']       = strtotime(I('post.endTime'));
            $data['org_group_guid'] = I('post.OGGuid');
            $data['created_at']     = $time;
            $data['updated_at']     = $time;

            // 后台提交验证
            $model_subject = D('ActivitySubject');
            $check = $model_subject->create($data);
            if (!$check){
                $this->error($model_subject->getError());exit();
            }

            //数据存到session    等到活动创建完毕以后   将数据全部存到数据库
            session('session_subject',$data);

            // 页面重定向******####******
            if(session('session_subject')){
                $this->redirect('Activity/type');
            }
            exit();
        }

        //获取用户的session数据
        $session_auth = $this->get_auth_session();

        //获取session('session_subject')里存储的数据    展现到页面
        //session('session_subject')里面存储着页面传过来的数据
        $session_subject = session('session_subject');

        //获取全部分组数据
        $list =  D('OrgGroup')->find_all(array('is_del' => '0', 'org_guid' => $session_auth['org_guid']));

        // 渲染模板
        //将session('session_subject')的数据渲染到模板
        $this->assign('session_subject',$session_subject);
        $this->assign('session_auth', $session_auth);
        //将剩余次数渲染到模板
        $this->assign('c_count',$num_left);
        //主题表的内容数据渲染
        $this->assign('list', $list);
        $this->assign('meta_title', '添加主题');
        $this->display();
    }

    /**
     * 检查主题是否可编辑
     * @param $subject_guid
     * @return int
     *
     *  CT 2014-11-21 16:20 by  ylx
     */
    private function _check_subject_status($subject_guid)
    {
        //遍历主题获取相关的数据状态
        $activity_status = D('Activity')->get_field('subject_guid = "'.$subject_guid.'" and is_del = 0','status', true);

        $subject_info = D('ActivitySubject')->find_one(array('guid'=>$subject_guid));
        //判断活动状态数据组的数据    值是否
        if($subject_info['end_time'] < time()) {
            return 0;
        }
        if (in_array('1', $activity_status) || in_array('2', $activity_status)){
            return 0; // 存在进行中/已结束活动, 不可编辑
        } else {
            return 1; // 所有活动均未发布, 可编辑
        }
    }
    /**
     *  文章内容页
     *
     *  CT 2014-11-03 10:20 by  RTH
     *  UT 2014-11-21 16:20 by  ylx
     */
    //内容查询页
    public function subject_view()
    {
        //获取界面上传过来的主题guid
        $subject_guid = I('get.guid');
        if(empty($subject_guid)){
            $this->error('主题不存在.', U('Activity/index'));
        }

        $time = time();
        //根据主题guid  查询对应的数据结果
        $subject_info = D('ActivitySubject')->find_one(array('guid'=>$subject_guid));
        if(empty($subject_info)){
            $this->error('主题不存在.', U('Activity/index'));
        }

        //检查主题是否可编辑
        $subject_info['can_edit'] = $this->_check_subject_status($subject_guid);

        //获取社团组GUID
        switch($subject_info['org_group_guid']){
            case get_org_all_member_group_guid($subject_info['org_guid']):
                $group_name = '全部成员';
                break;
            case get_org_other_member_group_guid($subject_info['org_guid']):
                $group_name = '未分组成员';
                break;
            default:
                $group_name = D('OrgGroup')->get_field(array('guid'=>$subject_info['org_group_guid']),'name');
                break;
        }

        $this->assign('group_name',!empty($group_name)?$group_name:'<i>分组已删除</i>');
        $this->assign('info',$subject_info);
        $this->assign('meta_title','主题内容');
        $this->display();
    }

    /**
     * editSub       主题编辑页
     *
     *
     * CT 2014-11-12 10:20 by  RTH
     * UT 2014-11-12 10:20 by  RTH
     */
    public function subject_edit()
    {
        $sesstion_auth = $this->get_auth_session();
        //获取界面传过来的相应的主题guid
        $guid = I('get.guid');
        if(empty($guid)){
            $this->error('主题不存在', U('Activity/index'));
        }

        $can_edit = $this->_check_subject_status($guid);
        if ($can_edit == 0) {
            $this->error('该主题有活动正在进行中或已结束, 无法编辑.');
        }

        //实例化主题表
        $model_subject = D('ActivitySubject');

        //系统当前时间
        $time = time();

        if (IS_POST){
            // 后台提交验证
            //主题名称验证
            $data = array(
                'name' => I('post.name'),
                'start_time' => strtotime(I('post.startTime')),
                'end_time' => strtotime(I('post.endTime')),
                'org_group_guid' => I('post.OGGuid'),
                'updated_at'    => $time
            );

            $r = $model_subject->create($data);
            if(!$r){
                $this->error($model_subject->getError());
            }

            //数据更新
            $r = $model_subject->update('guid ="'.$guid.'"',$data);

            if (empty($r)){
                $this->error('主题更新失败, 请稍后重试.',U('Activity/subject_view', array('guid'=>$guid)));
                exit();
            }else {
                $this->success('主题更新成功.',U('Activity/subject_view', array('guid'=>$guid)));
                exit();
            }
            exit();
        }


        //主题数据
        $info = $model_subject->where('guid = "'.$guid.'" and is_del = 0')->find();
        if(empty($info)){
            $this->error('主题不存在', U('Activity/index'));
        }
        //获取社团组数据
        $list_group = D('OrgGroup')->find_all(array('org_guid'=>$sesstion_auth['org_guid'], 'is_del'=>'0'),'guid, name');

        //渲染页面
        $this->assign('list_group',$list_group);
        $this->assign('info',$info);
        $this->display();

    }


    /**
     *  主题删除页
     *
     * CT 2014-11-03 10:20 by  RTH
     * UT 2014-11-03 10:20 by  RTH
     */
    public function subject_del()
    {
        $guid = I('get.guid');
        if (empty($guid)) {
            $this->error('主题不存在.');
        }
        $info = D('ActivitySubject')->find_one(array('guid' => $guid));
        if (empty($info)) {
            $this->error('主题不存在.');
        }
        $can_del = $this->_check_subject_status($guid);
        if ($can_del == 0) {
            $this->error('该主题有活动正在进行中或已结束, 无法删除.');
        }

        // 删除主题
        $r = D('ActivitySubject')->soft_delete(array('guid' => $guid));
        if (!empty($r)) {
            // 删除该主题下活动
            D('Activity')->soft_delete(array('subject_guid' => $guid));
            $this->success('主题删除成功', U('Activity/index'));
        }else{
            $this->error('主题删除失败, 请稍后重试.');
        }
    }


    /**
     *  活动类型页面
     *
     *  CT 2014-11-03 10:20 by  RTH
     *  UT 2014-11-21 10:20 by  ylx
     */
    public function type()
    {
        $subject_guid = I('get.sguid');

        //判断创建数是否超过配置
        if($this->check_activity_num()){
            $this->error('今天已经不能新建更多活动了',U('Activity/index'));
        }

        if (!empty($subject_guid)){
            $subject_info = D('ActivitySubject')->find_one(array('guid'=>$subject_guid));
        } else {
            //获取session里面的主题列表数据
            $subject_info = session('session_subject');
            if(empty($subject_info)){
                $this->error('主题不存在.');
            }
            $subject_guid = $subject_info['guid'];
        }

        if(empty($subject_info)){
            $this->error('主题不存在.');
        }

        $this->assign('subject_guid', $subject_guid);
        $this->assign('meta_title','活动类型');
        $this->display();
    }
    /**
     *
     *	活动列表
     *  CT 2014-11-03 10:20 by RTH
     *  UT 2014-11-19 17:20 by ylx
     */
    public function activity_list()
    {
        // 每页显示数量, 从配置文件中获取
        $num_per_page =  C('NUM_PER_PAGE');

        //获取界面的主题的GUID
        $subject_guid = I('get.sguid');
        if(empty($subject_guid)){
            $this->error('主题不存在.', U('Activity/index'));
        }

        // 获取主题列表
        $subject_info = D('ActivitySubject')->find_one(array('guid'=>$subject_guid));
        if(empty($subject_info)){
            $this->error('主题不存在.', U('Activity/index'));
        }
        
        if($subject_info['end_time']>time()){
            $this->assign('is_end',true);
        }
        
        //活动列表
        $condition = 'subject_guid = "'.$subject_guid.'" and is_del=0';
        list($show, $list) = D('Activity')->pagination($condition, I('get.p', '1'), $num_per_page);
        
        $time = time();
        foreach ($list as $k=>$v){
            if ($v['status'] == 0){ //未发布
                $list[$k]['state'] = '0';
            }else if($v['status'] == 3){
                $list[$k]['state'] = '4';
            }else if($v['start_time'] > $time){ //未开始
                $list[$k]['state'] = '1';
            }else if ($v['start_time'] < $time && $v['end_time'] > $time){ //进行中
                $list[$k]['state'] = '2';
            }else if ($v['end_time'] < $time){ //已结束
                // 更新活动状态
                D('Activity')->set_field(array('guid'=>$v['guid']), array('status'=>'2', 'updated_at'=>$time));
                $list[$k]['state'] = '3';
            }
        }
        
        //渲染到页面
        $this->assign('subject_info',$subject_info);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);
        $this->assign('meta_title','活动列表');
        $this->display();
    }

    /**
     *  文章内容页
     *
     *  CT 2014-11-03 10:20 by  RTH
     *  UT 2014-11-21 10:20 by  ylx
     */
    //内容查询页
    public function activity_view()
    {
        //获取界面上传过来的guid
        $activity_guid = I('get.guid');
        if(empty($activity_guid)){
            $this->error('活动不存在.');
        }
        
        $activity_info = D('Activity')->find_one(array('guid'=>$activity_guid, 'is_del'=>'0'));
        if(empty($activity_info)){
            $this->error('活动不存在.');
        }
        
        $subject_info = D('ActivitySubject')->find_one(array('guid'=>$activity_info['subject_guid']));
        $this->assign('subject_info', $subject_info);

        switch($activity_info['org_group_guid']){
            case get_org_all_member_group_guid($subject_info['org_guid']):
                $group_name = '全部成员';
                break;
            case get_org_other_member_group_guid($subject_info['org_guid']):
                $group_name = '未分组成员';
                break;
            default:
                $group_name = D('OrgGroup')->get_field(array('guid'=>$activity_info['org_group_guid']),'name');
                break;
        }
        $this->assign('group_name',!empty($group_name)?$group_name:'<i>分组已删除</i>');
        $this->assign('activity_info', $activity_info);

        // 活动状态
        $time = time();
        if ($activity_info['status'] == 0){ //未发布
            $status = '未发布';
        }else if($activity_info['status'] == 3){
            $status = '已关闭';
        }else if($activity_info['start_time'] > $time){ //未开始
            $status = '未开始';
        }else if ($activity_info['start_time'] < $time && $activity_info['end_time'] > $time){ //进行中
            $status = '进行中';
        }else if ($activity_info['end_time'] < $time){ //已结束
            // 更新活动状态
            D('Activity')->set_field(array('guid'=>$activity_info['guid']), array('status'=>'2', 'updated_at'=>$time));
            $status = '已结束';
        }
        $this->assign('status', $status);
        $this->assign('meta_title', '活动详情');

        switch($activity_info['type']){
            case self::ACTIVITY_ARTICLE:
                $this->_article_view($activity_info);
                break;
            case self::ACTIVITY_VOTE:
                $this->_vote_view($activity_info);
                break;
            case self::ACTIVITY_DISCUSS:
                $this->_discuss_view($activity_info);
                break;
            case self::ACTIVITY_SIGNUP:
                $this->_signup_view($activity_info);
                break;
            case self::ACTIVITY_QUESTIONNAIRE:
                $this->_question_view($activity_info);
                break;
            default:
                $this->error('活动不存在.');
                exit();
                break;
        }
    }
    private function _article_view($activity_info){
        $article_info = D('ActivityArticle')->find_one(array('activity_guid'=>$activity_info['guid']));
        $this->assign('article_info', $article_info);
        $this->display('article_view');
    }
    private function _vote_view($activity_info){
        $vote_info = D('ActivityVote')->find_one(array('activity_guid'=>$activity_info['guid']));
        $option_info = D('ActivityVoteOption')->find_all(array('vote_guid'=>$vote_info['guid']));

        //投票人数
        $vote_num = D('ActivityUserVote')->find_all(array('vote_guid'=>$vote_info['guid'], 'is_del'=>'0'),'user_guid','user_guid');
//        $ava_vote_num = M('ActivityUserVote')->where(array('vote_guid'=>$vote_info['guid'], 'is_del'=>'0'))->group('user_guid')->count();

        // 总票数
        $vote_option_sum = $ava_vote_num = D('ActivityUserVote')->get_count(array('vote_guid'=>$vote_info['guid'], 'is_del'=>'0'));

        // 票数统计
        $option_static = array();
        foreach($option_info as $o){
            $sum = D('ActivityUserVote')->get_count(array('vote_option_guid'=>$o['guid'], 'is_del'=>'0'));
            $option_static[$o['guid']]['sum'] = isset($sum)?$sum:'0';
            $option_static[$o['guid']]['percent'] = isset($sum)?round(($sum/$vote_option_sum)*100, 2):'0';
        }

        $this->assign('activity_info', $activity_info);
        $this->assign('vote_info', $vote_info);
        $this->assign('option_info', $option_info);
        $this->assign('vote_num', empty($vote_num)?0:count($vote_num));
        $this->assign('ava_vote_num', empty($vote_option_sum)?0:$vote_option_sum);
        $this->assign('option_static', $option_static);

        $this->display('vote_view');
    }
    private function _discuss_view($activity_info) {
        $article_info = D('GroupOrgDisc')->find_one(array('activity_guid'=>$activity_info['guid']));
        $this->assign('article_info', $article_info);
        $this->display('article_view');
    }
    private function _signup_view($activity_info) {
        $activity_guid = $activity_info['guid'];
        $signup_info = D('ActivitySignup')->find_one(array('activity_guid' => $activity_guid));
        if(empty($signup_info)) {
            $this->error('活动不存在.');
        }
        $signup_form = M('ActivitySignupFormBuild')
            ->where(array('signup_guid' => $signup_info['guid'], 'is_del' => '0'))
            ->select();
        //报名人数
        $user_count = M('ActivitySignupUserinfo')->where(array('activity_guid' => $activity_guid, 'is_del' => '0'))
                                                    ->count();

        // 承办机构
        $this->assign('undertaker', M('ActivityAttrUndertaker')->where(array('activity_guid' => $activity_guid, 'is_del' => '0'))->order('id asc')->select());
        // 活动流程
        $this->assign('flow', M('ActivityAttrFlow')->where(array('activity_guid' => $activity_guid, 'is_del' => '0'))->order('id asc')->select());

        $this->assign('user_count', $user_count);
        $this->assign('signup_info', $signup_info);
        $this->assign('signup_form', $signup_form);
        $this->display('signup_view');
    }
    
    private function _question_view($activity_info) {
        $activity_guid = $activity_info['guid'];

        $question_info = M('ActivityQuestion')->where(array('activity_guid' => $activity_guid))->find();
        if(empty($question_info)) {
            $this->error('活动不存在.');
        }
        $this->assign('question_info', $question_info);
        $this->display('question_view');
    }
    
    /**
     * 报表用户列表
     */
    public function signup_userinfo() {
        $aid = I('get.aid');
        if(empty($aid)) {
            $this->error('活动不存在.');
        }
        $activity_info = D('Activity')->find_one(array('guid' => $aid));
        if(empty($activity_info)) {
            $this->error('活动不存在.');
        }
        $this->assign('activity_info', $activity_info);

        // 获取新用户表单
        $this->_get_signup_form($aid);

        // 是否显示发送邮箱
        $this->assign('is_send_mail', M('ActivitySignupFormBuild')->where(array(array('activity_guid' => $aid, 'ym_type' => 'email', 'is_required' => '1')))->find());
        // 获取社团短信&邮件余额
        $auth = $this->get_auth_session();
        $org_info = M('Org')->field('num_sms, num_email')->where(array('guid' => $auth['org_guid']))->find();
        $this->assign('org_info', $org_info);

        // 用户列表
        $this->_get_signup_userlist($aid);

        $this->assign('subject_info', D('ActivitySubject')->find_one(array('guid' => $activity_info['subject_guid'])));
        $this->assign('meta_title', '报名表');
        $this->display();
    }

    /**
     * 组装报名表单
     * CT: 2015-04-03 14:09 by ylx
     */
    private function _get_signup_form($aid)
    {
        // 增加新用户的表单
        $signup_info = D('ActivitySignup')->find_one(array('activity_guid' => $aid));
        $build_info   = D('ActivitySignupFormBuild')->where(array('signup_guid' => $signup_info['guid']))->order('id asc')->select();
        $option_info  = D('ActivitySignupFormOption')->where(array('signup_guid' => $signup_info['guid']))->field('guid,build_guid,value')->select();
        foreach($option_info as $o) {
            $format_option_info[$o['build_guid']][] = $o;
        }
        // 获取票务相关
        $tickets = M('ActivityAttrTicket')->where(array('activity_guid' => $aid, 'is_del' => '0', 'is_for_sale' => '1'))->getField('guid, num, name', true);
        foreach($tickets as $k => $t) {
            $user_width_this_ticket = M('ActivityUserTicket')->field('guid')->where(array('ticket_guid' => $t['guid'], 'status' => '2', 'is_del' => '0'))->count();
            if($user_width_this_ticket >= $t['num']) {
                unset($tickets[$k]);
            }
        }
        $this->assign('tickets', $tickets);
        $this->assign('build_info', $build_info);
        $this->assign('option_info', $format_option_info);
    }

    /**
     * ajax 加载下一页报名用户
     * CT： 2015-03-09 14:15 by ylx
     */
    public function ajax_signup_user_next_page() {
        if(IS_AJAX) {
            $aid = I('get.aid');
            $action = I('get.action', '');
            if(empty($aid)) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '参数错误，请稍后重试。'));
            }
            // 用户列表
            list($show, $list) = $this->_get_signup_userlist($aid, $action);

            if(empty($list)) {
                $this->ajaxReturn(array('status' => 'nomore', 'msg' => '没有更多数据了。'));
            }

            $this->ajaxReturn(array('status' => 'ok', 'msg' => '加载成功。', 'data' => $list));
        } else {
            $this->ajaxReturn(array('status' => 'ko', 'msg' => '非法操作.'));
        }

    }

    /**
     * 获取报名用户列表
     * @param $aid 活动GUID
     * @param string $action 调用方action名称
     * @return array
     * CT: 2015-03-09 16:30 BY YLX
     */
    private function _get_signup_userlist($aid, $action = '') {
        $where = "i.activity_guid='$aid' and i.is_del=0";

        // 搜索关键字 只支持姓名和电话
        $keyword = urldecode(I('get.keyword'));
        if(isset($keyword)) { // 搜索姓名和电话
            $where .= " and (i.real_name like '%$keyword%' or i.mobile like '%$keyword%')";
        }

        // 票务类型过滤
        $ticket_type = I('get.t');
        if(!empty($ticket_type)) {
            if($ticket_type != 'all'){
                $where .= " and t.ticket_guid='$ticket_type'";
            }
        }

        // 人员来源过滤
        $from = I('get.f');
        if(!empty($from)) {
            if($from != 'all') {
                $where .= " and i.type='$from'";
            }
        }

        // 签到状态过滤
        $signin_status = I('get.s');
        if(!empty($signin_status)) {
            switch($signin_status) {
                case 'yes': // 已签到
                    $where .= " and t.status=4";
                    break;
                case 'no': // 未签到
                    $where .= " and (t.status=3 or t.status=2)";
                    break;
                case 'u0': // 未发送电子票
                case 'u1': // 电子发送失败
                case 'u2': // 已发送
                case 'u3': // 已查看
                case 'u4': // 已签到
                    $status = substr($signin_status, 1);
                    $where .= " and t.status='$status'";
                    break;
                case 'i1': // 扫码签到
                case 'i2': // 手工签到
                case 'i3': // 现场报名
                    $status = substr($signin_status, 1);
                    $where .= " and t.signin_status='$status'";
                    break;
                case 'all':
                default:
                    break;
            }
        } else {
            switch($action){
                case 'signin_chart':
                    $where .= " and t.status>=2";
                    break;
                default:
                    break;
            }
        }

        $list = M('ActivitySignupUserinfo')->alias('i')
            ->join('ym_activity_user_ticket t on t.activity_guid = i.activity_guid and t.user_guid = i.user_guid')
            ->field('*, t.guid as tid, i.guid as guid')
            ->where($where)
            ->order('i.created_at ASC')
            ->page(I('get.p', '1'), C('NUM_PER_PAGE', null, 10))
            ->select();
        // 使用page类,实现分类
        $count      = M('ActivitySignupUserinfo')->alias('i')->join('ym_activity_user_ticket t on t.activity_guid = i.activity_guid and t.user_guid = i.user_guid')->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count, C('NUM_PER_PAGE', null, 10));// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        foreach($list as $k => $l){
            // 来源
            $from = C('ACTIVITY_SIGNUP_FROM');
            $list[$k]['from'] = $from[$l['type']];

            // 其它信息
            $other = M('ActivitySignupUserinfoOther')->where(array('signup_userinfo_guid' => $l['guid'], 'is_del' => '0'))->select();
            foreach($other as $other_k => $o) {
                $vals = explode('_____', $o['value']);
                if(count($vals) <= 1) {
                    $v_str = $o['value'];
                } else {
                    $v_str = implode(', ', $vals);
                }
                $other[$other_k]['value'] = $v_str;
            }
            $list[$k]['other'] = $other;

            // 票务相关
            $ticket_status = C('ACTIVITY_TICKET_STATUS');
            $ticket_signin_status = C('ACTIVITY_TICKET_SIGNIN_STATUS');
            $ticket_status_tag = C('ACTIVITY_TICKET_STATUS_TAG');
            $ticket['ticket_status'] = isset($ticket_signin_status[$l['signin_status']]) ? $ticket_signin_status[$l['signin_status']] : $ticket_status[$l['status']];
            $ticket['ticket_status_tag'] = $ticket_status_tag[$l['status']];
            $ticket['ticket_name'] = $l['ticket_name'];
            $ticket['ticket_guid'] = $l['ticket_guid'];
            $list[$k]['ticket'] = $ticket;
        }

        $this->assign('user_list', $list);
        $this->assign('user_count', D('ActivitySignupUserinfo')->alias('i')->join('ym_activity_user_ticket t on t.activity_guid = i.activity_guid and t.user_guid = i.user_guid')->get_count($where));
        $this->assign('page', $show);
        return array($show, $list);
    }

    /**
     * 后台手动添加报名人员
     * CT： 2015.02.09 09:50 by ylx
     */
    public function ajax_signup_add_user() {
        // 提交报名
        if(IS_POST) {
            $aid = I('get.aid');
                if(empty($aid) || strlen($aid) != 32) {
                    $this->ajaxReturn(array('status' => 'ko', 'msg' => '增加失败, 请稍后重试.'));
            }

//            $activity_id = M('Activity')->where('guid = "'.$aid.'"')->getField('id');
            $signup_info = D('ActivitySignup')->find_one(array('activity_guid' => $aid));

            $params = I('post.');
            if(empty($params)) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '增加失败, 请稍后重试.'));
            }

            $time = time();
            $user_guid = 'add_by_org_'.create_guid();
            // 保存userinfo
            $info = $params['info'];
            $data_info = array(
                'guid'          => create_guid(),
                'activity_guid' => $aid,
                'signup_guid'   => $signup_info['guid'],
                'user_guid'     => $user_guid,
                'type'          => '4',
                'created_at'    => $time,
                'updated_at'    => $time
            );
            $data_info = array_merge($data_info, $info);
            $model_userinfo = D('ActivitySignupUserinfo');
            list($check, $r) = $model_userinfo->insert($data_info);
            if(!$check) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => $r));
            }
            if(!$r) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '增加失败, 请稍后重试.'));
            }

            // 保存其它信息
            $other = $params['other'];
            $data_other = array();
            foreach($other as $o) {
                $data_other[] = array(
                    'guid'                 => create_guid(),
                    'signup_userinfo_guid' => $data_info['guid'],
                    'activity_guid'        => $aid,
                    'build_guid'           => $o['build_guid'],
                    'ym_type'              => $o['ym_type'],
                    'key'                  => $o['key'],
                    'value'                => is_array($o['value']) ? implode('_____', $o['value']) : (isset($o['value']) ? $o['value'] : ''),
                    'created_at'           => $time,
                    'updated_at'           => $time
                );
            }
            M('ActivitySignupUserinfoOther')->addAll($data_other);

            // 保存票务信息
            $data_ticket = array(
                'guid'          => create_guid(),
                'activity_guid' => $aid,
                'user_guid'     => $user_guid,
                'mobile'        => $info['mobile'],
                'ticket_guid'   => I('post.ticket', 'nolimit'),
                'ticket_name'   => I('post.ticket') != '' ? M('ActivityAttrTicket')->where(array('guid' => I('post.ticket')))->getField('name') : 'nolimit',
                'created_at'    => $time,
                'updated_at'    => $time
            );
            // 若为签到页添加,则直接自动签到成功
            $is_signin = I('get.signin');
            if(isset($is_signin)){
                $data_ticket['status'] = 4;
                $data_ticket['signin_status'] = 3;
                $data_ticket['ticket_code'] = substr($aid, 0, 4).date('YmdHis').'0365';
                $data_ticket['ticket_verify_time'] = 1;
            }
            M('ActivityUserTicket')->add($data_ticket);

            $this->ajaxReturn(array('status' => 'ok', 'msg' => '增加成功.', 'data' => array('mobile' => $info['mobile']) ));
        }
    }

    /**
     * 报名用户列表相关操作
     * CT: 2015-03-06 17:50 BY YLX
     */
    public function ajax_signup_userlist_batch_op() {
        if(IS_POST) {
            $info_guids = I('post.ck');
            $aid = I('get.aid');
            $act = I('post.batch_op');

            if(empty($info_guids)) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '请选择要操作的用户.'));
            }

            if(empty($aid) || empty($act)) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '非法操作, 请重试.'));
            }

            switch($act) {
                case 'batch_delete':
                    $user_guids = M('ActivitySignupUserinfo')->where(array('guid' => array('in', $info_guids)))->getField('user_guid', true);
                    $info = D('ActivitySignupUserinfo')->where(array('guid' => array('in', $info_guids)))->delete();
                    if($info) {
                        M('ActivitySignupUserinfoOther')->where(array('signup_userinfo_guid' => array('in', $info_guids)))->delete();
                        M('ActivityUserTicket')->where(array('activity_guid' => $aid, 'user_guid' => array('in', $user_guids)))->delete(); // 删除用户票务信息
                        $this->ajaxReturn(array('status' => 'ok', 'msg' => '删除成功.'));
                    }
                    break;
                default:
                    $this->ajaxReturn(array('status' => 'ko', 'msg' => '非法操作, 请重试.'));
                    break;
            }
        }

    }

    /**
     * 报名活动名单导出Excel
     * CT：2015.02.06 09:55 by ylx
     */
    public function signup_export() {
        $info_guids = I('post.ck');
        $aid = I('get.aid');
        $act = I('post.batch_op', 'export');

        if(empty($info_guids)) {
//            $this->ajaxReturn(array('status' => 'ko', 'msg' => '请选择要操作的用户.'));
            $this->error('请选择要操作的用户.');
        }

        if(empty($aid) || empty($act)) {
//            $this->ajaxReturn(array('status' => 'ko', 'msg' => '非法操作, 请重试.'));
            $this->error('非法操作, 请重试.');
        }
        // 获到表格大标题
        $activity_name = M('Activity')->where(array('guid' => $aid))->getField('name');
        $main_title = '活动人员列表：'.$activity_name;

        // 获取表格头
        $form_build = M('ActivitySignupFormBuild')->where(array('activity_guid' => $aid, 'is_del' => '0'))
            ->order('id asc')->getField('name', true);
        // 获取表格内容
        $user_info = M('ActivitySignupUserinfo')
            ->where(array('activity_guid' => $aid, 'guid'=>array('in', $info_guids), 'is_del' => '0'))
            ->select();
        $user_info_other = M('ActivitySignupUserinfoOther')
            ->where(array('activity_guid' => $aid, 'signup_userinfo_guid'=>array('in', $info_guids), 'is_del' => '0'))
            ->order('id asc')
            ->select();
        $data = array();
        foreach($user_info as $k => $info) {
            $data[$info['guid']][] = $info['real_name'];
            $data[$info['guid']][] = $info['mobile'];
        }
        foreach($user_info_other as $k => $other) {
            $data[$other['signup_userinfo_guid']][] = $other['value'];
        }

        return D('Excel')->export($main_title, $form_build, $data, date('YmdHis'), array(array('总人数: ', count($data))));
    }

    /**
     * 报名用户详情
     */
    public function signup_userdetail() {

        $userinfo_guid = I('get.uid');
        $info = D('ActivitySignupUserinfo')->where(array('guid' => $userinfo_guid, 'is_del' => '0'))->find();
        $other = M('ActivitySignupUserinfoOther')
            ->where(array('signup_userinfo_guid' => $userinfo_guid, 'is_del' => '0'))
            ->getField('build_guid, guid, value');
        $this->assign('info', $info);
        $this->assign('other', $other);

        // 组装form
        $user_guid = $info['user_guid'];
        $activity_guid = $info['activity_guid'];
        $activity_info = D('Activity')->find_one(array('guid' => $activity_guid));
        $signup_info = D('ActivitySignup')->find_one(array('activity_guid' => $activity_guid));

        //判断是否走票务
        $total_ticket = M('ActivityAttrTicket')->field('SUM(num) as total')
            ->where(array('activity_guid' => $activity_guid, 'is_del' => '0', 'is_for_sale' => '1'))
            ->find();
        if(intval($total_ticket['total']) > 0) { // 如果票务已经被设置， 走票务
            $tickets = M('ActivityAttrTicket')
                ->where(array('activity_guid' => $activity_guid, 'is_del' => '0', 'is_for_sale' => '1'))
                ->getField('guid, num, name', true);
            $this->assign('tickets', $tickets);

            // 当前用户所选的票务
            $user_ticket = M('ActivityUserTicket')->where(array('activity_guid' => $activity_guid, 'user_guid' => $info['user_guid']))->find();
            $this->assign('user_ticket', $user_ticket);
        }

        // 提交报名
        if(IS_POST) {
            $params = I('post.');
            if(empty($params) || empty($params['info']['real_name']) || empty($params['info']['mobile'])) {
                $this->error('保存失败，请稍后重试。');
            }

            $time = time();
            // 保存userinfo
            $info = $params['info'];
            $data_info = array_merge($info, array('updated_at' => $time));
            $model_userinfo = D('ActivitySignupUserinfo');
            list($check, $r) = $model_userinfo->update(array('guid' => $userinfo_guid), $data_info);
            if(!$check) {
                $this->error($r);
            }
            if(!$r) {
                $this->error('保存失败，请稍后重试.');
            }

            // 保存其它信息
            $other = $params['other'];
            if(!empty($other)){
                foreach($other as $o) {
                    $data_other = array(
                        'value' => is_array($o['value']) ? implode('_____', $o['value']) : (isset($o['value']) ? $o['value'] : ''),
                        'updated_at' => $time
                    );
                    M('ActivitySignupUserinfoOther')->where(array('guid' => $o['other_info_guid']))->save($data_other);
                }
            }

            // 保存票务信息
            $ticket_guid = I('post.ticket');
            $data_ticket = array(
                'ticket_guid' => !empty($ticket_guid) ? I('post.ticket') : 'nolimit',
                'ticket_name' => !empty($ticket_guid) ? $tickets[I('post.ticket')]['name'] : 'nolimit',
                'updated_at' => $time
            );
            M('ActivityUserTicket')->where(array('guid' => $user_ticket['guid']))->save($data_ticket);

            //时间轴-参加活动-报名
            $this->success('修改成功');exit();
        }

        $build_info   = D('ActivitySignupFormBuild')->where(array('signup_guid' => $signup_info['guid']))->order('id asc')->select();
        $option_info  = D('ActivitySignupFormOption')->where(array('signup_guid' => $signup_info['guid']))->field('guid,build_guid,value')->select();
        foreach($option_info as $o) {
            $format_option_info[$o['build_guid']][] = $o;
        }

        $this->assign('activity_info', $activity_info);
        $this->assign('signup_info', $signup_info);
        $this->assign('build_info', $build_info);
        $this->assign('option_info', $format_option_info);

        $this->assign('meta_title', '报名人员详情');
        $this->display();
    }

    /**
     * 删除报名人员
     */
    public function signup_userinfo_delete() {
        $userinfo_guid = I('get.uid');
        $aid = I('get.aid');
        $userinfo = M('ActivitySignupUserinfo')->where(array('guid' => $userinfo_guid))->find();
        M('ActivitySignupUserinfo')->where(array('guid' => $userinfo_guid))->delete(); // 删除用户信息
        M('ActivitySignupUserinfoOther')->where(array('signup_userinfo_guid' => $userinfo_guid))->delete(); // 删除用户其它信息
        M('ActivityUserTicket')->where(array('activity_guid' => $aid, 'user_guid' => $userinfo['user_guid']))->delete(); // 删除用户票务信息
        $this->redirect('Activity/signup_userinfo', array('aid'=>$aid));
    }

    /**
     * 发送电子票 短信/邮件
     * CT： 2015-03-11 15:50 by ylx
     */
    public function ajax_send_ticket() {
        // 提交报名
        if(IS_AJAX) {
            $aguid = I('get.aguid');
            $aid = I('get.aid');
            if(empty($aid) || empty($aguid) || strlen($aguid) != 32) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '发送失败, 请刷新后重试.'));
            }

            $params = I('post.');
            $info_guids   = $params['ck'];
            $send_type    = $params['send_type'];
            $send_way     = $params['send_way'];
            $send_content = $params['send_content'];
            $send_sign    = $params['send_sign'];
            $time = time();

            $userinfo = M('ActivitySignupUserinfo')->field('guid, mobile, real_name, user_guid')
                ->where(array('guid' => array('in', $info_guids)))
                ->order('id asc')
                ->select();
            $auth = $this->get_auth_session();

            // 判断发送类别
            switch($send_type) {
                case 'ticket':  // 发送电子票
                    $ticket_code = substr($aguid, 0, 4).date('YmdHis').'0910';
                    foreach ($userinfo as $m) {
                        // 更新票务信息
                        $ticket_info = M('ActivityUserTicket')->where(array('user_guid' => $m['user_guid'], 'activity_guid' => $aguid))->find();
                        // 当票已发送则跳过
                        if($ticket_info['status'] == '2' && !empty($ticket_info['ticket_code'])) {
                            continue;
                        }

                        $ticket_url = U('Mobile/Activity/ticket', array('aid' => $aguid, 'iid' => $m['guid']), true, true);
                        $ticket_short_url = get_short_url($ticket_url); // 长度20

                        if(in_array('sms', $send_way)) { // 发送SMS
                            $is_send_sms = true;
                            $content        = '【' . C('APP_NAME') . '】' . $send_content . ' 电子票地址：' . $ticket_short_url . ' ' . $send_sign;
                            $content_length = mb_strlen($content, 'utf8');
                            if ($content_length > 500) {
                                $this->ajaxReturn(array('status' => 'ko', 'msg' => '消息长度超限，请减少字后重试。'));
                            }

                            $sms        = new YmSMS();
                            $sms_result = $sms->sendsms($m['mobile'], $content);

                            if($sms_result['code'] == '0') { // 短信发送成功
                                $data_user_ticket = array('ticket_code' => $ticket_code, 'status'=>'2', 'updated_at' => $time);
                                $sms_status = 1;
                                $is_send = true;

                                // 更新社团短信余额
                                D('Org')->inc_and_dec($auth['org_guid'], 'num_sms', ceil($content_length/67), 2);

                            } else { // 短信发送失败
                                $data_user_ticket = array('ticket_code' => $ticket_code, 'status'=>'1', 'updated_at' => $time);
                            }
                        }

                        $email = '';
                        if(in_array('email', $send_way)) {
                            $is_send_email = true;
                            $email = M('ActivitySignupUserinfoOther')
                                ->where(array('activity_guid' => $aguid, 'signup_userinfo_guid' => $m['guid'], 'ym_type' => 'email'))
                                ->getField('value');
                            if(!empty($email) && is_valid_email($email)) {
                                // 发送邮箱
                                $content        = $send_content . ' 电子票地址：<a href="'.$ticket_short_url.'">' . $ticket_short_url . '</a> ' . $send_sign;
                                $email_result = send_email(array($email), $auth['org_name'], '用户电子票，来自：'.$auth['org_name'], $content);

                                if($email_result['status'] == 'success') { // 邮件发送成功
                                    $data_user_ticket = array('ticket_code' => $ticket_code, 'status'=>'2', 'updated_at' => $time);
                                    $email_status = 1;
                                    $is_send = true;
                                    // 更新社团邮件余额
                                    D('Org')->inc_and_dec($auth['org_guid'], 'num_email', 1, 2);
                                } else { // 邮件发送失败
                                    $data_user_ticket = array('ticket_code' => $ticket_code, 'status'=>'1', 'updated_at' => $time);
                                }
                            }
                        }

                        M('ActivityUserTicket')
                            ->where(array('user_guid' => $m['user_guid'], 'activity_guid' => $aguid))
                            ->save($data_user_ticket);

                        // 存储到notice表
                        if($sms_status || $email_status) {
                            $data_notice = array(
                                'guid'         => create_guid(),
                                'is_sms'       => isset($is_send_sms) ? true : false,
                                'is_email'     => isset($is_send_email) ? true : false,
                                'title'        => '电子票发送' . $ticket_code,
                                'from'         => $auth['org_name'],
                                'from_guid'    => $auth['user_guid'],
                                'from_type'    => 2,
                                'content'      => $content,
                                'to_mobile'    => $m['mobile'],
                                'to_email'     => $email,
                                'to_guid'      => $m['user_guid'],
                                'is_multiple'  => 0,
                                'sms_status'   => $sms_status,
                                'email_status' => $email_status,
                                'created_at'   => $time,
                                'updated_at'   => $time
                            );
                            M('Notice')->add($data_notice);
                        }

                        // 电子票数字自增
                        $ticket_code++;
                    }
                    break;
                case 'notice': // 发送通知
                    // 发送SMS
                    if(in_array('sms', $send_way)) {
                        $is_send_sms = true;
                        $content        = '【'.C('APP_NAME').'】' . $send_content . ' ' . $send_sign;
                        $content_length = mb_strlen($content, 'utf8');
                        if ($content_length > 500) {
                            $this->ajaxReturn(array('status' => 'ko', 'msg' => '消息长度超限，请减少字后重试。'));
                        }

                        $mobiles = M('ActivitySignupUserinfo')
                            ->where(array('guid' => array('in', $info_guids)))
                            ->order('id asc')
                            ->getField('mobile', true);
                        $to_mobiles = json_encode($mobiles, ',');
                        $mobiles = array_chunk($mobiles, 200);
                        $sms        = new YmSMS();
                        foreach($mobiles as $m) {
                            $sms_result = $sms->sendsms(json_encode(',', $m), $content);
                        }

                        if($sms_result['code'] == '0') { // 短信发送成功
                            $sms_status = 1;
                            $is_send = true;
                            // 更新社团短信余额
                            D('Org')->inc_and_dec($auth['org_guid'], 'num_sms', ceil($content_length/67), 2);
                        }
                    }
                    // 发送 email
                    if(in_array('email', $send_way)) {
                        $is_send_email = true;
                        $email_list = M('ActivitySignupUserinfoOther')
                            ->where(array('activity_guid' => $aguid, 'signup_userinfo_guid' => array('in', $info_guids), 'ym_type' => 'email'))
                            ->getField('value', true);
                        $to_email = json_encode($email_list, ',');
                        if(!empty($email_list)) {
                            $content        = $send_content . ' ' . $send_sign;
                            $email_result = send_email($email_list, $auth['org_name'], '用户通知，来自：'.$auth['org_name'], $content);

                            if($email_result['status'] == 'success') { // 邮件发送成功
                                $email_status = 1;
                                $is_send = true;
                                // 更新社团邮件余额
                                D('Org')->inc_and_dec($auth['org_guid'], 'num_email', count($email_list), 2);
                            }
                        }
                    }

                    // 存储到notice表
                    if($sms_status || $email_status) {
                        $data_notice = array(
                            'guid'         => create_guid(),
                            'is_sms'       => isset($is_send_sms) ? true : false,
                            'is_email'     => isset($is_send_email) ? true : false,
                            'title'        => '用户通知，来自：'.$auth['org_name'],
                            'from'         => $auth['org_name'],
                            'from_guid'    => $auth['user_guid'],
                            'from_type'    => 2,
                            'content'      => $content,
                            'to_mobile'    => isset($to_mobiles) ? $to_mobiles : '',
                            'to_email'     => isset($to_email) ? $to_email : '',
                            'to_guid'      => $m['user_guid'],
                            'is_multiple'  => 0,
                            'sms_status'   => isset($sms_status) ? $sms_status : 0,
                            'email_status' => isset($email_status) ? $email_status : 0,
                            'created_at'   => $time,
                            'updated_at'   => $time
                        );
                        M('Notice')->add($data_notice);
                    }

                    break;
                default:
                    $this->ajaxReturn(array('status' => 'ko', 'msg' => '提交错误，请刷新页面后重试。'));
                    break;
            }

            if($is_send == true) {
                $this->ajaxReturn(array('status' => 'ok', 'msg' => '发送成功'));
            } else {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '发送失败，请刷新页面后重试。'));
            }

        }
    }

    /**
     *  活动内容编辑页
     *
     * CT 2014-11-03 10:20 by RTH
     * UT 2014-11-21 10:20 by ylx
     */
    public function activity_edit()
    {
        $activity_guid = I('get.guid');
        if (empty($activity_guid)) {
            $this->error('活动不存在.');
        }
        $activity_info = D('Activity')->find_one(array('guid' => $activity_guid));
        if (empty($activity_guid)) {
            $this->error('活动不存在.');
        }

        if($activity_info['status'] != '0'){
            $this->error('活动正在进行中或已结束, 无法编辑.');
        }

        $subject_info = D('ActivitySubject')->find_one(array('guid' => $activity_info['subject_guid']));
        $this->assign('subject_info', $subject_info);
        $this->assign('activity_info', $activity_info);
        $this->assign('meta_title','编辑活动');

        switch($activity_info['type']){
            case self::ACTIVITY_ARTICLE:
                $this->_article_edit($activity_info, $subject_info);
                break;
            case self::ACTIVITY_VOTE:
                $this->_vote_edit($activity_info, $subject_info);
                break;
            case self::ACTIVITY_DISCUSS:
                $this->_discuss_edit($activity_info, $subject_info);
                break;
            case self::ACTIVITY_SIGNUP:
                $this->_signup_edit($activity_info, $subject_info);
                break;
            case self::ACTIVITY_QUESTIONNAIRE:
                $this->_question_edit($activity_info, $subject_info);
                break;
            default:
                $this->error('活动不存在.');
                exit();
                break;
        }

    }
    private function _article_edit($activity_info, $subject_info)
    {
        //获取session('auth')里面的登录信息
        $session_auth = $this->get_auth_session();

        if(IS_POST) {
            //获取系统时间
            $time = time();
            $subject_guid = $activity_info['subject_guid'];

            //后台验证文章内容
            if (I('post.content') == ""){
                $this->error('内容不能为空');
            }
            //后台验证文章开始时间
            if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                $this->error('开始时间不能早于主题开始时间');
            }
            //后台验证文章开始时间
            if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                $this->error('结束时间不能晚于主题结束时间');
            }
            //***************存储活动表数据******************
            $data_activity = $this->_update_activity(self::ACTIVITY_ARTICLE, $activity_info['guid']);

            //***************存储文章表数据******************
            $data_article = array(
                'name'       => I('post.name'),
                'content'    => I('post.content'),
                'start_time' => strtotime(I('post.startTime')),
                'end_time'   => strtotime(I('post.endTime')),
                'status'     => I('post.status'),
                'updated_at' => $time
            );
            list($check, $r) = D('ActivityArticle')->update(array('activity_guid'=>$activity_info['guid']),$data_article);
            if (!$check){
                $this->error($r);exit();
            }
            if (!$r){
                $this->error('活动保存失败, 请稍后重试.');
            }

            // 清空缓存
            session('session_subject', null);
            // 发送通知
            if(I('post.status') == '1'){
                $this->_send_notice($data_activity['org_group_guid'], $data_activity['name'], $activity_info['guid']);
            }

            $this->success('活动保存成功',U('Activity/activity_view', array('guid'=>$activity_info['guid'])));
            exit();
        }


        //设置where条件
        $where = 'is_del = 0 AND org_guid = "' . $session_auth['org_guid'] . '"';
        $group_list = D('OrgGroup')->find_all($where);

        $article_info = D('ActivityArticle')->find_one(array('activity_guid'=>$activity_info['guid']));

        $this->assign('article_info', $article_info);
        $this->assign('group_list',$group_list);
        $this->display('article_edit');
    }

    private function _discuss_edit($activity_info, $subject_info)
    {
        //获取session('auth')里面的登录信息
        $session_auth = $this->get_auth_session();
        // 获取群组数据
        $discuss_group_info = D('GroupOrgDisc')->find_one(array('activity_guid'=>$activity_info['guid']));

        if(IS_POST) {
            //获取系统时间
            $time = time();

            //后台验证文章开始时间
            if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                $this->error('活动开始时间不能早于主题开始时间');
            }
            //后台验证文章开始时间
            if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                $this->error('活动结束时间不能晚于主题结束时间');
            }
            //***************存储活动表数据******************
            //活动社团组guid
            $data_activity['org_group_guid'] = I('post.OGGuid');
            //活动名字
            $data_activity['name'] = I('post.name');
            //活动发布状态
            $data_activity['status'] = I('post.status');
            //获取活动开始时间
            $data_activity['start_time'] = strtotime(I('post.startTime'));
            //获取活动结束时间
            $data_activity['end_time'] = strtotime(I('post.endTime'));
            //活动表中创建时间
            $data_activity['udpated_at'] = $time;

            if($data_activity['status']=='1'){
                $data_activity['published_at'] = $time;
            }

            $model_activity = D('Activity');
            $check = $model_activity->create($data_activity);
            if (!$check){
                $this->error($model_activity->getError());exit();
            }
            //将活动数据添加到活动数据表
            $r =$model_activity->where(array('guid'=>$activity_info['guid']))->save();
            if (empty($r)){
                //错误跳转到活动添加页面
                $this->error('活动保存失败, 请稍后重试.');
            }

            //***************存储讨论组表数据******************
            $data_discuss = array(
                'name'          => I('post.name'),
                'content'       => I('post.content'),
                'start_time'    => strtotime(I('post.startTime')),
                'end_time'      => strtotime(I('post.endTime')),
                'updated_at'    => $time,
                'status'        => I('post.status')
            );

            $r = D('GroupOrgDisc')->where(array('activity_guid'=>$activity_info['guid']))->save($data_discuss);
            if (empty($r)){
//                $model_activity->_delete(array('guid'=>$data_activity['guid']));
                //如果错误跳转到添加活动页面
                $this->error('活动保存失败, 请稍后重试.');
            }

            // 如果分组修改, 则注销旧分组, 注册新分组
            $old_group_guid = $activity_info['org_group_guid'];
            $new_group_guid = I('post.OGGuid');
            if($new_group_guid != $old_group_guid)
            {
                // 删除旧群组成员
                D('GroupOrgDiscMembers')->where(array('group_disc_guid'=>$discuss_group_info['guid']))->delete();
                // 注销环信讨论组
                $chat = new YmChat();
                $chat->deleteGroups($discuss_group_info['chat_group_id']);

                // 保存讨论组成员
                $member_guids = D('Org')->get_member_guid_by_group($subject_info['org_guid'], $new_group_guid);
                if (!empty($member_guids)) {
                    foreach ($member_guids as $user_guid) {
                        $data_members[] = array(
                            'guid'            => create_guid(),
                            'user_guid'       => $user_guid,
                            'group_disc_guid' => $discuss_group_info['guid'],
                            'updated_at'      => $time,
                            'created_at'      => $time
                        );
                    }
                    //________________________________________________________________
                    $r = M('GroupOrgDiscMembers')->addAll($data_members);
                }

                //注册环信群组
                $options = array(
                    'groupname' => $discuss_group_info['guid'],
                    'desc'      => $discuss_group_info['content'],
                    'public'    => false,
                    'owner'     => $discuss_group_info['creater_guid']
                );
                if (!empty($member_guids)) {
                    $options['members'] = $member_guids;
                }
                $r = $chat->createGroups($options);
                // 保存chat_group_id
                $chat_group_id = $r['data']['groupid'];
                //______________________________________________________________________RTH
                D('GroupOrgDisc')->set_field(array('guid'=>$discuss_group_info['guid']),array('chat_group_id'=>$chat_group_id));
            }
            // 清空缓存
            session('session_subject', null);

            // 发送通知
            if(I('post.status') == '1'){
                $this->_send_notice($data_activity['org_group_guid'], $data_activity['name'], $activity_info['guid']);
            }

            //如果成功并且不继续添加跳转到主题列表页面
            $this->success('活动保存成功',U('Activity/activity_view', array('guid'=>$activity_info['guid'])));
            exit();
        }


        //设置where条件
        $where = 'is_del = 0 AND org_guid = "' . $session_auth['org_guid'] . '"';
        $group_list = M('OrgGroup')->where($where)->select();

        $this->assign('discuss_group_info', $discuss_group_info);
        $this->assign('group_list',$group_list);
        $this->display('discuss_edit');
    }
    private function _vote_edit($activity_info, $subject_info)
    {
        //获取session('auth')里面的登录信息
        $session_auth = $this->get_auth_session();
        $vote_info = D('ActivityVote')->find_one(array('activity_guid'=>$activity_info['guid']));
        $option_info = D('ActivityVoteOption')->find_all(array('vote_guid'=>$vote_info['guid']));

        if(IS_POST) {
            //获取系统时间
            $time = time();

            //后台验证文章开始时间
            if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                $this->error('活动开始时间不能早于主题开始时间');
            }
            //后台验证文章开始时间
            if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                $this->error('活动结束时间不能晚于主题结束时间');
            }
            $options = I('post.options');
            if(empty($options)){
                $this->error('选项内容不能为空.');
            }

            $picUrl = I('post.picurls');
            //***************存储活动表数据******************
            $data_activity = $this->_update_activity(self::ACTIVITY_VOTE, $activity_info['guid']);

            //***************存储投票表数据******************
            $data_vote = array(
                'name'          => I('post.name'),
                'content'       => I('post.content'),
                'is_multiple'   => I('post.is_multiple'),
                'multiple_num'  => I('post.max_choice', '0'),
                'is_anony'      => I('post.is_anony', '0'),
                'updated_at'    => $time
            );

            $artRes = D('ActivityVote')->where(array('activity_guid'=>$activity_info['guid']))->save($data_vote);
            if (empty($artRes)){
//                $model_activity->_delete(array('guid'=>$data_activity['guid']));
                //如果错误跳转到添加活动页面
                $this->error('活动添加失败, 请稍后重试.');
            }

            //删除旧选项
            D('ActivityVoteOption')->_delete(array('vote_guid'=>$vote_info['guid']), '1');
            // 存储选项内容
            foreach($options as $key=>$o){
                $data[] = array(
                    'guid'       => create_guid(),
                    'vote_guid'  => $vote_info['guid'],
                    'content'    => $o,
                    'pic_url'    => $picUrl[$key],
                    'created_at' => $time,
                    'updated_at' => $time
                );
            }
            D('ActivityVoteOption')->insert_all($data);

            // 清空缓存
            session('session_subject', null);

            // 发送通知
            if(I('post.status') == '1'){
                $this->_send_notice($data_activity['org_group_guid'], $data_activity['name'], $activity_info['guid']);
            }

            //如果成功并且不继续添加跳转到主题列表页面
            $this->success('活动保存成功',U('Activity/activity_view', array('guid'=>$activity_info['guid'])));
            exit();
        }

        //设置where条件
        $where = 'is_del = 0 AND org_guid = "' . $session_auth['org_guid'] . '"';
        $group_list = M('OrgGroup')->where($where)->select();

        $this->assign('vote_info',$vote_info);
        $this->assign('option_info',$option_info);
        $this->assign('group_list',$group_list);
        $this->display('vote_edit');
    }
    public function _signup_edit($activity_info, $subject_info) {
        $activity_guid = $activity_info['guid'];
        //获取session('auth')里面的登录信息
        $session_auth = $this->get_auth_session();
        $signup_info  = D('ActivitySignup')->find_one(array('activity_guid' => $activity_guid));
        $build_info   = D('ActivitySignupFormBuild')->where(array('signup_guid' => $signup_info['guid']))->order('id asc')->select();
        $option_info  = D('ActivitySignupFormOption')->where(array('signup_guid' => $signup_info['guid']))->field('guid,build_guid,value')->select();
        foreach($option_info as $o) {
            $format_option_info[$o['build_guid']][] = $o;
        }
        // 承办机构
        $this->assign('undertaker', M('ActivityAttrUndertaker')->where(array('activity_guid' => $activity_guid, 'is_del' => '0'))->order('id asc')->select());
        // 活动流程
        $this->assign('flow', M('ActivityAttrFlow')->where(array('activity_guid' => $activity_guid, 'is_del' => '0'))->order('id asc')->select());
        // 票务
        $ticket = M('ActivityAttrTicket')->where(array('activity_guid' => $activity_guid, 'is_del' => '0'))->order('id asc')->select();
        foreach($ticket as $k => $t) {
            $user_width_this_ticket = M('ActivityUserTicket')->field('guid')->where(array('ticket_guid' => $t['guid'], 'status' => '2', 'is_del' => '0'))->count();
            $ticket[$k]['num_used'] = $user_width_this_ticket;
        }
        $this->assign('ticket', $ticket);
        if(IS_POST) {
            //后台验证文章内容
            if (I('post.content') == ""){
                $this->error('内容不能为空');
            }
            //后台验证文章开始时间
            if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                $this->error('活动开始时间不能早于主题开始时间');
            }
            //后台验证文章开始时间
            if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                $this->error('活动结束时间不能晚于主题结束时间');
            }
            //***************存储活动表数据******************
            $data_activity = $this->_update_activity(self::ACTIVITY_SIGNUP, $activity_info['guid']);
            //***************存储报名表数据******************
            $time = time();
            // 判断报名的开始时间和结束时间
            $start = I('post.start');
            if(empty($start)) {
                if (I('post.status') == '1') {
                    $start = $time;
                } else {
                    $start = '';
                }
            } else {
                $start = strtotime($start);
            }
            $end = I('post.end');
            if(empty($end)) {
                $end = strtotime(I('post.endTime'))-3600;
            } else {
                $end = strtotime($end);
            }

            $num_person = trim(I('post.num_person'));
            $data_signup = array(
                'name'          => trim(I('post.name')),
                'content'       => I('post.content'),
                'start'         => $start,
                'end'           => $end,
                'poster'        => I('post.poster'),
                'start_time'    => strtotime(I('post.startTime')),
                'end_time'      => strtotime(I('post.endTime')),
                'areaid_1'      => I('post.areaid_1'),
                'areaid_1_name' => get_area(I('post.areaid_1')),
                'areaid_2'      => I('post.areaid_2'),
                'areaid_2_name' => get_area(I('post.areaid_2')),
                'address'       => trim(I('post.address')),
                'lng'           => trim(I('post.lng')),
                'lat'           => trim(I('post.lat')),
                'keyword'       => trim(I('post.keyword')),
                'num_person'    => (empty($num_person) || $num_person=='0' || !is_numeric($num_person)) ? 0 : $num_person,
                'status'        => I('post.status'),
                'is_public'     => I('post.is_public'),
                'updated_at'    => $time
            );
            list($check, $r) =  D('ActivitySignup')->update(array('guid' => $signup_info['guid']), $data_signup);
            if (!$check){
                $this->error($r);exit();
            }
            if (!$r){
                //如果错误跳转到添加活动页面
                $this->error('活动保存失败, 请稍后重试.');
            }

            // ************** 编辑 承办机构 **************
            M('ActivityAttrUndertaker')->where(array('activity_guid' => $activity_guid))->delete();
            $undertakers = I('post.op_undertaker');
            if(!empty($undertakers)) {
                $data_undertakers = array();
                foreach($undertakers as $k => $u) {
                    $data_undertakers[$k] = array(
                        'guid'          => create_guid(),
                        'activity_guid' => $activity_guid,
                        'type'          => $u['type'],
                        'name'          => $u['name'],
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                }
                M('ActivityAttrUndertaker')->addAll($data_undertakers);
            }

            // ************** 编辑 活动流程 **************
            M('ActivityAttrFlow')->where(array('activity_guid' => $activity_guid))->delete();
            $flow = I('post.op_flow');
            if(!empty($flow)) {
                $data_flow = array();
                foreach($flow as $k => $f) {
                    $data_flow[$k] = array(
                        'guid' => create_guid(),
                        'activity_guid' => $activity_guid,
                        'title' => $f['title'],
                        'content' => $f['content'],
                        'start_time' => !empty($f['start_time']) ? strtotime($f['start_time']) : '',
                        'end_time' => !empty($f['end_time']) ? strtotime($f['end_time']) : '',
                        'created_at' => $time,
                        'updated_at' => $time
                    );
                }
                M('ActivityAttrFlow')->addAll($data_flow);
            }

            // ************** 编辑 票务 **************
            $tickets = I('post.op_ticket');
            if(!empty($tickets)) {
                $model_ticket = M('ActivityAttrTicket');
                $time = time();
                if(!empty($tickets['old'])){
                    foreach($tickets['old'] as $t) {
                        $t['updated_at'] = $time;
                        $model_ticket->where(array('guid' => $t['guid']))->save($t);
                    }
                }
                if(!empty($tickets['new'])) {
//                $data_ticket = array();
                    foreach($tickets['new'] as $k => $t) {
                        $data_ticket = array(
//                    $data_ticket[] = array(
                            'guid'          => create_guid(),
                            'activity_guid' => $activity_guid,
                            'name'          => $t['name'],
                            'num'           => $t['num'],
                            'verify_num'    => $t['verify_num'],
                            'is_for_sale'   => $t['is_for_sale'],//isset($t['is_for_sale']) ? '1' : '0',
                            'created_at'    => $time,
                            'updated_at'    => $time
                        );
                        $model_ticket->add($data_ticket);
                    }
//                $r = $model_ticket->addAll($data_ticket, array(), true);
                }

//            if(!empty($tickets)) {
//                $data_ticket = array();
//                foreach($tickets as $k => $t) {
//                    $data_ticket[$k] = array(
//                        'guid'          => create_guid(),
//                        'activity_guid' => $activity_guid,
//                        'name'          => $t['name'],
//                        'num'           => $t['num'],
//                        'verify_num'    => $t['verify_num'],
//                        'is_for_sale'   => isset($t['is_for_sale']) ? '1' : '0',
//                        'created_at'    => $time,
//                        'updated_at'    => $time
//                    );
//                }
//                M('ActivityAttrTicket')->addAll($data_ticket);
//            }
            }

            //************** 删除旧表名表单 *************
            $signup_guid = $signup_info['guid'];
            D('ActivitySignupFormBuild')->phy_delete(array('signup_guid' => $signup_guid));
            D('ActivitySignupFormOption')->phy_delete(array('signup_guid' => $signup_guid));
            //************** 创建表名表单 *************
            $data_build = array();
            $data_build[] = array( // 姓名
                'guid'          => create_guid(),
                'signup_guid'   => $signup_guid,
                'activity_guid' => $activity_guid,
                'name'          => I('post.real_name'),
                'note'          => I('post.real_name_note'),
                'ym_type'       => 'real_name',
                'html_type'     => 'text',
                'is_required'   => 1,
                'is_info'       => 1,
                'created_at'    => $time,
                'updated_at'    => $time
            );
            $data_build[] = array( //手机
                'guid'          => create_guid(),
                'signup_guid'   => $signup_guid,
                'activity_guid' => $activity_guid,
                'name'          => I('post.mobile'),
                'note'          => I('post.mobile_note'),
                'ym_type'       => 'mobile',
                'html_type'     => 'text',
                'is_required'   => 1,
                'is_info'       => 1,
                'created_at'    => $time,
                'updated_at'    => $time
            );
            $items = I('post.items');
            if(!empty($items)) { //其它
                $data_options = array();
                foreach($items as $i) {
                    if(isset($i['name'])) {
                        $buid_guid    = create_guid();
                        $data_build[] = array(
                            'guid'          => $buid_guid,
                            'signup_guid'   => $signup_guid,
                            'activity_guid' => $activity_guid,
                            'name'          => $i['name'],
                            'note'          => $i['note'],
                            'ym_type'       => $i['ym_type'],
                            'html_type'     => $i['html_type'],
                            'is_info'       => 0, //$i['is_info'],
                            'is_required'   => isset($i['is_required']) ? $i['is_required'] : 0,
                            'created_at'    => $time,
                            'updated_at'    => $time
                        );
                        if (!empty($i['options'])) {
                            foreach ($i['options'] as $o) {
                                $data_options[] = array(
                                    'guid'        => create_guid(),
                                    'signup_guid' => $signup_guid,
                                    'build_guid'  => $buid_guid,
                                    'value'       => $o,
                                    'created_at'  => $time,
                                    'updated_at'  => $time
                                );
                            }
                        }
                    }
                }
            }
            if(!empty($data_build)) {
//                $r = M('ActivitySignupFormBuild')->addAll($data_build);
                foreach($data_build as $db) {
                    M('ActivitySignupFormBuild')->add($db);
                }
            }
            if(!empty($data_options)) {
                M('ActivitySignupFormOption')->addAll($data_options);
            }

            // 清空缓存
            session('session_subject', null);

            // 发送通知
            if(I('post.status') == '1'){
                $this->_send_notice($data_activity['org_group_guid'], $data_activity['name'], $activity_guid);
            }

            //如果成功并且不继续添加跳转到主题列表页面
            $this->success('活动保存成功',U('Activity/activity_view', array('guid'=>$activity_guid)));
            exit();

        }

        //地区
        $this->assign('area_1', D('Area')->find_all('deep=1', 'id, name'));
        $this->assign('area_2', D('Area')->find_all(array('parent_id'=>$signup_info['areaid_1']), 'id, name'));
        $this->assign('group_list', M('OrgGroup')->where('is_del = 0 AND org_guid = "' . $session_auth['org_guid'] . '"')->select());
        $this->assign('signup_info', $signup_info);
        $this->assign('build_info', $build_info);
        $this->assign('option_info', $format_option_info);
        $this->display('signup_edit');
    }
    
    public function _question_edit($activity_info, $subject_info) {
        $activity_guid = $activity_info['guid'];
        //获取session('auth')里面的登录信息
        $session_auth = $this->get_auth_session();
        $where = 'is_del = 0 AND org_guid = "' . $session_auth['org_guid'] . '"';
        $group_list = D('OrgGroup')->find_all($where);

        if(IS_POST){
           //***************验证日期是否合法******************
           $this->check_activity_time($subject_info);
           //***************存储活动表数据********************
           $data_activity = $this->_update_activity(self::ACTIVITY_QUESTIONNAIRE, $activity_info['guid']);
           //***************修改问卷信息*********************
           $res_topic_data = $this->handle_question($activity_guid);
           if(M('ActivityQuestion')->inserUp($res_topic_data['question_data'])){
               if(M('ActivityQuestionTopic')->inserUpAll($res_topic_data['topic_data'])){
                   if(M('ActivityQuestionOption')->inserUpAll($res_topic_data['option_data'])){
                       session('session_subject', null);// 清空缓存
                       // 发送通知
                       if(I('post.status') == '1'){
                           $this->_send_notice($data_activity['org_group_guid'], $data_activity['name'], $activity_info['guid']);
                       }
                       $this->success('活动保存成功',U('Activity/activity_view', array('guid'=>$activity_guid)));
                       exit();
                   }
               }
           }
        }
        
        $question_info = M('ActivityQuestion')->where(array('activity_guid'=>$activity_guid))->find();
        $topic_info = M('ActivityQuestionTopic')
                       ->where(array('question_guid'=>$question_info['guid']))
                       ->order('sort ASC')
                       ->select();
        $option_info = M('ActivityQuestionOption')
                        ->where(array('question_guid'=>$question_info['guid']))
                        ->order('sort ASC')
                        ->select();
        
        foreach($topic_info as $key=>$value){
            foreach($option_info as $k=>$v){
                if($value['guid']== $v['topic_guid']){
                    $topic_info[$key]['option'][] = $v;
                }
            }
        }
        $this->assign('group_list',$group_list);
        $this->assign('question_info',$question_info);
        $this->assign('topic_info',$topic_info);
        $this->display('questionnaire_edit');
    }
    
    public function ques_del_topic(){
        if(IS_AJAX){
            $topic_guid = I('post.tid');
            if(M('ActivityQuestionTopic')->where(array('guid'=>$topic_guid))->delete()){
                if(M('ActivityQuestionOption')->where(array('topic_guid'=>$topic_guid))->delete()){
                    $this->ajaxReturn(array('status'=>'ok'));
                }else{
                    $this->ajaxReturn(array('status'=>'ko', 'msg'=>'选项删除失败, 请重试'));
                }
            }else{
                $this->ajaxReturn(array('status'=>'ko', 'msg'=>'题目删除失败, 请重试'));
            }
        }else{
            $this->error('非法操作 ');
        }
    }
    
    public function ques_del_option(){
        if(IS_AJAX){
            $option_guid = I('post.oid');
            if(M('ActivityQuestionOption')->where(array('guid'=>$option_guid))->delete()){
                $this->ajaxReturn(array('status'=>'ok'));
            }else{
                $this->ajaxReturn(array('status'=>'ko', 'msg'=>'选项删除失败, 请重试'));
            }
        }else{
            $this->error('非法操作 ');
        }
    }
    
    private function check_activity_time($subject_info){
        //后台验证文章开始时间
        if (strtotime(I('post.startTime')) < $subject_info['start_time']){
            $this->error('活动开始时间不能早于主题开始时间');
        }
        //后台验证文章开始时间
        if (strtotime(I('post.endTime')) > $subject_info['end_time']){
            $this->error('活动结束时间不能晚于主题结束时间');
        }
    }
    
    private function handle_question($activity_guid=''){
        $time = time();
        $param_topic = I('post.topic');
        $question_data = $topic_data = $option_data = $option_arrange_data = array();
        //拼装Question数据
        $question_data['guid'] = I('post.qguid') ? I('post.qguid') : create_guid();
        $question_data['name'] = I('post.name');
        $question_data['is_public'] = I('post.is_public');
        $question_data['description'] = I('post.description');
        $question_data['conclusion'] = I('post.conclusion');
        if(!I('post.qguid')) $question_data['created_at'] = $time;
        $question_data['updated_at'] = $time;
        if(I('post.sguid')) $question_data['subject_guid'] = I('post.sguid');
        $question_data['activity_guid'] = empty($activity_guid) ? I('post.guid') : $activity_guid;
        
        foreach($param_topic as $key=>$value){
            //拼装Topic数据
            $topic_data[$key]['guid'] = $value ['topic_guid'] ? $value ['topic_guid'] : create_guid();
            $topic_data[$key]['name'] = $value ['topic_title'];
            $topic_data[$key]['type'] = $value ['topic_type'];
            $topic_data[$key]['sort'] = $value ['topic_sort'];
            //if(empty($value ['topic_guid'])) $topic_data[$key]['created_at'] = $time;
            $topic_data[$key]['updated_at'] = $time;
            $topic_data[$key]['question_guid'] = $question_data['guid'];
            foreach($value['option'] as $k=>$v){
                //拼装Option数据
                $option_data[$key][$k]['guid'] = $v['guid'] ? $v['guid'] : create_guid();
                $option_data[$key][$k]['option'] = $v['title'];
                $option_data[$key][$k]['sort'] = $v['sort'];
                //if(empty($v['guid'])) $option_data[$key][$k]['created_at'] = $time;
                $option_data[$key][$k]['updated_at'] = $time;
                $option_data[$key][$k]['topic_guid'] = $topic_data[$key]['guid'];
                $option_data[$key][$k]['question_guid'] = $question_data['guid'];
            }
        }
        
        foreach($option_data as $key=>$value){
            foreach($value as $k=>$v){
                $option_arrange_data[] = $v;
            }
        }
        return array('question_data'=>$question_data,'topic_data'=>$topic_data,'option_data'=>$option_arrange_data);
    }

    
    /**
     * 关闭活动
     * CT 2015.02.12 15:37 by ylx
     */
    public function close() {
        $aid = I('get.guid');
        if(empty($aid)){
            $this->error('活动不存在.');
        }
        $activity_info = D('Activity')->find_one(array('guid'=>$aid));
        if(empty($activity_info)){
            $this->error('活动不存在.');exit();
        }
        if($activity_info['status'] != '1'){
            $this->error('活动未发布或已结束, 无法关闭.');exit();
        }

        //删除活动
        $res = D('Activity')->where(array('guid'=>$aid))->save(array('status' => '3', 'updated_at' => time()));
        if(empty($res)){
            $this->error('活动关闭失败, 请稍后重试');exit();
        }
        $this->success('操作功成！');
    }


    /**
     * 删除活动
     * CT 2014-11-03 10:20 by  RTH
     * UT 2014-11-21 10:20 by ylx
     */
    public function activity_del()
    {
        $activity_guid = I('get.guid');
        if(empty($activity_guid)){
            $this->error('活动不存在.');
        }
        $activity_info = D('Activity')->find_one(array('guid'=>$activity_guid));
        if(empty($activity_info)){
            $this->error('活动不存在.');exit();
        }
        if($activity_info['status'] != '0'){
            $this->error('活动正在进行中或已结束, 无法删除.');exit();
        }

        //删除活动
        $res = D('Activity')->soft_delete(array('guid'=>$activity_guid));//->save($data);
        if(empty($res)){
            $this->error('活动删除失败, 请稍后重试');exit();
        }

        switch($activity_info['type']){
            case self::ACTIVITY_ARTICLE:
                //删除文章
                M('ActivityArticle')->where(array('activity_guid'=>$activity_guid))->delete();//->save($data);
                break;
            case self::ACTIVITY_VOTE:
                //删除投票
                $vote_info = D('ActivityVote')->find_one(array('activity_guid'=>$activity_guid));
                D('ActivityVote')->soft_delete(array('activity_guid'=>$activity_guid));//->save($data);
                D('ActivityVoteOption')->soft_delete(array('vote_guid'=>$vote_info['guid']));
                break;
            case self::ACTIVITY_DISCUSS:
                $discuss_group_info = D('GroupOrgDisc')->find_one(array('activity_guid'=>$activity_guid));
                D('GroupOrgDisc')->soft_delete(array('activity_guid'=>$activity_guid));
                D('GroupOrgDiscMembers')->soft_delete(array('group_disc_guid'=>$discuss_group_info['guid']));
                // 删除环信分组
                $chat = new YmChat();
                $chat->deleteGroups($discuss_group_info['chat_group_id']);
                break;
            case self::ACTIVITY_SIGNUP:
                D('ActivitySignup')->soft_delete(array('activity_guid' => $activity_guid));
                break;
            default:
                $this->error('活动不存在.');exit();
                break;
        }

        $this->success('活动删除成功',U('Activity/activity_list', array('sguid'=>$activity_info['subject_guid'])));
    }

    /**
     *  检查活动是否超过等级配置
     *  @Param String type
     *  @return bool
     *
     *  CT 2014-12-16 09:31 by QXL
     */
    public function check_activity_num($type=''){
        $auth = $this->get_auth_session();
        $vip_config = $this->get_vip_info();
        $today = strtotime(today);
        $where=array('created_at'=>array('GT', $today),'org_guid'=>$auth['org_guid']);
        if($type == 'published'){
            $where['status'] = '1';
        }
        $count = count(M('Activity')->where($where)->select());

        if($type == 'published'){
            return  $count >= $vip_config['NUM_ACTIVITY_PUBLISH_PER_DAY'];
        }

        return  $count >= $vip_config['NUM_ACTIVITY_PER_DAY'];
    }

    private function _add_subject($save_subject, $org_guid, $subject_info) {
        if ($save_subject) {
            //活动主题所对应的社团组
            $subject_info['org_guid'] = $org_guid;
            //将主题数据存储到数据库
            list($check, $r) = D('ActivitySubject')->insert($subject_info);
            if (!$check){
                $this->error($r, U('Activity/subject_add'));exit();
            }
            //保存错误跳转到活动添加页面
            if (!$r){
                //错误跳转到添加主题页面
                $this->error('主题失败, 请稍后重试.', U('Activity/subject_add'));
            }
        }
    }
    private function _update_activity($type, $activity_guid) {
        $time = time();
        $data_activity = array(
            'org_group_guid' => I('post.OGGuid'),
            'name'           => trim(I('post.name')),
            'status'         => I('post.status'),
            'poster'         => I('post.poster'),
            'type'           => $type,
            'start_time'     => strtotime(I('post.startTime')),
            'end_time'       => strtotime(I('post.endTime')),
            'is_public'      => I('is_public', 0),
            'updated_at'     => $time,
        );
        if($data_activity['status']=='1'){
            $data_activity['published_at'] = $time;
        }
        $model_activity = D('Activity');
        $condition = array('guid'=>$activity_guid);
        list($check, $r) =  $model_activity->update($condition, $data_activity);
        if (!$check){
            $this->error($r);exit();
        }
        if (!$r){
            //错误跳转到活动添加页面
            $this->error('活动编辑失败, 请稍后重试.');
        }
        return $data_activity;
    }
    private function _add_activity($type, $org_guid, $subject_guid) {
        $time = time();
        $data_activity = array(
            'guid'           => create_guid(),
            'org_group_guid' => I('post.OGGuid'),
            'org_guid'       => $org_guid,
            'subject_guid'   => $subject_guid,
            'name'           => I('post.name'),
            'status'         => I('post.status'),
            'poster'         => I('post.poster', ''),
            'type'           => $type,
            'is_public'      => I('post.is_public', 0),
            'start_time'     => strtotime(I('post.startTime')),
            'end_time'       => strtotime(I('post.endTime')),
            'created_at'     => $time,
            'updated_at'     => $time,
        );
        if($data_activity['status']=='1'){
            //判断发布数是否超过配置
            if($this->check_activity_num('published')){
                $data_activity['status'] = '0';
                $add_peak = true;
            }
            $data_activity['published_at'] = $time;
        }
        $model_activity = D('Activity');
        list($check, $r) =  $model_activity->insert($data_activity);
        if (!$check){
            $this->error($r);exit();
        }
        //保存错误跳转到活动添加页面
        if (!$r){
            $this->error('活动添加失败, 请稍后重试.');
        }
        return array($add_peak, $data_activity);
    }

    public function activity_add(){
        //判断创建数是否超过配置
        if($this->check_activity_num()){
            $this->error('今天已经不能新建更多活动了', U('Activity/index'));
        }

        $subject_guid = I('get.sguid');
        $add_peak = false;
        if (!empty($subject_guid)){
            $save_subject = false;
            $subject_info = D('ActivitySubject')->find_one(array('guid'=>$subject_guid));
            if(empty($subject_info)) {
                //获取session里面的主题列表数据
                $subject_info = session('session_subject');
                if(empty($subject_info)){
                    $this->error('主题不存在.', U('Activity/index'));
                }
                $save_subject = true;
                $subject_guid = $subject_info['guid'];
            }
        } else {
            //获取session里面的主题列表数据
            $subject_info = session('session_subject');
            if(empty($subject_info)){
                $this->error('主题不存在.', U('Activity/index'));
            }
            $save_subject = true;
            $subject_guid = $subject_info['guid'];
        }

        if(empty($subject_guid)){
            $this->error('主题不存在', U('Activity/index'));
        }
        //获取session('auth')里面的登录信息
        $session_auth = $this->get_auth_session();
        $org_guid = $session_auth['org_guid'];
        //获取系统时间
        $time = time();

        // 相关保存操作 --- start
        $type = I('get.type');
        switch(intval($type)) {
            case self::ACTIVITY_QUESTIONNAIRE:
                    $template = 'questionnaire_add';
                    if(IS_POST){
                        //后台验证文章开始时间
                        if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                            $this->error('活动开始时间不能早于主题开始时间');
                        }
                        //后台验证文章开始时间
                        if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                            $this->error('活动结束时间不能晚于主题结束时间');
                        }
                        //************* 保存主题 *************
                        $this->_add_subject($save_subject, $org_guid, $subject_info);
                        
                        //***************存储活动表数据******************
                        list($add_peak, $data_activity) = $this->_add_activity(self::ACTIVITY_QUESTIONNAIRE, $org_guid, $subject_guid);
                        
                        $param_topic = I('post.topic');
                        $question_data = $topic_data = $option_data = $option_arrange_data = array();
                        //拼装Question数据
                        $question_data['guid'] = I('post.qguid') ? I('post.qguid') : create_guid();
                        $question_data['name'] = I('post.name');
                        $question_data['description'] = I('post.description');
                        $question_data['conclusion'] = I('post.conclusion');
                        if(!I('post.qguid')) $question_data['created_at'] = $time;
                        $question_data['updated_at'] = $time;
                        if(I('post.sguid')) $question_data['subject_guid'] = I('post.sguid');
                        if(!I('post.guid')) $question_data['activity_guid'] =  $data_activity['guid'];
                        
                        foreach($param_topic as $key=>$value){
                            //拼装Topic数据
                            $topic_data[$key]['guid'] = $value ['guid'] ? $value ['guid'] : create_guid();
                            $topic_data[$key]['name'] = $value ['topic_title'];
                            $topic_data[$key]['type'] = $value ['topic_type'];
                            $topic_data[$key]['sort'] = $value ['topic_sort'];
                            if(empty($value ['guid'])) $topic_data[$key]['created_at'] = $time;
                            $topic_data[$key]['updated_at'] = $time;
                            $topic_data[$key]['question_guid'] = $question_data['guid'];
                            foreach($value['option'] as $k=>$v){
                                //拼装Option数据
                                $option_data[$key][$k]['guid'] = $v['guid'] ? $v['guid'] : create_guid();
                                $option_data[$key][$k]['option'] = $v['title'];
                                $option_data[$key][$k]['sort'] = $v['sort'];
                                if(empty($v['guid'])) $option_data[$key][$k]['created_at'] = $time;
                                $option_data[$key][$k]['updated_at'] = $time;
                                $option_data[$key][$k]['topic_guid'] = $topic_data[$key]['guid'];
                                $option_data[$key][$k]['question_guid'] = $question_data['guid'];
                            }
                        }
                        
                        foreach($option_data as $key=>$value){
                            foreach($value as $k=>$v){
                                $option_arrange_data[] = $v;
                            }
                        }

                        if(M('ActivityQuestion')->inserUp($question_data)){
                            if(M('ActivityQuestionTopic')->inserUpAll($topic_data)){
                                M('ActivityQuestionOption')->inserUpAll($option_arrange_data);
                            }
                        }
                    }
                break;
            case self::ACTIVITY_ARTICLE:
                $template = 'article_add';

                if(IS_POST) {
                    //后台验证文章内容
                    if (I('post.content') == ""){
                        $this->error('内容不能为空');
                    }
                    //后台验证文章开始时间
                    if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                        $this->error('活动开始时间不能早于主题开始时间');
                    }
                    //后台验证文章开始时间
                    if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                        $this->error('活动结束时间不能晚于主题结束时间');
                    }

                    //************* 保存主题 *************
                    $this->_add_subject($save_subject, $org_guid, $subject_info);

                    //***************存储活动表数据******************
                    list($add_peak, $data_activity) = $this->_add_activity(self::ACTIVITY_ARTICLE, $org_guid, $subject_guid);

                    //***************存储文章表数据******************
                    $data_article = array(
                        'guid'          => create_guid(),
                        'activity_guid' => $data_activity['guid'],
                        'name'          => I('post.name'),
                        'content'       => I('post.content'),
                        'start_time'    => strtotime(I('post.startTime')),
                        'end_time'      => strtotime(I('post.endTime')),
                        'status'        => I('post.status'),
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                    list($check, $r) =  D('ActivityArticle')->insert($data_article);
                    if (!$check){
                        M('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        $this->error($r);exit();
                    }
                    if (!$r){
                        M('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        //如果错误跳转到添加活动页面
                        $this->error('活动添加失败, 请稍后重试.');
                    }

                }
                break;
            case self::ACTIVITY_VOTE:
                $template = 'vote_add';

                if(IS_POST) {
                    //后台验证文章开始时间
                    if (strtotime(I('post.startTime')) < $subject_info['start_time']) {
                        $this->error('活动开始时间不能早于主题开始时间');
                    }
                    //后台验证文章开始时间
                    if (strtotime(I('post.endTime')) > $subject_info['end_time']) {
                        $this->error('活动结束时间不能晚于主题结束时间');
                    }
                    $options = I('post.options');
                    if (empty($options)) {
                        $this->error('选项内容不能为空.');
                    }
                    $picUrl = I('post.picurls');

                    //************* 保存主题 *************
                    $this->_add_subject($save_subject, $org_guid, $subject_info);

                    //***************存储活动表数据******************
                    list($add_peak, $data_activity) = $this->_add_activity(self::ACTIVITY_VOTE, $org_guid, $subject_guid);

                    //***************存储投票表数据******************
                    $data_vote = array(
                        'guid'          => create_guid(),
                        'activity_guid' => $data_activity['guid'],
                        'name'          => I('post.name'),
                        'content'       => I('post.content'),
                        'is_multiple'   => I('post.is_multiple'),
                        'multiple_num'  => I('post.max_choice', '0'),
                        'is_anony'      => I('post.is_anony', '0'),
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                    list($check, $r) =  D('ActivityVote')->insert($data_vote);
                    if (!$check){
                        M('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        $this->error($r);exit();
                    }
                    if (!$r){
                        M('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        //如果错误跳转到添加活动页面
                        $this->error('活动添加失败, 请稍后重试.');
                    }

                    // 存储选项内容
                    foreach($options as $key=>$o){
                        $data[] = array(
                            'guid'       => create_guid(),
                            'vote_guid'  => $data_vote['guid'],
                            'content'    => $o,
                            'pic_url'    => $picUrl[$key],
                            'created_at' => $time,
                            'updated_at' => $time
                        );
                    }
                    D('ActivityVoteOption')->insert_all($data);
                }
                break;
            case self::ACTIVITY_DISCUSS:
                $template = 'discuss_add';

                if(IS_POST) {
                    //后台验证文章开始时间
                    if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                        $this->error('活动开始时间不能早于主题开始时间');
                    }
                    //后台验证文章开始时间
                    if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                        $this->error('活动结束时间不能晚于主题结束时间');
                    }

                    //************* 保存主题 *************
                    $this->_add_subject($save_subject, $org_guid, $subject_info);

                    //***************存储活动表数据******************
                    list($add_peak, $data_activity) = $this->_add_activity(self::ACTIVITY_DISCUSS, $org_guid, $subject_guid);

                    //***************存储讨论组表数据******************
                    $data_discuss = array(
                        'guid'          => create_guid(),
                        'creater_guid'  => $session_auth['org_guid'],
                        'subject_guid'  => $subject_guid,
                        'activity_guid' => $data_activity['guid'],
                        'name'          => I('post.name'),
                        'content'       => I('post.content'),
                        'start_time'    => strtotime(I('post.startTime')),
                        'end_time'      => strtotime(I('post.endTime')),
                        'updated_at'    => $time,
                        'created_at'    => $time,
                        'status'        => I('post.status')
                    );

                    //注册环信
                    $options = array(
                        'groupname' => $data_discuss['guid'],
                        'desc' => $data_discuss['content'],
                        'public' => false,
                        'owner' => $data_discuss['creater_guid']
                    );
                    // 获取分组下成员guids
                    $member_guids = D('Org')->get_member_guid_by_group($subject_info['org_guid'], $data_activity['org_group_guid']);
                    if(!empty($member_guids)){
                        $options['members'] = $member_guids;
                    }
                    $chat = new YmChat();
                    $r = $chat->createGroups($options);
                    if($r['status'] != 200) {
                        D('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        //如果错误跳转到添加活动页面
                        $this->error('活动添加失败, 请稍后重试.1');
                    }

                    // 保存chat_group_id
                    $data_discuss['chat_group_id'] = $r['data']['groupid'];
                    // 保存群组到数据库
                    list($check, $r) =  D('GroupOrgDisc')->insert($data_discuss);
                    if (!$check){
                        M('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        $this->error($r);exit();
                    }
                    if (!$r){
                        M('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        //如果错误跳转到添加活动页面
                        $this->error('活动添加失败, 请稍后重试.');
                    }

                    // 保存讨论组成员
                    foreach($member_guids as $user_guid){
                        $data_members[] = array(
                            'guid'            => create_guid(),
                            'user_guid'       => $user_guid,
                            'group_disc_guid' => $data_discuss['guid'],
                            'updated_at'      => $time,
                            'created_at'      => $time
                        );
                    }
                    if(!empty($data_members)) {
                        $r = D('GroupOrgDiscMembers')->insert_all($data_members);
                    }
                }
                break;
            case self::ACTIVITY_SIGNUP:
                $template = 'signup_add';
                // 获取一级地区
                $area_1 = D('Area')->find_all('deep=1', 'id, name');
                $this->assign('area_1', $area_1);

                if(IS_POST) {
                    //后台验证文章内容
                    if (I('post.content') == ""){
                        $this->error('内容不能为空');
                    }
                    //后台验证文章开始时间
                    if (strtotime(I('post.startTime')) < $subject_info['start_time']){
                        $this->error('活动开始时间不能早于主题开始时间');
                    }
                    //后台验证文章开始时间
                    if (strtotime(I('post.endTime')) > $subject_info['end_time']){
                        $this->error('活动结束时间不能晚于主题结束时间');
                    }

                    //************* 保存主题 *************
                    $this->_add_subject($save_subject, $org_guid, $subject_info);
                    //***************存储活动表数据******************
                    list($add_peak, $data_activity) = $this->_add_activity(self::ACTIVITY_SIGNUP, $org_guid, $subject_guid);
                    //***************存储文章表数据******************
                    // 判断报名的开始时间和结束时间
                    $start = I('post.start');
                    if(empty($start)) {
                        if (I('post.status') == '1') {
                            $start = $time;
                        } else {
                            $start = '';
                        }
                    } else {
                        $start = strtotime($start);
                    }
                    $end = I('post.end');
                    if(empty($end)) {
                        $end = strtotime(I('post.endTime'))-3600;
                    } else {
                        $end = strtotime($end);
                    }

                    $num_person = trim(I('post.num_person'));
                    $data_signup = array(
                        'guid'          => create_guid(),
                        'activity_guid' => $data_activity['guid'],
                        'subject_guid'  => $subject_guid,
                        'name'          => trim(I('post.name')),
                        'content'       => I('post.content'),
                        'start_time'    => strtotime(I('post.startTime')),
                        'end_time'      => strtotime(I('post.endTime')),
                        'start'         => $start,
                        'end'           => $end,
                        'poster'        => I('post.poster', ''),
                        'areaid_1'      => I('post.areaid_1'),
                        'areaid_1_name' => get_area(I('post.areaid_1')),
                        'areaid_2'      => I('post.areaid_2'),
                        'areaid_2_name' => get_area(I('post.areaid_2')),
                        'address'       => trim(I('post.address')),
                        'lng'           => trim(I('post.lng')),
                        'lat'           => trim(I('post.lat')),
                        'keyword'       => trim(I('post.keyword')),
                        'num_person'    => (empty($num_person) || $num_person=='0' || !is_numeric($num_person)) ? 0 : $num_person,
                        'status'        => I('post.status'),
                        'is_public'     => I('post.is_public'),
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                    list($check, $r) =  D('ActivitySignup')->insert($data_signup);
                    if (!$check){
                        D('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        $this->error($r);exit();
                    }
                    if (!$r){
                        D('Activity')->phy_delete(array('guid'=>$data_activity['guid']));
                        //如果错误跳转到添加活动页面
                        $this->error('活动添加失败, 请稍后重试.');
                    }

                    // ************** 增加 承办机构 **************
                    $undertakers = I('post.op_undertaker');
                    if(!empty($undertakers)) {
                        $data_undertakers = array();
                        foreach($undertakers as $k => $u) {
                            $data_undertakers[$k] = array(
                                'guid'          => create_guid(),
                                'activity_guid' => $data_activity['guid'],
                                'type'          => $u['type'],
                                'name'          => $u['name'],
                                'created_at'    => $time,
                                'updated_at'    => $time
                            );
                        }
                        M('ActivityAttrUndertaker')->addAll($data_undertakers);
                    }

                    // ************** 增加 活动流程 **************
                    $flow = I('post.op_flow');
                    if(!empty($flow)) {
                        $data_flow = array();
                        foreach($flow as $k => $f) {
                            $data_flow[$k] = array(
                                'guid' => create_guid(),
                                'activity_guid' => $data_activity['guid'],
                                'title' => $f['title'],
                                'content' => $f['content'],
                                'start_time' => !empty($f['start_time']) ? strtotime($f['start_time']) : '',
                                'end_time' => !empty($f['end_time']) ? strtotime($f['end_time']) : '',
                                'created_at' => $time,
                                'updated_at' => $time
                            );
                        }
                        M('ActivityAttrFlow')->addAll($data_flow);
                    }

                    // ************** 增加 票务 **************
                    $tickets = I('post.op_ticket');
                    if(!empty($tickets)){
                        $model_ticket = M('ActivityAttrTicket');
                        $time = time();
                        if(!empty($tickets['new'])) {
                            $data_ticket = array();
                            foreach($tickets['new'] as $k => $t) {
//                            $data_ticket = array(
                                $data_ticket[] = array(
                                    'guid'          => create_guid(),
                                    'activity_guid' => $data_activity['guid'],
                                    'name'          => $t['name'],
                                    'num'           => $t['num'],
                                    'verify_num'    => $t['verify_num'],
                                    'is_for_sale'   => $t['is_for_sale'],//isset($t['is_for_sale']) ? '1' : '0',
                                    'created_at'    => $time,
                                    'updated_at'    => $time
                                );
//                            $model_ticket->add($data_ticket);
                            }
                            $r = $model_ticket->addAll($data_ticket, array(), true);
                        }
                    }

                    //************** 创建表名表单 *************
                    $data_build = array();
                    $signup_guid = $data_signup['guid'];
                    $data_build[] = array( // 姓名
                        'guid'          => create_guid(),
                        'signup_guid'   => $signup_guid,
                        'activity_guid' => $data_activity['guid'],
                        'name'          => I('post.real_name'),
                        'note'          => I('post.real_name_note'),
                        'ym_type'       => 'real_name',
                        'html_type'     => 'text',
                        'is_required'   => 1,
                        'is_info'       => 1,
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                    $data_build[] = array( //手机
                        'guid'          => create_guid(),
                        'signup_guid'   => $signup_guid,
                        'activity_guid' => $data_activity['guid'],
                        'name'          => I('post.mobile'),
                        'note'          => I('post.mobile_note'),
                        'ym_type'       => 'mobile',
                        'html_type'     => 'text',
                        'is_required'   => 1,
                        'is_info'       => 1,
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                    $items = I('post.items');
                    if(!empty($items)) { //其它
                        $data_options = array();
                        foreach($items as $i) {
                            if(isset($i['name'])) {
                                $buid_guid    = create_guid();
                                $data_build[] = array(
                                    'guid'          => $buid_guid,
                                    'signup_guid'   => $signup_guid,
                                    'activity_guid' => $data_activity['guid'],
                                    'name'          => $i['name'],
                                    'note'          => $i['note'],
                                    'ym_type'       => $i['ym_type'],
                                    'html_type'     => $i['html_type'],
                                    'is_info'       => 0,
                                    'is_required'   => isset($i['is_required']) ? $i['is_required'] : 0,
                                    'created_at'    => $time,
                                    'updated_at'    => $time
                                );
                                if (!empty($i['options'])) {
                                    foreach ($i['options'] as $o) {
                                        $data_options[] = array(
                                            'guid'        => create_guid(),
                                            'signup_guid' => $signup_guid,
                                            'build_guid'  => $buid_guid,
                                            'value'       => $o,
                                            'created_at'  => $time,
                                            'updated_at'  => $time
                                        );
                                    }
                                }
                            }
                        }
                    }
                    if(!empty($data_build)) {
//                $r = M('ActivitySignupFormBuild')->addAll($data_build);
                        foreach($data_build as $db) {
                            M('ActivitySignupFormBuild')->add($db);
                        }
                    }
                    if(!empty($data_options)) {
                        M('ActivitySignupFormOption')->addAll($data_options);
                    }

                }
                break;
            default:
                $this->error('添加活动错误, 请重试');
                exit();
                break;
        }
        if(IS_POST) {
            // 清空缓存
            session('session_subject', null);

            // 发送通知
            if(I('post.status') == '1'){
                $this->_send_notice($data_activity['org_group_guid'], $data_activity['name'], $data_activity['guid']);
            }

            $add_again = I('post.add_again');
            if (empty($add_again)){
                //如果成功并且不继续添加跳转到主题列表页面
                if($add_peak){
                    $this->error('发布失败,活动发布数量超出限制', U('Activity/activity_list', array('sguid'=>$subject_guid)));
                }else{
                    $this->success('活动创建成功',U('Activity/activity_view', array('guid'=>$data_activity['guid'])));
                }
            }else{
                if($add_peak){
                    $this->error('发布失败,活动发布数量超出限制', U('Activity/type', array('sguid'=>$subject_guid)));
                }else{
                    $this->success('活动创建成功，继续创建',U('Activity/type', array('sguid'=>$subject_guid)));
                }
            }
            exit();
        }

        // 相关保存操作 --- end

        $this->assign('subject_info', $subject_info);
        $this->assign('group_list', D('OrgGroup')->find_all(array('is_del' => '0', 'org_guid'=>$session_auth['org_guid'])));
        $this->assign('meta_title', '新增活动');
        $this->display($template);
    }

    /**
     * 检查用户是否重复报名
     */
    public function ajax_check_signup_user() {
        $params = I('post.');
        $aid = $params['aid'];
        $kv = $params['info'];
        $value = current($kv);
        $key = key($kv);

        switch($key) {
            case 'mobile':
                $result = M('ActivitySignupUserinfo')->where(array($key=>$value, 'activity_guid'=>$aid))->find();
                echo empty($result) ? 'true' : 'false';exit();
                break;
            default:
                echo 'true';exit();
                break;
        }
    }

    /**
     * 票务列表
     * CT: 2015-03-05 10:25 BY YLX
     */
    public function ticket() {
        $activity_guid = I('get.guid');
        if(empty($activity_guid)) {
            $this->error('活动不存在。');
        }
        $activity_info = D('Activity')->find_one(array('guid'=>$activity_guid, 'is_del'=>'0'));
        if(empty($activity_info)){
            $this->error('活动不存在.');
        }

        if(IS_POST) {
            $tickets = I('post.op_ticket');
            $model_ticket = M('ActivityAttrTicket');
            $time = time();
            if(!empty($tickets['old'])){
                foreach($tickets['old'] as $t) {
                    $t['updated_at'] = $time;
                    $model_ticket->where(array('guid' => $t['guid']))->save($t);
                }
            }
            if(!empty($tickets['new'])) {
//                $data_ticket = array();
                foreach($tickets['new'] as $k => $t) {
                    $data_ticket = array(
                        'guid'          => create_guid(),
                        'activity_guid' => $activity_guid,
                        'name'          => $t['name'],
                        'num'           => $t['num'],
                        'verify_num'    => $t['verify_num'],
                        'is_for_sale'   => $t['is_for_sale'],//isset($t['is_for_sale']) ? '1' : '0',
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                    $model_ticket->add($data_ticket);
                }
//                $r = $model_ticket->addAll($data_ticket);
            }
        }

        $this->assign('activity_info', $activity_info);
        $this->assign('subject_info', D('ActivitySubject')->find_one(array('guid'=>$activity_info['subject_guid'])));

        // 票务
        $ticket = M('ActivityAttrTicket')->where(array('activity_guid' => $activity_guid, 'is_del' => '0'))->order('id asc')->select();
        foreach($ticket as $k => $t) {
            $user_width_this_ticket = M('ActivityUserTicket')->field('guid')->where(array('ticket_guid' => $t['guid'], 'status' => '2', 'is_del' => '0'))->count();
            $ticket[$k]['num_used'] = $user_width_this_ticket;
        }

        $this->assign('ticket', $ticket);
        $this->assign('meta_title', '票务设置');
        $this->display();
    }

    /**
     * 删除票务
     * CT: 2015-03-26 16:28 BY YLX
     */
    public function ajax_delete_ticket()
    {
        if(IS_AJAX) {
            $tid = I('post.tid');
            if(empty($tid)) $this->ajaxReturn(array('status' => 'ko', 'msg' => '删除失败，请稍后重试。'));

            $result = M('ActivityAttrTicket')->where(array('guid' => $tid))->delete();
            if($result) {
                $this->ajaxReturn(array('status' => 'ok'));
            } else {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '删除失败，请稍后重试。'));
            }
        } else {
            $this->ajaxReturn(array('status' => 'ko', 'msg' => '删除失败，请稍后重试。'));
        }
    }

    /**
     * 选择发布后, 发送消息通知
     * @param $group_guid
     * @param $activity_name
     *
     * @return boolen
     * CT: 2014-11-24 17:07 by ylx
     */
    private function _send_notice($group_guid, $activity_name, $activity_guid)
    {
        $session_auth = $this->get_auth_session();

        $content = '通知: 新活动 "'.$activity_name.'"';
        $time = time();

        // 通过SDK发送消息
        $msg = array(
            'from_id'  => $session_auth['org_guid'],
            'from_name'  => $session_auth['org_name'],
            'from_iconID' => $session_auth['org_logo'],
            'to_id'    => '',
            'to_name'    => '',
            'to_iconID'    => '',
            'content'    => htmlspecialchars_decode($content),
            'send_time'  => $time,
            'msg_type'  => '11101',
            'type' => '11006',
            'is_read' => 0
        );
        $to_user = D('OrgGroup')->get_chat_group_id($session_auth['org_guid'], $group_guid);
        if (empty($to_user)){
//            $this->error('该分组下没有成员, 请重新分组.');
            return false;
        }

        $chat = new YmChat();
        $res = $chat->sendMsg($session_auth['org_guid'], array($to_user), 'txt', $msg['content'], 'chatgroups', array('content' => $msg));
        if($res['status'] != 200){
//            $this->error('系统错误, 消息发送失败, 请稍候重试.');
            return false;
        }

        $data_box = array(
            'guid' => create_guid(),
            'name' => '活动通知消息-'.$activity_guid,
            'group_guid' => $group_guid,
            'org_guid' => $session_auth['org_guid'],
            'status' => '1',
            'content' => $content,
            'is_activity_notice' => '1',
            'created_at' => $time,
            'updated_at' => $time
        );
        D('OrgGroupMsgBox')->insert($data_box);

        //保存聊天记录
        $data_msg = array(
            'guid'       => create_guid(),
            'org_group_guid' => $group_guid,
            'msg_box_guid' => $data_box['guid'],
            'from_guid'  => $session_auth['org_guid'],
            'from_name'  => $session_auth['org_name'],
            'from_photo' => $session_auth['org_logo'],
            'to_guid'    => $activity_guid,
            'to_name'    => '',
            'to_photo'   => '',
            'content'    => $content,
            'sdk_msg_id'    => '1',
            'sent_time'  => $time,
            'created_at' => $time,
            'updated_at' => $time,
            'type'   => '3',

        );
        D('OrgMsg')->insert($data_msg);

        return true;
    }
    
    public function question_collect(){
        $activity_info = M('Activity')->where(array('guid'=>I('get.guid')))->find();
        $collect_list = D('ActivityQuestionCollectView')->where(array('activity_guid'=>I('get.guid')))->select();
        $this->assign('collect_list', $collect_list);
        $this->assign('activity_info', $activity_info);
        $this->display();
    }
    
    public function question_collect_detail(){
        $detail_list = D('ActivityQuestionCollectDetailView')->where(array('collect_guid'=>I('get.collect_guid')))->select();
        $option_list = array();
        foreach($detail_list as $key=>$value){
            if(is_array((json_decode($value['answer'],true)))){
                $detail_list[$key]['answer'] = json_decode($value['answer'],true);
            }
            if($value['type']=='2'){
                $option_list[] = json_decode($value['answer'],true);
                $i++;
            }
            if($value['type']=='1'){
                $option_list[] = $value['answer'];
            }
        }
        $i = 0;
        $f = array();
        foreach($option_list as $key=>$value){
            if(is_array($value)){
                foreach($value as $vo){
                    $f[]=$vo;
                }
            }else{
                $f[] = $value;
            }
            $i++;
        }
        $option_detail = M('ActivityQuestionOption')->field('guid,option')->where(array('guid'=>array('IN',implode(',',$f))))->select();
        foreach($detail_list as $key=>$value){

            if($value['type']=='1'){
                foreach($option_detail as $k=>$v){
                    if($value['answer'] == $v['guid']){
                        $detail_list[$key]['answer'] = $v['option'];
                    }
                }
            }

            if($value['type']=='2'){
                foreach($value['answer'] as $n=>$op){
                    foreach($option_detail as $k=>$v){
                        if($op == $v['guid']){
                            $detail_list[$key]['answer'][$n] = $v['option'];
                        }
                    }
                }
            }
        }
        $this->assign('detail_list' ,$detail_list);
        $this->display();
    }

    /**
     * 报名活动 - 其它设置页
     * CT: 2015-03-25 10:24 BY YLX
     */
    public function signup_setting()
    {
        $activity_guid = I('get.guid');
        if(empty($activity_guid)) {
            $this->error('活动不存在。');
        }
        $activity_info = D('Activity')->find_one(array('guid'=>$activity_guid, 'is_del'=>'0'));
        if(empty($activity_info)){
            $this->error('活动不存在.');
        }
        $signup_info = D('ActivitySignup')->find_one(array('activity_guid' => $activity_guid));

        if(IS_POST) {
            $show_front_list = I('post.show_front_list', 0);
            $result = M('ActivitySignup')->where(array('guid' => $signup_info['guid']))->save(array('show_front_list' => $show_front_list));
            if($result) {
                $this->success('基本设置更新成功。');exit();
            }
        }

        $this->assign('activity_info', $activity_info);
        $this->assign('signup_info', $signup_info);
        $this->assign('subject_info', D('ActivitySubject')->find_one(array('guid'=>$activity_info['subject_guid'])));
        $this->assign('meta_title', '其它设置');
        $this->display();
    }

    /**
     * 在线签到页
     * CT: 2015-03-24 11:14 BY YLX
     */
    public function signin()
    {
        $aid = I('get.aid');
        if(empty($aid)){
            $this->error('活动无法找到, 请重新点击.');
        }

        // 活动详情
        $activity_info = M('Activity')->where(array('guid' => $aid))->find();
        if(empty($activity_info)){
            $this->error('活动无法找到, 请重新点击.');
        }
        $this->assign('activity_info', $activity_info);

        // 获取报名表单
        $this->_get_signup_form($aid);

        $this->assign('meta_title', '在线签到');
        $this->display();
    }

    /**
     * 在线签到统计页
     * CT: 2015-03-25 10:14 BY YLX
     */
    public function signin_chart()
    {
        $aid = I('get.aid');
        if(empty($aid)){
            $this->error('活动无法找到, 请重新点击.');
        }

        $activity_info = M('Activity')->where(array('guid' => $aid))->find();
        $this->assign('activity_info', $activity_info);


        // 获取票务相关
        $tickets = M('ActivityAttrTicket')->where(array('activity_guid' => $aid, 'is_del' => '0', 'is_for_sale' => '1'))->getField('guid, num, name', true);
        foreach($tickets as $k => $t) {
            $user_width_this_ticket = M('ActivityUserTicket')->field('guid')->where(array('ticket_guid' => $t['guid'], 'status' => '2', 'is_del' => '0'))->count();
            if($user_width_this_ticket >= $t['num']) {
                unset($tickets[$k]);
            }
        }
        $this->assign('tickets', $tickets);

        // 获取用户列表
        $this->_get_signup_userlist($aid, 'signin_chart');

        // 签到统计
        // 签到状况统计
        $status_statistic_result = M('ActivityUserTicket')
            ->field('status, count(status) as sum')
            ->where(array('activity_guid' => $aid, 'is_del' => '0', 'status' => array('in', array(2, 3, 4))))
            ->group('status')
            ->select();
        $status_statistic = array( 'title' => array('未签到','已签到'), 'data' => array() );
        $i=0;

        foreach($status_statistic_result as $s){
            if($s['status'] == 2){
                $status_statistic['data'][$i]['name'] = '未签到';
                $status_statistic['data'][$i]['value'] = $s['sum'];
            } else if ($s['status'] == 3) {
                if(!empty($status_statistic['data'][$i-1]['value'])){
                    $i = $i-1;
                }
                $status_statistic['data'][$i]['value'] += $s['sum'];
            } else if($s['status'] == 4) {
                $status_statistic['data'][$i]['name'] = '已签到';
                $status_statistic['data'][$i]['value'] = $s['sum'];
            }
            $i++;
        }
        $status_statistic['total'] = $status_statistic['data'][0]['value']+$status_statistic['data'][1]['value'];
        $this->assign('status_statistic', $status_statistic);

        // 签到方式统计
        $type_statistic_result = M('ActivityUserTicket')
            ->field('signin_status, count(signin_status) as sum')
            ->where(array('activity_guid' => $aid, 'is_del' => '0', 'signin_status' => array('gt', 0)))
            ->group('signin_status')
            ->select();
        $this->assign('type_statistic', $type_statistic_result);


        $this->assign('meta_title', '签到统计');
        $this->display();
    }

    /**
     * AJAX检查签到人员
     * CT: 2015-03-30 16:14 BY YLX
     */
    public function ajax_signin_check_user()
    {
        if(IS_AJAX) {
            $aid = I('post.aid');
            $value = I('post.value'); // 当手动签到时为mobile, 当二维码扫描时, 为ticket_code
            $signin_type = I('post.signin_type');
            if(empty($aid) || empty($value)) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '二维码错误或手机号码格式不对, 请刷新后重试！'));
            }

            // 检查票务是否存在
            $field = $signin_type==1 ? 'ticket_code' : 'mobile';
            $check = M('ActivityUserTicket')
                ->where(array('activity_guid' => $aid,
                              'status' => array('gt', 1), 'is_del' => 0,
                              $field => $value,
                    ))
                ->find();
            if(empty($check)){
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '无法找到相应的票务信息, 请刷新页面后重试！'));
            }

            // 获取用户信息
            $userinfo = D('ActivitySignupUserinfo')
                ->where(array('activity_guid' => $aid, 'user_guid' => $check['user_guid'], 'is_del' => '0'))
                ->find();
            if(empty($userinfo)) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '系统错误，无法找到该用户。'));
            }

            // 来源
            $from = C('ACTIVITY_SIGNUP_FROM');
            $userinfo['from'] = $from[$userinfo['type']];

            // 其它信息
            $other = M('ActivitySignupUserinfoOther')
                ->where(array('signup_userinfo_guid' => $userinfo['guid'], 'is_del' => '0'))
                ->select();
            foreach($other as $other_k => $o) {
                if($o['ym_type'] == 'company') $userinfo['company'] = $o['value'];
                else if($o['ym_type'] == 'position') $userinfo['position'] = $o['value'];
                $vals = explode('_____', $o['value']);
                if(count($vals) <= 1) {
                    $v_str = $o['value'];
                } else {
                    $v_str = implode(', ', $vals);
                }
                $other[$other_k]['value'] = $v_str;
            }
            $userinfo['other'] = $other;

            // 票务相关
            $ticket = M('ActivityUserTicket')->field('guid, ticket_guid, ticket_name, status')
                ->where(array('user_guid' => $userinfo['user_guid'], 'activity_guid' => $aid))
                ->find();
            $ticket_status = C('ACTIVITY_TICKET_STATUS');
            $ticket_status_tag = C('ACTIVITY_TICKET_STATUS_TAG');
            $ticket['ticket_status'] = $ticket_status[$ticket['status']];
            $ticket['ticket_status_tag'] = $ticket_status_tag[$ticket['status']];
            $ticket['user_ticket_guid'] = $ticket['guid'];
            $userinfo['ticket'] = $ticket;

            // 判断验证次数
            if(strlen($check['ticket_guid']) == 32){ // 走票务设置
                $ticket_verify_num = M('ActivityAttrTicket')->where(array('guid' => $check['ticket_guid']))->getField('verify_num');
            } else { // 走参与人数， 刚默认为可难10次
                $ticket_verify_num = C('ACTIVITY_TICKET_DEFAULT_VERIFY_TIME', null, 10);
            }
            if($check['ticket_verify_time'] >= $ticket_verify_num) {
                $this->ajaxReturn(array('status' => 'ok', 'data' => $userinfo, 'msg' => '该票无效，验证次数已超。'));
            }
            // 返回信息
            $this->ajaxReturn(array('status' => 'ok', 'data' => $userinfo));
        } else {
            $this->ajaxReturn(array('status' => 'ko', 'msg' => '参数错误，请刷新页面后重试。'));
        }
    }

    /**
     * AJAX签到
     * CT: 2015-04-01 17:14 BY YLX
     */
    public function ajax_signin()
    {
        if(IS_AJAX) {
            $user_ticket_guid = I('post.user_ticket_guid');
            $model = M('ActivityUserTicket');

            // 获取票务信息
            $ticket = M('ActivityUserTicket')
                ->field('guid, ticket_guid, ticket_verify_time, activity_guid, mobile, user_guid')
                ->where(array('guid' => $user_ticket_guid, 'status' => array('in', array(2, 3, 4)), 'is_del' => 0))
                ->find();
            if(empty($ticket)) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '签到失败，请刷新页面后重试。'));
            }

            // 判断验证次数
            if(strlen($ticket['ticket_guid']) == 32){ // 走票务设置
                $ticket_verify_num = M('ActivityAttrTicket')->where(array('guid' => $ticket['ticket_guid']))->getField('verify_num');
            } else { // 走参与人数， 刚默认为可难10次
                $ticket_verify_num = C('ACTIVITY_TICKET_DEFAULT_VERIFY_TIME', null, 10);
            }
            if($ticket['ticket_verify_time'] >= $ticket_verify_num) {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '该票无效，验证次数已超。'));
            }

            // 进行签到
            $signin_type = I('post.signin_type');
            $data = array(
                'ticket_verify_time' => array('exp', 'ticket_verify_time+1'),
                'status'             => 4,
                'signin_status'      => $signin_type,
                'updated_at'         => time()
            );
            $result = $model->where(array('guid' => $user_ticket_guid))->save($data);

            // 返回结果
            if($result) {
                $this->ajaxReturn(array('status' => 'ok', 'msg' => '签到成功！'));
            } else {
                $this->ajaxReturn(array('status' => 'ko', 'msg' => '签到失败，请刷新页面后重试。'));
            }
        } else {
            $this->ajaxReturn(array('status' => 'ko', 'msg' => '参数错误，请刷新页面后重试。'));
        }
    }

    /**
     * 生成票务图片
     * @param $ticket
     * @return string
     * CT: 2015-04-01 15:00 by ylx
     */
    private function _print_ticket($ticket)
    {
        // 获取用户信息
        $userinfo = D('ActivitySignupUserinfo')
            ->where(array('activity_guid' => $ticket['activity_guid'], 'mobile' => $ticket['mobile'], 'user_guid' => $ticket['user_guid'], 'is_del' => '0'))
            ->find();

        $image = new Image();
        $template_image = PUBLIC_PATH.'/common/images/ticket.jpg';
        $dest_path = UPLOAD_PATH.'/activity/signin/'.$ticket['activity_guid'].'/';
        if(!is_dir($dest_path)){
            mkdir($dest_path, 0777, true);
        }
        $dest_name = $ticket['guid'].'.jpg';
        $dest_image = $dest_path.$dest_name;
        $image->open($template_image);
        $image->text('姓名: '.$userinfo["real_name"],  UPLOAD_PATH.'/font/msyh.ttf', '20', '#000000', array(20, 20));
        $image->text('手机号码: '.$userinfo["mobile"],  UPLOAD_PATH.'/font/msyh.ttf', '20', '#000000', array(20, 60));
        $image->save($dest_image);
        return UPLOAD_URL.'/activity/signin/'.$ticket['activity_guid'].'/'.$dest_name;
    }
}