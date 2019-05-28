<?php 
namespace app\index\controller;
use app\common\controller\Base;


class Test extends Base
{
	//测试用户表的验证器
	public function test1()
	{
		$data = [
			'name'=>'peterzhu',
			'email'=>'peter@php.cn',
			'mobile'=>'18976552345',
			'password'=>'123456abcdefg',
		];

		$rule = 'app\common\validate\User';

		return $this->validate($data,$rule);
	}

	//测试获取器与设置器
	public function test2()
	{
		dump(\app\common\model\User::get(2));
	}

	//测试导航的调取
	public function test3()
	{
		$this->showNav();
	}

	
}