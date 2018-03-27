<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Config;
use think\Db;
use think\Url;
use think\Route;
use think\Loader;
use think\Request;
// 应用公共文件
/**
 * 获取当前登录的管理员ID
 * @return int
 */
function get_current_admin_id(){
	return session('ADMIN_ID');
}
/**
 * 判断前台用户是否登录
 * @return boolean
 */
function is_user_regist($username)
{
    $userinfo = Db::name("users")->where(['username'=>$username])->find();
    return empty($userinfo);
}
/**
 * 判断前台用户是否登录
 * @return boolean
 */
function is_user_login()
{
    $sessionUser = session('user');
    return !empty($sessionUser);
}
/**
 * 获取当前登录前台用户id
 * @return int
 */
function get_current_user_id()
{
    $sessionUserId = session('user.id');
    if (empty($sessionUserId)) {
        return 0;
    }

    return $sessionUserId;
}
/**
 * 更新当前登录前台用户的信息
 * @param array $user 前台用户的信息
 */
function update_current_user($user)
{
    session('user', $user);
}
/**
 * 返回带协议的域名
 */
function get_domain()
{
    $request = Request::instance();
    return $request->domain();
}
/**
 * 获取网站根目录
 * @return string 网站根目录
 */
function get_root()
{
    $request = Request::instance();
    $root    = $request->root();
    $root    = str_replace('/index.php', '', $root);
    if (defined('APP_NAMESPACE') && APP_NAMESPACE == 'api') {
        $root = preg_replace('/\/api$/', '', $root);
        $root = rtrim($root, '/');
    }
    return $root;
}
/**
 * 随机字符串生成
 * @param int $len 生成的字符串长度
 * @return string
 */
function cmf_random_string($len = 6)
{
    $chars    = [
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    ];
    $charsLen = count($chars) - 1;
    shuffle($chars);    // 将数组打乱
    $output = "";
    for ($i = 0; $i < $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}
/**
 * 获取当前主题名
 * @return string
 */
function get_current_theme()
{
    static $_currentTheme;

    if (!empty($_currentTheme)) {
        return $_currentTheme;
    }

    $t     = 't';
    $theme = config('default_theme');

    $cmfDetectTheme = config('detect_theme');
    if ($cmfDetectTheme) {
        if (isset($_GET[$t])) {
            $theme = $_GET[$t];
            cookie('template', $theme, 864000);
        } elseif (cookie('template')) {
            $theme = cookie('template');
        }
    }

    $hookTheme = hook_one('switch_theme');

    if ($hookTheme) {
        $theme = $hookTheme;
    }

    $_currentTheme = $theme;

    return $theme;
}

/**
 * 获取前台模板根目录
 * @param string $theme
 * @return string 前台模板根目录
 */
function get_theme_path($theme = null)
{
    $themePath = config('theme_path');
    if ($theme === null) {
        // 获取当前主题名称
        $theme = get_current_theme();
    }

    return './' . $themePath . $theme;
}
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return string
 */
function get_client_ip($type = 0, $adv = false)
{
    return request()->ip($type, $adv);
}
/**
* 遍历模块
*/
function getModules(){
    $path = ADDONS_PATH;
    $data = [];
    foreach(scandir($path) as $afile)
    {
        if($afile=='.'||$afile=='..') continue; 
        if(is_dir($path.'/'.$afile)) 
        {
            $data[] = $afile;
        }
    }
    return $data;
}
/**
 * 获取模块完整路径
 */
function getAddonsFullPath($addons_name){
    return ADDONS_PATH.$addons_name;
}
/**
 * 获取模块配置信息
 */
function getAddonsConfigPath($addons_name){
    $config = include ADDONS_PATH.$addons_name."/config.php";
    return $config;
}
/**
*  是否升级
*/
function isUpgrade(){
    $data = getModules();
    if(!empty($data)){
        foreach ($data as $key => $value) {
            $config = include(ADDONS_PATH.$value.'/config.php');
            $application = $config['application'];
            if($application['version']){
                var_dump($application['version']);
            }
        }
    }
}
/**
 * 切分SQL文件成多个可以单独执行的sql语句
 * @param $file sql文件路径
 * @param $tablePre 表前缀
 * @param string $charset 字符集
 * @param string $defaultTablePre 默认表前缀
 * @param string $defaultCharset 默认字符集
 * @return array
 */
function split_sql($file, $tablePre, $charset = 'utf8mb4', $defaultTablePre = 'cmf_', $defaultCharset = 'utf8mb4')
{
    if (file_exists($file)) {
        //读取SQL文件
        $sql = file_get_contents($file);
        $sql = str_replace("\r", "\n", $sql);
        $sql = str_replace("BEGIN;\n", '', $sql);//兼容 navicat 导出的 insert 语句
        $sql = str_replace("COMMIT;\n", '', $sql);//兼容 navicat 导出的 insert 语句
        $sql = str_replace($defaultCharset, $charset, $sql);
        $sql = trim($sql);
        //替换表前缀
        $sql  = str_replace(" `{$defaultTablePre}", " `{$tablePre}", $sql);
        $sqls = explode(";\n", $sql);
        return $sqls;
    }

    return [];
}
/**
 * curl get 请求
 * @param $url
 * @return mixed
 */
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $SSL = substr($url, 0, 8) == "https://" ? true : false;
    if ($SSL) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名
    }
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}