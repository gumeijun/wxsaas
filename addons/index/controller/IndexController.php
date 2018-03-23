<?php
namespace app\index\controller;
use wxsaas\controller\AddonsBaseController;
use wxsaas\model\Users;
class IndexController extends AddonsBaseController
{
    public function index()
    {
        $user['username'] = 'gumeijun';
        $user['password'] = 123456;
        $users = new Users();
        /*if(!$users->addUser($user)){
        	$this->error("用户已注册");
        }*/
        $this->assign("username",$user['username']);
        return $this->fetch();
    }
}
