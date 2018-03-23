<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
// 调试模式开关
define("APP_DEBUG", true);
define("PUBLIC_PATH", __DIR__);
// 定义根目录,可更改此目录
define('WXSAAS_ROOT',__DIR__."/../");
// 定义应用目录
define('ADDONS_PATH', WXSAAS_ROOT . 'addons/');
// 定义应用目录
define('APP_PATH', WXSAAS_ROOT . 'application/');
// 定义核心包目录
define('WXSAAS_PATH',WXSAAS_ROOT."framework/wxsaas/");
// 定义扩展目录
define('EXTEND_PATH', WXSAAS_ROOT . 'framework/extend/');
define('VENDOR_PATH', WXSAAS_ROOT . 'framework/vendor/');
// 定义应用的运行时目录
define('RUNTIME_PATH', WXSAAS_ROOT . 'data/runtime/');

// 加载框架引导文件
require __DIR__ . '/../framework/thinkphp/start.php';
