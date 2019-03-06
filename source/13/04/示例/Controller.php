<?php

namespace app\demo\controller;

// use think\Request;

//导入请求对象的静态代理
use think\facade\Request;

/**
 * 正常情况下，控制器不依赖于父类Controller.php
 * 推荐继承于父类，可以很方便的使用在父类中封装好的一些方法和属性
 * Controller.php没有静态代理
 * 控制器中的输出，字符串全部用return 返回，不要用echo
 * 如果输出的是复杂类型，我们可以用dump()函数
 * 默认输出的格式为html，可以指定为其他格式：json
 * 
 * 1、传统的 new Request
 * 2、静态代理：think\facade\Request
 * 3、依赖注入：Request $request
 * 4、父类Controller中的属性$request：$this->request
 */
class Controller extends \think\Controller
{
    //依赖注入
    public function test(Request $request)
    {
        dump($request->get());
    }

    //父类属性
    public function test2()
    {
        dump($this->request->get());
    }

    //静态代理
    public function test3()
    {
        return (json_encode(Request::get()));
    }
}