# 数据库与模型

> 项目示例使用MySQL数据库

### 一、数据库

1、修改项目设置

打开`config\app.php`修改配置

<img src='./img/app设置.png' width=300>

2、数据库连接

 * 数据准备
 
 <img src='./img/数据表.png' width=300>
 
 * 全局配置
 
 打开`config\database.php`修改配置
 
 <img src='./img/全局配置.png' width=300>
  
	```
	//全局配置连接
	public function conn()
	{
	    return Db::table('student')
	    ->where('id','2')
	    ->value('name');
	}
	```

 <img src='./img/全局连接.png' width=500>
 
 * 动态配置

 ```
	public function conn2()
	{
	    return Db::connect([
	        'type'=>'mysql',
	        'hostname'=>'localhost',
	        'database'=>'demo',
	        'username'=>'root',
	        'password'=>'root',
	    ])
	    ->table('student')
	    ->where('id','5')
	    ->value('name');
	}
 ```
 
 <img src='./img/动态连接.png' width=500>
 
 * DSN连接
 
 ```
    public function conn3()
    {
        $dsn = 'mysql://root:root@localhost/demo#utf8';
        return Db::connect($dsn)
        ->table('student')
        ->where('id','3')
        ->value('name');
    }
 ```
 
 <img src='./img/DSN连接.png' width=500>
 
3、增删改查操作

* 单条查询

 ```
 public function find()
    {
        /**
         * Db类数据库操作的入口类
         * 功能：静态调用think\db\Query.php类中的查询方法实现基本操作
         * table():选择数据表
         * field():用来设置返回的字段或别名
         * where():设置查询条件 表达式，数组
         * 1、单个条件 使用表达式
         * 2、对于多个条件使用数组
         * find()返回符合条件的第一条记录，没有的话返回null
         */

        // $res = Db::table('student')
        // ->field('id,name,email')
        // ->field(['id'=>'编号','name'=>'姓名','email'=>'邮箱'])
        // ->where('id',4) //如果是相等关系 = 可忽略
        // ->find();
        // dump(is_null($res) ? '没有找到' : $res);

        $res = Db::table('student')
        ->field('id,name,email')
        ->find(5); //如果是主键查询，可省略where()
        dump(is_null($res) ? '没有找到' : $res);
    }
 ```
 
 <img src='./img/单条查询.png' width=500>
 
 **单条查询原理**
 
 <img src='./img/单条查询原理.png' width=500>

	**【问题】**  
	
	```
	//返回字段设置别名出错，暂时还没找到原因？
	->field(['id'=>'编号','name'=>'姓名','email'=>'邮箱'])
	```
	
	<img src='./img/设置别名错误.png' width=500>
	
* 多条查询

	```
	public function select()
	{
	    //select()返回的是一个二维数组，没有数据返回是一个空数据
	    $res = Db::table('student')
	    ->field('id,name,email')
	    ->where([
	        ['age','=',18],
	        ['id','<=',5]
	    ])
	    ->select();
	
	    if (empty($res)){
	        return '没有满足条件的记录';
	    } else {
	        foreach ($res as $row)
	        {
	            dump($row);
	        }
	    }
	}
	```
	
	<img src='./img/多条查询.png' width=500>
	
	**多条查询原理**
	
	<img src='./img/多条查询原理.png' width=500>
	
* 单条插入

	```
	public function insert()
    {
        //insert()成功返回新增的数量，失败返回false
        //准备一下要插入的数据
        $data = [
            'name'=>'金毛狮王4',
            'age'=>52,
            'email'=>'jinmaoshiwang2@163.com',
        ];

        // return Db::table('student')->insert($data);

        //只有数据库类型为MySQL的时候，才可以传入true
        //REPLACE INTO方式插入,性能更高
        // return Db::table('student')->insert($data,true);

        //data()方法对数据进行过滤，更安全，insert不支持参数true
        // return Db::table('student')->data($data)->insert();

        //插入的同时返回新增主键ID
        //insertGetId()同时执行两步：第一步插入，第二步返回主键ID
        return Db::table('student')->insertGetId($data);
    }
	```
	
	<img src='./img/单条插入.png' width=500>
	
	**insertGetId原理**
	
	<img src='./img/insertGetId原理.png' width=500>

* 多条插入

	```
	public function insertAll()
    {
        $data = [
            ['name'=>'多条插入','age'=>1,'email'=>'duotiao@163.com'],
            ['name'=>'多条插入1','age'=>2,'email'=>'duotiao1@163.com'],
            ['name'=>'多条插入2','age'=>3,'email'=>'duotiao2@163.com'],
        ];

        // return Db::table('student')->insertAll($data);
        return Db::table('student')->data($data)->insertAll();
    }
	```
	
	<img src='./img/多条插入.png' width=500>
	
	**多条插入原理**
	
	<img src='./img/多条插入原理.png' width=500>
	
* 更新操作

	```
	public function update()
    {
        //update()必须要有更新条件
        // return Db::table('student')
        // ->where('id',2)
        // ->update(['name'=>'郭靖被修改了']);

        //如果更新条件是主键的话，可以直接把主键写到更新数组中
        return Db::table('student')
        ->update(['name'=>'郭靖被修改了','id'=>2]);
    }
	```
	
	<img src='./img/更新.png' width=500>
	
	**更新原理**
	
	<img src='./img/更新原理.png' width=500>
	
* 删除操作

	```
	public function delete()
    {
        // return Db::table('student')
        // ->delete(13);

        return Db::table('student')
        ->where('id',12)
        ->delete();
    }
	```
	
	<img src='./img/删除.png' width=500>
	
	**删除原理**
	
	<img src='./img/删除原理.png' width=500>
	
* 原生查询

	```
	public function query()
    {
        $sql = "SELECT `id`,`name`,`email` FROM `student` WHERE `id` IN (3,4,5)";
        dump(Db::query($sql));
    }

	```
	
	<img src='./img/原生查询.png' width=500>
	
* 原生写操作：更新，删除，添加
	
	```
	public function execute()
    {
        // return Db::execute("UPDATE `student` SET `name`='武松' WHERE `id`=10");
        // return Db::execute("INSERT `student` SET `name`='宋江'");
        return Db::execute("DELETE FROM `student` WHERE `name`='宋江'");
    }
	```