<?php
$id = $_GET['id'];

$dbhost = 'localhost:3306';  // 服务器主机地址
$dbuser = 'root';            // 用户名
$dbpass = '88888888';        // 密码

//连接数据库
$conn = mysqli_connect($dbhost,$dbuser,$dbpass);

if (!$conn){
    exit('数据库连接失败');
}else{
    //  var_dump($conn);
}

//设置字符集
mysqli_set_charset($conn,'utf8');

//选择数据库
mysqli_select_db($conn,'mock');

$sql = "DELETE FROM tbl_User WHERE id = ".$id;

$result = mysqli_query( $conn, $sql );

if ($result && mysqli_affected_rows($conn)){
    echo '删除数据成功 <a href="index.php">返回</a>';
} else {
    echo '删除数据失败: ' . mysqli_error($conn);
}

mysqli_close($conn);