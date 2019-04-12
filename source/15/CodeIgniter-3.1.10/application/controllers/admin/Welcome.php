<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * CI控制器：
	 * 控制器就是controllers目录下面的类
	 * 1、文件名的第一个字母一定要大写
	 * 2、类型和文件名要一致
	 * 3、一定要继承自CI_Controller类
	 * 
	 * 控制器的子目录
	 * 访问子目录中的控制器，在url上要加上子目录的名称
	 * 
	 * 设置默认控制器
	 * 默认控制器设置：config/routes.php中设置
	 * 
	 * 控制器的构造函数
	 * parent::__construct();
	 * 
	 * 系统保留字
	 * https://codeigniter.org.cn/user_guide/general/reserved_names.html
	 * 
	 * CI视图是一个Web页面
	 * CI默认的视图文件是.php的文件。放在views目录中
	 * 视图只能在控制器中加载来访问
	 * $this->load->view('视图文件名')
	 * 
	 * CI模型
	 * 模型是专门和数据库打交道的类，一般封装了对数据库进行增、删、改、查的方法。
	 * 
	 * 模型文件一般放在models目录下面
	 * CI的模型不是必须的，在实际开发中最好加上，以符合MVC规范。
	 */
	public function index()
	{
		// echo '欢迎页面';
		$this->load->view('admin/welcome_message');
	}

	public function hello()
	{
		//参数获取
		$this->name = $this->input->get('name'); 
		echo $this->name.'你好，这是欢迎页面';

		//页面传值1
		// $this->load->view('admin/welcome_hello',$this);

		$data['name'] = 'name';
		//页面传值2
		// $this->load->view('admin/welcome_hello',$data);

		//将视图作为数据返回
		echo $this->load->view('admin/welcome_hello','',TRUE);
	}

	public function detail()
	{
		//加载模型
		// $this->load->model('article_model');
		//配置自动加载：autoload.php $autoload['model'] = array('article_model');
		//调用模型中的方法
		$result = $this->article_model->detail(1);
		echo '<pre>';
		print_r($result);
	}
}
