<?php

namespace app\demo\controller;

use think\Facade;

class Pattern
{
    public function run()
    {
        //将Site类的实例上树，放到对象池
        Register::set('site',Factory::create());
        //从树上取一个对象下来
        $obj = Register::get('site');
        //查看一下这个对象
        dump($obj); 

        echo '<hr>';
        echo $obj->siteName;
    }
}

//单例模式
class Site
{
    //属性
    public $siteName;
    //本类的静态实例
    protected static $instance = null;
    //禁用掉构造器
    private function __construct($siteName)
    {
        $this->siteName = $siteName;
    }
    //获取本类唯一实例
    public static function getInstance($siteName='PHP中文网')
    {
        if (!self::$instance instanceof self)
        {
            self::$instance = new self($siteName);
        }
        return self::$instance;
    }
}

//工厂模式
class Factory
{
    //创建指定类的实例
    public static function create()
    {
        return Site::getInstance('Factory创建');
    }
}

//对象注册树
/**
 * Class Register
 * 1、注册：set()，把对象挂到树上
 * 2、获取：get()，把对象取下来用
 * 3、注销：_unset()，把对象吃掉
 */
class Register
{
    //创建对象池：数组
    protected static $objects = [];
    //生成对象并上树
    public static function set($alias,$object)
    {
        self::$objects[$alias] = $object;
    }

    //从树上面取下对象
    public static function get($alias)
    {
        return self::$objects[$alias];
    }

    //把树上面对象吃掉
    public static function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}