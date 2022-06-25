<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes_model extends CI_Model
{
    public function get_active_data()
    {
        $get = $this->db
            ->from('quotes')
            ->where('status','1')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_active_mark_data()
    {
        $get = $this->db
            ->from('quotes')
            ->where('status','1')
            ->where('mark', '1')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null)
    {
        $get = $this->db
            ->from('quotes')
            ->where('status!=','99')
            ->limit($limit, $offset)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null)
    {
        if(!$filter) {
            return $this->db
                ->where('status!=','99')
                ->count_all_results('quotes');
        }

        return 0;
    }

    public function get_data_publish($offset = 0, $limit = 20, $query = null, $sort= null)
    {
        if($query!=''){
            $this->db->like('name', $query);
        }
        if($sort == '1'){
            $this->db->order_by('created_at', 'desc');
        }else if($sort == '2'){
            $this->db->order_by('created_at', 'asc');
        }else if($sort == '3'){
            $this->db->order_by('name', 'asc');
        }else if($sort == '4') {
            $this->db->order_by('name', 'desc');
        }else{
            $this->db->order_by('created_at', 'asc');
        }
        $get = $this->db
            ->from('quotes')
            ->where('status','1')
            ->limit($limit, $offset)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data_publish($query = null)
    {
        if($query!=''){
            $this->db->like('name', $query);
        }

        return $this->db
            ->where('status','1')
            ->count_all_results('quotes');

        return 0;
    }

    public function get_publish_data_slug($slug)
    {
        $get = $this->db
            ->select('a.*')
            ->from('quotes a')
            // ->join('administrator b', 'b.id=a.id_author')
            ->where('a.status','1')
            ->where('a.slug', $slug)
            ->limit(1)
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_publish_rand($limit, $slug=null)
    {
        if($slug){
            $this->db->where('slug!=', $slug);
        }
        $get = $this->db
            ->from('quotes')
            ->where('status','1')
            ->limit($limit)
            ->order_by('RAND()')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function save($data){
        $this->db
            ->set($data)
            ->insert('quotes');
        return $this->db->insert_id();
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('quotes');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('quotes');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('quotes');
    }

    public function mark($id, $mark){
        return $this->db
            ->set('mark', $mark)
            ->where('id', $id)
            ->limit(1)
            ->update('quotes');
    }
}