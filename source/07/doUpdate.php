<?php
require_once('../tool/mysql.class.php');

/* 连接数据库 */
$mysql = new mysql();
$mysql->connect();
if (!$mysql){
    exit ('数据库连接失败');
}else{
    // echo '数据库连接成功';
}

$id = $_POST['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$address = $_POST['address'];

$data = array(  
    'name' => $name,
    'gender' => $gender,
    'age' => $age,
    'address' => $address
);

$result = $mysql->update('tbl_User',$data,'id = '.$id);

if ($result){
    echo '更新数据成功 <a href="index.php">返回</a>';
} else {
    echo '更新数据失败'.$sql;
}

$mysql->disconnect();