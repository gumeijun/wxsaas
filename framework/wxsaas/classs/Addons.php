<?php
/**
 * 模块操作类
 */
namespace wxsaas\classs;
use think\Request;
use wxsaas\model\Modules;
use wxsaas\model\ModulesBindings;
class Addons{
    /**
     * 安装模块
     */
    public function install($addonName){
        $config = getAddonsConfigPath($addonName);
        if(empty($config)){
            return ['error'=>'404','msg'=>'模块不存在'];
        }
        $data = [
            'name'=>$config['application']['identifie'],
            'type'=>$config['application']['type'],
            'title'=>$config['application']['name'],
            'version'=>$config['application']['version'],
            'description'=>$config['application']['description'],
            'author'=>$config['application']['author']
        ];
        $module = new Modules();
        $moduleInfo = $module->where(['name'=>$data['name']])->find();
        if(!empty($moduleInfo)){
            return ['error'=>101,'msg'=>'模块已安装'];
        }
        $module->data($data);
        $module->save();
        if($module->mid && !empty($config['bindings']['menu'])){
            $this->addMenu($data['name'],$config['bindings']['menu']);
        }
        return ['error'=>0,'msg'=>'模块已安装','data'=>$module->mid];
    }
    /**
     * 添加菜单
     */
    private function addMenu($name,$menus){
        foreach($menus as $item){
            $data = [
                'module'=>$name,
                'entry'=>'menu',
                'title'=>$item['title'],
                'action'=>$item['action'],
                'ctroller'=>$item['ctroller']
            ];
            $menu = new ModulesBindings($data);
            $menu->save();
        }
    }
    /**
     * 卸载
     */
    public function uninstall(){

    }
    /**
     * 升级
     */
    public function upgrade(){

    }
    /**
     * 获取菜单
     */
    public function getAdminMenus($moduleName){
        $menu = new ModulesBindings();
        $menus = $menu->where(['module'=>$moduleName])->select();
        foreach($menus as $item){
            $url = Request::instance()->host."/saas/public/addons.php/".$item->module."/web.".$item->ctroller."/".$item->action;
            echo "<a href='$url'>$item->title</a>";
        }
    }
}