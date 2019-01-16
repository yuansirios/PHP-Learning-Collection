<html>
<head>
<meta charset="utf-8">
<title>你好</title>
</head>
<body>
 
<form method="post">
用户名: <input type="text" name="username">
<br>
密码: <input type="text" name="password">
<br>
<input type="submit" value="提交">

<br>
欢迎<?php echo $_POST["username"]; ?>!<br>
你的密码是 <?php echo $_POST["password"]; ?>  岁。
<br>

</form>
</body>
</html>
