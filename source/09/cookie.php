<?php
    if(isset($_POST['exit'])){
        setcookie("user", "", time()-3600);
    }

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        if(empty($name)){
            echo '请输入用户名';
        }else{
            $expire = time() + 5;
            setcookie("user", $name, $expire);
        }
    }

?>

<html>

<head>
    <meta charset="utf-8">
    <title>Cookie示例</title>
</head>

<body>

    <?php
        echo '<form method="post">';
        if (isset($_COOKIE["user"])){
            echo "欢迎 " . $_COOKIE["user"] . "!<br>";
            echo '<input type="hidden" name="exit">';
            echo '<input type="submit" value="退出登录">';
        }else{
            echo '用户名: <input type="text" name="name">';
            echo '<input type="submit" value="登录">';
        }
        echo '</form>';
    ?>

</body>

</html>