<?php

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

$sql = 'SELECT * FROM tbl_User';

$result = mysqli_query( $conn, $sql );

$number = mysqli_num_rows($result);

echo '<table width=600 border=1>';

echo '<tr><th colspan="6">人员信息列表，共'.$number.'人 <a href="add.php">添加</a> </th></tr>';
echo '<th>编号</th><th>姓名</th><th>性别</th><th>年龄</th><th>地址</th><th>操作</th>';

while ($rows = mysqli_fetch_assoc($result)){
    $id      = $rows['id'];
    $name    = $rows['name'];
    $gender  = $rows['gender'];
    $age     = $rows['age'];
    $address = $rows['address'];
    echo '<tr>';
        echo '<td>'.$id.'</td>';
        echo '<td>'.$name.'</td>';
        echo '<td>'.$gender.'</td>';
        echo '<td>'.$age.'</td>';
        echo '<td>'.$address.'</td>';
        echo '<td><a href="delete.php?id='.$id.'">删除</a>  <a href="edit.php?id='.$id.'">编辑</a></td>';
    echo '</tr>';
}
echo '</table>';

function deleteAction(){
    $result = confirm('是否删除！');  
    if ($result){
        echo '删除';
    }else{
        echo '取消';
    }
}