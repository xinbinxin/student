<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 17:40
 */

namespace hou\core;

/**
 *框架启动类
 * Class Boot
 * @package hou\core
 */
class Boot
{
    public static function run()
    {

        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();


//        1.初始化
        self::init();
        self::appRun();
    }

    private static function appRun()
    {
        $rules = isset($_GET['s']) ? strtolower($_GET['s']) : "index/index/index"; //?s=index/index/index
        $arr = explode('/', $rules);


        //定义模块，控制器，方法的常量
        define('MODULE', $arr[0]);
        define('CONTROLLER', $arr[1]);
        define('ACTION', $arr[2]);


        $d = ucfirst($arr[1]);
        $className = "\app\\$arr[0]\\controller\\$d"; //组合类名
        $fangFa = $arr[2];//组合方法
        $result = new $className;
        $result->$fangFa();
    }


    /**
     * 框架初始化
     * private 只能在Boot类使用，外部无法使用
     */
    private static function init()
    {
        session_id() || session_start();//开启session
        date_default_timezone_set('PRC');//设置时区
    }


}