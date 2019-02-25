<?php

namespace app\admin\controller;
use think\facade\Config;

class User
{
    public function get()
    {
        //获取全部的配置项
        // dump(Config::get());

        //仅获取app下面的配置项，app是一级配置项，与config/app.php文件对应
        // dump(Config::get('app.'));

        //仅获取一级配置项，推荐使用pull()
        // dump(Config::pull('app'));

        //获取二级配置项
        // dump(Config::get('app.app_debug'));

        //app是默认的一级配置前缀，所以可以省略
        // dump(Config::get('app_debug'));
        // dump(Config::get('default_lang'));

        //是否有这个配置
        dump(Config::has('default_lang'));

        //查询database一级配置底下的内容
        dump(Config::get('database.hostname'));
    }

    public function set()
    {
        //静态设置就是直接修改配置文件
        //动态设置用的是Config类中的set()方法
        dump(Config::get('app_debug'));
        Config::set('app_debug',true);
        dump(Config::get('app_debug'));
    }

    public function helper()
    {
        //助手函数不依赖于Config类
        //不传参获取全部配置项
        // dump(config());
        // dump(config('default_module'));

        //查询是否存在
        dump(config('?database.username'));
        dump(config('database.username'));

        //设置会输出localhost
        // dump(config('database.username','localhost'));

        //取值
        dump(config('database.username'));
    }
}