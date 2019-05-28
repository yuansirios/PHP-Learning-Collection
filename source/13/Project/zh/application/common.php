<?php

// 应用公共文件
use think\Db;

// 根据user_id查询user表,获取用户的姓名
if(!function_exists('getUserName'))
{
    function getUserName($id)
    {
        return Db::table('zh_user')->where(['id'=>$id])->value('name');
    }
}

// 根据cate_id查询zh_article_cate表,获取栏目名称
if(!function_exists('getCateName'))
{
    function getCateName($cateId)
    {
        return Db::table('zh_article_category')->where(['id'=>$cateId])->value('name');
    }
}




