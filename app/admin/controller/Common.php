<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 0:26
 */

namespace app\admin\controller;


use app\index\controller\Base;

class Common extends Base
{
   public function __construct()
   {
       if (!isset($_SESSION['user'])) {
           $this->message('请去登陆', '?s=admin/login/index');
       }
   }
}