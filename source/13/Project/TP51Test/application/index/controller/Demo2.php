<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 2019-03-21
 * Time: 16:01
 */

namespace app\index\controller;
use think\Controller;

class Demo2 extends Controller
{
    public function test1()
    {
        return $this->view->fetch();
    }

    public function test2()
    {
        return $this->view->fetch();
    }
}