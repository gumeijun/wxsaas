<?php
namespace wxsaas\classs;
use think\Db;
class Account{
    public $uniacid;//uniacid 唯一ID
    public function createAccount($type=1,$endtime=0){
        $data = ['type'=>$type,'endtime'=>$endtime];
        $acid = Db::name('account')->insertGetId($data);
        if($acid){
            $this->uniacid = $acid;
            Db::name('account')->where(['id'=>$acid])->update(['uniacid'=>$acid]);
        }
    }
}