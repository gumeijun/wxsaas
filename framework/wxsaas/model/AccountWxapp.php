<?php
/**
 * Created by PhpStorm.
 * User: aiwo
 * Date: 2018-3-30
 * Time: 20:33
 */
namespace wxsaas\model;
use think\Model;
/**
 * 系统users模型
 */
class AccountWxapp extends Model
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
}