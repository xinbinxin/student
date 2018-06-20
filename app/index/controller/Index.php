<?php

namespace app\index\controller;

use hou\model\Base;
use hou\model\Model;
use hou\view\View;
use system\model\Stu;
use system\model\Test;
use Gregwar\Captcha\CaptchaBuilder;

class Index
{
    public function index()
    {
        $where =isset($_GET['gid'])? " where s.gid=".(int)$_GET['gid']:"";
        $sql = "select *,s.id sid from stu s JOIN grade g on s.gid=g.id {$where}";
        $data = Model::select($sql);
        View::with(compact('data'))->make();
    }

    public function show()
    {
        $id = $_GET['id'];
        $sql = "select *,s.id sid from stu s JOIN grade g on s.gid=g.id WHERE s.id=$id";
        $data = current(Stu::select($sql));
        View::with(compact('data'))-> make();
    }

    public function read()
    {
        $gid = $_GET['gid'];
        $sql = "select * from stu where gid=$gid";
        $data = count(Model::select($sql));
        $str = <<<str
    <script>    
    alert('共'+ $data+'名学生');
   history.back();
    </script> 
str;
        die($str);
    }
}