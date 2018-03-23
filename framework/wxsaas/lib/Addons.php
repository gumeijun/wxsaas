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
    /**
     * 获取模块完整路径
     */
    public function getAddonsFullPath($addons_name){
        return ADDONS_PATH.$addons_name;
    }
    /**
     * 获取模块配置路径
     */
    public function getAddonsConfigPath($addons_name){
        return ADDONS_PATH.$addons_name."/config.php";
    }
}