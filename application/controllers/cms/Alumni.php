<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model([
            'alumni_model'
        ]);
    }

    public function index()
    {
        $this->page(1);
    }

    public function page($page = 1)
    {
        $page = abs((int)$page);
        $limit = 10;
        $offset = $page <= 1 ? 0 : (($page - 1) * $limit);
        
        $q = '';
        if($this->input->get('q')!=''){
            $q = $this->input->get('q');
        }

        $s = '';
        if($this->input->get('s')!=''){
            $s = $this->input->get('s');
        }

        $f = '';
        if($this->input->get('f')!=''){
            $f = $this->input->get('f');
        }

        $a = '';
        if($this->input->get('a')!=''){
            $a = $this->input->get('a');
        }

        $g = '';
        if($this->input->get('g')!=''){
            $g = $this->input->get('g');
        }

        $p = '';
        if($this->input->get('p')!=''){
            $p = $this->input->get('p');
        }

        $d = '';
        if($this->input->get('d')!=''){
            $d = $this->input->get('d');
        }

        $vars['data'] = $this->alumni_model->get_data($offset, $limit, $q, $s, $f, $a, $g, $p, $d);
        $vars['page'] = $page;
        $vars['limit'] = $limit;
        $vars['total_data'] = $this->alumni_model->get_total_data($q, $f, $a, $g, $p, $d);
        $vars['paging'] = paging([
            'first_url' => base_url('cms/alumni?q='.$q.'&s='.$s.'&f='.$f.'&a='.$a.'&g='.$g.'&p='.$p.'&d='.$d),
            'base_url' => base_url('cms/alumni/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit,
            'uri_segment' => 4,
            'reuse_query_string' => TRUE
        ]);
        $vars['majors'] = $this->alumni_model->get_majors();
        $vars['facultys'] = $this->alumni_model->get_faculty();
        $vars['districts'] = $this->alumni_model->get_district();
        $vars['provinces'] = $this->alumni_model->get_province();
		$this->load->view('cms/alumni/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->alumni_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);

        $this->load->library('upload');

        // upload avatar
        $namefile                       = 'alumni-ava-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
        $config['upload_path']          = './media/alumni/avatars/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImg');
        $data['image'] = base_url('media/alumni/avatars/'.$namefile);

        // upload ktp
        $namefile                       = 'alumni-ktp-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgKtp']['type'])[1];
        $config['upload_path']          = './media/alumni/ktp/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImgKtp');
        $data['image_ktp'] = base_url('media/alumni/ktp/'.$namefile);

        // upload certificate
        $namefile                       = 'alumni-certificate-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgCertificate']['type'])[1];
        $config['upload_path']          = './media/alumni/certificate/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImgCertificate');
        $data['image_certificate_graduation'] = base_url('media/alumni/certificate/'.$namefile);

        // upload npwp
        $namefile                       = 'alumni-npwp-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgNpwp']['type'])[1];
        $config['upload_path']          = './media/alumni/npwp/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImgNpwp');
        $data['npwp_image'] = base_url('media/alumni/npwp/'.$namefile);

        // upload payment
        $namefile                       = 'alumni-payment-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgPayment']['type'])[1];
        $config['upload_path']          = './media/alumni/payment/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImgPayment');
        $data['payment_image'] = base_url('media/alumni/payment/'.$namefile);

        $data['created_at']= date('YmdHis');
        $res = $this->alumni_model->save($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('cms/alumni'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);
        $this->load->library('upload');
        if($_FILES["fileImg"]["tmp_name"]!=''){

            $namefile                       = 'alumni-ava-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/alumni/avatars/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            $data['image'] = base_url('media/alumni/avatars/'.$namefile);
        }
        if($_FILES["fileImgKtp"]["tmp_name"]!=''){
            $namefile                       = 'alumni-ktp-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgKtp']['type'])[1];
            $config['upload_path']          = './media/alumni/ktp/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImgKtp');
            $data['image_ktp'] = base_url('media/alumni/ktp/'.$namefile);
        }
        if($_FILES["fileImgCertificate"]["tmp_name"]!=''){
            $namefile                       = 'alumni-certificate-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgCertificate']['type'])[1];
            $config['upload_path']          = './media/alumni/certificate/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImgCertificate');
            $data['image_certificate_graduation'] = base_url('media/alumni/certificate/'.$namefile);
        }
        if($_FILES["fileImgNpwp"]["tmp_name"]!=''){
            $namefile                       = 'alumni-npwp-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgNpwp']['type'])[1];
            $config['upload_path']          = './media/alumni/npwp/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImgNpwp');
            $data['npwp_image'] = base_url('media/alumni/npwp/'.$namefile);
        }
        if($_FILES["fileImgPayment"]["tmp_name"]!=''){
            $namefile                       = 'alumni-payment-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgPayment']['type'])[1];
            $config['upload_path']          = './media/alumni/payment/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImgPayment');
            $data['payment_image'] = base_url('media/alumni/payment/'.$namefile);
        }
        $res = $this->alumni_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->alumni_model->publish($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }

    public function excel()
    {
        $data = $this->alumni_model->get_excel_master(0, 200);
        header('Content-Type: application/json');
        echo json_encode( $data );
    }


}
