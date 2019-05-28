<?php 
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Cate as CateModel;
use think\facade\Request;
use think\facade\Session;

class Cate extends Base
{
	//分类管理首页
	public function index()
	{
		//检测是否登录
    	$this->isLogin();
		
		//登录成功后默认跳转到用户管理界面
		return $this->redirect('catelist');
	}

	//分类列表
	public function cateList()
	{
		//1. 检测是否登录
    	$this->isLogin();

		//2.获取所有分类
		$cateList = CateModel::all();

		//3.设置必要的模板变量
		$this->view->assign('title', '分类管理');
		$this->view->assign('empty','<span style="red">没有任何分类</span>');
		$this->view->assign('cateList', $cateList);

		//4.渲染出分类列表
		return $this->view->fetch('catelist');
	}

	//渲染编辑分类界面
	public function cateEdit()
	{
		//1.获取要更新的分类主键
		$cateId = Request::param('id');

		//2.根据主键查询到需要更新的用户全部信息
		$cateInfo = CateModel::where('id',$cateId)->find();


		//3.设置编辑界面的模板变量
		$this->view->assign('title','编辑分类');
		$this->view->assign('cateInfo',$cateInfo);

		//4.渲染编辑界面
		return $this->fetch('cateedit');
	}

	//执行编辑保存操作
	public function doEdit()
	{
		//1.获取用户提交的更新信息
		$data = Request::param();

		$id = $data['id'];  //取出更新主键

		//2.删除主键字段,封装出要更新的字段数组
		unset($data['id']);

		//3.执行更新操作
		if(CateModel::where('id',$id)->data($data)->update()){
			return $this->success('更新成功','cateList');
		}

		//4. 更新失败提示
		$this->error('没有更新或更新失败');
	}

	//执行分类删除操作
	public function doDelete()
	{
		//1.获取要删除的数据主键
		$id = Request::param('id');

		//2.执行删除操作
		if(CateModel::where('id',$id)->delete()){
			return $this->success('删除成功','cateList');
		}

		//3. 删除失败提示
		$this->error('删除失败');

	}

	//渲染添加界面
	public function cateAdd()
	{
    	//1.设置编辑界面的模板变量
		$this->view->assign('title','添加分类');

		//2.渲染添加界面
		return $this->fetch('cateadd');
	}

	//执行添加操作
	public function doAdd()
	{
		//1.获取要添加的数据
		$data = Request::param();

		//2.执行添加操作并判断是否成功
		if(CateModel::create($data)){
			$this->success('添加成功','catelist');
		}

		//3:失败
		$this->error('添加失败','catelist');
	}
}









