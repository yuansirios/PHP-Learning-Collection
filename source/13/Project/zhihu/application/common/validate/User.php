<?php
/**
 * zh_user表的验证器
 */

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name|姓名' => [
            'require'=>'require',
            'length'=>'5,20',
            'chsAlphaNum'=>'chsAlphaNum'    //仅允许汉字，字母和数字
        ],

        'email|邮箱' => [
            'require'=>'require',
            'email'=>'email',
            'unique'=>'zh_user'             //该字段必须在zh_user表中是唯一
        ],

        'mobile|手机号' => [
            'require'=>'require',
            'mobile'=>'mobile',
            'unique'=>'zh_user',             //该字段必须在zh_user表中是唯一
            'number'=>'number'
        ],

        'password|密码' => [
            'require'=>'require',
            'length'=>'6,20',
            'alphaNum'=>'alphaNum',           //仅允许字母和数字
            // 'confirm'=>'confirm'              //自动与password_confirm字段进行自动相等验证
        ],
    ];
}