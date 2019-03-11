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
	
### 二、模型

1、模型定义

定义一个Student模型类很简单：

```
<?php

namespace app\demo\model;

use think\model;

class Student extends model
{

}
```

> 请确保你已经在数据库配置文件中配置了数据库连接信息

模型会自动对应数据表，模型类的命名规则是除去表前缀的数据表名称，采用驼峰法命名，并且首字母大写，例如：

| 模型名称 | 模型名	约定对应数据表（假设数据库的前缀定义是 `think_`） |
| :--- | :--- |
| User | `think_user` |
| UserType | `think_user_type` |

> 模型自动对应的数据表名称都是遵循小写+下划线规范，如果你的表名有大写的情况，必须通过设置模型的table属性。

如果担心模型的名称和PHP关键字冲突，可以启用类后缀功能，只需要在应用配置文件`app.php`中设置：

```
// 开启应用类库后缀
    'class_suffix'           => true,
```

> 开启后，所有的应用类库定义的时候都需要加上对应后缀，包括控制器类。

这样`app\demo\model\Student`类定义就要改成

```
<?php
namespace app\demo\model;

use think\Model;

class StudentModel extends Model
{
}
```

并且文件名也要改为`StudentModel.php`。

> 大多数情况下，不同模块的模型是不需要独立的，因此可以统一在`common`模块下面定义模型。

2、模型设置

默认主键为`id`，如果你没有使用`id`作为主键名，需要在模型中设置属性：

```
<?php
namespace app\demo\model;

use think\Model;

class Student extends Model
{
    protected $pk = 'sid';
}
```

> 5.1中模型不会自动获取主键名称，必须设置pk属性。

如果你想指定数据表甚至数据库连接的话，可以使用：

```
<?php
namespace app\ demo\model;

use think\Model;

class Student extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'think_student';
    
    // 设置当前模型的数据库连接
    protected $connection = 'db_config';
}
```

`connection`属性的建议用配置参数名（需要在`database.php`中添加）而不是具体的连接信息，从而避免把数据库连接固化在代码里面。

常用的模型设置属性包括（以下属性都不是必须设置）：

| 属性 | 描述 |
| :--- | :--- |
| name | 模型名（默认为当前不含后缀的模型类名） |
| table | 数据表名（默认自动获取） |
| pk | 主键名（默认为id） |
| connection | 数据库连接（默认读取数据库配置） |
| query | 模型使用的查询类名称 |
| field | 模型对应数据表的字段列表（数组 |

3、模型初始化

模型同样支持初始化，与控制器的初始化不同的是，模型的初始化是定义`Model`的`init`方法，具体如下

```
<?php
namespace app\demo\model;

use think\Model;

class Student extends Model
{

    // 模型初始化
    protected static function init()
    {
        //TODO:初始化内容
    }
}
```

模型初始化方法通常用于注册模型的事件操作。

> init必须是静态方法，并且只在第一次实例化的时候执行

4、模型操作

> 在模型中除了可以调用数据库类的方法之外（换句话说，数据库的所有查询方法模型中都可以支持），可以定义自己的方法，所以也可以把模型看成是数据库的增强版。

模型的查询方法无需和数据库查询一样调用`table`或者`name`方法，因为模型会按照规则自动匹配对应的数据表，例如：

```
Db::name('Student')->where('id','>',10)->select();
```

改成模型操作的话就变成

```
Student::where('id','>',10)->select();
```

虽然看起来是相同的查询条件，但一个最明显的区别是查询结果的类型不同。
第一种方式的查询结果是一个（二维）数组，而第二种方式的查询结果是包含了模型（集合）的数据集。不过，在大多数情况下，这二种返回类型的使用方式并无明显区别。

**更多操作参考示例代码**

### 总结

这一章讲了`数据库与模型`技术相关操作，

* `数据库`介绍了配置连接的各种方式，CURD常规操作，示例代码参考`demo\controller\DataBase.php`
* `模型`介绍了数据表的映射关系，方便数据操作，示例代码参考`demo\controller\Model.php`

同时感谢[PHP中文网](http://www.php.cn) 的教学资源...

以上均是自学过程的积累，学到哪记到哪

原创文章，转载请注明出处，谢谢！