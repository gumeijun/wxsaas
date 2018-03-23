<?php
namespace wxsaas\model;
use think\Model;
/**
* 系统模块模型
*/
class Modules extends Model{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    /**
     * 按照模块名称查找一个模块信息
     */
    public function module_fetch($name){
        $moduleInfo = $this->where(['name'=>$name])->find();
        if(empty($moduleInfo)){
            return ['error'=>'404','msg'=>'模块不存在'];
        }
        return $moduleInfo;
    }
}