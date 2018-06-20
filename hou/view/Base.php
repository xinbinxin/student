<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 18:41
 */

namespace hou\view;
/**
 * 核心类
 * Class Base
 * @package hou\view
 */
class Base
{

    private $data = [];

    /**
     * 载入模板
     */
    public function make()
    {
       extract($this->data);//将compact打包好的数据(变量)拆开
        //include "../app/index/view/index/index.html";
        $rules = '../app/' . MODULE . '/view/' . CONTROLLER . '/' . ACTION . '.html';
        include $rules;
    }


    public  function with($data)
    {
        $this->data = $data;
        return $this;
    }
}