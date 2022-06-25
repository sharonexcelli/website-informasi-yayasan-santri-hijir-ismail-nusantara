<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		// cek admin session
	}
		
	public function index()
	{
		if($this->session->userdata('admin')->role != 1 && $this->session->userdata('admin')->role != 2){
			redirect(base_url('/cms/alumni'));
		}
		$this->load->model([
				'alumni_model',
				'management_model',
				'events_model',
				'news_model'
		]);
		$vars['total']['total_alumni'] = $this->alumni_model->get_total_data();
		$vars['total']['total_management'] = $this->management_model->get_total_data();
		$vars['total']['total_management_central'] = $this->management_model->get_total_data_type(1);
		$vars['total']['total_management_regional'] = $this->management_model->get_total_data_type(2);

		$vars['last']['alumni'] = $this->alumni_model->get_data(0, 5);
		$vars['last']['management'] = $this->management_model->get_data(0, 5);
		$vars['last']['event'] = $this->events_model->get_data(0, 5);
		$vars['last']['news'] = $this->news_model->get_data(0, 5);

		$vars['content'] = 'Dashboard Content';
		$vars['menu_active'] = 'dashboard';
		
		$data['content'] = $this->load->view('cms/main', $vars, true);
        $this->load->view('cms/main', $data);
	}
	
	public function logout(){
		$this->session->unset_userdata('admin');
		redirect(base_url('cms/auth?t=' . strtotime('now')));
	}
}
