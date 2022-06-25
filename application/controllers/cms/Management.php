<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}

        $this->load->model([
            'management_model'
        ]);
    }

    public function index()
    {
        $this->page(1);
    }

    public function page($page = 1)
    {
        $page = abs((int)$page);
        $limit = 15;
        $offset = $page <= 1 ? 0 : (($page - 1) * $limit);

        $q = '';
        if($this->input->get('q')!=''){
            $q = $this->input->get('q');
        }

        $s = '';
        if($this->input->get('s')!=''){
            $s = $this->input->get('s');
        }

        $pt = '';
        if($this->input->get('pt')!=''){
            $pt = $this->input->get('pt');
        }

        $p = '';
        if($this->input->get('p')!=''){
            $p = $this->input->get('p');
        }

        $pp = '';
        if($this->input->get('pp')!=''){
            $pp = $this->input->get('pp');
        }

        $vars['data'] = $this->management_model->get_data($offset, $limit, $q, $s, $pt, $p, $pp);
        $vars['page'] = $page;
        $vars['limit'] = $limit;
        $vars['total_data'] = $this->management_model->get_total_data($q, $pt, $p, $pp);
        $vars['paging'] = paging([
            'first_url' => base_url('cms/management?q='.$q.'&s='.$s.'&pt='.$pt.'&p='.$p.'&pp='.$pp),
            'base_url' => base_url('cms/management/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit,
            'uri_segment' => 4,
            'reuse_query_string' => TRUE
        ]);
        $vars['position'] = $this->management_model->get_position(1);
        $vars['position_region'] = $this->management_model->get_position(2);
        $vars['address_region'] = $this->management_model->get_province();
		$this->load->view('cms/management/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->management_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);

        $this->load->library('upload');

        $namefile                       = 'ava-'.uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
        $config['upload_path']          = './media/avatars/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImg');
        $data['image'] = base_url('media/avatars/'.$namefile);

        $data['created_at']= date('YmdHis');
        $res = $this->management_model->save($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('cms/management'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);
        if($_FILES["fileImg"]["tmp_name"]!=''){
            $this->load->library('upload');

            $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/news/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            $data['image'] = base_url('media/news/'.$namefile);
        }
        $res = $this->management_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->management_model->publish($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }

    public function excel()
    {
        $data = $this->management_model->get_excel_master(0, 500);
        header('Content-Type: application/json');
        echo json_encode( $data );
    }


}