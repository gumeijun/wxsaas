<?php
namespace wxsaas\lib;

class Addons{
    public $addons = [];
    /**
     * 获取所有模块
     */
    public function lists(){
        $handler = opendir(ADDONS_PATH);
        while( ($filename = readdir($handler)) !== false ) 
        {
            //略过linux目录的名字为'.'和‘..'的文件
            if($filename != '.' && $filename != '..')
            {  
                //输出文件名
                if(is_dir(ADDONS_PATH.$filename)){
                    $this->addons[] = $filename;
                }
            }
        }
        return $this->addons;
    }
}