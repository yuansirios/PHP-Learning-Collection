<?php
    //指定返回json数据，默认html
    header("Content-Type:application/json; charset=utf-8");
    //导入工具类
    require_once('../tool/Response.php');

    //请求类型
    $method = $_SERVER['REQUEST_METHOD'];

    //header参数获取
    $headArr = apache_request_headers();
    if (array_key_exists('token',$headArr)){
        $GLOBALS['token'] = $headArr['token'];
    }

    //Post参数获取，因为是json，需要转换
    if ($method === 'POST'){
        $argStr = file_get_contents("php://input");
        $argArr = json_decode($argStr);
        $username = $argArr->{'username'};
        $password = $argArr->{'password'};
    }else if ($method === 'GET'){
        $username = $_GET['username'];
        $password = $_GET['password'];
    }else{
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
    }

    //请求输出
    $success = 1;
    $errCode = 200;
    $errMsg = '请求成功';
    $body = array("method"=>"$method","username"=>"$username","password"=>"$password","token"=>"$token");
    Response::show($success,$errCode,$errMsg,$body,'json');
?>