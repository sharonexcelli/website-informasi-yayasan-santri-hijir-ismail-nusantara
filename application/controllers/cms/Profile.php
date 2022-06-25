<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
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

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $this->session->userdata('admin')->id;
        if($_FILES["fileImg"]["tmp_name"]!=''){
            $this->load->library('upload');

            $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/avatars/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            $data['image'] = base_url('media/avatars/'.$namefile);
        }

        $data['name'] = htmlspecialchars($data['name']);
        if($data['password']!=''){
            $data['password'] = md5(htmlspecialchars($data['password']));
        }else{
            unset($data['password']);
        }
        $res = $this->users_model->update($id,$data);
        $get = $this->db
			->select('id, email, name, role, image')
			->where([
				'id' => $this->session->userdata('admin')->id
			])
			->limit(1)
            ->get('administrator');
        $this->session->set_userdata('admin', $get->row());
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }

}