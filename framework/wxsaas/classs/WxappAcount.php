<?php
namespace wxsaas\classs;
use wxsaas\classs\Account;
use wxapp\aes\WXBizDataCrypt;
use think\Validate;
use think\Request;
use wxsaas\model\AccountWxapp;

class WxappAcount extends Account{
    public function __construct(){
        $this->request = Request::instance();
    }

    /**
     * 创建小程序应用
     * @param $data
     * @param int $type
     * @param int $endtime
     */
    public function create($data,$type = 2,$endtime = 0)
    {
        parent::createAccount($type, $endtime);
        $wxapp = new AccountWxapp;
        $wxapp->uniacid = $this->uniacid;
        $wxapp->original = $data['original'];
        $wxapp->key = $data['key'];
        $wxapp->secret = $data['secret'];
        $wxapp->name = $data['name'];
        $wxapp->save();
        return $wxapp->id;
    }

    // 微信小程序用户登录 TODO 增加最后登录信息记录,如 ip
    public function login($app_id,$app_secret)
    {
        $validate = new Validate([
            'code'           => 'require',
            'encrypted_data' => 'require',
            'iv'             => 'require',
            'raw_data'       => 'require',
            'signature'      => 'require',
        ]);

        $validate->message([
            'code.require'           => '缺少参数code!',
            'encrypted_data.require' => '缺少参数encrypted_data!',
            'iv.require'             => '缺少参数iv!',
            'raw_data.require'       => '缺少参数raw_data!',
            'signature.require'      => '缺少参数signature!',
        ]);

        $data = $this->request->param();
        if (!$validate->check($data)) {
            die($validate->getError());
        }

        $code          = $data['code'];
        $appId        = $app_id;
        $appSecret    = $app_secret;

        $response = curl_get("https://api.weixin.qq.com/sns/jscode2session?appid=$appId&secret=$appSecret&js_code=$code&grant_type=authorization_code");

        $response = json_decode($response, true);
        if (!empty($response['errcode'])) {
            die('操作失败!');
        }
        $wxUserData = $this->DataCrypt($response['openid'],$response['session_key'],$data);
        return $wxUserData;
    }
    /**
     * 解码数据
     */
    private function DataCrypt($openid,$sessionKey,$data){
        $pc      = new WXBizDataCrypt($appId, $sessionKey);
        $errCode = $pc->decryptData($data['encrypted_data'], $data['iv'], $wxUserData);

        if ($errCode != 0) {
            die('操作失败!');
        }
        return $wxUserData;
    }
}