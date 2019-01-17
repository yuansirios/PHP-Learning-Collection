<?php
$result = isset($_GET['select'])? htmlspecialchars($_GET['select']) : '';
if($result) {
        if($result =='a') {
                echo '选择了苹果';
        } else if($result =='b') {
                echo '选择了香蕉';
        } else if($result =='c') {
                echo '选择了芒果';
        }
} else {
?>
下拉列表选择示例
<form action="" method="get">
    <select name="select">
        <option value="">选择一个:</option>
        <option value="a">苹果</option>
        <option value="b">香蕉</option>
        <option value="c">芒果</option>
    </select>
    <input type="submit" value="提交">
</form>
<?php
}
?>