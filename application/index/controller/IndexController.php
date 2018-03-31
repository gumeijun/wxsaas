<?php
namespace app\index\controller;
use think\Db;
use think\Config;
use think\Session;
use think\Validate;
use wxsaas\controller\HomeBaseController;
use shop\Init;
class IndexController extends HomeBaseController
{
    public function index()
    {
        //创建数据库
        // $dbConfig             = Config::get("database");
        
        // $db = Db::connect($dbConfig);
        // $sqls = split_sql(ADDONS_PATH.$module_name.DS."thinkcmf.sql", $dbConfig['prefix'], $dbConfig['charset']);
        // foreach($sqls as $item){
        //     $db->execute($item);
        // }
        if($this->isLogin()){
            $this->redirect('admin/index/index');
        }
        return $this->fetch();
    }

    /**
     * 登陆
     */
    public function login(){
        $username = input("username");
        $password = md5(input("password"));
        $map = [
            'username'=>$username,
            'password'=>$password
        ];
        $userinfo = Db::name("users")->where($map)->find();
        if(empty($userinfo)){
            $this->error("帐号密码错误");
        }
        Session::set('admin_id',$userinfo['uid']);
        Session::set('admin_username',$userinfo['username']);
        $this->redirect('admin/index/index');
    }

    /**
     * 判断是否登陆
     * @return bool
     */
    private function isLogin(){
        if(Session::get('admin_id')){
            return true;
        }
        return false;
    }
}
