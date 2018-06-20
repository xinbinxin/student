<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 17:26
 */
//判断 dd 函数是否存在  如果不存在
if (!function_exists('dd')) {
//    定义p函数
    function dd($var)
    {
        echo '<pre style="background: #cccccc;padding: 10px;border-radius: 10px;">';
        if (is_null($var) || is_bool($var)) {
            var_dump($var);
        } else {
            print_r($var);
        }
        echo '</pre>';
        die;
    }
}

//判断 p 函数是否存在  如果不存在
if (!function_exists('p')) {
//    定义p函数
    function p($var)
    {
        echo '<pre style="background: #cccccc;padding: 10px;border-radius: 10px;">';
        if (is_null($var) || is_bool($var)) {
            var_dump($var);
        } else {
            print_r($var);
        }
        echo '</pre>';
    }
}

/**
 * 全局配置函数
 * 使用
 * config(database.db_host)
 */
//判断 config 函数是否存在  如果不存在
if (!function_exists('config')) {
//    定义config函数
    function config($path) //$path='database.db_host'
    {
        $arr = explode('.', $path);//字符串分割成数组
        $dirPath = '../app/' . $arr[0] . '.php';//配置项路径
        $filePath = include $dirPath;//获得配置项
//        Array
//        (
//            [db_host] => 127.0.0.1
//        )
//        dd($arr[1]);
        return isset($filePath[$arr[1]]) ? $filePath[$arr[1]] : NUll;
    }
}


/**
 * 全局变量
 *
 * @param $name 变量名
 * @param string $value 变量值
 *
 * @return mixed 返回值
 * v('a','abc');  v('a')
 * 使用：
 * $a =include '../app/database.php';
 * v('config', $a);
 * p(v('config.db_name'))/p(v('config'))
 *
 */
if (!function_exists('v')) {
    function v($name = null, $value = '[null]')
    {
        static $vars = [];
        if (is_null($name)) {
            return $vars;
        } else if ($value == '[null]') {
            //取变量
            $tmp = $vars;
            foreach (explode('.', $name) as $d) {
                if (isset($tmp[$d])) {
                    $tmp = $tmp[$d];
                } else {
                    return null;
                }
            }
            return $tmp;
        } else {
            //设置
            $tmp = &$vars;
            foreach (explode('.', $name) as $d) {
                if (!isset($tmp[$d])) {
                    $tmp[$d] = [];
                }
                $tmp = &$tmp[$d];
            }
            return $tmp = $value;
        }
    }
}





