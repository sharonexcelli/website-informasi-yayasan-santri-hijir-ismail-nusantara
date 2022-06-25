<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kta_users_model extends CI_Model
{
    private $DBKTA;
    public function __construct()
    {
        parent::__construct();
        $this->DBKTA = $this->load->database('kta', TRUE);
    }
    public function get_email($email)
    {
        $get = $this->DBKTA
                ->where('email', $email)
                ->limit(1)
                ->get('administrator');

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_email_ex_id($id, $email)
    {
        $get = $this->DBKTA
                ->where('email', $email)
                ->where('id!=', $id)
                ->limit(1)
                ->get('administrator');

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_active_data()
    {
        $get = $this->DBKTA
            ->from('administrator')
            ->where('status','1')
            ->order_by('name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_data($offset = 0, $limit = 20, $filter = null)
    {
        $get = $this->DBKTA
            ->select('id,email, name, image, role, status, created_at, updated_at')
            ->from('administrator')
            ->where('status!=','99')
            ->limit($limit, $offset)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null)
    {
        if(!$filter) {
            return $this->DBKTA
                ->where('status!=','99')
                ->count_all_results('administrator');
        }

        return 0;
    }

    public function save($data){
        return $this->DBKTA
            ->set($data)
            ->insert('administrator');
    }

    public function update($id,$data){
        return $this->DBKTA
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('administrator');
    }

    public function publish($id, $status){
        return $this->DBKTA
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('administrator');
    }

    public function delete($id){
        $data = $this->DBKTA
                    ->where('id', $id)
                    ->limit(1)
                    ->get('administrator')
                    ->row_array();
        return $this->DBKTA
            ->set('status', '99')
            ->set('email', 'deleted-'.strtotime('now').'-'.$data['email'])
            ->where('id', $id)
            ->limit(1)
            ->update('administrator');
    }
}