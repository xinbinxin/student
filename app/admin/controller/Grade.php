<?php

namespace app\admin\controller;

use app\index\controller\Base;
use hou\model\Model;
use hou\view\View;
use system\model\Grade as GradeModel;

class Grade extends Common
{
    public function index()
    {
        $sql = "select *, g.name gname, g.id ids,count(s.id) num from grade g left join stu s on g.id=s.gid group by g.id order by ids desc";
        $data = GradeModel::select($sql);
//        dd($data);
        View::with(compact('data'))->make();
    }

    public function create()
    {
        if (IS_POST) {
            try {
                GradeModel::insert($_POST);
            } catch (\Exception $e) {
                $this->message($e->getMessage(), '?s=admin/grade/index');
            }
            $this->message('班级添加成功', '?s=admin/grade/index');
        } else {
            View::make();
        }
    }

    public function edit()
    {
        $id =(int)$_GET['id'];
        $data = GradeModel::find($id);
        if (IS_POST) {
            GradeModel::update($_POST);
            $this->message('编辑成功', '?s=admin/grade/index');
        }else{
            View::with(compact('data'))->make();
        }
    }

    public function delete()
    {
        $id =(int)$_GET['id'];
//        判断班级下面是否有学生
        $sql = "select * from stu WHERE gid=$id";
        $data = GradeModel::select($sql);
        if ($data) {
            $this->message('班级下有学生不能直接删除', '?s=admin/grade/index');
        } else {
            GradeModel::delete($id);
        }
        $this->message('删除成功', '?s=admin/grade/index');
    }





}