<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallerys_model extends CI_Model
{
    public function get_active_data()
    {
        $get = $this->db
            ->from('gallerys')
            ->where('status','1')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null)
    {
        if($filter && $filter!=''){
            $this->db->like('title', $filter);
        }
        $get = $this->db
            ->from('gallerys')
            ->where('status!=','99')
            ->limit($limit, $offset)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null, $type= null)
    {
        if($filter && $filter!=''){
            $this->db->like('title', $filter);
        }
        if($type && $type!=''){
            $this->db->where('type', $type);
        }

        return $this->db
            ->where('status!=','99')
            ->count_all_results('gallerys');

        return 0;
    }

    public function get_data_publish($offset = 0, $limit = 20, $type = null)
    {
        if($type == 'P'){
            $this->db->where('type', 'P');
        } else if($type == 'V'){
            $this->db->where('type', 'V');
        }
        $get = $this->db
            ->from('gallerys')
            ->where('status','1')
            ->limit($limit, $offset)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data_publish($type = null)
    {
        if($type == 'P'){
            $this->db->where('type', 'P');
        } else if($type == 'V'){
            $this->db->where('type', 'V');
        }

        return $this->db
            ->where('status','1')
            ->count_all_results('gallerys');

        return 0;
    }

    public function save($data){
        $this->db
            ->set($data)
            ->insert('gallerys');
        return $this->db->insert_id();
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('gallerys');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('gallerys');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('gallerys');
    }
}