<?php

echo '添加模拟数据'.'<br>';

$dbhost = 'localhost:3306';  // 服务器主机地址
$dbuser = 'root';            // 用户名
$dbpass = '88888888';        // 密码

//连接数据库
$conn = mysqli_connect($dbhost,$dbuser,$dbpass);

if (!$conn){
    exit('数据库连接失败');
}else{
    // var_dump($conn);
}

//设置字符集
mysqli_set_charset($conn,'utf8');

//选择数据库
mysqli_select_db($conn,'mock');

//sql语句
//Step1：创建tbl_User表
/*
$sql = "CREATE TABLE IF NOT EXISTS `tbl_User`(".
       "`id` INT UNSIGNED AUTO_INCREMENT,".
       "`name` VARCHAR(10) NOT NULL COMMENT '姓名' ,".
       "`gender` VARCHAR(2) NOT NULL COMMENT '性别',".
       "`age` INT COMMENT '年龄',".
       "`address` VARCHAR(20) COMMENT '地址',".
       "PRIMARY KEY ( `id` )".
       ")ENGINE=InnoDB DEFAULT CHARSET=utf8";

//执行
$result = mysqli_query( $conn, $sql );

if(!$result ){
    die('数据表创建失败: ' . mysqli_error($conn));
}else{
    echo "数据表创建成功\n";
}
*/

//Step2：插入mock数据
/*for ($i = 0 ; $i < 10 ; $i ++ )
{
    $name = "姓名".$i;
    $gender = ($i % 2 == 0)? "男" : "女";
    $age = $i;
    $address = "地址".$i;
    $sql = "INSERT INTO tbl_User ( name, gender , age , address )".
           "VALUES ('$name', '$gender','$age','$address' )";

    $result = mysqli_query( $conn, $sql );

    if(!$result ){
        echo $name . '插入数据失败: ' . mysqli_error($conn);
    }else{
        echo $name . "插入数据成功".'<br>';
    }
}*/

//Step3：删除数据
/*$sql = "DELETE FROM tbl_User WHERE id = 2";

$result = mysqli_query( $conn, $sql );

if(!$result ){
    echo '删除数据失败: ' . mysqli_error($conn);
}else{
    echo "删除数据成功".'<br>';
}*/

//Step4：更新数据
$sql = "UPDATE tbl_User ".
       "SET name = '修改姓名',gender = '女',age = 12,address = '修改了地址' ".
       "WHERE id = 3 ";

$result = mysqli_query( $conn, $sql );

if(!$result ){
    echo '更新数据失败: ' . mysqli_error($conn);
}else{
    echo "更新数据成功".'<br>';
}

//Step5：事务
mysqli_query($conn, "SET AUTOCOMMIT=0"); // 设置为不自动提交，因为MYSQL默认立即执行
mysqli_begin_transaction($conn);         // 开始事务定义
mysqli_query($conn, "ROLLBACK");         // 判断当执行失败时回滚
mysqli_commit($conn);                    //执行事务

//最后记得关闭连接，释放内存
mysqli_close($conn);