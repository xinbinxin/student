<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 20:51
 */

namespace hou\model;


class Model
{
    public function __call($name, $arguments)
    {
        return call_user_func_array([new Base(), $name], $arguments);
    }

    public static function __callStatic($name, $arguments)
    {

        $data = explode('\\', get_called_class()); //获得调用的类名
        $tableName = strtolower($data[2]);


        return call_user_func_array([new Base($tableName), $name], $arguments);
    }
}