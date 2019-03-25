# ThinkPHP验证器使用和实践

> `ThinkPHP5.1`推荐使用验证器进行数据验证（也支持使用`\think\Validate`类进行独立验证）。

## 验证器定义

为具体的验证场景或者数据表定义好验证器类，直接调用验证类的`check`方法即可完成验证，下面是一个例子：

我们定义一个`\app\index\validate\User`验证器类用于`User`的验证。

```
<?php

namespace app\validate;

use think\Validate;

class User extends Validate
{
    //要验证的数据
    protected $rule = [

        //|设置显示名称
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

    //自定义错误提示
    protected $message  =   [
        'name.require'      => '名称必须',
        'name.max'          => '名称最多不能超过20个字符',
        'password.max'      => '密码最多不能超过12个字符',
        'password.alphaNum' => '密码只能只能是字母和数字'
    ];
}
```

> 如果没有定义错误提示信息，则使用系统默认的提示信息

## 数据验证

在需要进行`User`验证的控制器方法中，添加如下代码即可：

```
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
```

## 总结

这一章讲了`验证器使用和实践`技术相关操作，
     
* 验证器是一个自定义的类，必须继承于框架的验证类`think\Validate.php`
* 验证器可以创建在应用`application`目录下的任何一个可以访问的目录下面，这个访问是指控制器可以访问，并不是指外部的URL访问，只需要制定正确的命名空间
* 验证器其实就是完成框架的`think\Validate`类中的属性`protected $rule=[]`初始化,在控制器中其实实例化调用`check()`完成验证
* 还可以创建一个自定义的静态代理，来统一验证方法的效用方式

同时感谢[PHP中文网](http://www.php.cn) 的教学资源...

以上均是自学过程的积累，学到哪记到哪

原创文章，转载请注明出处，谢谢！