<?php
$result = isset($_GET['item'])? htmlspecialchars($_GET['item']) : '';
if($result) {
        if($result =='a') {
                echo '苹果';
        } else if($result =='b') {
                echo '香蕉';
        } else if($result =='c') {
                echo '芒果';
        }
} else {
?>
单选按钮示例：
<form action="" method="get">
    <input type="radio" name="item" value="a" />苹果
    <input type="radio" name="item" value="b" />香蕉
    <input type="radio" name="item" value="c" />芒果
    <input type="submit" value="提交">
</form>
<?php
}
?>