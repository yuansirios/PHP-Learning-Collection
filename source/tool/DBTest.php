<?php
    header("Content-type:text/html;charset=utf-8");

	$dbType   = 'mysql';
	$host     = '127.0.0.1';
	$dbName   = 'ysdb';
	$userName = 'root';
	$pwd      = '88888888';
 
	$dsn = "$dbType:host=$host;dbname=$dbName";
	try {
		$pdo = new PDO($dsn, $userName, $pwd);
		echo '连接成功';
	} catch (PDOException $e) {
		echo '连接失败：' . $e->getMessage();
	}
?>