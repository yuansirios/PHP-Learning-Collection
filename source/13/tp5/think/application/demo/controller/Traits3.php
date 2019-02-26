<?php

/**
 * trait优先级问题
 * 1、当前类中的方法与trait类，父类中的方法重名了，怎么办？
 * Demo,Test,Demo1都有hello方法
 * Demo > Demo1 > Test
 * 2、trait类的优先级是高于同名父类方法
 * 3、当多个trait类中有同名方法，怎么办？
 */
namespace app\demo\controller;

class Traits3
{
    public function run()
    {
        $obj = new Demo;
        echo $obj->hello();

        echo '<hr>';
        echo $obj->test1();

        echo '<hr>';
        echo $obj->test2();
    }
}

trait Demo1
{
    public function hello()
    {
        return __METHOD__;
    }
}

trait Demo2
{
    public function hello()
    {
        return __METHOD__;
    }
}

class Test
{
    public function hello()
    {
        return __METHOD__;
    }
}

class Demo extends Test
{
    use Demo1,Demo2{
        Demo1::hello insteadof Demo2;   //Demo1的hello方法指向Demo2
        Demo2::hello as Demo2Hello;     //Demo2的hello方法取别名Demo2Hello
    }
    // public function hello()
    // {
    //     return __METHOD__;
    // }
    public function test1()
    {
        return $this->hello();
    }
    public function test2()
    {
        return $this->Demo2Hello();
    }
}
