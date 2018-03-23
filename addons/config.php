<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
if (file_exists(WXSAAS_ROOT . "data/conf/config.php")) {
    $runtimeConfig = include WXSAAS_ROOT . "data/conf/config.php";
} else {
    $runtimeConfig = [];
}
$configs = [];
return array_merge($configs, $runtimeConfig);