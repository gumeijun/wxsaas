<?php
namespace app\admin\controller;
use wxsaas\controller\AdminBaseController;
use think\Config;
use wxsaas\classs\WxappAcount;
class IndexController extends AdminBaseController
{
    public function index()
    {
        var_dump(getModules());
        return $this->fetch();
    }
    public function login(){
    	return $this->fetch();
    }
    public function main(){

    }
}
