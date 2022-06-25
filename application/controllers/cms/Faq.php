<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}

        $this->load->model([
            'faq_model'
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

        $vars['data'] = $this->faq_model->get_data($offset, $limit);
        $vars['total_data'] = $this->faq_model->get_total_data();
        $vars['paging'] = paging([
            'first_url' => base_url('cms/faq'),
            'base_url' => base_url('cms/faq/page'),
            'total_rows' => $vars['total_data'],
            'per_page' => $limit
        ]);
		$this->load->view('cms/faq/content', $vars);
    }

    public function delete()
    {
        $id = $this->input->post('id', true);
        $delete = $this->faq_model->delete($id);

        print_json([
            'success' => $delete,
            'message' => $delete ? 'Item successfully deleted.' : 'Item couldn\'t be deleted at this time. Please try again later!'
        ]);
    }

    public function save(){
        $data = $this->input->post(NULL, TRUE);

        $data['created_at']= date('YmdHis');
        $data['type']= 3;
        $data['subject'] = htmlspecialchars($data['subject']);
        $res = $this->faq_model->save($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('cms/faq'));
    }

    public function update(){
        $data = $this->input->post(NULL, TRUE);
        $id = $data['id'];
        unset($data['id']);
        $data['subject'] = htmlspecialchars($data['subject']);
        $res = $this->faq_model->update($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


    public function publish(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->faq_model->publish($data['id'], $data['status']);
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
        $vars['core'] = $this->faq_model->get_data_id($id);
        if(!$vars['core']){
            redirect(base_url('cms/faq'));
        }

        $vars['data'] = $this->faq_model->get_data_content(0, 100,$id);
        // $vars['total_data'] = $this->faq_model->get_total_data_content();
        // $vars['paging'] = paging([
        //     'first_url' => base_url('cms/faq/edit'),
        //     'base_url' => base_url('cms/faq/edit'),
        //     'total_rows' => $vars['total_data'],
        //     'per_page' => $limit
        // ]);
		$this->load->view('cms/faq/content_items', $vars);
    }

    public function save_content($id){
        $data = $this->input->post(NULL, TRUE);

        $data['qa_subject_id'] = $id;
        $data['created_at']= date('YmdHis');
        $data['question'] = htmlspecialchars($data['question']);
        $data['answer'] = htmlspecialchars($data['answer']);
        $res = $this->faq_model->save_content($data);
        $this->session->set_flashdata('success', true);
        redirect(base_url('cms/faq/edit/'.$id));
    }

    public function publish_content(){
        $data = $this->input->post(NULL, TRUE);
        $res = $this->faq_model->publish_content($data['id'], $data['status']);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }

    public function delete_content()
    {
        $id = $this->input->post('id', true);
        $delete = $this->faq_model->delete_content($id);

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
        $res = $this->faq_model->update_content($id,$data);
        print_json([
            'success' => true,
            'message' => 'Success to update data'
        ]);
    }


}