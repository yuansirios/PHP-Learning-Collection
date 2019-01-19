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
/************* 分页开始 **************/

//起始页数
$page = 1;
if(!empty($_GET['page'])){
    $page = $_GET['page'];
}

//1、查询所有数据
$table = 'tbl_User';
$totalCount = $mysql->count($table);

//每页条数
$num = 5;
//总页数
$pageCount = ceil($totalCount/$num);
//页数偏移
$offset = ($page - 1)*$num;
/************* 分页结束 **************/

$listArr = $mysql->selectLimite($table,$offset,$num);

$mysql->disconnect();

echo '<table width=600 border=1>';
echo '<tr><th colspan="6">人员信息列表，共'.$totalCount.'人 <a href="add.php">添加</a> </th></tr>';
echo '<th>编号</th><th>姓名</th><th>性别</th><th>年龄</th><th>地址</th><th>操作</th>';

while ($rows = mysqli_fetch_assoc($listArr)){
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
