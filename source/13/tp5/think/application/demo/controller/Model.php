<?php

namespace app\demo\controller;

use think\Db;
use app\demo\model\Student;

class Model
{
    //插入单条
    public function save()
    {
        //1、实例化模型对象后赋值并保存：
        // $stu           = new Student;
        // $stu->name     = '小红';
        // $stu->age      = 20;
        // $stu->email    = 'xiaohong@qq.com';
        // dump($stu->save());

        //2、也可以直接传入数据到save方法批量赋值：
        // $stu->save([
        //     'name'=>'小明',
        //     'age'=>21,
        //     'email'=>'xiaoming@qq.com'
        // ]);

        //3、或者直接在实例化的时候传入数据
        // $stu = new Student([
        //     'name'=>'小丽',
        //     'age'=>24,
        //     'email'=>'xiaoli@qq.com'
        // ]);
        // dump($stu->save());

        //V5.1.14+版本开始，save方法可以支持replace写入。
        // $stu->replace()->save();
        // 获取自增ID
        // dump($stu->id);

        //4、还可以直接静态调用create方法创建并写入：

        // $stu = Student::create([
        //     'name'=>'杨过3',
        //     'age'=>25,
        //     'email'=>'yangguo3@qq.com'
        // ]);

        // echo $stu->name;
        // echo $stu->age;
        // echo $stu->email;
        //和save方法不同的是，create方法返回的是当前模型的对象实例。

        /**
         * create方法的第二个参数可以传入允许写入的字段列表
         * （传入true则表示仅允许写入数据表定义的字段数据），
         * 例如：
         */
        // 只允许写入name和email字段的数据
        $stu = Student::create([
            'name'=>'杨过3',
            'email'=>'yangguo3@qq.com'
        ],['name','email'],true);
        echo $stu->name;
        echo $stu->email;

        //最佳实践
        //新增数据的最佳实践原则：使用create方法新增数据，使用saveAll批量新增数据。
    }

    //插入多条
    public function saveAll()
    {
        $stu = new Student;
        $list = [
            ['name'=>'杨过','age'=>32,'email'=>'yangguo@163.com'],
            ['name'=>'杨过2','age'=>32,'email'=>'yangguo@163.com'],
        ];
        // saveAll方法新增数据返回的是包含新增模型（带自增ID）的数据集对象。
        $stu->saveAll($list);
    }

    //查询单条
    public function get()
    {
        $res = Student::get(3);

        //输出的是对象
        dump($res instanceof Student);

        dump($res -> name);

        //Student 等价于 Db::table('student')

        //输出的是数组
        // 用查询构造器创建更加复杂的查询
        // $res = Db::table('student')
        // ->where('id','3')
        // ->find();

        // dump($res);
    }

    //查询多条
    public function all()
    {
        // $res = Student::all([3,4,5]);
        // dump($res);

        //等价于

        // 用查询构造器创建更加复杂的查询
        // 设置别名出错 ['name'=>'姓名','email'=>'邮箱']
        $res = Student::field('id,name,email')
                        ->where('id','in','3,4,5')
                        ->select();
        dump($res);
    }
    
    //查找并更新
    public function update()
    {
        // $stu = Student::get(22);
        // $stu->name     = '修改了';
        // $stu->age      = 10;
        // $stu->email    = 'xiugai@qq.com';
        // $stu->save();

        /**
         * save方法返回影响的记录数，
         * 并只有当before_update事件返回false的时候返回false，
         * 从V5.1.6+版本开始统一返回布尔值
         */

         //对于复杂的查询条件，也可以使用查询构造器来查询数据并更新

        // $stu = Student::where('name','小丽')
        //                 ->where('email','xiaoli@qq.com')
	    //                 ->find();
        // $stu->name      = '1';
        // $stu->email     = '213@qq.com';
        // $stu->save();

        /**
         * save方法更新数据，只会更新变化的数据，
         * 对于没有变化的数据是不会进行重新更新的。
         * 如果你需要强制更新数据，可以使用下面的方法：
         */

        $stu = Student::get(1);
        $stu->name     = '强制更新';
        $stu->email    = '1231@qq.com';
        $stu->force()->save();

        //上面两种方式更新数据，如果需要过滤非数据表字段的数据，可以使用：
        $stu = new Student;
        // 过滤post数组中的非数据表字段数据
        $stu->allowField(true)->save($_POST,['id' => 1]);
        // post数组中只有name和email字段会写入
        $stu->allowField(['name','email'])->save($_POST, ['id' => 1]);
        //最佳建议是在传入模型数据之前就进行过滤，例如：
        // post数组中只有name和email字段会写入
        $data = Request::only(['name','email']);
        $stu->save($data, ['id' => 1]);

        /********** 静态方法 **********/
         
        Student::where('id', 1)
            ->update(['name' => '杨过']);
        //数据库的update方法返回影响的记录数

        Student::update(['id' => 1, 'name' => '杨过']);
        //模型的update方法返回模型的对象实例

        //上面两种写法的区别是第一种是使用的数据库的update方法，
        //而第二种是使用的模型的update方法（可以支持模型的修改器、事件和自动完成）。

        /**
         * 更新的最佳实践原则是：
         * 如果需要使用模型事件，那么就先查询后更新，
         * 如果不需要使用事件，直接使用静态的Update方法进行条件更新，
         * 如非必要，尽量不要使用批量更新。
         */
    }

    //删除
    public function delete()
    {
        //模型的删除和数据库的删除方法区别在于，模型的删除会包含模型的事件处理。

        // $stu = Student::get(2);
        // $stu->delete();

        //根据主键删除
        // Student::destroy(19);
        // 支持批量删除多个数据
        // Student::destroy('19,20,22');
        // 或者
        // Student::destroy([19,20,22]);

        //条件删除
        //还支持使用闭包删除，例如：
        /*Student::destroy(function($query){
            $query->where('id','>',17);
        });*/

        //或者通过数据库类的查询条件删除
        Student::where('id','>',14)->delete();

        /**
         * 删除的最佳实践原则是：
         * 如果删除当前模型数据，用delete方法，
         * 如果需要直接删除数据，使用destroy静态方法。
         */
    }
}