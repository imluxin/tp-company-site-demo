<?php
namespace Common\Model;
/**
 * 手机验证码 模型
 *
 * CT 2015-04-10 17:39 by ylx
 */
class CheckMobileModel extends BaseModel
{
    /**
     * 验证手机验证码
     * @param $mobile 手机
     * @param $code 验证码
     * @return mixd
     * CT 2015-04-10 17:39 by ylx
     */
    public function check_code($mobile, $code)
    {
        if(empty($mobile) || empty($code)) {
            return false;
        }
        $check_data = $this->where(array('mobile'=>$mobile, 'status' => '0', 'code' => $code))
            ->order('created_at DESC')->find();
        if(empty($check_data)) {
           return 31;
        }

        if($check_data['expired_at'] > time()){
            $this->where(array('mobile'=>$mobile, 'code'=>$code))->delete();
            return true;
        }else{
            return 30;
        }
    }

}