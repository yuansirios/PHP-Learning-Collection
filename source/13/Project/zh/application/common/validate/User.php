<?php 
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
	//经过分析,用户注册需要提供:用户名,邮箱,手机号和密码
	protected $rule = [
		'name|姓名'=> 'require|length:2,20|chsAlphaNum',
		'email|邮箱'=> 'require|email|unique:zh_user',
		'mobile|手机号'=>'require|mobile|unique:zh_user',
		'password|密码'=>'require|length:6,20|alphaNum|confirm'
	];
	
}