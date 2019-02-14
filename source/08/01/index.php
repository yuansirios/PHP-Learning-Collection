<?php 
    require_once('../tool/file.class.php');

    $path = "./test.txt";

    //创建文件
    create_file($path);

    //拷贝文件
    // copy_file($path,'./copy');

    //重命名
    // rename_file($path,'./new.txt');

    //剪切文件
    // cut_file($path,'./cut');

    //写入文件
    //覆盖写入
    // write_file($path,'覆盖写入');
    //换行得双引号下\n
    // write_append_file($path,"追加写入\n");

    //以字符串形式读取内容
    // $value = read_file($path);

    //以数组形式读取文件内容
    // $value = read_file_array($path,true);
    // var_dump($value);

    //获取文件详细信息
    // $value = get_file_info($path);
    // var_dump($value);
    
?>