<?php
    $upfile = $_FILES["upFile"];
    // var_dump($upfile);
    if(is_uploaded_file($upfile['tmp_name'])){
        $name = $upfile['name'];
        $type = $upfile['type'];
        $size = $upfile['size'];
        $tmp_name = $upfile['tmp_name'];
        switch ($type){
            case 'image/pjpeg':$okType=true;
            break;
            case 'image/jpeg':$okType=true;
            break;
            case 'image/gif':$okType=true;
            break;
            case 'image/png':$okType=true;
            break;
        }

        if ($okType){
            $error = $upfile['error'];
            echo "=============<br/>";

            echo "上传的文件名称是：".$name."<br/>";
            echo "上传的文件类型是：".$type."<br/>";
            echo "上传的文件大小是：".$size."<br/>";
            echo "上传后系统返回值是：".$error."<br/>";
            echo "上传后临时存放路径是：".$tmp_name."<br/>";

            echo "=============<br/>";

            if ($error == 0){
                echo '文件上传成功';
                $filePath = 'imgs/'.$name;
                if(move_uploaded_file($tmp_name,$filePath)){ 
                    echo '<br>图片预览<br>';
                    echo "<img src = ".$filePath.">";
                }else{
                    echo '保存文件失败';
                }
            }elseif($error == 1){
                echo '超过文件大小，在php.ini文件中设置';
            }elseif($error == 2){
                echo '超过文件大小MAX_FILE_SIZE选项制定的值';
            }elseif($error == 23){
                echo '文件只有部分被上传';
            }else{
                echo '上传文件大小为0';
            }
        }else{
            echo '请上传jpg,gif,png等格式的图片';
        }
    }
?>

<form action = "" 
enctype="multipart/form-data" 
method="post" 
name="uploadFile" > 上传文件：<br>

<input type="file" name="upFile"/>
<input type="submit" value="上传"/> 

</form>