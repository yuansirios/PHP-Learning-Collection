<?php

namespace app\demo\controller;

class Traits
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
    public function hello1()
    {
        return __METHOD__;
    }
}

trait Demo2
{
    public function hello2()
    {
        return __METHOD__;
    }
}

class Demo
{
    use Demo1,Demo2;
    public function hello()
    {
        return __METHOD__;
    }
    public function test1()
    {
        return $this->hello1();
    }
    public function test2()
    {
        return $this->hello2();
    }
}
