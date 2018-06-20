<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 22:48
 */

namespace app\index\controller;

//abstract 不需要实例化
abstract class Base
{
//    protected 子类调用
    protected function message($msg, $url)
    {
    $str = <<<str
      <script>   
        alert('{$msg}');       
        location.href ='{$url}';
      </script>
str;
       echo die($str);
    }

}