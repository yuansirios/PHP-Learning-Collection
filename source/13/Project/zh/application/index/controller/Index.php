<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Article;
use app\common\model\ArtCate;
use think\facade\Request; //导入请求静态代理
use think\Db;

class Index extends Base
{
    //首页
    public function index()
    {
        //设置全局查询条件
        $map = [];  //将当前页面的全部查询条件封装到一个条件数组中
        // 条件1:显示状态必须为1
        $map[] = ['status','=',1];  //等号必须要有,不允许省略

        //实现搜索功能
        $keywords = Request::param('keywords');
        if (!empty($keywords)){
            //条件2: 模糊匹配查询条件
            $map[] = ['title' , 'like','%'.$keywords.'%'];
        }

        //分类信息显示
        //1.获取到URL中的分类ID
        $cateId = Request::param('cate_id');
        //如果当前存在分类ID,再进行查询获取到分类名称
        if (isset($cateId)){
            //条件3: 当前列表与当前栏目id对应,此时$map[]条件数组生成完毕
            $map[] = ['cate_id','=', $cateId];
            $res = ArtCate::get($cateId);
            //文章列表分页显示,分页仅显示三条
            $artList = Db::table('zh_article')
                    ->where($map)
                    ->order('create_time','desc')->paginate(4); 
          $this->view->assign('cateName',$res->name);
          
        } else {
            //如果当前没有分类ID,就是首页啦
          $this->view->assign('cateName','全部文章');
          $artList = Db::table('zh_article')
                    // ->where('status',1)
                    ->where($map)
                    ->order('create_time','desc')->paginate(4); 
        }

        
        $this->view->assign('empty','<h3>没有文章</h3>'); 
        $this->view->assign('artList', $artList);
        
        //渲染首页模板
        return $this->fetch('index',['title'=>'社区问答']) ;
    }

    //添加文章界面
    public function insert()
    {
    	//1.必须登录才允许发布
    	$this->isLogin();

    	//2.设置页面标题
    	$this->view->assign('title','发布文章');

        //3.获取栏目信息
        $cateList = ArtCate::all();
        // halt($cateList);        
        if (count($cateList)>0) {            
            $this->assign('cateList', $cateList);
        } else {
            $this->error('请先添加栏目','index/index');
        }

    	//3.渲染文章发布界面
    	return $this->view->fetch('insert',['title'=>'发布文章']);
     }

     //保存文章
     public function save()
     {
        if (Request::isPost()){
            //1.获取表单提交的数据
            $data = Request::post();
            // halt($data);
            //2. 对前端表单提交的数据进行验证
            $res = $this->validate($data, 'app\common\validate\Article');
            if (true !== $res) {
                //验证不能过
                echo '<script>alert("'.$res.'")</script>';
    
            } else {
                //验证通过
                //获取上传的标题图片信息
                $file = Request::file('title_img'); //获取file对象
                //文件信息验证与上传到服务器指定目录
                $info = $file -> validate([
                    'size'=>5000000000,  //文件大小
                    'ext'=>'jpeg,jpg,png,gif'  //文件扩展名
                ]) -> move('uploads/');  //移动到public/uploads目录下面
                if ($info) {
                    $data['title_img'] = $info->getSaveName();

                } else {
                    $this->error($file->getError(),'index/index/insert');
                }
                //将数据写到文档表中
                if(Article::create($data)){
                    $this->success('文章发布成功','index/index');
                } else {
                    $this->error('文章保存失败');
                }
                
            }


        } else {
            $this->error('请求类型错误');
        }
     }

    //详情页
    public function detail()
    {
        $artId = Request::param('id');
        $art = Article::get(function($query) use ($artId){
            $query->where('id','=',$artId)->setInc('pv');
        });
        if (!is_null($art)){

            $this->view->assign('art',$art);
        }

        $this->view->assign('title','详情页');
        return $this->view->fetch('detail');
    }




    // 用户收藏
    public function fav()
    {  

        if (!Request::isAjax()){
            return ['status'=>-1, 'message'=>'请求类型错误'];
        }         

        $data = Request::param();
        //1.先查询fav收藏表中是否有这条收藏记录,如果有,表示已收藏过了
        // halt($data);
        // 
        if (empty($data['session_id'])){
            return  ['status'=>-2, 'message'=>'请登录后再收藏'];
        }
        $map[] = ['user_id','=', $data['user_id']];
        $map[] = ['article_id','=', $data['article_id']];

        $fav=Db::table('zh_user_fav')->where($map)->find();
        // halt($fav);
        if (is_null($fav)) {

            Db::table('zh_user_fav')
            ->data([
                'user_id'=>$data['user_id'],
                'article_id'=>$data['article_id']
            ])->insert();
            return ['status'=>1, 'message'=>'收藏成功'];
                  
        }else {
            Db::table('zh_user_fav')->where($map)->delete();
            return ['status'=>0, 'message'=>'已取消'];      
        }

        //思考: 如果验证用户是否登录?
    }
}









