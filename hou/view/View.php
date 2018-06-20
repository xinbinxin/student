<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 18:41
 */

namespace hou\view;


class View
{
    //当我们在调用一个类里面不存在的静态方法时会自动触发__callStatic方法，
    //而且会把方法的名称和参数传进来

    public static function __callStatic($name, $arguments)
    {
      return  call_user_func_array([new Base(), $name], $arguments);
    }

    //当我们在调用一个类里面不存在的方法时会自动触发__call方法，
    //而且会把方法的名称和参数传进来
    public  function __call($name, $arguments)
    {
      return  call_user_func_array([new Base(), $name], $arguments);
    }


}