<?php

namespace app\index\controller;

use app\common\controller\Base;  //导入公共控制器

class Index extends Base
{
    public function index()
    {
        return $this->fetch('index',['name'=>'yuan']);
    }
}
