<?php

header('content-type:text/html;charset=utf-8');

/**

* [create_file 创建文件]

* @param  string $filename [文件名]

* @return [type]          [true|false]

*/

function create_file(string $filename) {

  if (file_exists($filename)) {

    return false;

  }

  // 判断文件类型是否为目录, 如果不存在则创建

  if (!file_exists(dirname($filename))) {

    mkdir(dirname($filename), 0777, true);

  }

  if(touch($filename)) {

    return true;

  }

  return false;

}

/**

* [del_file 删除文件]

* @param  string $filename [文件名]

* @return [type]          [true|false]

*/

function del_file(string $filename) {

  // 如果文件不存在或者权限不够, 则返回false

  if (!file_exists($filename)||!is_writeable($filename)) {

    return false;

  }

  if (unlink($filename)) {

    return true;

  }

  return false;

}

/**

* [copy_file 拷贝文件]

* @param  string $filename [文件名]

* @param  string $dest    [目标路径]

* @return [type]          [true|false]

*/

function copy_file(string $filename, string $dest) {

  if (!is_dir($dest)) {

    mkdir($dest, 0777, true);

  }

  // DIRECTORY_SEPARATOR '/'分割符

  $destName = $dest.DIRECTORY_SEPARATOR.basename($filename);

  if(copy($filename, $destName)) {

    return true;

  }

  return false;

}

/**

* [rename_file 文件重命名]

* @param  string $oldname [原始文件名]

* @param  string $newname [新文件名]

* @return [type]          [true|false]

*/

function rename_file(string $oldname, string $newname) {

  if (!is_file($oldname)) {

    return false;

  }

  $path = dirname($oldname);

  $destName = $path.DIRECTORY_SEPARATOR.$newname;

  if(!is_file($destName)) {

    return rename($oldname, $newname);

  }

  return false;

}

/**

* [cut_file 剪切文件]

* @param  [type] $filename [文件名]

* @param  [type] $dest    [目录名称]

* @return [type]          [true|false]

*/

function cut_file($filename, $dest) {

  if (!file_exists($filename)) {

    return false;

  }

  // 检测文件目录是否存在, 如果不存在则创建

  if (!is_dir($dest)) {

    mkdir($dest, 0777, true);

  }

  // 检测文件夹是否包含同名文件

  $destName = $dest.DIRECTORY_SEPARATOR.basename($filename);

  // 如果是一个文档则returnfalse 如果不是文档则剪切文档

  if (!is_file($destName)) {

    return rename($filename, $destName);

  }

  return false;

}




/**
 * [get_file_info 获取文件详细信息]
 * @param  string $filename [文件名字]
 * @return [type]           [array|false]
 */
function get_file_info(string $filename) {

  // 如果不是文件 或者 不可读返回false
  if (!is_file($filename) || !is_readable($filename)) {
    return false;
  }
  // 否则直接返回文件信息, 定义一个关联数组
  return [
    "文件名称" => basename($filename),
    "文件类型" => filetype($filename),
    "文件大小" => trans_byte(filesize($filename)),
    "创建时间" => date('Y-m-d H:i:s', filectime($filename)),
    "修改时间" => date('Y-m-d H:i:s', filemtime($filename)),
    "上一次访问时间" => date('Y-m-d H:i:s', fileatime($filename)),
  ];
}


/**
 * [read_file_array 以数组形式读取文件内容]
 * @param  string  $filename         [文件名称]
 * @param  boolean $skip_empty_lines [是否忽略空行, 默认值为false]
 * @return [type]                    [array]
 */
function read_file_array(string $filename, bool $skip_empty_lines=false) {
  if (is_file($filename) && is_readable($filename)) {
    if ($skip_empty_lines) {
      // 忽略空行读取
      return file($filename, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    } else {
      // 以数组形式直接读取, 不忽略空行
      return file($filename);
    }
  }
}



/**
 * [read_file 以字符串形式读取内容]
 * @param  [type] $filename [文件名]
 * @return [type]           [string|false]
 */
function read_file(string $filename){
  if (is_file($filename) && is_readable($filename)) {
    return file_get_contents($filename);
  }
  return false;
}

/**
 * 清空形式写入文件
 * @param  string $filename 路径
 * @param  mixed $data     写入的数据
 * @return mixed           true|false
 */
function write_file($filename, $data) {
  $dirname = dirname($filename);
  // 检测目标路径是否存在
  if(!file_exists($dirname)) {
    mkdir($dirname, 0777, true);
  }
  // 检测数据是否为数组或者对象
  if(is_array($data) || is_object($data)) {
    // 序列化数据
    $data = serialize($data);
  }
  // 写入数据
  if(file_put_contents($filename, $data) !== false) {
    return true;
  }
  return false;
}

/**
 * 增加文件内容升级版
 * @param  string  $filename      路径名称
 * @param  mixed  $data          需要写入的数据
 * @param  boolean $clear_content 是否清空原始内容再写入
 * @return bool                 true|false
 */
function write_append_file($filename, $data, bool $clear_content=false) {
  $dirname = dirname($filename);
  // 检测目标路径是否存在
  if(!file_exists($dirname)) {
    mkdir($dirname, 0777, true);
  }
  // 文件存在并且不清空原始文件
  if (is_file($filename) && !$clear_content) {
    $srcData = file_get_contents($filename);
  }

  // 检测数据是否为数组或者对象
  if(is_array($data) || is_object($data)) {
    // 序列化数据
    $data = serialize($data);
  }

  // 拼装数据
  $data = $srcData.$data;

  // 写入数据
  if(file_put_contents($filename, $data) !== false) {
    return true;
  }
  return false;
}

/**
 * [trans_byte 转换字节大小]
 * @param  int     $byte      [字节大小]
 * @param  integer $precision [小数点保留位数]
 * @return [type]             [转换后的单位]
 */
function trans_byte(int $byte,  $precision=2) {
  $kb = 1024;
  $mb = 1024*$kb;
  $gb = 1024*$mb;
  $tb = 1024*$gb;

  if ($byte < $kb) {
    return $byte.'B';
  }

  if($byte < $mb) {
    // 默认四舍五入, 保留两位小数
    return round($byte/$kb, $precision).' KB';
  }

  if ($byte < $gb) {
    return round($byte/$mb, $precision).' MB';
  }

  if ($byte < $tb) {
    return round($byte/$tb, $precision).' GB';
  }
}

/**
 * 截断文本
 * @param  string $filename 文件名称
 * @param  int    $length   截断文本长度
 * @return boolean           true|false
 */
function truncate_file(string $filename, int $length) {
  // 判断文件是否存在并且是可写的
  if (is_file($filename) && is_writeable($filename)) {
    // 创建文件句柄, 以读写方式打开
    $handler = fopen($filename, 'rb+');
    $length = $length < 0 ? 0 : $length;
    ftruncate($handler, $length);
    fclose($handler);
  }
  return false;
}

?>