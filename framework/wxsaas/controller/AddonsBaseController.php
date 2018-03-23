<?php
namespace wxsaas\controller;

use think\Db;
use think\Session;
class AddonsBaseController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
        $adminUid = Session::get("adminUid");
        if(!$adminUid){
            //echo "非法登陆";die;
        }
    }
	public function show(){
		echo "hello";
	}
}