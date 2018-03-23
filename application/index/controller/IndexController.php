<?php
namespace app\index\controller;
use think\Db;
use think\Config;
use think\Session;
use wxsaas\controller\HomeBaseController;
use shop\Init;
class IndexController extends HomeBaseController
{
    public function index()
    {
        $module_name = "shuozhuo_benyilipin";
        //创建数据库
        // $dbConfig             = Config::get("database");
        
        // $db = Db::connect($dbConfig);
        // $sqls = split_sql(ADDONS_PATH.$module_name.DS."thinkcmf.sql", $dbConfig['prefix'], $dbConfig['charset']);
        // foreach($sqls as $item){
        //     $db->execute($item);
        // }
        Session::set('name','thinkphp');
        //return $this->fetch();
    }
}
