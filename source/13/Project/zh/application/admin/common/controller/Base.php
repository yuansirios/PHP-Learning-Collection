<?php 
namespace app\admin\common\controller;
use think\Controller;
use think\facade\Request;
use think\facade\Session;
use app\admin\common\model\Site;

//后台公共控制器
class Base extends Controller 
{
	// 初始化
    protected function initialize()
    {
        
    }

    /**
     * 检测用启是否登录
     * 调用位置:
     * 1.后台首页的admin/index/index()
     */
    protected function isLogin()
    {
        if (!Session::has('user_id')) {
            $this->error('请先登录','admin/user/login');
        }
    }

   
}