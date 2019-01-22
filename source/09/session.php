<?php

    session_start();

    if(isset($_POST['exit'])){
        unset($_SESSION['user']);
    }

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        if(empty($name)){
            echo '请输入用户名';
        }else{
            $_SESSION['user'] = $name;
        }
    }

?>

<html>

<head>
    <meta charset="utf-8">
    <title>Session示例</title>
</head>

<body>

    <?php
    echo '<form method="post">';
        if (isset($_SESSION["user"])){
            echo "欢迎 " . $_SESSION["user"] . "!<br>";
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