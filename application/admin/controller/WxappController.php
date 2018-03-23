<?php
namespace app\admin\controller;
use wxsaas\controller\AdminBaseController;
use think\Config;
use wxsaas\model\Modules;
class WxappController extends AdminBaseController
{
    public function index()
    {
        $model = new Modules();
        $moduleInfo = $model->module_fetch('shuozhuo_benyilipin');
        if(isset($moduleInfo['error'])){
            var_dump($moduleInfo['msg']);die;
        }
        var_dump(get_client_ip());
        return $this->fetch();
    }
    public function login(){
    	return $this->fetch();
    }
    public function main(){
       
    }
}