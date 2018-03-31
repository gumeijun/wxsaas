<?php
namespace app\admin\controller;
use wxsaas\classs\WxappAcount;
use wxsaas\controller\AdminBaseController;
use think\Config;
use wxsaas\model\AccountWxapp;
use wxsaas\model\Modules;
class WxappController extends AdminBaseController
{
    public function index()
    {
        $lists = AccountWxapp::all();
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    public function login(){
    	return $this->fetch();
    }
    public function main(){
       
    }
    public function add(){
        $lists = Modules::all();
        $this->assign("lists",$lists);
        return $this->fetch();
    }
    public function createWxapp(){
        $data = request()->post();
        $account = new WxappAcount();
        $id = $account->create($data);
        if($id){
            $this->redirect("wxapp/manage",['id'=>$id]);
        }
    }
    public function detail(){
        $id = input('id');
        $module = AccountWxapp::get(['id'=>$id]);
        $this->assign('info',$module);
        $lists = unserialize('a:1:{s:11:"yyf_company";a:2:{s:4:"name";s:11:"yyf_company";s:7:"version";s:4:"21.0";}}');
        $wxappLists = [];
        foreach($lists as $name=>$item){
            $wxappInfo = Modules::get(['name'=>$name]);
            $wxapp['name'] = $name;
            $wxapp['title'] = $wxappInfo->title;
            $wxapp['url'] = 'addons.php/'.$name."/web.index";
            $wxappLists[]= $wxapp;
        }
        var_dump($wxappLists);
        return $this->fetch();
    }
    public function manage(){
        echo request()->get('id');
        return $this->fetch();
    }
}