<?php

class mysql
{
    private $mysqli;
    private $result;

    /**
     * 数据库连接
     */
    public function connect()
    {
        /* 配置连接参数 */
        $config = array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '88888888',
            'database' => 'mock'
        );

        $host = $config['host'];        //主机地址
        $username = $config['username'];//用户名
        $password = $config['password'];//密码

        $this->mysqli = mysqli_connect($host,$username,$password);

        //设置字符集
        mysqli_set_charset($this->mysqli,'utf8');
        //选择数据库
        mysqli_select_db($this->mysqli,$config['database']);

        if ($this->mysqli){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return 关闭连接
     */
    public function disconnect()
    {
        mysqli_close($this->mysqli);
    }

    /**
     * @return mixed 获取全部结果
     */
    public function fetchAll()
    {
        return mysqli_fetch_assoc($this->result);
    }

    /**
     * 数据查询
     * @param $table 数据表
     * @param null $field 字段
     * @param null $where 条件
     * @return mixed 查询结果数目
     */
    public function select($table, $field = null, $where = null)
    {
        $sql = "SELECT * FROM {$table}";
        if (!empty($field)) {
            $field = '`' . implode('`,`', $field) . '`';
            $sql = str_replace('*', $field, $sql);
        }
        if (!empty($where)) {
            $sql = $sql . ' WHERE ' . $where;
        }
        $this->result = mysqli_query( $this->mysqli, $sql );
        return $this->result;
    }

    /**
     * 分页查询
     * @param $table 数据表
     * @param null $offset 条数偏移
     * @param null $pageNum 条数
     * @return array 查询结果
     */
    public function selectLimite($table,$offset=null, $pageNum=null)
    {
        $sql = 'SELECT * FROM '. $table . ' LIMIT ' . $offset . ',' . $pageNum;
        return mysqli_query( $this->mysqli, $sql );
    }

    /**
     * 条数查询
     * @param $table 数据表
     * @param null $field 字段
     * @param null $where 条件
     * @return mixed 查询结果数目
     */
    public function count($table, $field = null, $where = null)
    {
        $sql = "SELECT COUNT(*) AS count FROM {$table}";
        if (!empty($field)) {
            $field = '`' . implode('`,`', $field) . '`';
            $sql = str_replace('*', $field, $sql);
        }
        if (!empty($where)) {
            $sql = $sql . ' WHERE ' . $where;
        }
        $this->result = mysqli_query( $this->mysqli, $sql );
        return self::fetchAll()['count'];
    }

    /**
     * 插入数据
     * @param $table 数据表
     * @param $data 数据数组
     * @return mixed 插入ID
     */
    public function insert($table, $data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->mysqli->real_escape_string($value);
        }
        $keys = '`' . implode('`,`', array_keys($data)) . '`';
        $values = '\'' . implode("','", array_values($data)) . '\'';
        $sql = "INSERT INTO {$table}( {$keys} )VALUES( {$values} )";

        return mysqli_query( $this->mysqli, $sql );
    }

    /**
     * 更新数据
     * @param $table 数据表
     * @param $data 数据数组
     * @param $where 过滤条件
     * @return mixed 受影响记录
     */
    public function update($table, $data, $where)
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->mysqli->real_escape_string($value);
        }
        $sets = array();
        foreach ($data as $key => $value) {
            $kstr = '`' . $key . '`';
            if (is_int($value)){
                //int类型不要加引号
                $vstr = $value;
            }else{
                 $vstr = '\'' . $value . '\'';
            }
            array_push($sets, $kstr . '=' . $vstr);
        }
        $kav = implode(',', $sets);
        $sql = "UPDATE {$table} SET {$kav} WHERE {$where}";
        $result = mysqli_query( $this->mysqli, $sql );
        if ($result && mysqli_affected_rows($this->mysqli)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除数据
     * @param $table 数据表
     * @param $where 过滤条件
     * @return mixed 受影响记录
     */
    public function delete($table, $where)
    {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $result = mysqli_query( $this->mysqli, $sql );
        if ($result && mysqli_affected_rows($this->mysqli)){
            return true;
        } else {
            return false;
        }
    }

}