<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
		$this->admin = $this->session->userdata('admin');
		if ($this->admin) {
				redirect(base_url('cms'));
		}
	}

	public function index()
	{
		$this->load->view('/cms/login');
	}

	public function do_login()
	{
		$username = $this->input->post('username', true);
		// $username = preg_replace('/[^a-zA-Z0-9]/i', '', $username);

		$password = $this->input->post('password', true);
		$password = preg_replace('/[^a-zA-Z0-9]/i', '', $password);

		#$result = validateEcaptcha($this->input->post('g-recaptcha-response'));


		// print_r($this->input->post(null, true));exit;

		// check from db
		// if($result['success']){
			$get = $this->db
			->select('id, email, name, role, image')
			->where([
				'email' => $username,
				'password' => md5($password),
				'status'	=> '1'
			])
			->limit(1)
			->get('administrator');

			// print_r($get->row());exit;
			if ($get && $get->num_rows()) {
				$row = $get->row();
				$this->session->set_userdata('admin', $row);
					redirect(base_url('cms?t=' . strtotime('now')));
			} else {
        $this->session->set_flashdata('error', true);
				redirect(base_url('cms/auth?t=' . strtotime('now')));
			}
		// }
		// $this->session->set_flashdata('error', true);
		// redirect(base_url('cms/auth?t=' . strtotime('now')));
	}
}
