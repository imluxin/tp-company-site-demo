<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Org\Api\YmChat;

/**
 * 实现社团下会员的基础操作
 * 
 * CT 2014-09-17 15:00 by  QY  
 */
class MemberController extends BaseHomeController
{
    /**
     * 成员列表
     * CT 2014-09-17 15:00 by QY 
     * UT 2014-10-30 11:30 by QY
     */
    public function index()
    {
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        //group
        //$group_guid = I('get.group_guid', C('GROUP_FOR_ALL_MEMBER', null, '6AE34F5B36BA577093736C88C310B6D1'));
        $group_guid = I('get.group');

        $m = D('OrgGroupMembers');
        $num_per_page = C('NUM_PER_PAGE', null, '10');
        
        $where = array('g.org_guid'=>$org_guid, 'g.is_del'=>'0');

        
        if (empty($group_guid) || $group_guid=='all'){
            $current_group_name = '全部分组';
            // do nothing
        }else if ($group_guid == 'other') {
            $current_group_name = '未分组';
            $where['g.org_group_guid'] = array('exp', 'IS NULL');
        } else {
            $current_group_name = D('OrgGroup')->get_field('guid="' . $group_guid . '"','name');
            if (empty($current_group_name)){
                $this->error('当前分组不存在', U('Member/index'));
            }
            $where['g.org_group_guid'] = $group_guid;
        }

        // 社员列表
        $list = $m->alias('g')
                    ->field('u.guid as uid, g.guid as gid, u.real_name, u.remark, u.photo , u.is_active, u.areaid_1, u.areaid_2')
                    ->join('ym_user as u ON g.user_guid = u.guid')
                    ->where($where)->order('u.real_name')
                    ->group('g.user_guid')
                    ->page(I('get.p', '1').','.$num_per_page)
                    ->select();
        // 使用page类,实现分类
        $count      = $m->alias('g')->where($where)->count('distinct(g.user_guid)');// 查询满足要求的总记录数
        $page       = new \Think\Page($count, $num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $page->show();// 分页显示输出

        
        // 分组统计
        $group_list   = $this->get_ogm_list();//社团分组列表
        // TODO:优化SQL
        $group_list_stat = $m->alias('gm')
                             ->join('ym_org_group as g on gm.org_group_guid = g.guid', 'right')
                             ->where(array('g.org_guid'=>$org_guid, 'gm.is_del'=>'0'))
                             ->group('g.guid')
                             ->getField('g.guid, COUNT(gm.user_guid) as num');
        $num_all = $m->where(array('org_guid'=>$org_guid, 'is_del'=>'0'))->count('distinct(user_guid)');
        $num_other = $m->where(array('org_guid'=>$org_guid, 'is_del'=>'0', 'org_group_guid'=>array('exp', 'IS NULL')))->count('distinct(user_guid)');

//        $ogmlist2  = $this->get_ogm_list('is_default = 0');
        //获取社团分组列表
        $this->assign('group_list', $group_list);
        $this->assign('group_list_stat', $group_list_stat);
        $this->assign('current_group_name', $current_group_name);
        $this->assign('num_all', $num_all);
        $this->assign('num_other', $num_other);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('meta_title', '成员管理');
        $this->assign('group_guid',$group_guid);
        $this->display();
    }
    
   
    /**
     * 添加社团成员
     * CT 2014-09-17 15:00 by QY 
     * UT 2014-12-04 11:00 by ylx
     * 
     */
    public function add()
    {
    	$auth = $this->get_auth_session();
    	$org_guid = $auth['org_guid'];
    	
    	//权限-社团社员最大数量
    	$user_count = M('OrgGroupMembers')->where(array('org_guid'=>$org_guid))->count();
    	$vip_config=$this->get_vip_info();
    	if($user_count > $vip_config['NUM_MEMBERS']){
    	    exit($this->error('您的社团最多创建'.$vip_config['NUM_MEMBERS'].'名社员'));
    	}
    	
    	if (IS_POST){
    		//1 获取参数值
    		$data = array();
    		$time = time();
    		$data['guid'] = create_guid();
    		$_userGuid = $data['guid'];
    		$data['email'] = I('post.email');
    		$data['mobile'] = I('post.mobile');
    		$data['real_name'] = I('post.xname');
    		$data['is_active'] = 1;
            $data['password'] = I('post.password');
            $data['repassword'] = I('post.password');
    		$data['created_at'] = $time;
    		$data['updated_at'] = $time;

    		$model = D("User");
    		//邮箱或者手机存在
    		$restmp = $model->find_all('email="' . $data['email'] . '" OR mobile = "' . $data['mobile'] . '"');

            $this->assign('exist', $restmp);
    		if (!empty($restmp)){
                $count = count($restmp);

                if($count == 1){
                    $e = $restmp[0];

                    // 判断是哪个字段重复了
                    if($e['email'] == $data['email'] && $e['mobile'] != $data['mobile']) $t = 1; // 邮箱重复
                    else if($e['email'] != $data['email'] && $e['mobile'] == $data['mobile']) $t = 2; // 电话重复
                    else if($e['email'] == $data['email'] && $e['mobile'] == $data['mobile']) $t = 3; // 邮箱和电话重复

                    $e['org'] = $model->getOrgNames($e['guid']);
                    $e['company'] = $model->getCompanyNames($e['guid']);
                    $m = false;
                }else{
                    $t = 4;
                    foreach ($restmp as $k => $r){
                        if($r['email'] == $data['email']){
                            $e = $r;
                            $e['org'] = $model->getOrgNames($e['guid']);
                            $e['company'] = $model->getCompanyNames($e['guid']);
                        }
                        if($r['mobile'] == $data['mobile']){
                            $m = $r;
                            $m['org'] = $model->getOrgNames($m['guid']);
                            $m['company'] = $model->getCompanyNames($m['guid']);
                        }
                    }
                }
                $this->assign('e', $e);
                $this->assign('m', $m);
                $this->assign('t', $t);
    		} else {
                //验证
                if (!$model->create($data)) {
                    exit($this->error($model->getError()));
                }

                // 注册聊天服务帐号
//                $api = new YmREST();
//                $reg_user = $api->chatRegister(array('username' => $_userGuid, 'password' => hashCode(md5(I('post.password')))));
//                $reg_to_all = $api->add_group_users($auth['org_all_chat_id'], $_userGuid, '1');
//                $reg_to_other = $api->add_group_users($auth['org_other_chat_id'], $_userGuid, '1');
                $chat = new YmChat();
                $reg_user = $chat->accreditRegister(array('username' => $_userGuid, 'password' => hashCode(md5(I('post.password')))));
                $reg_to_all = $chat->addGroupsUser($auth['org_all_chat_id'], $_userGuid);
                $reg_to_other = $chat->addGroupsUser($auth['org_other_chat_id'], $_userGuid);
                if($reg_user['status'] != 200 || $reg_to_all['status'] != 200 || $reg_to_other['status'] != 200) {
                    exit($this->error('社员添加失败, 请稍后重试'));
                }

                //创建用户
                $data['password'] = md5($data['password']);
                $res = $model->add($data);
                
                //附加表信息写入
                $user_attr_data = array();
                $user_attr_data['guid'] = create_guid();
                $user_attr_data['user_guid'] = $_userGuid;
                $user_attr_data['updated_at'] = time();
                $user_attr_data['created_at'] = time();
                $user_attr_res = M('UserAttribute')->add($user_attr_data);
                if (!$res && !$user_attr_res) {
                    exit($this->error('社员 添加失败'));
                }

                //创建用户和社团的关系
                unset($data);
                $model = D("OrgGroupMembers");
                $data['guid'] = create_guid();
                $data['created_at'] = $time;
                $data['updated_at'] = $time;
                $data['user_guid'] = $_userGuid;
                $data['org_guid'] = $org_guid;//session获取
                //创建用户
                $res = $model->insert($data);
                if (!$res) {
                    exit($this->error('社员 添加失败'));
                }else {
                    //成功 记录LOG
                    D('OrgGroupMembersLog')->record(array($auth['org_all_guid'],$auth['org_other_guid']), array($_userGuid), '1');
                    D('OrgMembersLog')->record($org_guid, array($_userGuid), '1');

                    $saa = I('post.save_and_add');
                    
                    //时间轴-加入社团帮
                    D('UserTimeline')->record($_userGuid, '1');
                    //时间轴-加入社团
                    D('UserTimeline')->record($_userGuid, '2', $org_guid, $auth['org_name'],5);
                  
                    if (!empty($saa)) {
                        exit($this->success('社员 添加成功, 请继续添加.', U('Member/add')));
                    } else {
                        exit($this->success('社员 添加成功', U('Member/index')));
                    }
                }
            }
    	}
    	
    	
    	$this->assign('meta_title', '创建新社员');
    	$this->display();
    }

    /**
     * 社员详情
     *
     * CT: 2014-11-10 09:44 by YLX
     */
    public function member_info()
    {
        $guid = I('get.guid');
        if(empty($guid)) $this->error('未找到所选社员');

        $info = D('User')->getDetailForWeb($guid);
        if(empty($info)) $this->error('未找到所选社员');

        // 获取用户分组信息
        $session_auth = $this->get_auth_session();
        $groups = D('OrgGroupMembers')->get_group_guid_by_member_guid($session_auth['org_guid'], $guid);
        if(($key = array_search($session_auth['org_all_guid'], $groups)) !== false) {
            unset($groups[$key]);
        }
        if(($key = array_search($session_auth['org_other_guid'], $groups)) !== false) {
            $group_info[$session_auth['org_other_guid']] = '未分组';
        } else {
            $group_info = M('OrgGroup')->where(array('guid' => array('in', $groups)))->getField('guid, name');
        }
        if(empty($group_info)) $group_info = array();

        $this->assign('meta_title', '社员详情');
        $this->assign('info', $info);
        $this->assign('group_info', $group_info);

        $this->display();

    }
    
    /**
     * 删除社团成员
     * 逻辑 只能删除为激活用户
     * CT 2014-09-17 15:00 by QY  
     * UT 2014-09-17 10:00 by QY 
    */
    public function del()
    {
    	if (IS_DELETE){
    		$data = array();
    		//1 获取前台参数
    		$userGuid = I('DELETE.ID');
    		
    		$orgGuid = '';//从session中获得社团id
    		
    		//2 这里要验证数据有效性
    		$data['user_guid'] = $userGuid;
    		$data['org_group_guid'] = $orgGuid;
    		
    		$OGM = D("OrgMembers"); // org_group_members
    		
    		$data = $OGM->field('user_guid,org_group_guid')->create($data);
    		if (!$data)
    		{
    			// 如果创建失败 表示验证没有通过 输出错误提示信息
    			$this->ajaxReturn($OGM->getError());
    			exit;
    		}
    		
    		//3 数据库查询需要的逻辑验证
    		
    		//验证必须这个用户和组织存在关系，没关系的不可以删除
    		$data = $OGM->find_one(array('user_guid'=>$userGuid,'org_group_guid'=>$userGuid ));
    		if ($data == false)
    		{
    			//报错
    			exit;
    		}
    		if ($data == NUll)
    		{
    			//无数据
    			exit;
    		}
    		
    		//4 开始具体操作
    		//delete方法的返回值是删除的记录数，如果返回值是false则表示SQL出错，返回值如果为0表示没有删除任何数据。
    		$data = $OGM->_delete('user_guid="' . $userGuid . '" AND org_group_guid="' . $userGuid . '"');
    		if ($data==false)
    		{
    			//false则表示SQL出错无数据
    			exit;
    		}
    		if ($data == 0) {
    		    $this->error('参数错误, 删除失败, 请稍候重试.', 'url');
    		    exit;
    		}
    		
    		$User =  D("User");
    		$data = $User->_delete('guid="' . $userGuid . '" AND is_active = 0');
    		if ($data==false)
    		{
    			//false则表示SQL出错无数据
    			exit;
    		}
    		//5 返回成功的一些信息
    		
    		
    		
    		
    		//dump($data);
    	}
    }
    
    /**
     * 获取社团所有成员分组
     * CT 2014-09-17 15:00 by QY
     * UT 2014-09-23 15:00 by QY
     */
    public function ogm()
    {
        $vip_config=$this->get_vip_info();
        $this->assign('NUM_ORG_GROUP', $vip_config['NUM_ORG_GROUP']);
        $this->assign('list', $this->get_ogm_list());
        $this->assign('meta_title', '分组管理');
        $this->display();
    }
    /**
     * 获取社团分组列表
     * CT 2014-10-08 17:00 by QY 
     * UT 2014-10-08 17:00 by QY 
     * @return unknown|NULL
     */
    private function get_ogm_list($where = null)
    {
    	
    	$auth = $this->get_auth_session();
    	//获取前台参数
    	$_orgGuid = $auth['org_guid'];
    	//组合筛选条件 1 基本条件
    	$_sqlWhere = 'is_del=0' . ' AND org_guid = "' . $_orgGuid . '"';
    	if (!empty($where)){
    		$_sqlWhere .= ' and ' . $where;
    	}
    	
    		// 实例化模型
    	$_model = D('OrgGroup');
    	
    		// 获取社团成员分组列表
    	$_list = $_model->find_all($_sqlWhere,'','','created_at');
    	
    	
        return $_list;
    	
    	
    }
    
    public function ogm_save(){
        $group_name = I('post.group_name');
        $guid = I('post.guid');
        $auth = $this->get_auth_session();
        $time = time();
        $model = D("OrgGroup");
        if($guid){
            //修改数据
            $is_activity_exists=$model->where(array('guid'=>array('NEQ',$guid),'org_guid'=>$auth['org_guid'],'name'=>$group_name,'is_del'=>'0'))->find();
            if(!empty($is_activity_exists)){
                $resData['status'] = 'ko';
                $resData['msg'] = $group_name.'已存在';
            }else{
                if(!$model->where(array('guid'=>$guid))->save(array('name'=>$group_name,'updated_at'=>$time))){
                    $resData['status'] = 'ko';
                    $resData['msg'] = '修改失败';
                }else{
                    $resData['status'] = 'ok';
                    $resData['msg'] = '修改成功';
                }
            }       
        }else{
            //新增数据
            $vip_config=$this->get_vip_info();
            $count=count($model->where(array('org_guid'=>$auth['org_guid'],'is_del'=>'0'))->select());
            if($count >= $vip_config['NUM_ORG_GROUP']){
                $resData['status'] = 'ko';
                $resData['msg'] = '社团分组数量不得超过限制';
                exit($this->ajaxReturn($resData));
            }
            
            $is_activity_exists=$model->where(array('org_guid'=>$auth['org_guid'],'name'=>$group_name,'is_del'=>'0'))->find();
            if(!empty($is_activity_exists)){
                $resData['status'] = 'ko';
                $resData['msg'] = $group_name.'已存在';
            }else{
                $guid = create_guid();
                $options = array(
                    'groupname' => $guid,
                    'desc'      => $group_name,
                    'public'    => false,
                    'owner'     => $auth['org_guid']
                );
                $chat = new YmChat();
                $r = $chat->createGroups($options);
                if($r['status'] == 200){
                    $data = array(
                        'guid'          => $guid,
                        'org_guid'      => $auth['org_guid'],
                        'name'          => $group_name,
                        'chat_group_id' => $r['data']['groupid'],
                        'created_at'    => $time,
                        'updated_at'    => $time
                    );
                    $res = $model->data($data)->add();
                    if (!$res) {
                        $resData['status'] = 'ko';
                        $resData['msg'] = '新增失败';
                    }else{
                        // 更新记录表
                        D('OrgGroupLog')->record(array($guid=>$group_name), '1');

                        $resData['status'] = 'ok';
                        $resData['msg'] = '新增成功';
                        $resData['attach'] = array('guid'=>$guid, 'group_name'=>$group_name);
                    }
                }else{
                    $resData['status'] = 'ko';
                    $resData['msg'] = '新增失败';
                }
            }
        }
        exit($this->ajaxReturn($resData));
    }
    
    
    
    
    public function ogm_del()
    {
        $guid = I('post.guid');
        if (empty($guid)) $this->ajaxReturn(array('status'=>'ko', 'msg'=>'删除失败, 请稍后重试.'));

        // 检查是否存在
        $group_info = D('OrgGroup')->find_one(array('guid'=>$guid));
        if (!$group_info){
            $this->ajaxReturn(array('status'=>'ok', 'msg'=>'删除成功.'));
        }

        // 执行删除操作
        $res = D('OrgGroup')->soft_delete(array('guid'=>$guid));

        // 返回数据
        if (empty($res)) {
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'删除失败, 请稍后重试.'));
        } else {

            // 处理该分组下的会员
            $r = D('OrgGroupMembers')->get_field(array('org_group_guid'=>$guid),'user_guid', true);
            M('OrgGroupMembers')->where(array('org_group_guid'=>$guid))->delete();
            $auth = $this->get_auth_session();
            $org_guid = $auth['org_guid'];
            if (!empty($r)){
                foreach ($r as $uid){
                    $num = M('OrgGroupMembers')->where(array('org_guid'=>$org_guid, 'user_guid'=>$uid))->count('id');
                    if ($num<1){
                        $data = array('guid'=>create_guid(),
                                      'org_guid' => $org_guid,
                                      'user_guid' => $uid,
                                      'created_at' => time(),
                                      'updated_at' => time()
                        );
                        M('OrgGroupMembers')->data($data)->add();
                    }
                }
            }
            // 更新记录表
            D('OrgGroupLog')->record(array($guid=>$group_info['name']), '2');

            // 删除环信注册
            $chat = new YmChat();
            $chat->deleteGroups($group_info['chat_group_id']);

            $this->ajaxReturn(array('status'=>'ok', 'msg'=>'删除成功.'));
        }
    }

    /**
     * 批量删除操作
     *
     * CT 2014-10-09 17:40 by QY
     * UT 2014-11-11 17:40 by ylx
     */
    public function ogm_operate()
    {
    	// 此操作必须为POST
    	if (IS_POST){
    		$auth = $this->get_auth_session();
    		//获取前台参数
    		$org_guid = $auth['org_guid'];
    		// 获取数据
    		$batch_act = I('post.batch_act');//获得标识位
    		$member_guids = I('post.ckguid');//获得操作数组 数据格式   666666666666666（ogm_group_member guid）|3333333333333333 （user_guid）
            $org_group_guid = I('post.group2');
            //$org_group_guid = I('post.g_name');
//            var_dump($batch_act, $guids, $org_group_guid);die();
    		// 验证数据
    		if (empty($member_guids) || empty($batch_act) || empty($org_group_guid) || $org_group_guid=='no'){
    			exit($this->error('操作失败，请重试。', $this->getReferer()));
    		}
             
    		// 实例化模型
            $m = D('OrgGroupMembers');
    
    		switch ($batch_act){
    			// 从该组删
                case 'del_from_group':
                    $chat_group_id = M('OrgGroup')->where(array('guid'=>$org_group_guid))->getField('chat_group_id');
                    if(empty($chat_group_id)){
                        $this->error('操作失败, 请重试.', $this->getReferer());
                    }

                    $g_guids =  array();
                    $user_guids = array();

                    foreach ($member_guids as $g){
                        $_id = explode('|', $g);
                        $g_guids[] = $_id[0];
                        $user_guids[] = $_id[1];
                    }

                    // 从环信群组删除
                    $chat = new YmChat();
                    $r = $chat->delGroupsUsers($chat_group_id, $user_guids);
                    if($r < 1) {
                        $this->error('操作失败, 请重试.', $this->getReferer());
                    }

                    // 数据库中删除
                    $res = $m->phy_delete(array('guid'=> array('IN', $g_guids)));
                    if ($res > 0){
                        // 人员变动记录
                        D('OrgGroupMembersLog')->record(array($org_group_guid), $user_guids, '2');

                        foreach ($user_guids as $uid){
                            // 检查是该用户是否存在其它分组, 若设为未分组成员
                            $r = $m->where(array('org_guid'=>$org_guid, 'user_guid'=>$uid))->count('id');
                            if ($r<1){
                                $data = array('guid'=>create_guid(),
                                            'org_guid' => $org_guid,
                                            'user_guid' => $uid,
                                            'created_at' => time(),
                                            'updated_at' => time()
                                );
                                $m->data($data)->add();
                                $to_other_gorup[] = $uid;
                            }
                        }
                        //添加到未分组环信群组中
                        if(!empty($to_other_gorup)){
                            $chat->addGroupsUsers($auth['org_other_chat_id'], $to_other_gorup);
                        }
                        $this->success('删除成功.', $this->getReferer());
                    } else {
                        $this->error('参数错误, 请重试.', $this->getReferer());
                    }
                    exit();
                    break;
                case 'del_member':
                    $g_guids =  array();

                    foreach ($member_guids as $g){
                        $_id = explode('|', $g);
                        $g_guids[] = $_id[1];
                    }

                    $res = $m->where(array('user_guid'=> array('IN', $g_guids), 'org_guid'=>$org_guid))->delete();
                    if ($res > 0){
                        $this->success('删除成功.', $this->getReferer());
                    } else {
                        $this->error('参数错误, 请重试.', $this->getReferer());
                    }
                    exit();
                    break;
    			case 'op':
    				//批量操作分组
    				//1 获取该社团分组下的所有成员 放入Oldlist 然后获得前台选择的待加入分组的人员列表 与Oldlist 对比没有的就添加

    				$old_list = $m->where('org_guid="' . $org_guid . '" and is_del = 0 and  org_group_guid = "' . $org_group_guid . '"')
                                ->getField('user_guid', true);
    				$new_list = array();
    				foreach ($member_guids as  $ngg){
    					$ng = explode('|',$ngg);
                        if(!in_array($ng['1'], $old_list)){
                            $new_list[] = $ngg;
                        }
    				}
    				
    				if (count($new_list)>0){ //判断是否有新增加的分组人
                        $time = time();
    					foreach ($new_list as $v) {
    						$_guidT = explode('|',$v);//拆分传递过来的参宿值   格式*_guid
    						
    						$user_guid = $_guidT[1];  //获取guid

                            $new_guid_list[] = $user_guid;
    						$new_data[] = array(
                                'guid' => create_guid(),
                                'org_group_guid' => $org_group_guid,
                                'org_guid' => $org_guid,
                                'updated_at' => $time,
                                'created_at' => $time,
                                'user_guid' => $user_guid
                            );
    					}

                        // 注册环信
                        $dest_chat_group_id = M('OrgGroup')->where(array('guid'=>$org_group_guid))->getField('chat_group_id');
//                        $rest = new YmREST();
//                        $r = $rest->add_group_users($dest_chat_group_id, $new_guid_list, '2');
                        $chat = new YmChat();
                        $r = $chat->addGroupsUsers($dest_chat_group_id, $new_guid_list);
                        if($r['status'] != 200){
                            $this->error('添加失败, 请重试');exit();
                        }

                        // 操作数据库, 添加到新组
                        $m->addAll($new_data);

                        // 人员变动记录
                        D('OrgGroupMembersLog')->record(array($org_group_guid), $new_guid_list, '1');

                        // 删除未分组状态
                        $r = $chat->delGroupsUsers($auth['org_other_chat_id'], $new_guid_list);
                        if ($r > 0) {
                            $m->phy_delete(array('org_guid'       => $org_guid,
                                            'user_guid'      => array('in', $new_guid_list),
                                            'org_group_guid' => array('exp', 'IS NULL')));
                        }

    					exit($this->success('添加成功!', $this->getReferer()));
    				} else{
                        $this->error('所选社员已存在于所选分组中, 请匆重复增加.', $this->getReferer());
                    }

    				break;	
    			default:
    				exit($this->error('非法操作。', $this->getReferer()));
    				break;
    		}
    		
    	}
    
    	$this->error('非法操作。', $this->getReferer());
    }

    /**
     * 移出社团
     *
     * CT: 2014-11-01 14:00 by ylx
     * UT: 2014-12-04 15:00 by ylx
     */
    public function member_del()
    {
        $user_guid = I('get.guid');
        $sesstion_auth = $this->get_auth_session();
        if (empty($user_guid)) $this->error('未找到该社员.');

        //获取用户所有组的group_guid
        $user_group_guids = D('OrgGroupMembers')->get_group_guid_by_member_guid($sesstion_auth['org_guid'], $user_guid);

        // 删除环信注册
        $all_and_other = array($sesstion_auth['org_all_guid'], $sesstion_auth['org_other_guid']);
        $group_guids = array_diff($user_group_guids, $all_and_other);
        $groups = M('OrgGroup')->where(array('guid'=>array('in', $group_guids)))->getField('guid, chat_group_id');
        if(empty($groups)){
            $groups = array();
        }
        $groups[$sesstion_auth['org_all_guid']] = $sesstion_auth['org_all_chat_id'];
        $groups[$sesstion_auth['org_other_guid']] = $sesstion_auth['org_other_chat_id'];
        $chat = new YmChat();
        foreach($groups as $guid => $chat_id) {
            $r = $chat->delGroupsUser($chat_id, $user_guid);
            if($r['status'] != 200){
                $this->error('操作失败, 请重试.');
            }
            //删除数据库
            if($guid == $sesstion_auth['org_other_guid']) {
                M('OrgGroupMembers')->where(array('user_guid'  => $user_guid,
                                                  'org_guid'   => $sesstion_auth['org_guid'],
                                                  'org_group_guid' => array('exp', 'IS NULL')
                                            ))->delete();
            } else if($guid != $sesstion_auth['org_all_guid']) {
                M('OrgGroupMembers')->where(array('user_guid'      => $user_guid,
                                                  'org_guid'       => $sesstion_auth['org_guid'],
                                                  'org_group_guid' => $guid
                                            ))->delete();
            }
        }

        // 删除数据库
        $res = M('OrgGroupMembers')->where(array('user_guid'=> $user_guid, 'org_guid'=>$sesstion_auth['org_guid']))->find();
        if (!$res){
            M('user_org_state')->where(array('user_guid' => $user_guid,'org_guid' => $sesstion_auth['org_guid']))->delete();
            D('OrgGroupMembersLog')->record($user_group_guids, array($user_guid), '2');
            D('OrgMembersLog')->record($sesstion_auth['org_guid'], array($user_guid), '2');

            $this->success('删除成功.', U('Member/index'));
        } else {
            $this->error('参数错误, 请重试.', U('Member/index'));
        }
    }
    
    
    public function invite(){
        if (IS_POST || I('get.search')){
            $keyword =  I('post.search') ? I('post.search') : urldecode(I('get.search'));
            $org_guid = session('auth')['org_guid'];
            $num_per_page = 2;
            $condition = array();
            $condition['mobile'] = $condition['real_name'] = $condition['email'] = $keyword;
            $condition['_logic'] = 'OR';
            $user_info=array();
            $user_info = D('UserView')->where($condition)->group('guid')->page(I('get.p', '1').','.$num_per_page)->select();
            //数据分页
            $count = M('User')->where($condition)->count();// 查询满足要求的总记录数
            $Page = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
            $Page->parameter['search'] = $keyword;
            $show = $Page->show();// 分页显示输出
            $this->assign('page',$show);// 赋值分页输出

            /*当用户存在，判断用户和社团之间的状态 type:1 org->user type:2 user->org
                status:1 申请加入 2同意加入 3拒绝加入
            */
            if(!empty($user_info)){
                //判断是否被用户拉黑
                foreach($user_info as $k=>$v){
                    $is_blicklist=M('OrgBlacklist')->where(array('user_guid'=>$v['guid'],'org_guid'=>$org_guid,'type'=>'2','is_del'=>'0'))->find();
                    if($is_blicklist){
                       unset($user_info[$k]);
                       continue;
                    }
                    
                    $is_in_org=M('OrgGroupMembers')->where(array('user_guid'=>$v['guid'],'org_guid'=>$org_guid))->find();
                    if(!empty($is_in_org)){
                        $user_info[$k]['is_in_org'] = '1';
                    }else{
                        $where = array();
                        $where['user_guid'] = $v['guid'];
                        $where['org_guid'] = $org_guid;
                        $where['is_del'] = '0';
                        $user_org_state_list = M('UserOrgState')->where($where)->select();
                        foreach($user_org_state_list as $key=>$value){
                            if($value['status']=='1' && $value['type']=='1'){
                              $user_info[$k]['status'] = '1';
                            }
                            if($value['status']=='3' && $value['type']=='1'){
                              $user_info[$k]['status'] = '3';
                            }
                        } 
                    }
                }
            }
            $this->assign('result_list',$user_info);
        }
        $this->display();
    }
  
    public function invite_list(){
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        $num_per_page = C('NUM_PER_PAGE', null, '10');
        $condition = array('org_guid'=>$org_guid, 'status'=>array('neq','4'), 'type'=>'1');
        $examine_list = D('UserOrgStateView')->where($condition)->page(I('get.p', '1').','.$num_per_page)->order('status ASC')->select();
        
        //数据分页
        $count = D('UserOrgStateView')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        
        $this->assign('examine_list' ,$examine_list);
        $this->display();
    }
    
    public function invite_user(){
        $user_guid = I('post.user_guid');
        $org_guid = session('auth')['org_guid'];
        
        //移除黑名单
        M('OrgBlacklist')->where(array('org_guid'=>$org_guid, 'user_guid'=>$user_guid, 'type'=>'1'))->delete();
        
        $org_data = M('Org')->where(array('guid'=>$org_guid))->find();
        $user_data = M('User')->where(array('guid'=>$user_guid))->find();
        $data = array();
        $data['guid'] = create_guid();
        $data['user_guid'] = $user_guid;
        $data['org_guid'] = $org_guid;
        $data['type'] = '1';
        $data['status'] = '1';
        $data['created_at'] = time();
        $data['upadted_at'] = time();
        $model = M('UserOrgState');
        if($model->add($data,$options=array(),$replace=true)){
            
            $auth = $this->get_auth_session();
            $time = time();
            $msg = array(
                'from_id'  => $auth['org_guid'],
                'from_name'  => $auth['org_name'],
                'from_iconID' => $org_data['logo'],
                'to_id'    => $user_guid,
                'to_name'    => $user_data['real_name'],
                'to_iconID'   => $user_data['photo'],
                'content'    => $org_data['name'].'邀请你加入社团',
                'send_time'  => $time,
                'msg_type'  => '11101',
                'type'      => '11008'
            );
            // 发送消息
            $from_user = $org_guid;
            $to_user = array($user_guid);
            $chat = new YmChat();
            $chat->sendMsg($from_user, $to_user, 'txt', $msg['content'], 'users', array('content' => $msg));
            
            $this->ajaxReturn(array('status'=>'ok'));
        }else{
            $this->ajaxReturn(array('status'=>'ko'));
        }
    }
    
    
    public function examine(){
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        $num_per_page = C('NUM_PER_PAGE', null, '10');
        $condition = array('org_guid'=>$org_guid, 'status'=>array('neq','4'), 'type'=>'2');
        $examine_list = D('UserOrgStateView')->where($condition)->page(I('get.p', '1').','.$num_per_page)->order('status ASC')->select();
        
        //数据分页
        $count = D('UserOrgStateView')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        
        $this->assign('examine_list' ,$examine_list);
        $this->display();
    }
    
    public function examine_agree(){
        $time = time();
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        $user_guid = I('post.user_guid');
        $res = M('UserOrgState')->where(array('org_guid'=>$org_guid, 'user_guid'=>$user_guid, 'type'=>'2'))->save(array('upadted_at'=>$time, 'status'=>'2'));

        if($res){
            $org_info = M('Org')->where(array('guid'=>$org_guid))->find();
            $all_chat_group_id = $org_info['all_chat_group_id'];
            $other_chat_group_id = $org_info['other_chat_group_id'];
            
            $add_group_members_data=array();
            $add_group_members_data['guid'] = create_guid();
            $add_group_members_data['user_guid'] = $user_guid;
            $add_group_members_data['org_group_guid'] = null;
            $add_group_members_data['org_guid'] = $org_guid;
            $add_group_members_data['created_at'] = $time;
            $add_group_members_data['updated_at'] = $time;
            
            if(M('OrgGroupMembers')->add($add_group_members_data)){
                //成功 记录LOG
                D('OrgGroupMembersLog')->record(array($auth['org_all_guid'],$auth['org_other_guid']), array($user_guid), '1');
                D('OrgMembersLog')->record($org_guid, array($user_guid), '1');

                $YmChat = new YmChat();
                $all_result = $YmChat->addGroupsUser($all_chat_group_id, $user_guid);
                $other_result = $YmChat->addGroupsUser($other_chat_group_id, $user_guid);
                if($all_result['status']=='200' && $other_result['status']=='200'){
                    
                    $user_data = M('User')->where(array('guid'=>$user_guid))->find();  
                    $msg = array(
                        'from_id'  => $auth['org_guid'],
                        'from_name'  => $auth['org_name'],
                        'from_iconID' => $org_info['logo'],
                        'to_id'    => $user_guid,
                        'to_name'    => $user_data['real_name'],
                        'to_iconID'   => $user_data['photo'],
                        'content'    => $org_info['name'].'同意你加入社团',
                        'send_time'  => $time,
                        'msg_type'  => '11101',
                        'type'      => '11008'
                    );
                    // 发送消息
                    $from_user = $org_guid;
                    $to_user = array($user_guid);
                    $chat = new YmChat();
                    $chat->sendMsg($from_user, $to_user, 'txt', $msg['content'], 'users', array('content' => $msg));
                    //时间轴-加入社团
                    D('UserTimeline')->record($user_guid, '2', $auth['org_guid'], $auth['org_name']);
                    $this->ajaxReturn(array('status'=>'ok'));
                }else{
                    $this->ajaxReturn(array('status'=>'ko', 'msg'=>'环信注册失败'));
                }
            }else{
                $this->ajaxReturn(array('status'=>'ko', 'msg'=>'操作失败'));
            }
            
        }else{
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'操作失败'));
        }
    }
    
    public function examine_refuse(){
        $time = time();
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        $user_guid = I('post.user_guid');
        $refuse_msg = I('post.refuseMsg');
        
        $org_info = M('Org')->where(array('guid'=>$org_guid))->find();
        $all_chat_group_id = $org_info['all_chat_group_id'];
        $other_chat_group_id = $org_info['other_chat_group_id'];
        
        
        $res = M('UserOrgState')->where(array('org_guid'=>$org_guid, 'user_guid'=>$user_guid, 'type'=>'2'))->save(array('upadted_at'=>$time,'status'=>'3', 'refuse_msg'=>$refuse_msg));
        if($res){
            
            $YmChat = new YmChat();
            $all_result = $YmChat->addGroupsUser($all_chat_group_id, $user_guid);
            $other_result = $YmChat->addGroupsUser($other_chat_group_id, $user_guid);
            if($all_result['status']=='200' && $other_result['status']=='200'){
                $user_data = M('User')->where(array('guid'=>$user_guid))->find();
                $msg = array(
                    'from_id'  => $auth['org_guid'],
                    'from_name'  => $auth['org_name'],
                    'from_iconID' => $org_info['logo'],
                    'to_id'    => $user_guid,
                    'to_name'    => $user_data['real_name'],
                    'to_iconID'   => $user_data['photo'],
                    'content'    => $org_info['name'].'已拒绝您的加入申请',
                    'send_time'  => $time,
                    'msg_type'  => '11101',
                    'type'      => '11008'
                );
                // 发送消息
                $from_user = $org_guid;
                $to_user = array($user_guid);
                $chat = new YmChat();
                $chat->sendMsg($from_user, $to_user, 'txt', $msg['content'], 'users', array('content' => $msg));
                
                $this->ajaxReturn(array('status'=>'ok'));
            }else{
                $this->ajaxReturn(array('status'=>'ko', 'msg'=>'环信注册失败'));
            }
            
        }else{
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'操作失败'));
        }
    }
    
    public function send_msg($org_info, $user_info, $content, $msg_type, $type){
        $msg = array(
            'from_id' => $org_info['org_guid'],
            'from_name'  => $org_info['org_name'],
            'from_iconID' => $org_info['logo'],
            'to_id'    => $user_info['guid'],
            'to_name'    => $user_info['real_name'],
            'to_iconID'   => $user_info['photo'],
            'content'    => $content,
            'send_time'  => time(),
            'msg_type'  => $msg_type,
            'type'      => $type
        );
        // 发送消息
        $from_user = $org_info['org_guid'];
        $to_user = array($user_info['guid']);
        $chat = new YmChat();
        $chat->sendMsg($from_user, $to_user, 'txt', $msg['content'], 'users', array('content' => $msg));
    }
    
    public function examine_pull_black(){
        $time = time();
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        $user_guid = I('post.user_guid');
        
        $res = M('UserOrgState')->where(array('org_guid'=>$org_guid, 'user_guid'=>$user_guid, 'type'=>'2'))->save(array('upadted_at'=>$time,'status'=>'4'));
        if($res){
	        $blacklist_data = array();
			$blacklist_data['guid'] = create_guid();
			$blacklist_data['user_guid'] = $user_guid;
			$blacklist_data['org_guid'] = $org_guid;
			$blacklist_data['type'] = '1';
			$blacklist_data['created_at'] = $time;
			$blacklist_data['updated_at'] = $time;
			if(M('OrgBlacklist')->add($blacklist_data)){
				 $this->ajaxReturn(array('status'=>'ok'));
			}else{
				 $this->ajaxReturn(array('status'=>'ko', 'msg'=>'操作失败'));
			}
        }else{
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'操作失败'));
        }
    }
    
    public function black_list(){
        $auth = $this->get_auth_session();
        $org_guid = $auth['org_guid'];
        $num_per_page = C('NUM_PER_PAGE', null, '10');
        $condition = array('org_guid'=>$org_guid, 'type'=>'1');
        $black_list = D('OrgBlacklistView')->where($condition)->page(I('get.p', '1').','.$num_per_page)->select();

        //数据分页
        $count = D('UserOrgStateView')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,$num_per_page);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        
        $this->assign('black_list' ,$black_list);
        $this->display();
    }
    
    public function remove_blacklist(){
        $guid = I('post.guid');
        
        $res = M('OrgBlacklist')->where(array('guid'=>$guid))->delete();
        if($res){
            $this->ajaxReturn(array('status'=>'ok'));
        }else{
            $this->ajaxReturn(array('status'=>'ko', 'msg'=>'操作失败'));
        }
    }
}