<?php

namespace app\demo\model;

use think\Model;

class UserModel extends Model
{
    //属性
    public $name;

    //禁用掉构造器
    public function __construct($name = 'yuan')
    {
        $this->name = $name;
    }
}