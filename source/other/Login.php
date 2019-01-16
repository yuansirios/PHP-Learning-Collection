<?php
    header("Content-Type:application/json; charset=utf-8");
    require_once('../tool/Response.php');
    require_once('../tool/DBConnect.php');
    require_once('../tool/mysql.class.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $userName = $_REQUEST['username'];
    $passWord = $_REQUEST['password'];

    $headArr = apache_request_headers();
    if (array_key_exists('token',$headArr)){
        $GLOBALS['tokenArg'] = $headArr['token'];
    }

    if ($method === 'POST'){
        $argStr = file_get_contents("php://input");
        $argArr = json_decode($argStr);
        $userName = $argArr->{'username'};
        $passWord = $argArr->{'password'};
    }

    $errMsg = '当前请求 >>>'.$method.' '.'userName >>>'.$userName.' '.'passWord >>>'.$passWord;

    $success = 1;
    $errCode = 200;
    $body = array('token'=>$tokenArg);

    Response::show($success,$errCode,$errMsg,$body,'json');

    /* 配置连接参数 */
    $config = array(
        'type' => 'mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '88888888',
        'database' => 'ysdb',
        'port' => '3306'
    );

    /* 连接数据库 */
    $mysql = new mysql();
    $mysql->connect($config);

    /* 查询数据 */

    //1、查询所有数据
    $table = 'account_tbl';//数据表
    $num = $mysql->select($table);
    echo '共查询到' . $num . '条数据';
    print_r($mysql->fetchAll());

    //2、查询部分数据
    $field = array('accountName', 'accountPassword'); //过滤字段
    $where = 'accountId = 1';                   //过滤条件
    $mysql->select($table, $field, $where);
    print_r($mysql->fetchAll());

    date_default_timezone_set('PRC');

    /* 插入数据 */
    $data = array(    //数据数组
        'accountName' => 'admin',
        'accountPassword' => sha1('admin'),
        'lastLoginDate' => date("Y-m-d G:i:s")
    );
    $id = $mysql->insert($table, $data);
    echo '插入记录的ID为' . $id;

    /* 修改数据 */
    $data = array(
        'accountPassword' => sha1('nimda')
    );
    $where = 'id = 1';
    $rows = $mysql->update($table, $data, $where);
    echo '受影响的记录数量为' . $rows . '条';

    /* 删除数据 */
    $where = 'id = 6';
    $rows = $mysql->delete($table, $where);
    echo '已删除' . $rows . '条数据';
    
    //测试数据库连接
    $pdo = DBConnect::connect();
    if (!($pdo instanceof PDO)){
        echo '数据库连接失败';
    }else{
        echo '数据库连接成功';

        $pdo->beginTransaction();//开启事务处理
        try{
            date_default_timezone_set('PRC');
            $stmt = $pdo->prepare("insert into account_tbl (accountName, accountPassword,lastLoginDate) values (?,?,?)");
            $stmt->bindValue(1, $userName);
            $stmt->bindValue(2, $passWord);
            $stmt->bindValue(3, date("Y-m-d G:i:s"));
            $stmt->execute();
            // $count = $stmt->rowCount();//受影响行数
            echo '插入成功。prepare方法影响行数：'.$count; 
            $pdo->commit();//提交事务
        }catch(PDOException $e){
            $pdo->rollBack();//事务回滚
            throw $e;
        }
        $result = null;
    }

    /*echo "1、当前正在执行脚本的文件名，与 document root相关 >>>>>> ".$_SERVER['PHP_SELF']."<br>";
    echo "2、传递给该脚本的参数 >>>>>> ".$_SERVER['argv']."<br>";
    echo "3、包含传递给程序的命令行参数的个数（如果运行在命令行模式） >>>>>> ".$_SERVER['argc']."<br>";
    echo "4、服务器使用的 CGI 规范的版本。例如，“CGI/1.1”  >>>>>> ".$_SERVER['GATEWAY_INTERFACE']."<br>";
    echo "5、当前运行脚本所在服务器主机的名称 >>>>>> ".$_SERVER['SERVER_NAME']."<br>";
    echo "6、服务器标识的字串，在响应请求时的头部中给出 >>>>>> ".$_SERVER['SERVER_SOFTWARE']."<br>";
    echo "7、请求页面时通信协议的名称和版本。例如，“HTTP/1.0” >>>>>> ".$_SERVER['SERVER_PROTOCOL']."<br>";
    echo "8、访问页面时的请求方法。例如：“GET”、“HEAD”，“POST”，“PUT” >>>>>> ".$_SERVER['REQUEST_METHOD']."<br>";
    echo "9、查询(query)的字符串  >>>>>> ".$_SERVER['QUERY_STRING']."<br>";
    echo "10、当前运行脚本所在的文档根目录。在服务器配置文件中定义 >>>>>> ".$_SERVER['DOCUMENT_ROOT']."<br>";
    echo "11、当前请求的 Accept: 头部的内容 >>>>>> ".$_SERVER['HTTP_ACCEPT']."<br>";
    echo "12、当前请求的 Accept-Charset: 头部的内容。例如：“iso-8859-1,*,utf-8” >>>>>> ".$_SERVER['HTTP_ACCEPT_CHARSET']."<br>";
    echo "13、当前请求的 Accept-Encoding: 头部的内容。例如：“gzip” >>>>>> ".$_SERVER['HTTP_ACCEPT_ENCODING']."<br>";
    echo "14、当前请求的 Accept-Language: 头部的内容。例如：“en” >>>>>> ".$_SERVER['HTTP_ACCEPT_LANGUAGE']."<br>";
    echo "15、当前请求的 Connection: 头部的内容。例如：“Keep-Alive” >>>>>> ".$_SERVER['HTTP_CONNECTION']."<br>";
    echo "16、当前请求的 Host: 头部的内容  >>>>>> ".$_SERVER['HTTP_HOST']."<br>";
    echo "17、链接到当前页面的前一页面的 URL 地址 >>>>>> ".$_SERVER['HTTP_REFERER']."<br>";
    echo "18、当前请求的 User_Agent: 头部的内容。 >>>>>> ".$_SERVER['HTTP_USER_AGENT']."<br>";
    echo "19、如果通过https访问,则被设为一个非空的值(on)，否则返回off >>>>>> ".$_SERVER['HTTPS']."<br>";
    echo "20、正在浏览当前页面用户的 IP 地址 >>>>>> ".$_SERVER['REMOTE_ADDR']."<br>";
    echo "21、正在浏览当前页面用户的主机名 >>>>>> ".$_SERVER['REMOTE_HOST']."<br>";
    echo "22、用户连接到服务器时所使用的端口 >>>>>> ".$_SERVER['REMOTE_PORT']."<br>";
    echo "23、当前执行脚本的绝对路径名 >>>>>> ".$_SERVER['SCRIPT_FILENAME']."<br>";
    echo "24、管理员信息 >>>>>> ".$_SERVER['SERVER_ADMIN']."<br>";
    echo "25、服务器所使用的端口 >>>>>> ".$_SERVER['SERVER_PORT']."<br>";
    echo "26、包含服务器版本和虚拟主机名的字符串 >>>>>> ".$_SERVER['SERVER_SIGNATURE']."<br>";
    echo "27、当前脚本所在文件系统（不是文档根目录）的基本路径 >>>>>> ".$_SERVER['PATH_TRANSLATED']."<br>";
    echo "28、包含当前脚本的路径。这在页面需要指向自己时非常有用 >>>>>> ".$_SERVER['SCRIPT_NAME']."<br>";
    echo "29、访问此页面所需的 URI。例如，“/index.html” >>>>>> ".$_SERVER['REQUEST_URI']."<br>";
    echo "30、当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的用户名 >>>>>> ".$_SERVER['PHP_AUTH_USER']."<br>";
    echo "31、当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的密码".$_SERVER['PHP_AUTH_PW']."<br>";
    echo "32、当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是认证的类型".$_SERVER['AUTH_TYPE']."<br>";
    */
?>