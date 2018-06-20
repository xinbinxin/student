<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 18:41
 */

namespace hou\model;
/**
 * 核心类
 * Class Common
 * @package hou\view
 */
class Base
{
    private static $pdo;
    private $table;

    public function __construct($table)
    {
        $this->connect();
        $this->table = $table;
    }

    private function connect()
    {
        if (is_null(self::$pdo)) {
            $dsn = 'mysql:host=' . config('database.db_host') . ';dbname=' . config('database.db_name') . '';

            try {
                $pdo = new \PDO($dsn, config('database.db_user'), config('database.db_password'));
                $pdo->exec('set names '.config('database.db_charset').'');
                $pdo->query('set names '.config('database.db_charset').'');
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);//把错误设置成异常错误
                self::$pdo = $pdo;
            } catch (\PDOException $e) {
                echo $e->getMessage();
                die;
            }
        }
    }

    /**
     *
     *有结果集的操作
     * @param $sql
     */
    public function select($sql)
    {
        try {
            $result = self::$pdo->query($sql);
            $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die;
        }

        return $data;
    }


    /**
     * 无结果集的操作
     */
    public function save($sql)
    {
        try {
            $result = self::$pdo->exec($sql);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }


    public function all()
    {
        $sql = "select * from {$this->table}";
        return $this->select($sql);
    }

    public function get()
    {
        return $this->all();
    }


    public function find($pri)
    {
        $priKey = $this->getPriKey();
        $sql = "select * from {$this->table} WHERE {$priKey}={$pri}";
        $result = $this->select($sql);
        if ($result) {
            return current($result); //获得当前单元
        } else {
            return [];
        }
    }

    public function insert($data)
    {
        $field = array_keys($data);//键名
        $field = implode(',', $field);//提交有多个值时
        $value = array_values($data);//键值
        $value = '"' . implode('","', $value) . '"';
        $sql = "insert into {$this->table} ($field) values ({$value})";
        return $this->save($sql);
    }


    public function update($post)
    {
        $priKey = $this->getPriKey();

        if (!isset($post[$priKey])) {
            echo 'error not priKey';
        } else {
            $ks = '';
            foreach ($post as $k => $v) {
                $ks .= $k . "='" . $v . "',";
            }
            $ks = rtrim($ks, ',');
            $sql = "update {$this->table} set {$ks} where {$priKey}={$post[$priKey]}";
            return $this->save($sql);
        }
    }


    public function delete($id)
    {
        $priKey = $this->getPriKey();
        $sql = "delete from {$this->table} where {$priKey} = {$id}";
        return $this->save($sql);
    }

    /**
     * 获得主键
     */
    private function getPriKey()
    {
        $data = $this->select("DESC {$this->table}");
        foreach ($data as $v) {
            if ($v['Key'] == 'PRI') {
                $priKey = $v['Field']; //主键
            }
        }
        return $priKey;
    }

}