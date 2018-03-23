<?php
namespace app\admin\controller;
use wxsaas\controller\AdminBaseController;
use think\Config;
class SystemController extends AdminBaseController
{
    public function index(){
        return $this->fetch();
    }
    public function wxappModules(){
       return $this->fetch();
    }
    public function wxapps(){

    }
}