<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banners_model extends CI_Model
{
    public function get_active_data($type)
    {
        $get = $this->db
            ->from('banners')
            ->where('status','1')
            ->where('type', $type)
            ->order_by('updated_at', 'desc')
            ->limit(1)
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null)
    {
        $get = $this->db
            ->from('banners')
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
                ->count_all_results('banners');
        }

        return 0;
    }

    public function save($data){
        return $this->db
            ->set($data)
            ->insert('banners');
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('banners');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('banners');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('banners');
    }
}