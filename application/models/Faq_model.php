<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_model extends CI_Model
{
    public function get_active_data()
    {
        $get = $this->db
            ->from('qa_subject')
            ->where('type', '3')
            ->where('status','1')
            ->order_by('order', 'asc')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_data_id($id)
    {
        $get = $this->db
            ->from('qa_subject')
            ->where('status!=','99')
            ->where('type', '3')
            ->where('id', $id)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null)
    {
        $get = $this->db
            ->from('qa_subject')
            ->where('status!=','99')
            ->where('type', '3')
            ->limit($limit, $offset)
            ->order_by('order', 'asc')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null)
    {
        if(!$filter) {
            return $this->db
                ->where('status!=','99')
                ->where('type', '3')
                ->count_all_results('qa_subject');
        }

        return 0;
    }

    public function save($data){
        return $this->db
            ->set($data)
            ->insert('qa_subject');
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('qa_subject');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('qa_subject');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('qa_subject');
    }

    // content\
    public function get_active_data_content($id)
    {
        $get = $this->db
            ->from('qa')
            ->where('qa_subject_id', $id)
            ->where('status','1')
            ->order_by('order', 'asc')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }
    public function get_data_content($offset = 0, $limit = 20, $id)
    {
        $get = $this->db
            ->from('qa')
            ->where('qa_subject_id', $id)
            ->where('status!=','99')
            ->limit($limit, $offset)
            ->order_by('order', 'asc')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data_content($id)
    {
        return $this->db
            ->where('qa_subject_id', $id)
            ->where('status!=','99')
            ->count_all_results('qa');

        return 0;
    }

    public function save_content($data){
        return $this->db
            ->set($data)
            ->insert('qa');
    }

    public function publish_content($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('qa');
    }

    public function delete_content($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('qa');
    }

    public function update_content($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('qa');
    }
}