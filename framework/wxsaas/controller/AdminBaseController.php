<?php
// +----------------------------------------------------------------------
// | Think [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.think.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace wxsaas\controller;

use think\Db;
use wxsaas\lib\Addons;
class AdminBaseController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
        $this->menu = $this->getMenu();
        foreach($this->menu as $key=>$item){
            $this->menu[$key]['url'] = $item['app']."/".$item['controller']."/".$item['action'];
        }
        $controller = $this->request->controller();
        if(!empty($controller)){
            $where['controller'] = $controller;
            $where['parent_id'] = ['>',0];
            $subMenu = DB::name("admin_menu")->where($where)->select();
            foreach($subMenu as $key=>$item){
                $subMenu[$key]['url'] = $item['app']."/".$item['controller']."/".$item['action'];
            }
            $this->assign('submenu',$subMenu);
        }
        $this->assign('menu',$this->menu);
    }
    public function _initializeView()
    {
        $AdminThemePath    = config('admin_theme_path');
        $AdminDefaultTheme = config('admin_default_theme');
        
        
        $themePath = "{$AdminThemePath}{$AdminDefaultTheme}";
        $root = get_root();
        $viewReplaceStr = [
                '__ROOT__'     => $root,
                '__TMPL__'     => "{$root}/{$themePath}",
                '__STATIC__'   => "{$root}/static",
                '__WEB_ROOT__' => $root
        ];

        $viewReplaceStr = array_merge(config('view_replace_str'), $viewReplaceStr);
        config('template.view_base', "$themePath/");
        config('view_replace_str', $viewReplaceStr);
    }
    public function getMenu(){
        $menu = DB::name("admin_menu")->where("parent_id=0")->select();
        return $menu;
    }
}