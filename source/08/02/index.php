<form action = "" 
enctype="multipart/form-data" 
method="post">

<input type="file" name="upFile"/>
<input type="submit"/> 
</form>

<?php

if (empty($_FILES)){
    exit;
}

$file = $_FILES['upFile'];

if ($file['error'] > 0){
    switch ($file['error']){
        case '1':
            echo '文件过大';
            break;
        case '2':
            echo '文件超出指定大小';
            break;
        case '3':
            echo '只有部分文件被上传';
            break;
        case '4':
            echo '文件没有被上传';
            break;
        case '6':
            echo '找不到指定文件夹';
            break;
        case '7':
            echo '文件写入失败';
            break;
    }
}else{
    //判断文件是否超出指定大小
    //单位为byte
    $MAX_FILE_SIZE = 1024*1024*2;

    if ($file['size'] > $MAX_FILE_SIZE){
        exit('文件超出指定大小');
    }

    //后缀名限制
    $allowSuffix = array(
        'jpg',
        'png',
        'gif',
    );

    //格式限制
    $allowMime = array(
        'image/jpg',
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
    );


    //判断后缀名和MIME类型是否符合指定需求
    $myImg = explode('.',$file['name']);
    /**
     * explode()将一个字符串用指定的字符切割，并返回一个数组，这里我们将文件名用'.'切割
     */

    $myImgSuffix = array_pop($myImg);
    /**
     * 使用in_array()函数判断后缀名是否符合要求
     */

    if (!in_array($myImgSuffix,$allowSuffix)){
        exit("文件后缀名不符合要求");
    }

    if (!in_array($file['type'],$allowMime)){
        exit("文件格式不正确，请检查");
    }

    $path = 'imgs/';
    /**
     * 根据当前时间生成随机文件名，当前时间+随机一个0-9的数字组合成文件名，
    * 后缀即为前面取到的后缀
    */
    
    $name = date('Y').date('m').date('d').date('H').date('i').date('s').rand(0,9).'.'.$myImgSuffix;

    //判断是否是上传的文件
    if (is_uploaded_file($file['tmp_name'])){

    if (move_uploaded_file($file['tmp_name'],$path.$name)){
        echo '上传成功<br>';
        echo "<img src = ".$path.$name.">";
    }else{
        echo '上传失败';
    }
    }else{
        echo '不是上传的文件，失败';
    }
}