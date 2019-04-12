<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 2019-03-28
 * Time: 14:20
 */

namespace app\index\controller;

use app\common\controller\Base;

class Test extends Base
{
    //测试用户的验证器
    public function test1()
    {
        $data = [
            'name' => 'yuansir',
            'email' => 'yuansir@163.com',
            'mobile' => '13537381917',
            'password' => '13537381917',

        ];

        $rule = 'app\common\validate\User';

        $res = $this->validate($data,$rule);

        return $res;
    }
}