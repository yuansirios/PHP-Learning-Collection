<?php 
namespace app\common\validate;

use think\Validate;

class ArtCate extends Validate 
{
	protected $rule = [
		'title|栏目名称'=> 'require|length:3,20|chsAlpha'
	];
}