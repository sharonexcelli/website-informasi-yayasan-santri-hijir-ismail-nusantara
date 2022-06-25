<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Management_model extends CI_Model
{
    public function get_active_data()
    {
        $get = $this->db
            ->from('management')
            ->where('status','1')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_faculty()
    {
        $get = $this->db
            ->from('facultys')
            ->order_by('name', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_position($type = null)
    {
        if($type){
            $this->db->where('type',$type);
        }
        $get = $this->db
            ->from('management_position')
            ->order_by('id', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_province()
    {
        $get = $this->db
            ->from('province')
            ->order_by('name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_province_id($id)
    {
        $get = $this->db
            ->from('province')
            ->where('id', $id)
            ->limit(1)
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_id($id)
    {
        $get = $this->db
            ->from('management')
            ->where('status!=','99')
            ->where('id', $id)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null, $sort = null, $pt= null, $p= null, $pp= null)
    {
        if($filter && $filter!=''){
            $this->db->like('a.name', $filter);
        }
        // $s = 'desc';
        // if($sort && $sort!=''){
        //     if($sort == 'A'){
        //         $s = 'asc'; 
        //     }else{
        //         $s = 'desc';
        //     }
        // }
        if($sort && $sort!=''){
            if($sort == '1'){
                $this->db->order_by('a.created_at', 'desc');
            }else if($sort == '2'){
                $this->db->order_by('a.created_at', 'asc');
            }else if($sort == '3'){
                $this->db->order_by('a.name', 'asc');
            }else if($sort == '4') {
                $this->db->order_by('a.name', 'desc');
            }
        }else{
            $this->db->order_by('a.created_at', 'desc');
        }

        if($pt == 1){
            $this->db->where('a.position_central_office!=', '');
            if($p && $p != ''){
                $this->db->where('a.position_central_office', $p);
            }
        } else if( $pt == 2){
            $this->db->where('a.position_regional_office!=','');
            if($p && $p != ''){
                $this->db->where('a.position_regional_office', $p);
            }
            if($pp && $pp != ''){
                $this->db->where('a.province_regional_office', $pp);
            }
        }

        $get = $this->db
            ->select('a.*, b.name as position_central_name, c.name as position_regional_name, d.name as reginal_address_name')
            ->from('management a')
            ->join('management_position b', 'b.id=a.position_central_office', 'left')
            ->join('management_position c', 'c.id=a.position_regional_office', 'left')
            ->join('province d', 'd.id=a.province_regional_office', 'left')
            ->where('a.status!=','99')
            ->limit($limit, $offset)
            // ->order_by('a.created_at', $s)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null, $pt= null, $p= null, $pp= null)
    {
        if($filter && $filter!=''){
            $this->db->like('name', $filter);
        }
        if($pt == 1){
            $this->db->where('position_central_office!=', '');
            if($p && $p != ''){
                $this->db->where('position_central_office', $p);
            }
        } else if( $pt == 2){
            $this->db->where('position_regional_office!=','');
            if($p && $p != ''){
                $this->db->where('position_regional_office', $p);
            }
            if($pp && $pp != ''){
                $this->db->where('province_regional_office', $pp);
            }
        }
        return $this->db
            ->where('status!=','99')
            ->count_all_results('management');

        return 0;
    }

    public function get_total_data_type($type = null)
    {
        if($type == 1) {
            $this->db->where('position_central_office!=', '');
        }
        if($type == 2) {
            $this->db->where('position_regional_office!=', '');
        }
        return $this->db
                ->where('status!=','99')
                ->count_all_results('management');

        return 0;
    }

    public function get_data_publish($offset = 0, $limit = 20, $filter = null, $sort = null, $position = null, $location = null, $type = null)
    {
        if($filter && $filter!=''){
            $this->db->like('a.name', $filter);
        }

        if($type == 'C'){
            $this->db->where('a.position_central_office!=','');
            if($position!=''){
                $this->db->where('a.position_central_office',$position);
            }
            if($sort && $sort!=''){
                if($sort == '' || $sort == 'A'){
                    $this->db->order_by('a.position_central_office');
                    $this->db->order_by('a.name');
                }else{
                    $this->db->order_by('a.position_central_office');
                    $this->db->order_by('a.name', 'desc');
                }
            }else{
                $this->db->order_by('a.position_central_office');
                $this->db->order_by('a.name');
            }
        }else if($type == 'R'){
            $this->db->where('a.position_regional_office!=','');
            if($position!=''){
                $this->db->where('a.position_regional_office',$position);
            }
            if($location!=''){
                $this->db->where('a.province_regional_office',$location);
            }else{
                $this->db->where('a.province_regional_office',31);
            }
            if($sort && $sort!=''){
                if($sort == '' || $sort == 'A'){
                    $this->db->order_by('a.position_regional_office');
                    $this->db->order_by('a.name');
                }else{
                    $this->db->order_by('a.position_regional_office');
                    $this->db->order_by('a.name', 'desc');
                }
            }else{
                $this->db->order_by('a.position_regional_office');
                $this->db->order_by('a.name');
            }
        }

        $get = $this->db
            ->select('a.*, b.name as position_central_name, c.name as position_regional_name, d.name as reginal_address_name')
            ->from('management a')
            ->join('management_position b', 'b.id=a.position_central_office', 'left')
            ->join('management_position c', 'c.id=a.position_regional_office', 'left')
            ->join('province d', 'd.id=a.province_regional_office', 'left')
            ->where('a.status','1')
            ->limit($limit, $offset)
            // ->order_by('a.name', $s)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data_publish($filter = null, $position = null, $location = null, $type = null)
    {
        if($filter && $filter!=''){
            $this->db->like('name', $filter);
        }
        if($type == 'C'){
            $this->db->where('position_central_office!=','');
            if($position!=''){
                $this->db->where('position_central_office',$position);
            }
        }else if($type == 'R'){
            $this->db->where('position_regional_office!=','');
            if($position!=''){
                $this->db->where('position_regional_office',$position);
            }
            if($location!=''){
                $this->db->where('province_regional_office',$location);
            }else{
                $this->db->where('province_regional_office',31);
            }
        }
        return $this->db
            ->where('status!=','99')
            ->count_all_results('management');

        return 0;
    }

    public function save($data){
        return $this->db
            ->set($data)
            ->insert('management');
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('management');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('management');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('management');
    }

    public function get_excel_master($offset = 0, $limit = 20)
    {
        $get = $this->db
            ->select('a.*, b.name as position_central_name, c.name as position_regional_name, d.name as reginal_address_name')
            ->limit($limit, $offset)
            ->from('management a')
            ->join('management_position b', 'b.id=a.position_central_office', 'left')
            ->join('management_position c', 'c.id=a.position_regional_office', 'left')
            ->join('province d', 'd.id=a.province_regional_office', 'left')
            ->order_by('a.name', 'asc')
            ->where('a.status!=','99')
            ->get();
        if($get && $get->num_rows()){
            $data = $get->result_array();
            $excel = [];
            foreach ($data as $key => $value) {
                $excel[$key] = array(
                    'name'          => $value['name'],
                    'phone'         => $value['phone'],
                    'address'       => $value['address'],
                    'position_central_name'     => $value['position_central_name']!=''?$value['position_central_name']:'',
                    'position_regional_name'    => $value['position_regional_name']!=''?$value['position_regional_name']:'',
                    'reginal_address_name'      => $value['reginal_address_name']!=''?$value['reginal_address_name']:'',
                    'created_at'    => date('d F Y', strtotime($value['created_at']))
                );
            }
            return $excel;
        }

        return [];
    }
}