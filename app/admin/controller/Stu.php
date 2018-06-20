<?php

namespace app\admin\controller;

use app\index\controller\Base;
use hou\view\View;
use system\model\Grade as GradeModel;
use system\model\Stu as StuModel;

class Stu extends Common
{
    public function index()
    {
        $data = StuModel::select("select *,s.id sid from stu s join grade g on s.gid=g.id");
        View::with(compact('data'))->make();

    }

    public function create()
    {
        $data = GradeModel::all();
        if (IS_POST) {
            $data = [
                'username' => $_POST['username'],
                'sex' => $_POST['sex'],
                'birthday' => $_POST['birthday'],
                'hobby' => implode(',', $_POST['hobby']),
                'gid' => $_POST['gid'],
            ];
            try {
                StuModel::insert($data);
            } catch (\Exception $e) {
                $this->message($e->getMessage(), '?s=admin/stu/index');
            }
            $this->message('添加成功', '?s=admin/stu/index');
        } else {
            View::with(compact('data'))->make();
        }
    }

    public function edit()
    {
        $id = (int)$_GET['id'];
        $data = StuModel::find($id);
        $data = [
            'id' => $data['id'],
            'username' => $data['username'],
            'sex' => $data['sex'],
            'birthday' => $data['birthday'],
            'hobby' => explode(',',$data['hobby']),
            'gid' => $data['gid'],
        ];
        $grade = GradeModel::all();//班级列表

        if (IS_POST) {
            $post = [
                'id' => $_POST['id'],
                'username' => $_POST['username'],
                'sex' => $_POST['sex'],
                'birthday' => $_POST['birthday'],
                'hobby' => isset($_POST['hobby'])?implode(',',$_POST['hobby']):'足球',
                'gid' => $_POST['gid'],
            ];
            StuModel::update($post);
            $this->message('编辑成功', '?s=admin/stu/index');
        } else {
            View::with(compact('data', 'grade'))->make();
        }
    }

    public function delete()
    {
        $id = (int)$_GET['id'];
        StuModel::delete($id);
        $this->message('删除成功', '?s=admin/stu/index');
    }


}