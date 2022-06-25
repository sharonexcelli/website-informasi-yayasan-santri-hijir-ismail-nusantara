<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni_model extends CI_Model
{
    public function get_active_data()
    {
        $get = $this->db
            ->from('alumni')
            ->where('status','1')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_majors()
    {
        $get = $this->db
            ->select('a.*, b.name as faculty_name, b.name_nick as faculty_name_nick')
            ->from('majors a')
            ->join('facultys b', 'b.id=a.faculty_id')
            ->order_by('a.name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_faculty()
    {
        $get = $this->db
            ->from('facultys')
            ->order_by('name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_district()
    {
        $get = $this->db
            ->select('a.*, b.name as province_name, CONCAT(a.name ," - ", b.name) as full_name')
            ->from('districts a')
            ->join('province b', 'b.id = a.id_province')
            ->order_by('a.name', 'asc')
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

    public function get_data_id($id)
    {
        $get = $this->db
            ->from('alumni')
            ->where('status!=','99')
            ->where('id', $id)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null, $sort = null, $faculty= null, $angkatan= null, $graduation=null, $province=null, $district=null)
    {
        if($filter && $filter!=''){
            $this->db->or_like('a.name', $filter);
            $this->db->or_like('a.name_full', $filter);
            $this->db->or_like('a.no_kta', $filter);
        }
        // $s = 'desc';
        if($sort && $sort!=''){
            if($sort == '1'){
                $this->db->order_by('a.created_at', 'desc');
            }else if($sort == '2'){
                $this->db->order_by('a.created_at', 'asc');
            }else if($sort == '3'){
                $this->db->order_by('a.name_full', 'asc');
            }else if($sort == '4') {
                $this->db->order_by('a.name_full', 'desc');
            }
        }else{
            $this->db->order_by('a.created_at', 'desc');
        }

        if($faculty != ''){
            $this->db->where('c.id', $faculty);
        }

        if($angkatan != ''){
            $this->db->where('a.angkatan', $angkatan);
        }
        if($graduation != ''){
            $this->db->where('a.graduation', $graduation);
        }
        if($district != ''){
            $this->db->where('d.id', $district);
        }
        if($province != ''){
            $this->db->where('e.id', $province);
        }

        $get = $this->db
            ->select('a.*, b.name as major_name, c.name as faculty_name, CONCAT(d.name ," - ", e.name) as address_full')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id')
            ->join('facultys c','b.faculty_id=c.id')
            ->join('districts d','d.id = a.district')
            ->join('province e', 'e.id = d.id_province')
            ->where('a.status!=','99')
            ->limit($limit, $offset)
            // ->order_by('a.created_at', $s)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null, $faculty= null, $angkatan= null, $graduation=null, $province=null, $district=null)
    {
        if($filter && $filter!=''){
            $this->db->or_like('a.name', $filter);
            $this->db->or_like('a.name_full', $filter);
            $this->db->or_like('a.no_kta', $filter);
        }
        if($faculty != ''){
            $this->db->where('c.id', $faculty);
        }

        if($angkatan != ''){
            $this->db->where('a.angkatan', $angkatan);
        }
        if($graduation != ''){
            $this->db->where('a.graduation', $graduation);
        }
        if($district != ''){
            $this->db->where('d.id', $district);
        }
        if($province != ''){
            $this->db->where('e.id', $province);
        }
        return $this->db
            ->join('majors b','a.major_id=b.id')
            ->join('facultys c','b.faculty_id=c.id')
            ->join('districts d','d.id = a.district')
            ->join('province e', 'e.id = d.id_province')
            ->where('a.status!=','99')
            ->count_all_results('alumni a');

        return 0;
    }

    public function save($data){
        return $this->db
            ->set($data)
            ->insert('alumni');
    }

    public function update($id,$data){
        return $this->db
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('alumni');
    }

    public function publish($id, $status){
        return $this->db
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('alumni');
    }

    public function delete($id){
        return $this->db
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('alumni');
    }

    public function get_excel_master($offset = 0, $limit = 20)
    {
        $get = $this->db
            ->select('a.*, b.name as major_name, c.name as faculty_name, d.name as district_name, e.name as province_name')
            ->limit($limit, $offset)
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id')
            ->join('facultys c','b.faculty_id=c.id')
            ->join('districts d','d.id = a.district')
            ->join('province e', 'e.id = d.id_province')
            ->order_by('a.name', 'asc')
            ->where('a.status!=','99')
            ->get();
        if($get && $get->num_rows()){
            $data = $get->result_array();
            $excel = [];
            foreach ($data as $key => $value) {
                $excel[$key] = array(
                    'name'          => $value['name'],
                    'name_full'     => $value['name_full'],
                    'birth_place'   => $value['birth_place'],
                    'birth_date'    => date('d/m/Y', strtotime($value['birth_date'])),
                    'email'         => $value['email'],
                    'phone'         => $value['phone'],
                    'gender'        => $value['gender']=='1'?'Man':'Women',
                    'address'       => $value['address'],
                    'district_name' => $value['district_name'],
                    'province_name' => $value['province_name'],
                    'angkatan'      => $value['angkatan'],
                    'graduation'    => $value['graduation'],
                    'major'         => $value['major_name'],
                    'faculty'       => $value['faculty_name'],
                    'profession'    => $value['profession'],
                    'profession_address'    => $value['profession_address'],
                    'no_kta'        => $value['no_kta'],
                    'contemporary_name'     => $value['contemporary_name'],
                    'avatar'        => $value['image'],
                    'ktp'           => $value['image_ktp'],
                    'certificate'   => $value['image_certificate_graduation'],
                    'npwp_image'    => $value['npwp_image'],
                    'payment_image' => $value['payment_image'],
                    'created_at'    => date('d F Y', strtotime($value['created_at']))
                );
            }
            return $excel;
        }

        return [];
    }
}
