<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}

        if($this->session->userdata('admin')->role != 1){
            redirect(base_url('/cms'));
        }

        $this->load->model([
            'users_model'
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

        $vars['data'] = $this->users_model->get_data($offset, $limit);
        $vars['total_data'] = $this->users_model->get_total_data();
        $vars['paging'] = paging([
            'first_url' => base_url('cms/users'),
            'base_url' => base_url('cms/users/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit
        ]);
		$this->load->view('cms/users/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->users_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);
        
        if($this->users_model->get_email($data['email'])){
            $error_data = array(
                'error' => true,
                'data' => $data
            );
            $this->session->set_flashdata($error_data);
            redirect(base_url('/cms/users'));
        }
        if($_FILES["fileImg"]["tmp_name"]!=''){
            
            $this->load->library('upload');
            $namefile                       = 'ava-'.uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/avatars/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            $data['image'] = base_url('media/avatars/'.$namefile);
        } else {
            $data['image'] = 'http://ika.uii.beruangstudio.com/media/avatars/5ee75ab20786c.png';
        }
        $data['created_at']= date('YmdHis');
        $data['name'] = htmlspecialchars($data['name']);
        $data['email'] = htmlspecialchars($data['email']);
        $data['role'] = $data['role'];
        $data['password'] = md5(htmlspecialchars($data['password']));
        $res = $this->users_model->save($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('/cms/users'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);

        if($this->users_model->get_email_ex_id($id, $data['email'])){
            print_json([
                'success' => false,
                'message' => 'Error to update data'
            ]);
        }

        if($_FILES["fileImg"]["tmp_name"]!=''){
            $this->load->library('upload');

            $namefile                       = 'ava-'.uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/avatars/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            $data['image'] = base_url('media/avatars/'.$namefile);
        }
        if($data['password']!=''){
            $data['password'] = md5(htmlspecialchars($data['password']));
        }else{
            unset($data['password']);
        }

        $data['name'] = htmlspecialchars($data['name']);
        $data['email'] = htmlspecialchars($data['email']);
        $data['role'] = $data['role'];
        $res = $this->users_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->users_model->publish($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


}