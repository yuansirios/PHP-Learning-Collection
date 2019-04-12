<?php

class demo1 {

    /**
     * 1、Strng(字符串):
     */
    public static function stringDemo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            $redis->set('cat', 111);
            echo $redis->get('cat').'<br>'; 

            //覆盖
            $redis->set('cat', 222);
            echo $redis->get('cat');

            //删除
            $redis->del('cat');
            echo $redis->get('cat');
        } else {
            echo "Redis 连接失败" . $conn;
        }
    }

    /**
     * 列表操作
     */
    public static function listDemo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //存储数据到列表中
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'css');
            $redis->lpush('list', 'php1');
        
            //获取列表中所有的值
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>'; 
        
            //从右侧加入一个
            $redis->rpush('list', 'mysql');
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>';
        
            //从左侧弹出一个
            $redis->lpop('list');
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>';
            
            //从右侧弹出一个
            $redis->rpop('list');
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>';

            //删除
            $redis->del('list');
            echo $redis->get('list');

        } else {
            echo "Redis 连接失败" . $conn;
        }
    }

    /**
     * 列表操作1
     */
    public static function list1Demo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //存储数据到列表中
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'css');
            $redis->lpush('list', 'php');
            $redis->lpush('list', 'mysql');
            $redis->lpush('list', 'javascript');
            $redis->lpush('list', 'ajax');
        
            //获取列表中所有的值
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>'; 
        
            //获取列表的长度
            $length = $redis->lsize('list');
            echo $length;echo '<br>';
        
            //返回列表key中index位置的值
            echo $redis->lget('list', 2);echo '<br>';
            echo $redis->lindex('list', 2);echo '<br>';
        
            //设置列表中index位置的值
            echo $redis->lset('list', 2, 'linux');echo '<br>';
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>';
        
            //返回key中从start到end位置间的元素
            $list = $redis->lrange('list', 0, 2);
            print_r($list);echo '<br>';
        
            $list = $redis->lgetrange('list', 0, 2);
            print_r($list);echo '<br>';
        
            //截取链表中start到end的元素
            //截取列表后列表发生变化,列表保留截取的元素,其余的删除

            $list = $redis->ltrim('list', 0, 1);
            print_r($list);echo '<br>';
            
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>';

            //删除
            $redis->del('list');
            echo $redis->get('list');
        } else {
            echo "Redis 连接失败" . $conn;
        }
        
    }

    /**
     * 列表操作2
     */
    public static function list2Demo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //存储数据到列表中
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'css');
            $redis->lpush('list', 'php');
            $redis->lpush('list', 'mysql');
            $redis->lpush('list', 'javascript');
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'html');
            $redis->lpush('list', 'ajax');
            //获取列表中所有的值
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>'; 
        
            //删除列表中count个值为value的元素
            //从左向右删
            $redis->lrem('list', 'html', 2);
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>'; 
            
            //从右向左删
            $redis->lrem('list', 'html', -2);
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>'; 
        
            //删除所有
            $redis->lrem('list', 'html', 0);
            $list = $redis->lrange('list', 0, -1);
            print_r($list);echo '<br>';

            //删除
            $redis->del('list');
            echo $redis->get('list');

        } else {
            echo "Redis 连接失败" . $conn;
        }
    }

    /**
     * hash操作
     */
    public static function hashDemo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //字典
            //给hash表中某个key设置value
            //如果没有则设置成功,返回1,如果存在会替换原有的值,返回0,失败返回0
            echo $redis->hset('hash', 'cat', 'cat');echo '<br>';
            echo $redis->hset('hash', 'cat', 'cat');echo '<br>';
            echo $redis->hset('hash', 'cat', 'cat1');echo '<br>';
            echo $redis->hset('hash', 'dog', 'dog');echo '<br>';
            echo $redis->hset('hash', 'bird', 'bird');echo '<br>';
            echo $redis->hset('hash', 'monkey', 'monkey');echo '<br>';
            //获取hash中某个key的值
            echo $redis->hget('hash', 'cat');echo '<br>';
        
            //获取hash中所有的keys
            $arr = $redis->hkeys('hash');
            print_r($arr);echo '<br>';
        
            //获取hash中所有的值 顺序是随机的
            $arr = $redis->hvals('hash');
            print_r($arr);echo '<br>';
        
            //获取一个hash中所有的key和value 顺序是随机的
            $arr = $redis->hgetall('hash');
            print_r($arr);echo '<br>';
        
            //获取hash中key的数量
            echo $redis->hlen('hash');echo '<br>';
        
            //删除hash中一个key 如果表不存在或key不存在则返回false
            echo $redis->hdel('hash', 'dog');echo '<br>';
            var_dump($redis->hdel('hash', 'rabbit'));echo '<br>';

            //删除
            $redis->del('hash');
            echo $redis->get('hash');

        } else {
            echo "Redis 连接失败" . $conn;
        }
    }

     /**
     * hash操作1
     */
    public static function hash1Demo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //字典
            //批量设置多个key的值
            $arr = [1=>1, 2=>2, 3=>3, 4=>4, 5=>5];
            $redis->hmset('hash', $arr);
            print_r($redis->hgetall('hash'));echo '<br>';
        
            // 批量获得额多个key的值
            $arr = [1, 2, 3, 5];
            $hash = $redis->hmget('hash', $arr);
            print_r($hash);echo '<br>';
        
            //检测hash中某个key知否存在
            echo $redis->hexists('hash', '1');echo '<br>';
            var_dump($redis->hexists('hash', 'cat'));echo '<br>';
        
            print_r($redis->hgetall('hash'));echo '<br>';
        
            //给hash表中key增加一个整数值
            $redis->hincrby('hash', '1', 1);
            print_r($redis->hgetall('hash'));echo '<br>';
        
            //给hash中的某个key增加一个浮点值
            $redis->hincrbyfloat('hash', 2, 1.3);
            print_r($redis->hgetall('hash'));echo '<br>';

            //删除
            $redis->del('hash');
            echo $redis->get('hash');

        } else {
            echo "Redis 连接失败" . $conn;
        }
    }

    /**
     * 集合操作
     */
    public static function setDemo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //集合
            // 添加一个元素
            echo $redis->sadd('set', 'cat');echo '<br>';
            echo $redis->sadd('set', 'cat');echo '<br>';
            echo $redis->sadd('set', 'dog');echo '<br>';
            echo $redis->sadd('set', 'rabbit');echo '<br>';
            echo $redis->sadd('set', 'bear');echo '<br>';
            echo $redis->sadd('set', 'horse');echo '<br>';
        
            // 查看集合中所有的元素
            $set = $redis->smembers('set');
            print_r($set);echo '<br>';
        
            //删除集合中的value
            echo $redis->srem('set', 'cat');echo '<br>';
            var_dump($redis->srem('set', 'bird'));echo '<br>';
        
            $set = $redis->smembers('set');
            print_r($set);echo '<br>';
        
            //判断元素是否是set的成员
            var_dump($redis->sismember('set', 'dog'));echo '<br>';
            var_dump($redis->sismember('set', 'bird'));echo '<br>';
        
            //查看集合中成员的数量
            echo $redis->scard('set');echo '<br>';
        
            //移除并返回集合中的一个随机元素(返回被移除的元素)
            echo $redis->spop('set');echo '<br>';
        
            print_r($redis->smembers('set'));echo '<br>';

            //删除
            $redis->del('set');
            echo $redis->get('set');

        } else {
            echo "Redis 连接失败" . $conn;
        }
    }

    /**
     * 集合操作1
     */
    public static function set1Demo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //集合
            $redis->sadd('set', 'horse');
            $redis->sadd('set', 'cat');
            $redis->sadd('set', 'dog');
            $redis->sadd('set', 'bird');
            $redis->sadd('set2', 'fish');
            $redis->sadd('set2', 'dog');
            $redis->sadd('set2', 'bird');
        
            print_r($redis->smembers('set'));echo '<br>';
            print_r($redis->smembers('set2'));echo '<br>';
        
            //返回集合的交集
            print_r($redis->sinter('set', 'set2'));echo '<br>';
        
            //执行交集操作 并结果放到一个集合中
            $redis->sinterstore('output', 'set', 'set2');
            print_r($redis->smembers('output'));echo '<br>';
        
            //返回集合的并集
            print_r($redis->sunion('set', 'set2'));echo '<br>';
        
            //执行并集操作 并结果放到一个集合中
            $redis->sunionstore('output', 'set', 'set2');
            print_r($redis->smembers('output'));echo '<br>';
        
            //返回集合的差集
            print_r($redis->sdiff('set', 'set2'));echo '<br>';
        
            //执行差集操作 并结果放到一个集合中
            $redis->sdiffstore('output', 'set', 'set2');
            print_r($redis->smembers('output'));echo '<br>';

            //删除
            $redis->del('set');
            echo $redis->get('set');

        } else {
            echo "Redis 连接失败" . $conn;
        }
    }

    /**
     * 集合操作2
     */
    public static function set2Demo()
    {
        //实例化redis
        $redis = new Redis();
        //连接
        $conn = $redis->connect('localhost', 6379);

        if ($conn){
            echo "Server is running: " . $redis->ping().'<br>';

            //有序集合
            //添加元素
            echo $redis->zadd('set', 1, 'cat');echo '<br>';
            echo $redis->zadd('set', 2, 'dog');echo '<br>';
            echo $redis->zadd('set', 3, 'fish');echo '<br>';
            echo $redis->zadd('set', 4, 'dog');echo '<br>';
            echo $redis->zadd('set', 4, 'bird');echo '<br>';
            
            //返回集合中的所有元素
            print_r($redis->zrange('set', 0, -1));echo '<br>';
            print_r($redis->zrange('set', 0, -1, true));echo '<br>';
        
            //返回元素的score值
            echo $redis->zscore('set', 'dog');echo '<br>';
        
            //返回存储的个数
            echo $redis->zcard('set');echo '<br>';
        
            //删除指定成员
            $redis->zrem('set', 'cat');
            print_r($redis->zrange('set', 0, -1));echo '<br>';
        
            //返回集合中介于min和max之间的值的个数
            print_r($redis->zcount('set', 3, 5));echo '<br>';
        
            //返回有序集合中score介于min和max之间的值
            print_r($redis->zrangebyscore('set', 3, 5));echo '<br>';
            print_r($redis->zrangebyscore('set', 3, 5, ['withscores'=>true]));echo '<br>';
        
            //返回集合中指定区间内所有的值
            print_r($redis->zrevrange('set', 1, 2));echo '<br>';
            print_r($redis->zrevrange('set', 1, 2, true));echo '<br>';
        
        
            //有序集合中指定值的socre增加
            echo $redis->zscore('set', 'dog');echo '<br>';
            $redis->zincrby('set', 2, 'dog');
            echo $redis->zscore('set', 'dog');echo '<br>';
        
            //移除score值介于min和max之间的元素
            print_r($redis->zrange('set', 0, -1, true));echo '<br>';
            print_r($redis->zremrangebyscore('set', 3, 4));echo '<br>';
            print_r($redis->zrange('set', 0, -1, true));echo '<br>';

            //删除
            $redis->del('set');
            echo $redis->get('set');

        } else {
            echo "Redis 连接失败" . $conn;
        }
    }
}

// demo1::stringDemo();
// demo1::listDemo();
// demo1::list1Demo();
// demo1::list2Demo();
// demo1::hashDemo();
// demo1::hash1Demo();
// demo1::setDemo();
// demo1::set1Demo();
demo1::set2Demo();
