<?php
namespace app\admin\controller;
use wxsaas\controller\AdminBaseController;
use think\Config;
class MenuController extends AdminBaseController
{
    public function index()
    {
        return $this->fetch();
    }
    public function login(){
    	return $this->fetch();
    }
    public function main(){
       
    }
}
