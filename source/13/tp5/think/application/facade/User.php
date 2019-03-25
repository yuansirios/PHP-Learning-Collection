<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 2019-03-25
 * Time: 11:07
 */

namespace app\facade;

use think\facade;

class User extends facade
{
     protected static function getFacadeClass()
     {
         return 'app\validate\User';
     }
}