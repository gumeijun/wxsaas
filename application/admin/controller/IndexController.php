<?php
namespace app\admin\controller;
use wxsaas\controller\AdminBaseController;
use think\Config;
use wxsaas\classs\WxappAcount;
use wxsaas\classs\Addons;
class IndexController extends AdminBaseController
{
    public function index()
    {
        $addons = new Addons();
        $data = $addons->getAdminMenus('shuozhuo_benyilipin');
        return $this->fetch();
    }
    public function login(){
    	return $this->fetch();
    }
    public function main(){

    }
}
