<?php

namespace app\index\controller;

use think\Controller;
//use app\validate\User; //用户自定义的验证器
use app\facade\User;
use think\facade\Validate;

class Demo3 extends Controller
{
    /*
     *  验证器总结
     * 1、验证器是一个自定义的类，必须继承于框架的验证类think\Validate.php
     * 2、验证器可以创建在应用application目录下的任何一个可以访问的目录下面，
     * 这个访问是指控制器可以访问，并不是指外部的URL访问，只需要制定正确的命名空间
     * 3、验证器其实就是完成框架的think\Validate类中的属性protected $rule=[]初始化
     * 在控制器中其实实例化调用check()完成验证
     * 5、还可以创建一个自定义的静态代理，来统一验证方法的效用方式
     */

    //1、验证器：使用的是Validate类中的rule属性
    public function test1()
    {
        //要验证的数据
        $data = [
            'name' => 'yuan1',
            'email' => 'yuan@163.com',
            'password' => '123abc',
            'mobile' => '13674637187'
        ];

        //验证器是一个类
        $validate = new User;

        if (!$validate->check($data)){
            return $validate->getError();
        }
        return '验证通过';
    }

    //2、使用静态代理
    public function test2()
    {
        $data = [
            'name' => 'yuan1',
            'email' => 'yuan@163.com',
            'password' => '123abc',
            'mobile' => '13674637187'
        ];
        if (!User::check($data)){
            return User::getError();
        }
        return '验证通过';
    }

    //3、控制器验证
    //调用控制器中的validate方法进行验证：使用用户自定义的验证器、类
    public function test3()
    {
        //$this->validate($data,$validate) 返回验证结果

        //要验证的数据
        $data = [
            'name' => 'yuan1',
            'email' => 'yuan@163.com',
            'password' => '123abc',
            'mobile' => '13674637187'
        ];

        //验证规则
        $validate = 'app\validate\User';
        $res = $this->validate($data,$validate);
        if (true !== $res){
            return $res;
        }
        return '验证通过';
    }

    //4、独立验证：使用的是验证器类think\Validate中的rule()方法
    //rule()方法实际上就是完成给当前类的protected $rule=[]初始化
    public function test4()
    {
        //创建验证规则
        $rule = [
            'name|姓名' => [
                'require',      //必填
                'min' => 5,     //最小长度5
                'max' => 20     //最大长度20
            ],

            'email' => [
                'require',
                'email'
            ],

            'password' => [
                'require',
                'min' => 3,
                'max' => 12,
                'alphaNum'      //只能是字母和数字
            ],

            'mobile' => [
                'require',
                'mobile'
            ]
        ];

        //要验证的数据
        $data = [
            'name' => 'yuan1',
            'email' => 'yuan@163.com',
            'password' => '123abc',
            'mobile' => '13674637187'
        ];

        if (!Validate::check($data)){
            return Validate::getError();
        }
        return '验证通过';
    }
}