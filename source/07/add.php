<html>

<form method="post" action="doAdd.php">
    姓名: <input type="text" name="name">
    <br>
    性别: 
    <input type="radio" name="gender" value="男">男 
    <input type="radio" name="gender" value="女">女
    <br>
    年龄:
    <!-- 只允许输入数字 -->
    <input type="text" name="age" maxlength="3" onKeyUp="value=value.replace(/[^\d]/g,'')">
    <br>
    地址: 
    <input type="text" name="address">
    <br>
    <input type="submit" value="添加">
</form>

</html>