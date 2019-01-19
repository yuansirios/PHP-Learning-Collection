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
    // var_dump($conn);
}

//设置字符集
mysqli_set_charset($conn,'utf8');

//选择数据库
mysqli_select_db($conn,'mock');

$sql = 'SELECT * FROM tbl_User WHERE id = '.$id;

$result = mysqli_query( $conn, $sql );

$rows = mysqli_fetch_assoc($result);

$gender = $rows['gender'];

mysqli_close($conn);
?>

<html>

<form method="post" action="doUpdate.php">
    <input type="hidden" name="id" value="<?php echo $rows['id'];?>">
    姓名: <input type="text" name="name" value=<?php echo $rows['name'];?>>
    <br>
    性别:
    <input type="radio" name="gender" value="男" <?php if($gender==="男" ) echo "checked" ;?>>男
    <input type="radio" name="gender" value="女" <?php if($gender==="女" ) echo "checked" ;?>>女
    <br>
    年龄:
    <!-- 只允许输入数字 -->
    <input type="text" name="age" maxlength="3" onKeyUp="value=value.replace(/[^\d]/g,'')" value=<?php echo
        $rows['age'];?>>
    <br>
    地址: <input type="text" name="address" value=<?php echo $rows['address'];?>>
    <br>
    <input type="submit" value="修改">
</form>

</html>