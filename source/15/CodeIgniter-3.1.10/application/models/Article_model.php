<?php

class Article_model extends CI_Model{
    public function detail($id)
    {
        //加载数据库的分组配置
        $this->load->database('default');
        //选择表
        $this->db->from('article');
        //查询字段
        $this->db->select('id,title,contents');
        //指定查询条件
        $this->db->where(array('id'=>$id));
        //获取查询结果
        $query = $this->db->get();
        return $query->row_array();      //单条
        // return $query->result_array();   //多条
        // return $query->result();         //多个对象
        // return $query->row();            //单个对象
    }
}