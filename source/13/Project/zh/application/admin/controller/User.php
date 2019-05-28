<?php 
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\User as UserModel;
use think\facade\Request;
use think\facade\Session;

class User extends Base 
{

	private $password = '';  //临时存放用户密码

	//渲染登录界面
	public function login()
	{
		$this->view->assign('title','管理员登录');
		return $this->view->fetch('login'); 
	}

	//验证用户登录
	public function checkLogin()
	{
		$data = Request::param();

		$map[] = ['email','=',$data['email']];
		$map[] = ['password','=',sha1($data['password'])];

		$result = UserModel::where($map)->find();
		if($result){
			Session::set('user_id',$result['id']);
			Session::set('user_name',$result['name']);
			Session::set('is_admin',$result['is_admin']);			
			$this->success('登录成功','admin/user/userList');
		}

		$this->error('登录失败');
	}

	//退出登录
	public function logout()
	{
		//1.清除全部session
		Session::clear();

		//2.退出登录并跳转到登录页面
		$this->success('退出成功','login');
	}


	//用户列表:能执行到这里,肯定是超级管理员is_admin=1
	public function userList()
	{
		//1.获取当前用户id与is_admin
		$data['user_id'] = Session::get('user_id');
		$data['is_admin'] = Session::get('is_admin');

		//2.获取当前用户
		$userList = UserModel::where('id',$data['user_id'])->select();

		//3.如果是超级管理员就获取到全部用户
		if ($data['is_admin'] == 1){
			$userList = UserModel::select();
		}

		//4.设置必要的模板变量
		$this->view->assign('title', '用户管理');
		$this->view->assign('empty','<span style="red">没有任何数据</span>');
		$this->view->assign('userList', $userList);

		//5.渲染出用户列表
		return $this->view->fetch('userlist');
	}

	//渲染编辑用户界面
	public function userEdit()
	{
		//1.获取要更新的数据主键
		$userId = Request::param('id');

		//2.根据主键查询到需要更新的用户全部信息
		$userInfo = UserModel::where('id',$userId)->find();

		//3. 取出密码保存到私有属性中临时存储
		$this->password = $userInfo['password'];

		//4.设置编辑界面的模板变量
		$this->view->assign('title','编辑用户');
		$this->view->assign('userInfo',$userInfo);

		//5.渲染编辑界面
		return $this->fetch('useredit');
	}

	//执行用户编辑操作
	public function doEdit()
	{
		//1.获取用户提交的更新信息
		$data = Request::param();

		$id = $data['id'];  //取出更新主键
		

		//2.将用户密码加密后再写回
		if ($data['password'] == $this->password) {
			unset($data['password']); 
		} else {
			$data['password'] = sha1($data['password']);
		}

		//3.删除主键字段,封装出要更新的字段数组
		unset($data['id']);

		//4.执行更新操作
		if(UserModel::where('id',$id)->data($data)->update()){
			return $this->success('更新成功','userList');
		}

		//3. 更新失败提示
		$this->error('没有更新或更新失败');
	}


	//执行用户的删除操作
	public function doDelete()
	{
		//1.获取要删除的数据主键
		$id = Request::param('id');

		//2.执行删除操作
		if(UserModel::where('id',$id)->delete()){
			return $this->success('删除成功','userList');
		}

		//3. 删除失败提示
		$this->error('删除失败');

	}


}

















