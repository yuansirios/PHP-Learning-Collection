<?php
$result = isset($_POST['result'])? $_POST['result'] : '';
if(is_array($result)) {
    $sites = array(
            'a' => '苹果',
            'b' => '香蕉',
            'c' => '芒果',
    );
    foreach($result as $item) {
        echo $sites[$item].'<br>';
    }
} else {
?>
复选框示例：
<form action="" method="post">
    <input type="checkbox" name="result[]" value="a"> 苹果 <br>
    <input type="checkbox" name="result[]" value="b"> 香蕉 <br>
    <input type="checkbox" name="result[]" value="c"> 芒果 <br>
    <input type="submit" value="提交">
</form>
<?php
}
?>