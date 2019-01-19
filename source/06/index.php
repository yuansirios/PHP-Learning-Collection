<?php

//起始页数
$page = 1;
if(!empty($_GET['page'])){
    $page = $_GET['page'];
}

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

/************* 分页开始 **************/

$sql = "SELECT count(*) AS count FROM tbl_User";
$result = mysqli_query( $conn, $sql );
$pageRes = mysqli_fetch_assoc($result);
$totalCount = $pageRes['count'];

//每页条数
$num = 5;
//总页数
$pageCount = ceil($totalCount/$num);
//页数偏移
$offset = ($page - 1)*$num;
/************* 分页结束 **************/

$sql = "SELECT * FROM tbl_User LIMIT " . $offset . ',' . $num;

$result = mysqli_query( $conn, $sql );

mysqli_close($conn);

echo '<table width=600 border=1>';
echo '<tr><th colspan="6">人员信息列表，共'.$totalCount.'人 <a href="add.php">添加</a> </th></tr>';
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

$next = $page + 1;
$prev = $page - 1;

//页数边界处理
if ($prev < 1){
    $prev = 1;
}

if ($next > $pageCount){
    $next = $pageCount;
}
?>
<a href="index.php?page=1">首页</a>&nbsp;&nbsp;&nbsp;
<a href="index.php?page=<?php echo $prev ;?>">上一页</a>&nbsp;&nbsp;&nbsp;
<a href="index.php?page=<?php echo $next ;?>">下一页</a>&nbsp;&nbsp;&nbsp;
<a href="index.php?page=<?php echo $pageCount ;?>">尾页</a>&nbsp;&nbsp;&nbsp;
