<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model
{
    public function get_active_data($limit=0)
    {
        if($limit!=0){
            $this->db->limit($limit);
        }
        $get = $this->db
            ->from('news')
            ->where('status','1')
            ->where('mark', '1')
            ->limit(3)
            ->order_by('published_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_publish_data_id($id)
    {
        $get = $this->db
            ->select('a.*, b.name as author_name, b.image as author_image')
            ->from('news a')
            ->join('administrator b', 'b.id=a.id_author')
            ->where('a.status','1')
            ->where('a.id', $id)
            ->limit(1)
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_publish_data_slug($slug)
    {
        $get = $this->db
            ->select('a.*, b.name as author_name, b.image as author_image')
            ->from('news a')
            ->join('administrator b', 'b.id=a.id_author')
            ->where('a.status','1')
            ->where('a.slug', $slug)
            ->limit(1)
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null)
    {
        if($filter && $filter!=''){
            $this->db->like('a.title', $filter);
        }
        $get = $this->db
            ->select('a.*, b.name as author_name')
            ->from('news a')
            ->join('administrator b', 'b.id = a.id_author')
            ->where('a.status!=','99')
            ->limit($limit, $offset)
            ->order_by('a.created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null)
    {
        if($filter && $filter!='') {
            $this->db->like('title', $filter);
        }
        return $this->db
            ->where('status!=','99')
            ->count_all_results('news');

        return 0;
    }

    public function get_data_publish_rand($limit, $slug=null)
    {
        if($slug){
            $this->db->where('slug!=', $slug);
        }
        $get = $this->db
            ->from('news')
            ->where('status','1')
            ->limit($limit)
            ->order_by('RAND()')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_data_publish($offset = 0, $limit = 20, $query = null, $sort= null, $tag=null)
    {
        if($query!=''){
            $this->db->like('title', $query);
        }
        if($sort == '1'){
            $this->db->order_by('published_at', 'desc');
        }else if($sort == '2'){
            $this->db->order_by('published_at', 'asc');
        }else if($sort == '3'){
            $this->db->order_by('title', 'asc');
        }else if($sort == '4') {
            $this->db->order_by('title', 'desc');
        }else{
            $this->db->order_by('published_at', 'desc');
        }
        if($tag!= ''){
            $this->db->like('tags', $tag);
        }
        $get = $this->db
            ->from('news')
            ->where('status','1')
            ->limit($limit, $offset)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data_publish($query = null, $tag=null)
    {
        if($query!=''){
            $this->db->like('title', $query);
        }
        if($tag!= ''){
            $this->db->like('tags', $tag);
        }

        return $this->db
            ->where('status','1')
            ->count_all_results('news');

        return 0;
    }

    public function save($data){
        $data['id_author'] = $this->session->userdata('admin')->id;
        $this->db
            ->set($data)
            ->insert('news');
        return $this->db->insert_id();
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('news');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('news');
    }

    public function mark($id, $mark){
        return $this->db
            ->set('mark', $mark)
            ->where('id', $id)
            ->limit(1)
            ->update('news');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('news');
    }
}