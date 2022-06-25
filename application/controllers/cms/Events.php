<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}

        $this->load->model([
            'events_model'
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

        $ds = '';
        if($this->input->get('ds')!=''){
            $ds = $this->input->get('ds');
        }

        $de = '';
        if($this->input->get('de')!=''){
            $de = $this->input->get('de');
        }

        $vars['data'] = $this->events_model->get_data($offset, $limit, $q, $ds, $de);
        $vars['total_data'] = $this->events_model->get_total_data($q, $ds, $de);
        $vars['paging'] = paging([
            'first_url' => base_url('cms/events?q='.$q.'&ds='.$ds.'&de='.$de),
            'base_url' => base_url('cms/events/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit,
            'uri_segment' => 4,
            'reuse_query_string' => TRUE
        ]);
		$this->load->view('cms/events/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->events_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);
        // print_r($data);exit;

        $this->load->library('upload');

        $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
        $config['upload_path']          = './media/events/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 20000;
        $config['file_name']            = $namefile;

        $this->upload->initialize($config);
        $this->upload->do_upload('fileImg');
        $data['image'] = base_url('media/events/'.$namefile);

        $data['created_at']= date('YmdHis');
        $data['title'] = htmlspecialchars($data['title']);
        $data['start_at'] = $data['start_at'].':00';
        $data['end_at'] = $data['end_at'].':00';
        $res = $this->events_model->save($data);
        $data['slug'] = generateSlug($data['title'].'-'.$res);
        $res = $this->events_model->update($res,$data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('/cms/events'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);

        if($_FILES["fileImg"]["tmp_name"]!=''){
            $this->load->library('upload');

            $namefile                       = uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
            $config['upload_path']          = './media/events/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 20000;
            $config['file_name']            = $namefile;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileImg');
            $data['image'] = base_url('media/events/'.$namefile);
        }

        
        $data['title'] = htmlspecialchars($data['title']);
        $data['slug'] = generateSlug($data['title'].'-'.$id);
        $data['start_at'] = $data['start_at'].':00';
        $data['end_at'] = $data['end_at'].':00';
        $res = $this->events_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->events_model->publish($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }

    public function mark(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->events_model->mark($data['id'], $data['mark']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


}