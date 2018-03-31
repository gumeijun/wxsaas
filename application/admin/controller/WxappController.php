<?php
namespace app\admin\controller;
use wxsaas\classs\WxappAcount;
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
    public function manage(){
        echo request()->get('id');
        return $this->fetch();
    }
}