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
$result = $mysql->insert('tbl_User',$data);

if($result){
    echo $name . '添加用户成功 <a href="index.php">返回</a>';
}else{
    die ($name . '添加用户失败');
}

$mysql->disconnect();

?>