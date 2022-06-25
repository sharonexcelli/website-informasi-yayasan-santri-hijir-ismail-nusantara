<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonys_model extends CI_Model
{
    public function get_active_data()
    {
        $get = $this->db
            ->from('testimonys')
            ->where('status','1')
            ->order_by('name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null)
    {
        $get = $this->db
            ->from('testimonys')
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
                ->count_all_results('testimonys');
        }

        return 0;
    }

    public function save($data){
        return $this->db
            ->set($data)
            ->insert('testimonys');
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('testimonys');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('testimonys');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('testimonys');
    }
}