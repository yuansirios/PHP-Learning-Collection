<?php 
namespace app\common\controller;
use think\Controller;
use think\Facade\Session;
use think\facade\Request;
use app\common\model\ArtCate; //分类自定义模型
use app\common\model\Article;
use app\admin\common\model\Site;  //调用后台的模型Site

/**
* 用户控制器应继承自这个基础公共控制器
* 该控制器继承自Controller.php
* 用户可以将一些公共操作放在这个公共控制器
*/
class Base extends Controller
{
	
	/**
	 * 初始化方法
	 * 1.在所有方法之前调用
	 * 2.常用来创建常量,公共方法等
	 */
    protected function initialize()
    {
        //检测站点是否已关闭
        $this->is_open();

        //显示分类导航,在初始化中调用,可以确保所有页面都可以使用分类信息变量
        $this->showNav();

        //按点击数时行排行显示在右边栏
        $this->getHotArt();
    }

    //检查是否已登录:防止重复登录:放在登录验证方法中调用
    protected function logined()
    {
    	if(Session::has('user_id')){
    		$this->error('客官,你已经登录啦~~','index/index');
    	} 
    }

    //检查是否未登录:放在需要登录操作的方法的最前面,例如发布文章
    protected function isLogin()
    {
        if (!Session::has('user_id')) {
            $this->error('客官,您是不是忘记登录啦~~','user/login');
        }
    }

    //显示分类导航
    protected function showNav()
    {
        //1.查询分类表得到所有的分类信息,该方法要在初始化方法中调用
        $cateList = ArtCate::all(function($query){
            $query->where('status',1)->order('sort','asc');
        });
        //2.将分类信息赋值给模板: nav.html中调用
        $this->view->assign('cateList', $cateList);
        
    }


     //检测站点是否已关闭:在公共控制器初始化方法中调用
    public function is_open()
    {
        //1.获取当前站点的状态
        $isOpen = Site::where('status',1)->value('is_open');

        //2.如果站点是关闭状态,那我们只允许关闭前台模块,后台模块必须仍然可以访问
        if ($isOpen==0 && Request::module()=='index') {
            //或者写上:此域名出售
            $info = <<<'INFO'
            <body style="background-color:#333">
            <h1 style="color:#eee;text-align:center;margin:200px">站点维护中...</h1>
            </body>
INFO;
            exit($info);
        }
    }


    //检测注册是否关闭:放在前台注册方法中调用
    public function is_reg()
    {
        //1.获取当前站点的注册状态
        $isReg = Site::where('status',1)->value('is_reg');

        //3. 如果已关闭注册,则直接跳转到首页
        if ($isReg == 0) {            

            $this->error('注册已关闭','index/index');
        }
    }

    //根据阅读量PV排名来获取内容,放在前台的右侧显示:在初始化方法中进行调用 
    public function getHotArt()
    {
        $hotArtList = Article::where('status',1)->order('pv','desc')->limit(12)->select();

        $this->view->assign('hotArtList', $hotArtList);
    }

}












