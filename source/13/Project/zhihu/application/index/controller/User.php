<?php

namespace app\index\controller;

use app\common\controller\Base;  //导入公共控制器
use app\common\model\User as UserModel;
use think\facade\Request;
class User extends Base
{
    /**
     * 注册
     */
    public function register()
    {
        return $this->fetch();
    }

    /**
     * 处理用户提交的注册信息
     */
    public function insert()
    {
//        return ['status'=>1,'message'=>'恭喜，注册成功'];

        //处理用户提交的注册信息
        if (Request::isAjax()){
            //使用模型来创建
            //获取用户通过表单提交过来的数据
            $data = Request::except('password_confirm','post');

            $rule = 'app\common\validate\User';

            $res = $this->validate($data,$rule);
        
            if (true !== $res){

                return ['status'=>0,'message'=>$res];

            }else{

                if (UserModel::create($data)) {

                    return ['status'=>1,'message'=>'恭喜，注册成功'];
 
                } else {
 
                    return ['status'=>0,'message'=>'注册失败，请重试'];
 
                }
            }
        } else {
            $this->error("请求类型错误",'register');
        }
    }
}