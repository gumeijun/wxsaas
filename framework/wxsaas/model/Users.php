<?php
namespace wxsaas\model;
use think\Model;
/**
* 系统users模型
*/
class Users extends Model
{
	
	//自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    public function addUser($userinfo){
    	if(!empty($userinfo)){
    		$this->username = $userinfo['username'];
            $this->salt = cmf_random_string(6);
            $this->password = md5($userinfo['password'].$this->salt);
            $this->joindate = $this->lastvisit = time();
            $this->joinip = $this->lastip = get_client_ip();
    		if(is_user_regist($this->username)){
                return $this->save();
            }else{
                return false;
            }
    	}else{
    		return false;
    	}
    }
}