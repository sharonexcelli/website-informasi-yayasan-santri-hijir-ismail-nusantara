<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}

        $this->load->model([
            'banners_model'
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

        $vars['data'] = $this->banners_model->get_data($offset, $limit);
        $vars['total_data'] = $this->banners_model->get_total_data();
        $vars['paging'] = paging([
            'first_url' => base_url('cms/banners'),
            'base_url' => base_url('cms/banners/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit
        ]);
		$this->load->view('cms/banners/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->banners_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);

        $this->load->library('upload');

        $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
        $namefile2                      = uniqid().'.'.explode("/",$_FILES['fileImgM']['type'])[1];
        $config['upload_path']          = './media/banners/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImg');
        $data['image'] = base_url('media/banners/'.$namefile);

        $config['file_name']            = $namefile2;
        $this->upload->initialize($config);
        $this->upload->do_upload('fileImgM');
        $data['image_mobile'] = base_url('media/banners/'.$namefile2);

        $data['created_at']= date('YmdHis');
        $data['title'] = htmlspecialchars($data['title']);
        $data['description'] = htmlspecialchars($data['description']);
        $res = $this->banners_model->save($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('/cms/banners'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);

        if($_FILES["fileImg"]["tmp_name"]!=''){
            $this->load->library('upload');

            $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/banners/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            $data['image'] = base_url('media/banners/'.$namefile);
        }

        if($_FILES["fileImgM"]["tmp_name"]!=''){
            $this->load->library('upload');

            $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImgM']['type'])[1];
            $config['upload_path']          = './media/banners/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImgM');
            $data['image_mobile'] = base_url('media/banners/'.$namefile);
        }

        $data['title'] = htmlspecialchars($data['title']);
        $data['description'] = htmlspecialchars($data['description']);
        $res = $this->banners_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->banners_model->publish($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


}