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
下拉列表多选示例：
<form action="" method="post">
    <select multiple="multiple" name="result[]" style="width:100">
        <option value="a">苹果</option>
        <option value="b">香蕉</option>
        <option value="c">芒果</option>
    </select>
    <input type="submit" value="提交">
</form>
<?php
}
?>