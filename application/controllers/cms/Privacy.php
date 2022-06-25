<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}

        $this->load->model([
            'privacy_model'
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

        $vars['data'] = $this->privacy_model->get_data($offset, $limit);
        $vars['total_data'] = $this->privacy_model->get_total_data();
        $vars['paging'] = paging([
            'first_url' => base_url('cms/privacy'),
            'base_url' => base_url('cms/privacy/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit
        ]);
		$this->load->view('cms/privacy/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->privacy_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);

        $data['created_at']= date('YmdHis');
        $data['subject'] = htmlspecialchars($data['subject']);
        $data['type']= 2;
        $res = $this->privacy_model->save($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('cms/privacy'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);
        $data['subject'] = htmlspecialchars($data['subject']);
        $res = $this->privacy_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->privacy_model->publish($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    // term content
    public function edit($id)
    {
        // $page = abs((int)$page);
        // $limit = 10;
        // $offset = $page <= 1 ? 0 : (($page - 1) * $limit);
        $vars['core'] = $this->privacy_model->get_data_id($id);
        if(!$vars['core']){
            redirect(base_url('cms/privacy'));
        }

        $vars['data'] = $this->privacy_model->get_data_content(0, 100,$id);
        // $vars['total_data'] = $this->privacy_model->get_total_data_content();
        // $vars['paging'] = paging([
        //     'first_url' => base_url('cms/privacy/edit'),
        //     'base_url' => base_url('cms/privacy/edit'),
        //     'total_rows' => $vars['total_data'],
        //     'per_page' => $limit
        // ]);
		$this->load->view('cms/privacy/content_items', $vars);
    }

    public function save_content($id){
        $data = $this->input->post(NULL, TRUE);

        $data['qa_subject_id'] = $id;
        $data['created_at']= date('YmdHis');
        $data['question'] = htmlspecialchars($data['question']);
        $data['answer'] = htmlspecialchars($data['answer']);
        $res = $this->privacy_model->save_content($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('cms/privacy/edit/'.$id));
    }

    public function publish_content(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->privacy_model->publish_content($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }

    public function delete_content()
    {
        $id = $this->input->post('id', true);
        $delete = $this->privacy_model->delete_content($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function update_content(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);
        $data['question'] = htmlspecialchars($data['question']);
        $data['answer'] = htmlspecialchars($data['answer']);
        $res = $this->privacy_model->update_content($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


}