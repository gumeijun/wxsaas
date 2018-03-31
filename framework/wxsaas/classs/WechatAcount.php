<?php
namespace wxsaas\classs;
use wxsaas\classs\Account;
use wxapp\aes\WXBizDataCrypt;
use think\Validate;
use think\Request;
class WechatAcount extends Account{
    /**
     * 添加一个公众号
     * @param int $type
     * @param int $endtime
     */
    public function create($data,$type = 1, $endtime = 0)
    {
        parent::createAccount($type, $endtime);
        //写入account_wechat记录
    }
}