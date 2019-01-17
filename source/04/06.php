<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>表单验证</title>
    <style>
        .error {color: #FF0000;}
</style>
</head>

<body>

    <?php
// 定义变量并默认设置为空值
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]))
    {
        $nameErr = "请输入姓名";
    }
    else
    {
        $name = test_input($_POST["name"]);
        // 检测名字是否只包含字母跟空格
        if (!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $nameErr = "只允许字母和空格"; 
        }
    }
    
    if (empty($_POST["email"]))
    {
      $emailErr = "邮箱是必需的";
    }
    else
    {
        $email = test_input($_POST["email"]);
        // 检测邮箱是否合法
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
        {
            $emailErr = "非法邮箱格式"; 
        }
    }
    
    if (empty($_POST["website"]))
    {
        $website = "";
    }
    else
    {
        $website = test_input($_POST["website"]);
        // 检测 URL 地址是否合法
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
        {
            $websiteErr = "非法的 URL 的地址"; 
        }
    }
    
    if (empty($_POST["comment"]))
    {
        $comment = "";
    }
    else
    {
        $comment = test_input($_POST["comment"]);
    }
    
    if (empty($_POST["gender"]))
    {
        $genderErr = "性别是必需的";
    }
    else
    {
        $gender = test_input($_POST["gender"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);//返回已剥离反斜杠的字符串
    $data = htmlspecialchars($data);//把一些预定义的字符转换为 HTML 实体
    return $data;
}
?>

    <h2>PHP 表单验证实例</h2>
    <p><span class="error">* 必需字段。</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>">
        名字: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">*
            <?php echo $nameErr;?></span>
        <br>
        邮箱: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">*
            <?php echo $emailErr;?></span>
        <br>
        网址: <input type="text" name="website" value="<?php echo $website;?>">
        <span class="error">
            <?php echo $websiteErr;?></span>
        <br>
        备注: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br>
        性别:
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="女" ) echo "已选择" ;?>
        value="女">女
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="男" ) echo "已选择" ;?>
        value="男">男
        <span class="error">*
            <?php echo $genderErr;?></span>
        <br>
        <input type="submit" name="submit" value="提交">
    </form>

    <?php
echo "<h2>您输入的内容是:</h2>";
echo '姓名：'.$name.'<br>';
echo '邮箱：'.$email.'<br>';
echo '网址：'.$website.'<br>';
echo '备注：'.$comment.'<br>';
echo '性别：'.$gender.'<br>';
?>

</body>

</html>