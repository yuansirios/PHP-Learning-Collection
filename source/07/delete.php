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

$id = $_GET['id'];

$result = $mysql->delete('tbl_User','id = '.$id);

if ($result){
    echo '删除数据成功 <a href="index.php">返回</a>';
} else {
    echo '删除数据失败: ' . mysqli_error($conn);
}

$mysql->disconnect();