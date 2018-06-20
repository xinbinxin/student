<?php
include "../vendor/autoload.php";//引入自动加载文件
define('IS_POST',$_SERVER['REQUEST_METHOD']=='POST'?TRUE:FALSE);
\hou\core\Boot::run();


