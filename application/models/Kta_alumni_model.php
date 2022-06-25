<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kta_alumni_model extends CI_Model
{
    private $DBKTA;
    public function __construct()
    {
        parent::__construct();
        $this->DBKTA = $this->load->database('kta', TRUE);
    }
    public function get_active_data()
    {
        $get = $this->DBKTA
            ->from('alumni')
            ->where('status','1')
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_majors()
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as faculty_name, b.name_nick as faculty_name_nick')
            ->from('majors a')
            ->join('facultys b', 'b.id=a.faculty_id')
            ->order_by('a.name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_faculty()
    {
        $get = $this->DBKTA
            ->from('facultys')
            ->order_by('name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_district()
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as province_name, CONCAT(a.name ," - ", b.name) as full_name')
            ->from('districts a')
            ->join('province b', 'b.id = a.id_province')
            ->order_by('a.name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_province()
    {
        $get = $this->DBKTA
            ->from('province')
            ->order_by('name', 'asc')
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_data_id($id)
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as major_name, c.name as faculty_name, c.name_nick as faculty_name_nick')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->where('a.status!=','99')
            ->where('a.id', $id)
            ->limit(1)
            ->order_by('a.created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_email($email)
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as major_name, c.name as faculty_name, c.name_nick as faculty_name_nick')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->where('a.status!=','99')
            ->where('a.email', $email)
            ->limit(1)
            ->order_by('a.created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_last()
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as major_name, c.name as faculty_name, c.name_nick as faculty_name_nick')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->limit(1)
            ->where('no_kta_serial!=','')
            ->order_by('a.no_kta_serial', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_email_otp($email, $otp)
    {
        $get = $this->DBKTA
            ->from('alumni')
            ->where('status!=','99')
            ->where('email', $email)
            ->where('otp_code', $otp)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_email_key($email, $key)
    {
        $get = $this->DBKTA
            ->from('alumni')
            ->where('status!=','99')
            ->where('email', $email)
            ->where('private_key', $key)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_check_uniq($email='', $phone='', $ktp='', $serial='', $kta='',$reference='', $va='')
    {
        $this->DBKTA->or_group_start();
        if($email!=''){
            $this->DBKTA->or_where('email', $email);
        }
        if($phone!=''){
            $this->DBKTA->or_where('phone', $phone);
        }

        if($ktp!=''){
            $this->DBKTA->or_where('no_ktp', $ktp);
        }

        if($serial!=''){
            $this->DBKTA->or_where('no_kta_serial', $serial);
        }

        if($kta!=''){
            $this->DBKTA->or_where('no_kta', $kta);
        }

        if($reference!=''){
            $this->DBKTA->or_where('no_reference', $reference);
        }

        if($va!=''){
            $this->DBKTA->or_where('no_va', $va);
        }
        $this->DBKTA->group_end();


        $get = $this->DBKTA
            ->from('alumni')
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_check_uniqe($email='', $phone='', $ktp='', $serial='', $kta='',$reference='', $va='')
    {
        $this->DBKTA->or_group_start();
        if($phone!=''){
            $this->DBKTA->or_where('phone', $phone);
        }

        if($ktp!=''){
            $this->DBKTA->or_where('no_ktp', $ktp);
        }

        if($serial!=''){
            $this->DBKTA->or_where('no_kta_serial', $serial);
        }

        if($kta!=''){
            $this->DBKTA->or_where('no_kta', $kta);
        }

        if($reference!=''){
            $this->DBKTA->or_where('no_reference', $reference);
        }

        if($va!=''){
            $this->DBKTA->or_where('no_va', $va);
        }
        $this->DBKTA->group_end();


        $get = $this->DBKTA
            ->from('alumni')
            ->where('email!=', $email)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_check_uniqid($id='', $phone='', $ktp='', $serial='', $kta='',$reference='', $va='')
    {
        $this->DBKTA->or_group_start();
        if($phone!=''){
            $this->DBKTA->or_where('phone', $phone);
        }

        if($ktp!=''){
            $this->DBKTA->or_where('no_ktp', $ktp);
        }

        if($serial!=''){
            $this->DBKTA->or_where('no_kta_serial', $serial);
        }

        if($kta!=''){
            $this->DBKTA->or_where('no_kta', $kta);
        }

        if($reference!=''){
            $this->DBKTA->or_where('no_reference', $reference);
        }

        if($va!=''){
            $this->DBKTA->or_where('no_va', $va);
        }
        $this->DBKTA->group_end();


        $get = $this->DBKTA
            ->from('alumni')
            ->where('id!=', $id)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    public function get_data_check_uniqid2($id='', $email='', $phone='', $ktp='', $serial='', $kta='',$reference='', $va='')
    {
        $this->DBKTA->or_group_start();
        if($email!=''){
            $this->DBKTA->or_where('email', $email);
        }
        if($phone!=''){
            $this->DBKTA->or_where('phone', $phone);
        }

        if($ktp!=''){
            $this->DBKTA->or_where('no_ktp', $ktp);
        }

        if($serial!=''){
            $this->DBKTA->or_where('no_kta_serial', $serial);
        }

        if($kta!=''){
            $this->DBKTA->or_where('no_kta', $kta);
        }

        if($reference!=''){
            $this->DBKTA->or_where('no_reference', $reference);
        }

        if($va!=''){
            $this->DBKTA->or_where('no_va', $va);
        }
        $this->DBKTA->group_end();


        $get = $this->DBKTA
            ->from('alumni')
            ->where('id!=', $id)
            ->limit(1)
            ->order_by('created_at', 'desc')
            ->get();

        return ($get && $get->num_rows()) ? $get->row_array() : null;
    }

    
    public function get_data($offset = 0, $limit = 20, $filter = null, $sort = null, $faculty= null, $angkatan= null, $graduation=null, $province=null, $district=null, $status=null)
    {
        if($filter && $filter!=''){
            $this->DBKTA->or_like('a.name', $filter);
            $this->DBKTA->or_like('a.name_full', $filter);
            $this->DBKTA->or_like('a.no_kta', $filter);
            $this->DBKTA->or_like('a.no_va', $filter);
            $this->DBKTA->or_like('a.no_reference', $filter);
        }
        // $s = 'desc';
        if($sort && $sort!=''){
            if($sort == '1'){
                $this->DBKTA->order_by('a.created_at', 'desc');
            }else if($sort == '2'){
                $this->DBKTA->order_by('a.created_at', 'asc');
            }else if($sort == '3'){
                $this->DBKTA->order_by('a.name_full', 'asc');
            }else if($sort == '4') {
                $this->DBKTA->order_by('a.name_full', 'desc');
            }
        }else{
            $this->DBKTA->order_by('a.created_at', 'desc');
        }

        if($faculty != ''){
            $this->DBKTA->where('c.id', $faculty);
        }

        if($angkatan != ''){
            $this->DBKTA->where('a.angkatan', $angkatan);
        }
        if($graduation != ''){
            $this->DBKTA->where('a.graduation', $graduation);
        }
        if($district != ''){
            $this->DBKTA->where('d.id', $district);
        }
        if($province != ''){
            $this->DBKTA->where('e.id', $province);
        }
        if($status != ''){
            $this->DBKTA->where('a.status', $status);
        }else{
            $this->DBKTA->where('a.status>', '0');
        }

        $get = $this->DBKTA
            ->select('a.*, (case when a.status = "0" then "E-Mail Belum Terverifikasi" when a.status = "5" then "E-Mail Sudah Terverifikasi" when a.status = "10" then "Data Diri" when a.status = "15" then "Data Alumni" when a.status = "20" then "Upload File" when a.status = "25" then "Data Bank" when a.status = "30" then "Submit Data" when a.status = "35" then "Menunggu Pembayaran" when a.status = "40" then "Pembayaran Sukses" when a.status = "45" then "Pengajuan KTA selesai" else "Terhapus" end) as status_name, b.name as major_name, c.name as faculty_name, CONCAT(d.name ," - ", e.name) as address_full')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->join('districts d','d.id = a.district', 'left')
            ->join('province e', 'e.id = d.id_province', 'left')
            ->where('a.status!=','99')
            // ->where('a.status>','0')
            ->where('a.alumni_type','1')
            ->limit($limit, $offset)
            // ->order_by('a.created_at', $s)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data($filter = null, $faculty= null, $angkatan= null, $graduation=null, $province=null, $district=null, $status=null)
    {
        if($filter && $filter!=''){
            $this->DBKTA->or_like('a.name', $filter);
            $this->DBKTA->or_like('a.name_full', $filter);
            $this->DBKTA->or_like('a.no_kta', $filter);
            $this->DBKTA->or_like('a.no_va', $filter);
            $this->DBKTA->or_like('a.no_reference', $filter);
        }
        if($faculty != ''){
            $this->DBKTA->where('c.id', $faculty);
        }

        if($angkatan != ''){
            $this->DBKTA->where('a.angkatan', $angkatan);
        }
        if($graduation != ''){
            $this->DBKTA->where('a.graduation', $graduation);
        }
        if($district != ''){
            $this->DBKTA->where('d.id', $district);
        }
        if($province != ''){
            $this->DBKTA->where('e.id', $province);
        }
        if($status != ''){
            $this->DBKTA->where('a.status', $status);
        }else{
            $this->DBKTA->where('a.status>', '0');
        }
        
        return $this->DBKTA
            // ->join('majors b','a.major_id=b.id')
            // ->join('facultys c','b.faculty_id=c.id')
            // ->join('districts d','d.id = a.district')
            // ->join('province e', 'e.id = d.id_province')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->join('districts d','d.id = a.district', 'left')
            ->join('province e', 'e.id = d.id_province', 'left')
            ->where('a.alumni_type','1')
            ->where('a.status<','99')
            // ->where('a.status>','0')
            ->count_all_results('alumni a');

        return 0;
    }

    public function get_data_paid($offset = 0, $limit = 20, $filter = null, $sort = null, $faculty= null, $angkatan= null, $graduation=null, $province=null, $district=null)
    {
        if($filter && $filter!=''){
            $this->DBKTA->or_like('a.name', $filter);
            $this->DBKTA->or_like('a.name_full', $filter);
            $this->DBKTA->or_like('a.no_kta', $filter);
            $this->DBKTA->or_like('a.no_va', $filter);
            $this->DBKTA->or_like('a.no_reference', $filter);
        }
        // $s = 'desc';
        if($sort && $sort!=''){
            if($sort == '1'){
                $this->DBKTA->order_by('a.created_at', 'desc');
            }else if($sort == '2'){
                $this->DBKTA->order_by('a.created_at', 'asc');
            }else if($sort == '3'){
                $this->DBKTA->order_by('a.name_full', 'asc');
            }else if($sort == '4') {
                $this->DBKTA->order_by('a.name_full', 'desc');
            }
        }else{
            $this->DBKTA->order_by('a.created_at', 'desc');
        }

        if($faculty != ''){
            $this->DBKTA->where('c.id', $faculty);
        }

        if($angkatan != ''){
            $this->DBKTA->where('a.angkatan', $angkatan);
        }
        if($graduation != ''){
            $this->DBKTA->where('a.graduation', $graduation);
        }
        if($district != ''){
            $this->DBKTA->where('d.id', $district);
        }
        if($province != ''){
            $this->DBKTA->where('e.id', $province);
        }

        $get = $this->DBKTA
            ->select('a.*, (case when a.status = "0" then "E-Mail Belum Terverifikasi" when a.status = "5" then "E-Mail Sudah Terverifikasi" when a.status = "10" then "Data Diri" when a.status = "15" then "Data Alumni" when a.status = "20" then "Upload File" when a.status = "25" then "Data Bank" when a.status = "30" then "Submit Data" when a.status = "35" then "Menunggu Pembayaran" when a.status = "40" then "Pembayaran Sukses" when a.status = "45" then "Pengajuan KTA selesai" else "Terhapus" end) as status_name, b.name as major_name, c.name as faculty_name, CONCAT(d.name ," - ", e.name) as address_full')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->join('districts d','d.id = a.district', 'left')
            ->join('province e', 'e.id = d.id_province', 'left')
            ->where('a.status<=','40')
            ->where('a.status>=','45')
            ->limit($limit, $offset)
            // ->order_by('a.created_at', $s)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_data_request($offset = 0, $limit = 20, $filter = null, $sort = null)
    {
        if($filter && $filter!=''){
            $this->DBKTA->or_like('a.name', $filter);
            $this->DBKTA->or_like('a.name_full', $filter);
            $this->DBKTA->or_like('a.no_kta', $filter);
            $this->DBKTA->or_like('a.no_va', $filter);
            $this->DBKTA->or_like('a.no_reference', $filter);
        }
        // $s = 'desc';
        if($sort && $sort!=''){
            if($sort == '1'){
                $this->DBKTA->order_by('a.created_at', 'desc');
            }else if($sort == '2'){
                $this->DBKTA->order_by('a.created_at', 'asc');
            }else if($sort == '3'){
                $this->DBKTA->order_by('a.name_full', 'asc');
            }else if($sort == '4') {
                $this->DBKTA->order_by('a.name_full', 'desc');
            }
        }else{
            $this->DBKTA->order_by('a.created_at', 'desc');
        }

        $get = $this->DBKTA
            ->select('a.*, (case when a.status = "0" then "E-Mail Belum Terverifikasi" when a.status = "5" then "E-Mail Sudah Terverifikasi" when a.status = "10" then "Data Diri" when a.status = "15" then "Data Alumni" when a.status = "20" then "Upload File" when a.status = "25" then "Data Bank" when a.status = "30" then "Submit Data" when a.status = "35" then "Menunggu Pembayaran" when a.status = "40" then "Pembayaran Sukses" when a.status = "45" then "Pengajuan KTA selesai" else "Terhapus" end) as status_name, b.name as major_name, c.name as faculty_name, CONCAT(d.name ," - ", e.name) as address_full')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->join('districts d','d.id = a.district', 'left')
            ->join('province e', 'e.id = d.id_province', 'left')
            ->where('a.status','30')
            ->limit($limit, $offset)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data_request($filter = null)
    {
        if($filter && $filter!=''){
            $this->DBKTA->or_like('a.name', $filter);
            $this->DBKTA->or_like('a.name_full', $filter);
            $this->DBKTA->or_like('a.no_kta', $filter);
            $this->DBKTA->or_like('a.no_va', $filter);
            $this->DBKTA->or_like('a.no_reference', $filter);
        }

        return $this->DBKTA
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->join('districts d','d.id = a.district', 'left')
            ->join('province e', 'e.id = d.id_province', 'left')
            ->where('a.status','30')
            ->count_all_results('alumni a');

        return 0;
    }

    public function get_data_result($offset = 0, $limit = 20, $filter = null, $sort = null, $faculty= null, $angkatan= null, $graduation=null, $province=null, $district=null, $alumni_type=null)
    {
        if($filter && $filter!=''){
            $this->DBKTA->or_like('a.name', $filter);
            $this->DBKTA->or_like('a.name_full', $filter);
            $this->DBKTA->or_like('a.no_kta', $filter);
            $this->DBKTA->or_like('a.no_va', $filter);
            $this->DBKTA->or_like('a.no_reference', $filter);
        }
        // $s = 'desc';
        if($sort && $sort!=''){
            if($sort == '1'){
                $this->DBKTA->order_by('a.created_at', 'desc');
            }else if($sort == '2'){
                $this->DBKTA->order_by('a.created_at', 'asc');
            }else if($sort == '3'){
                $this->DBKTA->order_by('a.name_full', 'asc');
            }else if($sort == '4') {
                $this->DBKTA->order_by('a.name_full', 'desc');
            }
        }else{
            $this->DBKTA->order_by('a.created_at', 'desc');
        }

        if($faculty != ''){
            $this->DBKTA->where('c.id', $faculty);
        }

        if($angkatan != ''){
            $this->DBKTA->where('a.angkatan', $angkatan);
        }
        if($graduation != ''){
            $this->DBKTA->where('a.graduation', $graduation);
        }
        if($district != ''){
            $this->DBKTA->where('d.id', $district);
        }
        if($province != ''){
            $this->DBKTA->where('e.id', $province);
        }
        if($alumni_type != ''){
            $this->DBKTA->where('a.alumni_type', $alumni_type);
        }

        $get = $this->DBKTA
            ->select('a.*, (case when a.status = "0" then "E-Mail Belum Terverifikasi" when a.status = "5" then "E-Mail Sudah Terverifikasi" when a.status = "10" then "Data Diri" when a.status = "15" then "Data Alumni" when a.status = "20" then "Upload File" when a.status = "25" then "Data Bank" when a.status = "30" then "Submit Data" when a.status = "35" then "Menunggu Pembayaran" when a.status = "40" then "Pembayaran Sukses" when a.status = "45" then "Pengajuan KTA selesai" else "Terhapus" end) as status_name, b.name as major_name, c.name as faculty_name, CONCAT(d.name ," - ", e.name) as address_full')
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->join('districts d','d.id = a.district', 'left')
            ->join('province e', 'e.id = d.id_province', 'left')
            ->where('a.status','45')
            ->limit($limit, $offset)
            // ->order_by('a.created_at', $s)
            ->get();

        return ($get && $get->num_rows()) ? $get->result_array() : null;
    }

    public function get_total_data_result($filter = null, $faculty= null, $angkatan= null, $graduation=null, $province=null, $district=null, $alumni_type=null)
    {
        if($filter && $filter!=''){
            $this->DBKTA->or_like('a.name', $filter);
            $this->DBKTA->or_like('a.name_full', $filter);
            $this->DBKTA->or_like('a.no_kta', $filter);
            $this->DBKTA->or_like('a.no_va', $filter);
            $this->DBKTA->or_like('a.no_reference', $filter);
        }
        if($faculty != ''){
            $this->DBKTA->where('c.id', $faculty);
        }

        if($angkatan != ''){
            $this->DBKTA->where('a.angkatan', $angkatan);
        }
        if($graduation != ''){
            $this->DBKTA->where('a.graduation', $graduation);
        }
        if($district != ''){
            $this->DBKTA->where('d.id', $district);
        }
        if($province != ''){
            $this->DBKTA->where('e.id', $province);
        }
        if($alumni_type != ''){
            $this->DBKTA->where('a.alumni_type', $alumni_type);
        }
        return $this->DBKTA
            ->join('majors b','a.major_id=b.id', 'left')
            ->join('facultys c','b.faculty_id=c.id', 'left')
            ->join('districts d','d.id = a.district', 'left')
            ->join('province e', 'e.id = d.id_province', 'left')
            ->where('a.status','45')
            ->count_all_results('alumni a');

        return 0;
    }

    public function get_total_dash($status='')
    {
        if($status==1){
            $this->DBKTA
                ->where('alumni_type','1')
                ->where('status>=','40')
                ->where('status<=','45');
        }else if($status == 2){
            $this->DBKTA
                ->where('status','35');
        }else if($status == 3){
            $this->DBKTA
                ->where('status','45');
        }else{
            $this->DBKTA
                ->where('alumni_type','1')
                ->where('status!=','99')
                ->where('status!=','0');
        }
        
        return $this->DBKTA
            ->count_all_results('alumni a');

        return 0;
    }

    public function get_total_income($status='')
    {
        if($status==1){
            $this->DBKTA
                ->where('MONTH(created_at)=MONTH(NOW())')
                ->where('alumni_type','1')
                ->where('status>=','40')
                ->where('status<=','45');
        }else{
            $this->DBKTA
                ->where('alumni_type','1')
                ->where('status>=','40')
                ->where('status<=','45');
        }
        
        $total= $this->DBKTA
            ->count_all_results('alumni');
        return $total * 200000;

        return 0;
    }

    public function get_data_chart()
    {
        $data = array(
            'total' => array(),
            'month' => array()
        );
        for ($i=-5; $i <1 ; $i++) {
            array_push($data['month'], date("M Y", strtotime($i."month")));
            array_push($data['total'], $this->DBKTA
                ->where('MONTH(created_at)', date("n", strtotime($i."month")))
                ->where('alumni_type','1')
                ->where('status!=','99')
                ->count_all_results('alumni a'));
        }
        return $data;

    }

    public function save($data){
        return $this->DBKTA
            ->set($data)
            ->insert('alumni');
    }

    public function update($id,$data){
        return $this->DBKTA
            ->set($data)
            ->where('id',$id)
            ->limit(1)
            ->update('alumni');
    }

    public function update_email($email,$data){
        return $this->DBKTA
            ->set($data)
            ->where('email',$email)
            ->limit(1)
            ->update('alumni');
    }

    public function publish($id, $status){
        return $this->DBKTA
            ->set('status', $status)
            ->where('id', $id)
            ->limit(1)
            ->update('alumni');
    }

    public function delete($id){
        return $this->DBKTA
            ->set('status', '99')
            ->where('id', $id)
            ->limit(1)
            ->update('alumni');
    }

    public function get_excel_master($offset = 0, $limit = 20)
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as major_name, c.name as faculty_name, d.name as district_name, e.name as province_name')
            ->limit($limit, $offset)
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id')
            ->join('facultys c','b.faculty_id=c.id')
            ->join('districts d','d.id = a.district')
            ->join('province e', 'e.id = d.id_province')
            ->order_by('a.name', 'asc')
            ->where('a.status<','99')
            ->where('a.status>','0')
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
                    'no_ktp'        => $value['no_ktp'],
                    'address'       => $value['address'],
                    'mother_name'   => $value['mother_name'],
                    'district_name' => $value['district_name'],
                    'province_name' => $value['province_name'],
                    'angkatan'      => $value['angkatan'],
                    'graduation'    => $value['graduation'],
                    'major'         => $value['major_name'],
                    'faculty'       => $value['faculty_name'],
                    'profession'    => $value['profession'],
                    'current_address'   => $value['current_address'],
                    'contemporary_name' => $value['contemporary_name'],
                    'no_kta'        => $value['no_kta'],
                    'no_reference'  => $value['no_reference'],
                    'account_type'  => $value['account_type']=='1'?'New Account':'Upgrade Account',
                    'avatar'        => $value['image'],
                    'ktp'           => $value['image_ktp'],
                    'certificate'   => $value['image_certificate_graduation'],
                    'npwp_image'    => $value['npwp_image'],
                    'npwp_image'    => $value['npwp_image'],
                    'created_at'    => date('d F Y', strtotime($value['created_at']))
                );
            }
            return $excel;
        }

        return [];
    }

    public function get_excel_master_result($offset = 0, $limit = 20)
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as major_name, c.name as faculty_name, d.name as district_name, e.name as province_name')
            ->limit($limit, $offset)
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id')
            ->join('facultys c','b.faculty_id=c.id')
            ->join('districts d','d.id = a.district')
            ->join('province e', 'e.id = d.id_province')
            ->order_by('a.name', 'asc')
            ->where('a.status','45')
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
                    'no_ktp'        => $value['no_ktp'],
                    'address'       => $value['address'],
                    'mother_name'   => $value['mother_name'],
                    'district_name' => $value['district_name'],
                    'province_name' => $value['province_name'],
                    'angkatan'      => $value['angkatan'],
                    'graduation'    => $value['graduation'],
                    'major'         => $value['major_name'],
                    'faculty'       => $value['faculty_name'],
                    'profession'    => $value['profession'],
                    'current_address'   => $value['current_address'],
                    'contemporary_name' => $value['contemporary_name'],
                    'no_kta'        => $value['no_kta'],
                    'no_reference'  => $value['no_reference'],
                    'account_type'  => $value['account_type']=='1'?'New Account':'Upgrade Account',
                    'avatar'        => $value['image'],
                    'ktp'           => $value['image_ktp'],
                    'certificate'   => $value['image_certificate_graduation'],
                    'npwp_image'    => $value['npwp_image'],
                    'npwp_image'    => $value['npwp_image'],
                    'created_at'    => date('d F Y', strtotime($value['created_at']))
                );
            }
            return $excel;
        }

        return [];
    }

    public function get_excel_master_va($offset = 0, $limit = 20)
    {
        $get = $this->DBKTA
            ->select('a.*, b.name as major_name, c.name as faculty_name, d.name as district_name, e.name as province_name')
            ->limit($limit, $offset)
            ->from('alumni a')
            ->join('majors b','a.major_id=b.id')
            ->join('facultys c','b.faculty_id=c.id')
            ->join('districts d','d.id = a.district')
            ->join('province e', 'e.id = d.id_province')
            ->order_by('a.name', 'asc')
            ->where('a.status','30')
            ->get();
        if($get && $get->num_rows()){
            $data = $get->result_array();
            $excel = [];
            $dstart = date("Ymd", strtotime("+1 day"));
            $dend = date("Ymd", strtotime("+31 day"));
            foreach ($data as $key => $value) {
                $excel[$key] = array(
                    'no_va'          => __VA_IKA_UII__.$value['no_va'],
                    // 'no_va'         => $value['no_va'],
                    'key1'          => '',
                    'key2'          => '',
                    'ccy'           => 'IDR',
                    'nama'          => substr($value['name_full'],0,40),
                    'fakultas'      => substr($value['faculty_name'],0,40),
                    'tahun_masuk'   => $value['angkatan'],
                    // 'nom_tghn'      => 200000,
                    'B_INFO04'      => '',
                    'B_INFO05'      => '',
                    'B_INFO06'      => '',
                    'B_INFO07'      => '',
                    'B_INFO08'      => '',
                    'B_INFO09'      => '',
                    'B_INFO010'     => '',
                    'B_INFO011'     => '',
                    'B_INFO012'     => '',
                    'B_INFO013'     => '',
                    'B_INFO014'     => '',
                    'B_INFO015'     => '',
                    'B_INFO016'     => '',
                    'B_INFO017'     => '',
                    'B_INFO018'     => '',
                    'B_INFO019'     => '',
                    'B_INFO020'     => '',
                    'B_INFO021'     => '',
                    'B_INFO022'     => '',
                    'B_INFO023'     => '',
                    'B_INFO024'     => '',
                    'B_INFO025'     => '',
                    'PERIOD_OPEN'   => $dstart,
                    'PERIOD_CLOSE'  => $dend,
                    'SUBBILL_01'    => "01\\KTABILL\\TAGIHANKTA\\200000",
                    'SUBBILL_02'    => "\\\\\\",
                    'SUBBILL_03'    => "\\\\\\",
                    'SUBBILL_04'    => "\\\\\\",
                    'SUBBILL_05'    => "\\\\\\",
                    'SUBBILL_06'    => "\\\\\\",
                    'SUBBILL_07'    => "\\\\\\",
                    'SUBBILL_08'    => "\\\\\\",
                    'SUBBILL_09'    => "\\\\\\",
                    'SUBBILL_10'    => "\\\\\\",
                    'SUBBILL_11'    => "\\\\\\",
                    'SUBBILL_12'    => "\\\\\\",
                    'SUBBILL_13'    => "\\\\\\",
                    'SUBBILL_14'    => "\\\\\\",
                    'SUBBILL_15'    => "\\\\\\",
                    'SUBBILL_16'    => "\\\\\\",
                    'SUBBILL_17'    => "\\\\\\",
                    'SUBBILL_18'    => "\\\\\\",
                    'SUBBILL_19'    => "\\\\\\",
                    'SUBBILL_20'    => "\\\\\\",
                    'SUBBILL_21'    => "\\\\\\",
                    'SUBBILL_22'    => "\\\\\\",
                    'SUBBILL_23'    => "\\\\\\",
                    'SUBBILL_24'    => "\\\\\\",
                    'SUBBILL_25'    => "\\\\\\",
                    'END_RECORD'    => '-'
                );
            }
            return $excel;
        }

        return [];
    }
}
