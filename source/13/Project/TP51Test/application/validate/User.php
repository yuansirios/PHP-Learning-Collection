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