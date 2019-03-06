<?php

namespace app\demo\controller;

// use app\demo\model\UserModel;

class Facade
{
    public function index($name='yuan')
    {
        // $user = new UserModel();
        // return $user->sayHello('everyBody');

        /**
         * 如果静态调用一个动态方法，需要给当前的类绑定一个静态代理类
         * 如果没有在静态代理类中显示要指定要绑定的类名，就需要动态显示绑定一下
         * \think\Facade::bind()
         */

        //  return \app\facade\UserModel::sayHello('everyBody');

        \think\Facade::bind('app\facade\UserModel','app\demo\model\UserModel');
        return \app\facade\UserModel::sayHello('everyBody');
    }
}