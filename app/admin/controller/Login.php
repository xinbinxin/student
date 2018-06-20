<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 0:30
 */

namespace app\admin\controller;


use app\index\controller\Base;
use Gregwar\Captcha\CaptchaBuilder;
use hou\view\View;
use system\model\User;

class Login extends Base
{
    public function index()
    {
        if ($_POST) {
            if (strtolower($_POST['captcha']) != $_SESSION['captcha']) {
                $this->message('验证码错误', '?s=admin/login/index');
                die;
            }
            $user = current(User::all());
            if ($_POST['username'] != $user['username'] || md5($_POST['password']) != $user['password']) {
                $this->message('用户名或密码错误', '?s=admin/login/index');
            }
            $_SESSION['user'] = $_POST;
            $this->message('登录成功', '?s=admin/index/index');
        } else {
            View::make();
        }
    }

    public function captcha()
    {
        $builder = new CaptchaBuilder();
        $builder->build();
        header('Content-type: image/jpeg');
        $builder->output();
        $_SESSION['captcha'] = strtolower($builder->getPhrase());
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->message('退出成功', '?s=admin/index/index');

    }

    public function repass()
    {
        $session = $_SESSION['user']['username'];
        $users = current(User::select("select * from user WHERE username ='{$session}'"));
        if (IS_POST) {
            if ($_POST['password'] != $_POST['qrpass']) {
                $this->message('两次密码不一致', '?s=admin/login/repass');
            }
            if (md5($_POST['password']) != $users['password']) {
                $this->message('旧密码错误', '?s=admin/login/repass');
            }
            $repass = md5($_POST['password']);
            $sql = "update user set password='{$repass}' where username='{$session}'";
            try {
                User::save($sql);
            } catch (\Exception $e) {
                p($e->getMessage());die;
            }
            session_unset();
            session_destroy();
            $this->message('密码修改成功', '?s=admin/login/index');
        } else {
            View::make();
        }
    }
}