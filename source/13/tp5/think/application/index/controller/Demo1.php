<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 2019-03-20
 * Time: 11:14
 */

namespace app\index\controller;

use think\Controller;
use think\facade\View;

class Demo1 extends Controller
{
    public function test1()
    {
        //直接将内容输出到页面，不通过模板
        $content = '<h3 style="color: green">直接将内容输出到页面，不通过模板</h3>';
        //return $this->display($content);

        //推荐使用，因为过程更加清晰，不隐藏细节
        return $this->view->display($content);

        //静态代理
        //导入think\facade\View;
        //return View::display($content);
    }

    //使用视图将数据进行输出：fetch()
    public function test2()
    {
        //模板变量赋值：assign()
        //1、普通变量
        $this->view->assign('name','yuan');
        $this->view->assign('age',20);

        //2、批量赋值
        $this->view->assign([
            'sex'=>'男',
            'salary'=>666
        ]);

        //3、array
        $this->view->assign('goods',[
            'id'=>3,
            'name'=>'手机',
            'model'=>'meta20'
        ]);

        //4、object
        $obj = new \stdClass();
        $obj->id = 1;
        $obj->name = 'yuan';
        $this->view->assign('info',$obj);

        //5、const
        define('SITE_NAME','我是常量');

        //在模板中输出数据
        //模板默认的目录位于当前模块的view目录，模板文件默认位于以当前控制器命名的目录中
        return $this->fetch();
    }

    //输出数据显示
    public function test3(){
//        $data = \app\model\Student::all();
        //分页
        $data = \app\model\Student::paginate(5);
        $this->view->assign('data',$data);
        return $this->view->fetch();
    }
}