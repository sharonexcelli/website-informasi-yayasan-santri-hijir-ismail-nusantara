<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallerys extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}

        $this->load->model([
            'gallerys_model'
        ]);
    }

    public function index()
    {
        $this->page(1);
    }

    public function page($page = 1)
    {
        $page = abs((int)$page);
        $limit = 12;
        $offset = $page <= 1 ? 0 : (($page - 1) * $limit);

        $q = '';
        if($this->input->get('q')!=''){
            $q = $this->input->get('q');
        }

        $vars['data'] = $this->gallerys_model->get_data($offset, $limit,$q);
        $vars['total_data'] = $this->gallerys_model->get_total_data($q);
        $vars['total_videos'] = $this->gallerys_model->get_total_data(null, 'V');
        $vars['total_photos'] = $this->gallerys_model->get_total_data(null, 'P');
        $vars['paging'] = paging([
            'first_url' => base_url('cms/gallerys'.($q!=''?('?q='.$q):'')),
            'base_url' => base_url('cms/gallerys/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit,
            'uri_segment' => 4,
            'reuse_query_string' => TRUE
        ]);
		$this->load->view('cms/gallerys/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->gallerys_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);
        $imgUrl=[];
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['fileImg']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['fileImg']['name']    = $files['fileImg']['name'][$i];
            $_FILES['fileImg']['type']    = $files['fileImg']['type'][$i];
            $_FILES['fileImg']['tmp_name']= $files['fileImg']['tmp_name'][$i];
            $_FILES['fileImg']['error']   = $files['fileImg']['error'][$i];
            $_FILES['fileImg']['size']    = $files['fileImg']['size'][$i];    


            $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/gallerys/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']			      = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            array_push($imgUrl, base_url('media/gallerys/'.$namefile));
        }
        $data['media'] = json_encode($imgUrl);

        $data['created_at']= date('YmdHis');
        $data['title'] = $data['title'];
        $res = $this->gallerys_model->save($data);
        $data['slug'] = generateSlug($data['title'].'-'.$res);
        $res = $this->gallerys_model->update($res, $data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('/cms/gallerys'));
    }

    public function save_vidio(){
        $data = $this->input->post(NULL, TRUE);
        $data['created_at']= date('YmdHis');
        $data['title'] = $data['title'];
        $data['media'] = htmlspecialchars($data['media']);
        $data['type']='V';
        $res = $this->gallerys_model->save($data);
        $data['slug'] = generateSlug($data['title'].'-'.$res);
        $res = $this->gallerys_model->update($res, $data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('/cms/gallerys'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);

        if($_FILES["fileImg"]["tmp_name"][0]!=''){
            $imgUrl=[];
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['fileImg']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['fileImg']['name']    = $files['fileImg']['name'][$i];
                $_FILES['fileImg']['type']    = $files['fileImg']['type'][$i];
                $_FILES['fileImg']['tmp_name']= $files['fileImg']['tmp_name'][$i];
                $_FILES['fileImg']['error']   = $files['fileImg']['error'][$i];
                $_FILES['fileImg']['size']    = $files['fileImg']['size'][$i];    


                $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
                $config['upload_path']          = './media/gallerys/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 20000;
                $config['file_name']			      = $namefile;

                $this->upload->initialize($config);
                $this->upload->do_upload('fileImg');
                array_push($imgUrl, base_url('media/gallerys/'.$namefile));
            }
            $data['media'] = json_encode($imgUrl);
        }

        $data['title'] = $data['title'];
        $data['slug'] = generateSlug($data['title'].'-'.$id);
        $res = $this->gallerys_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }

    public function update_video(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);

        $data['title'] = $data['title'];
        $data['slug'] = generateSlug($data['title'].'-'.$id);
        $res = $this->gallerys_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->gallerys_model->publish($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


}