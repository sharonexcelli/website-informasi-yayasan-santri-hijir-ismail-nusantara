<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Main extends CI_Controller {

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

	public function index()
	{
		$this->load->view('down');
	}

	public function home() {
		$this->load->model([
			'quotes_model',
			'news_model',
			'events_model',
			'testimonys_model',
			'banners_model'
		]);
		$vars['banner'] = $this->banners_model->get_active_data('1');
		$vars['quotes'] = $this->quotes_model->get_active_mark_data();
		$vars['news'] = $this->news_model->get_active_data();
		$vars['events'] = $this->events_model->get_active_data();
		$vars['testimonys'] = $this->testimonys_model->get_active_data();

		$this->load->view('home', $vars);
	}

	public function gallery($page = 1) {
		$this->load->model([
			'banners_model',
			'gallerys_model'
		]);
		$vars['banner'] = $this->banners_model->get_active_data('4');
		$page = abs((int)$page);
		$limit = 12;
		$offset = $page <= 1 ? 0 : (($page - 1) * $limit);

		$type= '';
		if($this->input->get('type')!=''){
			$type = $this->input->get('type');
		}

		$vars['data'] = $this->gallerys_model->get_data_publish($offset, $limit, $type);
		$vars['total_data'] = $this->gallerys_model->get_total_data_publish($type);
		$vars['paging'] = paging([
				'first_url' => base_url('gallery'),
				'base_url' => base_url('gallery/page'),
				'total_rows' => $vars['total_data'],
				'per_page' => $limit
		]);
		$this->load->view('gallery', $vars);
	}

	public function contactus() {
		$this->load->model([
			'banners_model',
		]);
		$vars['banner'] = $this->banners_model->get_active_data('5');
		$this->load->view('contactus', $vars);
	}

	public function send_contactus() {
		$data = $this->input->post(NULL, TRUE);

		$result = validateEcaptcha($data['g-recaptcha-response']);

		if($result['success']){
			$from = $data['email'];
			$html_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
				<head>
						<!-- This is a simple example template that you can edit to create your own custom templates -->
						<meta http-equiv="content-type" content="text/html; charset=UTF-8">
						<!-- Facebook sharing information tags -->
						<meta property="og:title" content="*|MC:SUBJECT|*">
						<link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
						<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
						<title>Emai Subject</title>

						<style type="text/css">
								* {
										font-family: \'Lato\', sans-serif;
										font-weight: 400;
								}

								img {
										max-width: 100%;
								}

								.collapse {
										padding-right: 15px;
										padding: 0;
								}

								body {
										-webkit-font-smoothing: antialiased;
										-webkit-text-size-adjust: none;
										width: 100% !important;
										height: 100%;
								}

								a {
										color: #323232;
										font-size: 12px;
								}

								.bt {
										padding-top: 10px;
								}

								p.callout {
										padding: 9px;
										font-size: 12px;
								}

								p.text {
										padding-left: 5px;
										font-size: 14px;
								}

								p.left {
										padding: 5px;
										font-size: 12px;
										text-align: left;
								}

								.prod {
										margin: 0;
										padding: 0;
										color: #aaaaaa;
								}

								.callout a {
										font-weight: bold;
										color: #aaaaaa;
								}

								table.head-wrap {
										width: 100%;
								}

								.header.container table td.logo {
										padding: 15px;
								}

								.header.container table td.label {
										padding: 15px;
										padding-left: 0;
								}

								table.body-wrap {
										width: 100%;
								}

								table.footer-wrap {
										width: 100%;
										background-color: #f5f5f5;
										height: 50px;
										border-top: 2px solid #929292;
								}

								table.footer-wrap2 {
										width: 100%;
								}

								h1,
								h2,
								h3,
								h4,
								h5,
								h6 {
										font-family: \'Lato\', sans-serif;
										font-weight: 700;
										line-height: 1.1;
										color: #000;
								}

								h1 small,
								h2 small,
								h3 small,
								h4 small,
								h5 small,
								h6 small {
										font-size: 60%;
										color: #197089;
										line-height: 0;
										text-transform: none;
								}

								h1 {
										font-weight: 400;
										font-size: 24px;
										padding: 15px 0;
										color: #166d88;
								}

								h2 {
										font-weight: 200;
										font-size: 37px;
										margin: 0;
								}

								h3 {
										font-weight: 500;
										font-size: 27px;
								}

								h4 {
										font-weight: 500;
										font-size: 23px;
								}

								h5 {
										font-weight: 900;
										font-size: 13px;
										color: #c2a67e;
										background-color: #f5f5f5;
								}

								h6 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
								}

								h7 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
										padding: 5px;
								}

								.collapse {
										margin: 0 !important;
								}

								p,
								ul {
										font-weight: normal;
										font-size: 12px;
										line-height: 1.6;
								}

								p.lead {
										font-size: 13px;
								}

								p.last {
										margin-bottom: 0;
								}

								ul li {
										margin-left: 5px;
										list-style-position: inside;
								}

								.container {
										display: block !important;
										max-width: 600px !important;
										margin: 0 auto !important;
										clear: both !important;
								}

								.content {
										padding: 15px;
										max-width: 600px;
										margin: 0 auto;
										display: block;
								}

								.content table {
										width: 100%;
								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col3] {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												padding-top: 15px;
												margin-top: 15px;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col2] {
												width: 100% !important;
												float: left;
												text-align: left;
										}

								}

								@media only screen and (max-width:600px) {
										[class=desc] {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col3 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												margin-top: 15px !important;
												padding-top: 15px !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col2 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
										}

								}

								@media only screen and (max-width:600px) {
										p.desc {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-device-width: 480px) {
										.hide {
												max-height: none !important;
												font-size: 12px !important;
												display: block !important;
										}

								}

								.hide {
										max-height: 0;
										font-size: 0;
										display: none;
								}

								.column {
										width: 49%;
										float: left;
										padding-bottom: 10px;
								}

								.col3 {
										width: 35%;
										float: right;
										text-align: right;
								}

								.col2 {
										width: 65%;
										float: left;
								}

								.column-wrap {
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.column3 {
										width: 300px;
										float: left;
								}

								.column3 tr td {
										padding: 1px;
								}

								.column3-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column3 table {
										width: 100%;
								}

								.column2 {
										width: 240px;
										float: left;
								}

								.column2 tr td {
										padding: 5px;
								}

								.column2-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column2 table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.prod {
										width: 200px;
										float: left;
								}

								.prod tr td {
										padding: 5px;
								}

								.prod-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.prod table {
										width: 100%;
								}

								.prod .column {
										width: 200px;
										float: left;
								}

								.clear {
										display: block;
										clear: both;
								}

								.imgPromo {
										width: 100%;
								}

								.imgPromo img {
										display: inline;
										width: calc(33.33% - 4px);
										margin-right: 1px;
								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										.imgPromo img {
												width: 100% !important;
												margin-bottom: 5px;
										}

								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column2] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column3] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										table[class=top] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.prod {
												width: 150px;
												float: left;
										}

								}

								@media only screen and (max-width:600px) {
										table.social div[class=column] {
												width: auto !important;
										}

								}
						</style>
				</head>

				<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
						<table bgcolor="#ffffff" class="body-wrap container">
								<tr>
										<td>
												<div style="text-align:center;">
														<img src="https://storage.googleapis.com/bsdn/ikauii/img/banner-email-ikauii.png" style="width: 60%;max-width: 100%;margin: 0 auto;">
														<h2 style="font-size:18px;color:#000;padding-bottom:5px;"><b style="font-weight:700;">
															Hai Admin, Seseorang telah mengirimkan pesan melalui website, Mohon untuk segera menindak lanjuti pesan tersebut, Terima kasih</b>
														</h2>
														<br>
														<p style="font-size:16px;color:#323232;">
															<p>&nbsp;</p>
															<table width="100%" cellspacing="0" width="100%">
																			<tr>
																							<td style="text-align:left;border-left: 1px solid #ccc;border-top: 1px solid #ccc;border-right: 1px solid #ccc; padding: 10px; width: 155px; border-bottom: 1px solid #ccc;">Name</td>
																							<td style="text-align:left;padding: 10px; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">'.$data['name'].'</td>
																			</tr>
																			<tr>
																							<td style="text-align:left;border-left: 1px solid #ccc;border-right: 1px solid #ccc; padding: 10px; width: 155px; border-bottom: 1px solid #ccc;">E-mail Address</td>
																							<td style="text-align:left;padding: 10px; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">'.$data['email'].'</td>
																			</tr>
																			<tr>
																							<td style="text-align:left;border-left: 1px solid #ccc;border-right: 1px solid #ccc; padding: 10px; width: 155px; border-bottom: 1px solid #ccc;">Message</td>
																							<td style="text-align:left;padding: 10px; border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">'.$data['message'].'</td>
																			</tr>
															</table>
															<p>&nbsp;</p>
														</p>
														<br>
														<div class="mcnButtonContent" style="font-size:14px;padding:15px;" align="center"><a class="mcnButton" href="'.base_url().'" target="_blank" style="border-collapse:separate !important;border-radius:9px;padding:15px;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#377dff;font-weight:bold;letter-spacing:0px;line-height:100%;text-align:center;text-decoration:none;color:#fff;">Kembali Ke Website </a>
														</div>
														<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
																<tr>
																		<td width="50%" align="left">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('news').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-info.jpg" style="" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																		<td width="50%" align="right">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('events').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-event.jpg" style="padding-bottom: 0;" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																</tr>
														</table>
														<br>
														<div class="soc" style="padding-top:20px;padding-bottom:10px; border-top:thin solid #ccc;border-bottom:thin solid #ccc;">
																<table cellspacing="0" cellpadding="0" border="0" align="center">
																		<tbody>
																				<tr>
																						<td valign="top" align="center">
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://www.facebook.com/DPPIKAUII" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconfb.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconfb.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="hhttps://id.linkedin.com/in/dppikauii" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconli.png" style="display:block" width="24" height="24" class="CToWUd" alt="icontw.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://twitter.com/DPPIKAUII_" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Icontw.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconig.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																						</td>
																				</tr>
																		</tbody>
																</table>
														</div>
														<div style="text-align: center;margin-top:1em"><span style="color:#000000"><span style="font-size:10px">© 2020. IKA UII. All rights reserved.</span></span></div>
												</div>
										</td>
								</tr>
						</table>
				</body>
				</html>';

			$send_to_admin = send_mail($from, __EMAIL_ADMIN__, 'Hai Admin, Seseorang Telah Mengirimkan Pesan Melalui Website', $html_content);
			$send_to_admin = send_mail($from, __EMAIL_ADMIN_2__, 'Hai Admin, Seseorang Telah Mengirimkan Pesan Melalui Website', $html_content);
			$this->session->set_flashdata('success', true);
			redirect(base_url('contactus'));
		}
		$this->session->set_flashdata('error', true);
		redirect(base_url('contactus'));
	}

	public function terms_and_condition() {
		$this->load->model([
			'terms_model'
		]);
		$vars['terms'] = $this->terms_model->get_active_data();
		foreach($vars['terms'] as $idx => $item){
			$vars['terms'][$idx]['content'] = $this->terms_model->get_active_data_content($item['id']);
		}
		$this->load->view('terms', $vars);
	}

	public function privacy_and_policy() {
		$this->load->model([
			'privacy_model'
		]);
		$vars['terms'] = $this->privacy_model->get_active_data();
		foreach($vars['terms'] as $idx => $item){
			$vars['terms'][$idx]['content'] = $this->privacy_model->get_active_data_content($item['id']);
		}
		$this->load->view('privacypolicy', $vars);
	}

	public function faq() {
		$this->load->model([
			'faq_model'
		]);
		$vars['terms'] = $this->faq_model->get_active_data();
		foreach($vars['terms'] as $idx => $item){
			$vars['terms'][$idx]['content'] = $this->faq_model->get_active_data_content($item['id']);
		}
		$this->load->view('faq', $vars);
	}

	public function coming() {
		$this->load->view('coming');
	}

	public function reg_alumni() {
		$this->load->view('reg_alumni');
	}

	public function reg_alumni_wsd() {
		$this->load->view('reg_alumni_wsd');
	}

	public function reg_alumni_nwsd()
	{
		$this->load->model([
			'alumni_model'
		]);
		$vars['majors'] = $this->alumni_model->get_majors();
		$vars['districts'] = $this->alumni_model->get_district();
		$this->load->view('reg_alumni_nwsd', $vars);
	}

	public function submit_alumni_nwsd(){
		$data = $this->input->post(NULL, TRUE);
		$result = validateEcaptcha($data['g-recaptcha-response']);
		if($result['success']){
			$this->load->model([
				'alumni_model'
			]);
			$this->load->library('upload');

			// upload avatar
			$namefile                       = 'alumni-ava-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImg']['type'])[1];
			$config['upload_path']          = './media/alumni/avatars/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 20000;
			$config['file_name']            = $namefile;

			$this->upload->initialize($config);
			$this->upload->do_upload('fileImg');
			$data['image'] = base_url('media/alumni/avatars/'.$namefile);

			// upload ktp
			$namefile                       = 'alumni-ktp-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgKtp']['type'])[1];
			$config['upload_path']          = './media/alumni/ktp/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 20000;
			$config['file_name']            = $namefile;

			$this->upload->initialize($config);
			$this->upload->do_upload('fileImgKtp');
			$data['image_ktp'] = base_url('media/alumni/ktp/'.$namefile);

			// upload certificate
			$namefile                       = 'alumni-certificate-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgCertificate']['type'])[1];
			$config['upload_path']          = './media/alumni/certificate/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 20000;
			$config['file_name']            = $namefile;

			$this->upload->initialize($config);
			$this->upload->do_upload('fileImgCertificate');
			$data['image_certificate_graduation'] = base_url('media/alumni/certificate/'.$namefile);

			// upload npwp
			$namefile                       = 'alumni-npwp-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgNpwp']['type'])[1];
			$config['upload_path']          = './media/alumni/npwp/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 20000;
			$config['file_name']            = $namefile;

			$this->upload->initialize($config);
			$this->upload->do_upload('fileImgNpwp');
			$data['npwp_image'] = base_url('media/alumni/npwp/'.$namefile);

			// upload payment
			$namefile                       = 'alumni-payment-'.uniqid().uniqid().uniqid().uniqid().'.'.explode("/",$_FILES['fileImgPayment']['type'])[1];
			$config['upload_path']          = './media/alumni/payment/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 20000;
			$config['file_name']            = $namefile;

			$this->upload->initialize($config);
			$this->upload->do_upload('fileImgPayment');
			$data['payment_image'] = base_url('media/alumni/payment/'.$namefile);

			$tmpDate = explode('-', $data['birth_date']);
			$data['birth_date'] =  $tmpDate[2].'-'.$tmpDate[1].'-'.$tmpDate[0];
			$data['created_at']= date('YmdHis');
			unset($data['g-recaptcha-response']);
			$res = $this->alumni_model->save($data);

			// email to alumni
			$from = 'no-replay@ika.uii.ac.id';
			$html_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
				<head>
						<!-- This is a simple example template that you can edit to create your own custom templates -->
						<meta http-equiv="content-type" content="text/html; charset=UTF-8">
						<!-- Facebook sharing information tags -->
						<meta property="og:title" content="*|MC:SUBJECT|*">
						<link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
						<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
						<title>Emai Subject</title>

						<style type="text/css">
								* {
										font-family: \'Lato\', sans-serif;
										font-weight: 400;
								}

								img {
										max-width: 100%;
								}

								.collapse {
										padding-right: 15px;
										padding: 0;
								}

								body {
										-webkit-font-smoothing: antialiased;
										-webkit-text-size-adjust: none;
										width: 100% !important;
										height: 100%;
								}

								a {
										color: #323232;
										font-size: 12px;
								}

								.bt {
										padding-top: 10px;
								}

								p.callout {
										padding: 9px;
										font-size: 12px;
								}

								p.text {
										padding-left: 5px;
										font-size: 14px;
								}

								p.left {
										padding: 5px;
										font-size: 12px;
										text-align: left;
								}

								.prod {
										margin: 0;
										padding: 0;
										color: #aaaaaa;
								}

								.callout a {
										font-weight: bold;
										color: #aaaaaa;
								}

								table.head-wrap {
										width: 100%;
								}

								.header.container table td.logo {
										padding: 15px;
								}

								.header.container table td.label {
										padding: 15px;
										padding-left: 0;
								}

								table.body-wrap {
										width: 100%;
								}

								table.footer-wrap {
										width: 100%;
										background-color: #f5f5f5;
										height: 50px;
										border-top: 2px solid #929292;
								}

								table.footer-wrap2 {
										width: 100%;
								}

								h1,
								h2,
								h3,
								h4,
								h5,
								h6 {
										font-family: \'Lato\', sans-serif;
										font-weight: 700;
										line-height: 1.1;
										color: #000;
								}

								h1 small,
								h2 small,
								h3 small,
								h4 small,
								h5 small,
								h6 small {
										font-size: 60%;
										color: #197089;
										line-height: 0;
										text-transform: none;
								}

								h1 {
										font-weight: 400;
										font-size: 24px;
										padding: 15px 0;
										color: #166d88;
								}

								h2 {
										font-weight: 200;
										font-size: 37px;
										margin: 0;
								}

								h3 {
										font-weight: 500;
										font-size: 27px;
								}

								h4 {
										font-weight: 500;
										font-size: 23px;
								}

								h5 {
										font-weight: 900;
										font-size: 13px;
										color: #c2a67e;
										background-color: #f5f5f5;
								}

								h6 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
								}

								h7 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
										padding: 5px;
								}

								.collapse {
										margin: 0 !important;
								}

								p,
								ul {
										font-weight: normal;
										font-size: 12px;
										line-height: 1.6;
								}

								p.lead {
										font-size: 13px;
								}

								p.last {
										margin-bottom: 0;
								}

								ul li {
										margin-left: 5px;
										list-style-position: inside;
								}

								.container {
										display: block !important;
										max-width: 600px !important;
										margin: 0 auto !important;
										clear: both !important;
								}

								.content {
										padding: 15px;
										max-width: 600px;
										margin: 0 auto;
										display: block;
								}

								.content table {
										width: 100%;
								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col3] {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												padding-top: 15px;
												margin-top: 15px;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col2] {
												width: 100% !important;
												float: left;
												text-align: left;
										}

								}

								@media only screen and (max-width:600px) {
										[class=desc] {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col3 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												margin-top: 15px !important;
												padding-top: 15px !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col2 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
										}

								}

								@media only screen and (max-width:600px) {
										p.desc {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-device-width: 480px) {
										.hide {
												max-height: none !important;
												font-size: 12px !important;
												display: block !important;
										}

								}

								.hide {
										max-height: 0;
										font-size: 0;
										display: none;
								}

								.column {
										width: 49%;
										float: left;
										padding-bottom: 10px;
								}

								.col3 {
										width: 35%;
										float: right;
										text-align: right;
								}

								.col2 {
										width: 65%;
										float: left;
								}

								.column-wrap {
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.column3 {
										width: 300px;
										float: left;
								}

								.column3 tr td {
										padding: 1px;
								}

								.column3-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column3 table {
										width: 100%;
								}

								.column2 {
										width: 240px;
										float: left;
								}

								.column2 tr td {
										padding: 5px;
								}

								.column2-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column2 table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.prod {
										width: 200px;
										float: left;
								}

								.prod tr td {
										padding: 5px;
								}

								.prod-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.prod table {
										width: 100%;
								}

								.prod .column {
										width: 200px;
										float: left;
								}

								.clear {
										display: block;
										clear: both;
								}

								.imgPromo {
										width: 100%;
								}

								.imgPromo img {
										display: inline;
										width: calc(33.33% - 4px);
										margin-right: 1px;
								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										.imgPromo img {
												width: 100% !important;
												margin-bottom: 5px;
										}

								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column2] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column3] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										table[class=top] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.prod {
												width: 150px;
												float: left;
										}

								}

								@media only screen and (max-width:600px) {
										table.social div[class=column] {
												width: auto !important;
										}

								}
						</style>
				</head>

				<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
						<table bgcolor="#ffffff" class="body-wrap container">
								<tr>
										<td>
												<div style="text-align:center;">
														<img src="https://storage.googleapis.com/bsdn/ikauii/img/banner-email-ikauii.png" style="width: 60%;max-width: 100%;margin: 0 auto;">
														<h2 style="font-size:18px;color:#000;padding-bottom:5px;"><b style="font-weight:700;">Selamat, Registrasi Anda Berhasil</b>
														</h2>
														<br>
														<p style="font-size:16px;color:#323232;">
																Anda telah berhasil melakukan registrasi data alumni.<br>
																Mohon tunggu untuk informasi lebih lanjut.
														</p>
														<br>
														<div class="mcnButtonContent" style="font-size:14px;padding:15px;" align="center"><a class="mcnButton" href="'.base_url().'" target="_blank" style="border-collapse:separate !important;border-radius:9px;padding:15px;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#377dff;font-weight:bold;letter-spacing:0px;line-height:100%;text-align:center;text-decoration:none;color:#fff;">Kembali Ke Website </a>
														</div>
														<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
																<tr>
																		<td width="50%" align="left">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('news').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-info.jpg" style="" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																		<td width="50%" align="right">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('events').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-event.jpg" style="padding-bottom: 0;" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																</tr>
														</table>

														<br>
														<div class="soc" style="padding-top:20px;padding-bottom:10px; border-top:thin solid #ccc;border-bottom:thin solid #ccc;">
																<table cellspacing="0" cellpadding="0" border="0" align="center">
																		<tbody>
																				<tr>
																						<td valign="top" align="center">


																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://www.facebook.com/DPPIKAUII" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconfb.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconfb.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="hhttps://id.linkedin.com/in/dppikauii" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconli.png" style="display:block" width="24" height="24" class="CToWUd" alt="icontw.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://twitter.com/DPPIKAUII_" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Icontw.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconig.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																						</td>
																				</tr>
																		</tbody>
																</table>
														</div>
														<div style="text-align: center;padding-top:1em;font-weight:bold">Untuk Informasi Lebih Lanjut</div>
														<div class="mcnButtonContent" style="margin-top:15px;font-size:14px;padding:15px;" align="center"><a class="mcnButton" href="'.base_url('contactus').'" target="_blank" style="border-collapse:separate !important;border-radius:9px;padding:15px;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#377dff;font-weight:bold;letter-spacing:0px;line-height:100%;text-align:center;text-decoration:none;color:#fff;">Hubungi Kami</a>
														</div>
														<div style="text-align: center;margin-top:1em"><span style="color:#000000"><span style="font-size:10px">© 2020. IKA UII. All rights reserved.</span></span></div>
												</div>
										</td>
								</tr>
						</table>
				</body>
				</html>';

			$send_to_admin = send_mail($from, $data['email'], 'Selamat, Registrasi Anda Berhasil', $html_content);

			// email to admin
			$from = $data['email'];
			$html_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
				<head>
						<!-- This is a simple example template that you can edit to create your own custom templates -->
						<meta http-equiv="content-type" content="text/html; charset=UTF-8">
						<!-- Facebook sharing information tags -->
						<meta property="og:title" content="*|MC:SUBJECT|*">
						<link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
						<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
						<title>Emai Subject</title>

						<style type="text/css">
								* {
										font-family: \'Lato\', sans-serif;
										font-weight: 400;
								}

								img {
										max-width: 100%;
								}

								.collapse {
										padding-right: 15px;
										padding: 0;
								}

								body {
										-webkit-font-smoothing: antialiased;
										-webkit-text-size-adjust: none;
										width: 100% !important;
										height: 100%;
								}

								a {
										color: #323232;
										font-size: 12px;
								}

								.bt {
										padding-top: 10px;
								}

								p.callout {
										padding: 9px;
										font-size: 12px;
								}

								p.text {
										padding-left: 5px;
										font-size: 14px;
								}

								p.left {
										padding: 5px;
										font-size: 12px;
										text-align: left;
								}

								.prod {
										margin: 0;
										padding: 0;
										color: #aaaaaa;
								}

								.callout a {
										font-weight: bold;
										color: #aaaaaa;
								}

								table.head-wrap {
										width: 100%;
								}

								.header.container table td.logo {
										padding: 15px;
								}

								.header.container table td.label {
										padding: 15px;
										padding-left: 0;
								}

								table.body-wrap {
										width: 100%;
								}

								table.footer-wrap {
										width: 100%;
										background-color: #f5f5f5;
										height: 50px;
										border-top: 2px solid #929292;
								}

								table.footer-wrap2 {
										width: 100%;
								}

								h1,
								h2,
								h3,
								h4,
								h5,
								h6 {
										font-family: \'Lato\', sans-serif;
										font-weight: 700;
										line-height: 1.1;
										color: #000;
								}

								h1 small,
								h2 small,
								h3 small,
								h4 small,
								h5 small,
								h6 small {
										font-size: 60%;
										color: #197089;
										line-height: 0;
										text-transform: none;
								}

								h1 {
										font-weight: 400;
										font-size: 24px;
										padding: 15px 0;
										color: #166d88;
								}

								h2 {
										font-weight: 200;
										font-size: 37px;
										margin: 0;
								}

								h3 {
										font-weight: 500;
										font-size: 27px;
								}

								h4 {
										font-weight: 500;
										font-size: 23px;
								}

								h5 {
										font-weight: 900;
										font-size: 13px;
										color: #c2a67e;
										background-color: #f5f5f5;
								}

								h6 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
								}

								h7 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
										padding: 5px;
								}

								.collapse {
										margin: 0 !important;
								}

								p,
								ul {
										font-weight: normal;
										font-size: 12px;
										line-height: 1.6;
								}

								p.lead {
										font-size: 13px;
								}

								p.last {
										margin-bottom: 0;
								}

								ul li {
										margin-left: 5px;
										list-style-position: inside;
								}

								.container {
										display: block !important;
										max-width: 600px !important;
										margin: 0 auto !important;
										clear: both !important;
								}

								.content {
										padding: 15px;
										max-width: 600px;
										margin: 0 auto;
										display: block;
								}

								.content table {
										width: 100%;
								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col3] {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												padding-top: 15px;
												margin-top: 15px;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col2] {
												width: 100% !important;
												float: left;
												text-align: left;
										}

								}

								@media only screen and (max-width:600px) {
										[class=desc] {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col3 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												margin-top: 15px !important;
												padding-top: 15px !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col2 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
										}

								}

								@media only screen and (max-width:600px) {
										p.desc {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-device-width: 480px) {
										.hide {
												max-height: none !important;
												font-size: 12px !important;
												display: block !important;
										}

								}

								.hide {
										max-height: 0;
										font-size: 0;
										display: none;
								}

								.column {
										width: 49%;
										float: left;
										padding-bottom: 10px;
								}

								.col3 {
										width: 35%;
										float: right;
										text-align: right;
								}

								.col2 {
										width: 65%;
										float: left;
								}

								.column-wrap {
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.column3 {
										width: 300px;
										float: left;
								}

								.column3 tr td {
										padding: 1px;
								}

								.column3-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column3 table {
										width: 100%;
								}

								.column2 {
										width: 240px;
										float: left;
								}

								.column2 tr td {
										padding: 5px;
								}

								.column2-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column2 table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.prod {
										width: 200px;
										float: left;
								}

								.prod tr td {
										padding: 5px;
								}

								.prod-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.prod table {
										width: 100%;
								}

								.prod .column {
										width: 200px;
										float: left;
								}

								.clear {
										display: block;
										clear: both;
								}

								.imgPromo {
										width: 100%;
								}

								.imgPromo img {
										display: inline;
										width: calc(33.33% - 4px);
										margin-right: 1px;
								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										.imgPromo img {
												width: 100% !important;
												margin-bottom: 5px;
										}

								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column2] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column3] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										table[class=top] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.prod {
												width: 150px;
												float: left;
										}

								}

								@media only screen and (max-width:600px) {
										table.social div[class=column] {
												width: auto !important;
										}

								}
						</style>
				</head>

				<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
						<table bgcolor="#ffffff" class="body-wrap container">
								<tr>
										<td>
												<div style="text-align:center;">
														<img src="https://storage.googleapis.com/bsdn/ikauii/img/banner-email-ikauii.png" style="width: 60%;max-width: 100%;margin: 0 auto;">
														<h2 style="font-size:18px;color:#000;padding-bottom:5px;"><b style="font-weight:700;">Selamat, '.$data['name'].' Telah Berhasil Mendaftarkan Untuk Pembuatan KTA UII</b></h2>
														<br>
														<p style="font-size:16px;color:#323232;">
															<p>&nbsp;</p>
																Admin, '.$data['name'].' telah berhasil melakukan registrasi KTA UII.<br>
																Mohon untuk segera menindak lanjuti pesan tersebut.<br>
																Terima kasih
															<p>&nbsp;</p>
														</p>
														<br>
														<div class="mcnButtonContent" style="font-size:14px;padding:15px;" align="center"><a class="mcnButton" href="'.base_url('cms/alumni').'" target="_blank" style="border-collapse:separate !important;border-radius:9px;padding:15px;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#377dff;font-weight:bold;letter-spacing:0px;line-height:100%;text-align:center;text-decoration:none;color:#fff;">Kembali Ke Website </a>
														</div>
														<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
																<tr>
																		<td width="50%" align="left">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('news').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-info.jpg" style="" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																		<td width="50%" align="right">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('events').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-event.jpg" style="padding-bottom: 0;" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																</tr>
														</table>
														<br>
														<div class="soc" style="padding-top:20px;padding-bottom:10px; border-top:thin solid #ccc;border-bottom:thin solid #ccc;">
																<table cellspacing="0" cellpadding="0" border="0" align="center">
																		<tbody>
																				<tr>
																						<td valign="top" align="center">
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://www.facebook.com/DPPIKAUII" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconfb.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconfb.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="hhttps://id.linkedin.com/in/dppikauii" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconli.png" style="display:block" width="24" height="24" class="CToWUd" alt="icontw.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://twitter.com/DPPIKAUII_" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Icontw.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconig.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																						</td>
																				</tr>
																		</tbody>
																</table>
														</div>
														<div style="text-align: center;margin-top:1em"><span style="color:#000000"><span style="font-size:10px">© 2020. IKA UII. All rights reserved.</span></span></div>
												</div>
										</td>
								</tr>
						</table>
				</body>
				</html>';

			$send_to_admin = send_mail($from, __EMAIL_ADMIN__, 'Hai Admin, '.$data['name'].' Telah Mendaftar Untuk Pembuatan KTA UII', $html_content);

			// email to admin 2
			$from = $data['email'];
			$html_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
				<head>
						<!-- This is a simple example template that you can edit to create your own custom templates -->
						<meta http-equiv="content-type" content="text/html; charset=UTF-8">
						<!-- Facebook sharing information tags -->
						<meta property="og:title" content="*|MC:SUBJECT|*">
						<link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
						<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
						<title>Emai Subject</title>

						<style type="text/css">
								* {
										font-family: \'Lato\', sans-serif;
										font-weight: 400;
								}

								img {
										max-width: 100%;
								}

								.collapse {
										padding-right: 15px;
										padding: 0;
								}

								body {
										-webkit-font-smoothing: antialiased;
										-webkit-text-size-adjust: none;
										width: 100% !important;
										height: 100%;
								}

								a {
										color: #323232;
										font-size: 12px;
								}

								.bt {
										padding-top: 10px;
								}

								p.callout {
										padding: 9px;
										font-size: 12px;
								}

								p.text {
										padding-left: 5px;
										font-size: 14px;
								}

								p.left {
										padding: 5px;
										font-size: 12px;
										text-align: left;
								}

								.prod {
										margin: 0;
										padding: 0;
										color: #aaaaaa;
								}

								.callout a {
										font-weight: bold;
										color: #aaaaaa;
								}

								table.head-wrap {
										width: 100%;
								}

								.header.container table td.logo {
										padding: 15px;
								}

								.header.container table td.label {
										padding: 15px;
										padding-left: 0;
								}

								table.body-wrap {
										width: 100%;
								}

								table.footer-wrap {
										width: 100%;
										background-color: #f5f5f5;
										height: 50px;
										border-top: 2px solid #929292;
								}

								table.footer-wrap2 {
										width: 100%;
								}

								h1,
								h2,
								h3,
								h4,
								h5,
								h6 {
										font-family: \'Lato\', sans-serif;
										font-weight: 700;
										line-height: 1.1;
										color: #000;
								}

								h1 small,
								h2 small,
								h3 small,
								h4 small,
								h5 small,
								h6 small {
										font-size: 60%;
										color: #197089;
										line-height: 0;
										text-transform: none;
								}

								h1 {
										font-weight: 400;
										font-size: 24px;
										padding: 15px 0;
										color: #166d88;
								}

								h2 {
										font-weight: 200;
										font-size: 37px;
										margin: 0;
								}

								h3 {
										font-weight: 500;
										font-size: 27px;
								}

								h4 {
										font-weight: 500;
										font-size: 23px;
								}

								h5 {
										font-weight: 900;
										font-size: 13px;
										color: #c2a67e;
										background-color: #f5f5f5;
								}

								h6 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
								}

								h7 {
										font-weight: 900;
										font-size: 14px;
										text-transform: uppercase;
										color: #444;
										padding: 5px;
								}

								.collapse {
										margin: 0 !important;
								}

								p,
								ul {
										font-weight: normal;
										font-size: 12px;
										line-height: 1.6;
								}

								p.lead {
										font-size: 13px;
								}

								p.last {
										margin-bottom: 0;
								}

								ul li {
										margin-left: 5px;
										list-style-position: inside;
								}

								.container {
										display: block !important;
										max-width: 600px !important;
										margin: 0 auto !important;
										clear: both !important;
								}

								.content {
										padding: 15px;
										max-width: 600px;
										margin: 0 auto;
										display: block;
								}

								.content table {
										width: 100%;
								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col3] {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												padding-top: 15px;
												margin-top: 15px;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=col2] {
												width: 100% !important;
												float: left;
												text-align: left;
										}

								}

								@media only screen and (max-width:600px) {
										[class=desc] {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col3 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
												margin-top: 15px !important;
												padding-top: 15px !important;
										}

								}

								@media only screen and (max-width:600px) {
										.col2 {
												width: 100% !important;
												float: left !important;
												text-align: left !important;
										}

								}

								@media only screen and (max-width:600px) {
										p.desc {
												display: none !important;
												height: 0;
												overflow: hidden;
										}

								}

								@media only screen and (max-device-width: 480px) {
										.hide {
												max-height: none !important;
												font-size: 12px !important;
												display: block !important;
										}

								}

								.hide {
										max-height: 0;
										font-size: 0;
										display: none;
								}

								.column {
										width: 49%;
										float: left;
										padding-bottom: 10px;
								}

								.col3 {
										width: 35%;
										float: right;
										text-align: right;
								}

								.col2 {
										width: 65%;
										float: left;
								}

								.column-wrap {
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.column3 {
										width: 300px;
										float: left;
								}

								.column3 tr td {
										padding: 1px;
								}

								.column3-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column3 table {
										width: 100%;
								}

								.column2 {
										width: 240px;
										float: left;
								}

								.column2 tr td {
										padding: 5px;
								}

								.column2-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.column2 table {
										width: 100%;
								}

								.social .column {
										float: left;
								}

								.prod {
										width: 200px;
										float: left;
								}

								.prod tr td {
										padding: 5px;
								}

								.prod-wrap {
										padding: 0 !important;
										margin: 0 auto;
										max-width: 600px !important;
								}

								.prod table {
										width: 100%;
								}

								.prod .column {
										width: 200px;
										float: left;
								}

								.clear {
										display: block;
										clear: both;
								}

								.imgPromo {
										width: 100%;
								}

								.imgPromo img {
										display: inline;
										width: calc(33.33% - 4px);
										margin-right: 1px;
								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										.imgPromo img {
												width: 100% !important;
												margin-bottom: 5px;
										}

								}

								@media only screen and (max-width:600px) {
										a[class=btn] {
												display: block !important;
												margin-bottom: 10px !important;
												background-image: none !important;
												margin-right: 0 !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.column {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column] {
												width: 100% !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column2] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										div[class=column3] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										table[class=top] {
												width: auto !important;
												float: none !important;
										}

								}

								@media only screen and (max-width:600px) {
										.prod {
												width: 150px;
												float: left;
										}

								}

								@media only screen and (max-width:600px) {
										table.social div[class=column] {
												width: auto !important;
										}

								}
						</style>
				</head>

				<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
						<table bgcolor="#ffffff" class="body-wrap container">
								<tr>
										<td>
												<div style="text-align:center;">
														<img src="https://storage.googleapis.com/bsdn/ikauii/img/banner-email-ikauii.png" style="width: 60%;max-width: 100%;margin: 0 auto;">
														<h2 style="font-size:18px;color:#000;padding-bottom:5px;"><b style="font-weight:700;">Selamat, '.$data['name'].' Telah Berhasil Mendaftarkan Untuk Pembuatan KTA UII</b></h2>
														<br>
														<p style="font-size:16px;color:#323232;">
															<p>&nbsp;</p>
																Admin, '.$data['name'].' telah berhasil melakukan registrasi KTA UII.<br>
																Mohon untuk segera menindak lanjuti pesan tersebut.<br>
																Terima kasih
															<p>&nbsp;</p>
														</p>
														<br>
														<div class="mcnButtonContent" style="font-size:14px;padding:15px;" align="center"><a class="mcnButton" href="'.base_url('cms/alumni').'" target="_blank" style="border-collapse:separate !important;border-radius:9px;padding:15px;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#377dff;font-weight:bold;letter-spacing:0px;line-height:100%;text-align:center;text-decoration:none;color:#fff;">Kembali Ke Website </a>
														</div>
														<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
																<tr>
																		<td width="50%" align="left">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('news').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-info.jpg" style="" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																		<td width="50%" align="right">
																				<div style="margin-top:1em;">
																						<a href="'.base_url('events').'" title="" target="_blank">
																								<img alt="" src="https://storage.googleapis.com/bsdn/afpi/email/banner-event.jpg" style="padding-bottom: 0;" class="mcnImage" width="95%"></a>
																				</div>
																		</td>
																</tr>
														</table>
														<br>
														<div class="soc" style="padding-top:20px;padding-bottom:10px; border-top:thin solid #ccc;border-bottom:thin solid #ccc;">
																<table cellspacing="0" cellpadding="0" border="0" align="center">
																		<tbody>
																				<tr>
																						<td valign="top" align="center">
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://www.facebook.com/DPPIKAUII" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconfb.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconfb.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="hhttps://id.linkedin.com/in/dppikauii" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Iconli.png" style="display:block" width="24" height="24" class="CToWUd" alt="icontw.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																								<table style="display:inline;" cellspacing="0" cellpadding="0" border="0" align="left">
																										<tbody>
																												<tr>
																														<td style="padding-right:10px;padding-bottom:9px;" valign="top">
																																<table width="100%" cellspacing="0" cellpadding="0" border="0">
																																		<tbody>
																																				<tr>
																																						<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;" valign="middle" align="left">
																																								<table cellspacing="0" cellpadding="0" border="0" align="left">
																																										<tbody>
																																												<tr>
																																														<td width="24" valign="middle" align="center">
																																																<a href="https://twitter.com/DPPIKAUII_" target="_blank"><img src="https://storage.googleapis.com/bsdn/afpi/email/Icontw.png" style="display:block" width="24" height="24" class="CToWUd" alt="iconig.png"></a>
																																														</td>
																																												</tr>
																																										</tbody>
																																								</table>
																																						</td>
																																				</tr>
																																		</tbody>
																																</table>
																														</td>
																												</tr>
																										</tbody>
																								</table>
																						</td>
																				</tr>
																		</tbody>
																</table>
														</div>
														<div style="text-align: center;margin-top:1em"><span style="color:#000000"><span style="font-size:10px">© 2020. IKA UII. All rights reserved.</span></span></div>
												</div>
										</td>
								</tr>
						</table>
				</body>
				</html>';

			$send_to_admin = send_mail($from, __EMAIL_ADMIN_2__, 'Hai Admin, '.$data['name'].' Telah Mendaftar Untuk Pembuatan KTA UII', $html_content);

			$this->session->set_flashdata('success', true);
			redirect(base_url('register-alumni-non-wisudawan'));
		}
		$this->session->set_flashdata('error', true);
		redirect(base_url('register-alumni-non-wisudawan'));
	}

	public function events($page = 1) {
		$this->load->model([
			'events_model',
			'banners_model'
		]);
		$vars['banner'] = $this->banners_model->get_active_data('3');

		$page = abs((int)$page);
		$limit = 12;
		$offset = $page <= 1 ? 0 : (($page - 1) * $limit);

		$query 	= $this->input->get('query', true);
		$sort		= $this->input->get('sort', true);

		$vars['data'] = $this->events_model->get_data_publish($offset, $limit, $query, $sort);
		$vars['total_data'] = $this->events_model->get_total_data_publish($query);
		$vars['paging'] = paging([
				'first_url' => base_url('events?query='.$query.'&sort='.$sort),
				'base_url' => base_url('events/page'),
				'total_rows' => $vars['total_data'],
				'per_page' => $limit,
				'uri_segment' => 3,
				'reuse_query_string' => TRUE
		]);
		$this->load->view('events', $vars);
	}

	public function events_detail($slug) {
		$this->load->model([
			'events_model'
		]);
		$vars['data'] = $this->events_model->get_publish_data_slug($slug);
		$vars['others'] = $this->events_model->get_data_publish_rand(3,$slug);
		if(!$vars['data']){
			redirect(base_url('events'));
		}
		$vars['meta'] = array(
			'title'	=> $vars['data']['title'],
			'type'	=> 'event',
			'image'	=> $vars['data']['image'],
			'url'		=>	base_url('events/detail/'.$vars['data']['slug'])
		);
		$this->load->view('events_detail', $vars);
	}
	public function news($page = 1) {
		$this->load->model([
			'news_model',
			'banners_model'
		]);
		$vars['banner'] = $this->banners_model->get_active_data('2');

		$page = abs((int)$page);
		$limit = 12;
		$offset = $page <= 1 ? 0 : (($page - 1) * $limit);

		$query 	= $this->input->get('query', true);
		$sort		= $this->input->get('sort', true);
		$tag 		= $this->input->get('tag', true);

		$vars['data'] = $this->news_model->get_data_publish($offset, $limit, $query, $sort, $tag);
		$vars['total_data'] = $this->news_model->get_total_data_publish($query, $tag);
		$vars['paging'] = paging([
				'first_url' => base_url('news?query='.$query.'&sort='.$sort.'&tag='.$tag),
				'base_url' => base_url('news/page'),
				'total_rows' => $vars['total_data'],
				'per_page' => $limit,
				'uri_segment' => 3,
				'reuse_query_string' => TRUE
		]);
		$this->load->view('news', $vars);
	}

	public function news_detail($slug) {
		$this->load->model([
			'news_model'
		]);
		$vars['data'] = $this->news_model->get_publish_data_slug($slug);
		$vars['others'] = $this->news_model->get_data_publish_rand(3,$slug);
		if(!$vars['data']){
			redirect(base_url('news'));
		}
		$vars['meta'] = array(
			'title'	=> $vars['data']['title'],
			'type'	=> 'news',
			'image'	=> $vars['data']['image'],
			'url'		=>	base_url('news/detail/'.$vars['data']['slug'])
		);
		$this->load->view('news_detail', $vars);
	}

	public function quotes($page = 1) {
		$this->load->model([
			'quotes_model',
			'banners_model'
		]);
		$vars['banner'] = $this->banners_model->get_active_data('6');

		$page = abs((int)$page);
		$limit = 12;
		$offset = $page <= 1 ? 0 : (($page - 1) * $limit);

		$query 	= $this->input->get('query', true);
		$sort		= $this->input->get('sort', true);

		$vars['data'] = $this->quotes_model->get_data_publish($offset, $limit, $query, $sort);
		$vars['total_data'] = $this->quotes_model->get_total_data_publish($query);
		$vars['paging'] = paging([
				'first_url' => base_url('profile-alumni?query='.$query.'&sort='.$sort),
				'base_url' => base_url('profile-alumni/page'),
				'total_rows' => $vars['total_data'],
				'per_page' => $limit,
				'uri_segment' => 3,
				'reuse_query_string' => TRUE
		]);
		$this->load->view('quotes', $vars);
	}

	public function quotes_detail($slug) {
		$this->load->model([
			'quotes_model'
		]);
		$vars['data'] = $this->quotes_model->get_publish_data_slug($slug);
		$vars['others'] = $this->quotes_model->get_data_publish_rand(3, $slug);
		if(!$vars['data']){
			redirect(base_url('profile-alumni'));
		}
		$vars['meta'] = array(
			'title'	=> $vars['data']['name'],
			'type'	=> 'quotes',
			'image'	=> $vars['data']['image'],
			'url'		=>	base_url('profile-alumni/detail/'.$vars['data']['slug'])
		);
		$this->load->view('quotes_detail', $vars);
	}

	public function central_man($page = 1)
	{
		$this->load->model([
			'management_model'
		]);

		$page = abs((int)$page);
		$limit = 1000;
		$offset = $page <= 1 ? 0 : (($page - 1) * $limit);

		$q = '';
		if($this->input->get('query')!=''){
			$q=$this->input->get('query');
		}

		$p = '';
		if($this->input->get('position')!=''){
			$p =$this->input->get('position');
		}

		$vars['data'] = $this->management_model->get_data_publish($offset, $limit, $q, null, $p, null, 'C');
		$vars['total_data'] = $this->management_model->get_total_data_publish($q, $p, null, 'C');
		$vars['paging'] = paging([
				'first_url' => base_url('central-management'),
				'base_url' => base_url('central-management/page'),
				'total_rows' => $vars['total_data'],
				'per_page' => $limit
		]);
		$vars['position'] = $this->management_model->get_position(1);
		$this->load->view('central_man', $vars);
	}

	public function regional_man($page = 1)
	{
		$this->load->model([
			'management_model'
		]);

		$page = abs((int)$page);
		$limit = 1000;
		$offset = $page <= 1 ? 0 : (($page - 1) * $limit);

		$q = '';
		if($this->input->get('query')!=''){
			$q=$this->input->get('query');
		}

		$p = '';
		if($this->input->get('position')!=''){
			$p =$this->input->get('position');
		}

		$pp = '';
		if($this->input->get('location')!=''){
			$pp =$this->input->get('location');
		}

		$vars['data'] = $this->management_model->get_data_publish($offset, $limit, $q, null, $p, $pp, 'R');
		$vars['total_data'] = $this->management_model->get_total_data_publish($p, $p, $pp, 'R');
		$vars['paging'] = paging([
				'first_url' => base_url('regional-management'),
				'base_url' => base_url('regional-management/page'),
				'total_rows' => $vars['total_data'],
				'per_page' => $limit
		]);
		$vars['position'] = $this->management_model->get_position(2);
		$vars['province'] = $this->management_model->get_province();
		if($pp !=''){
			$vars['province_active'] = $this->management_model->get_province_id($pp);
		}else{
			$vars['province_active'] = $this->management_model->get_province_id(31);
		}
		$this->load->view('regional_man', $vars);
	}
	public function aboutus()
	{
		$this->load->view('aboutus');
	}
	public function general_policy()
	{
		$this->load->view('general_policy');
	}

	public function pendidikan_umum()
	{
		$this->load->view('pendidikan_umum');
	}
	public function pendidikan_khusus()
	{
		$this->load->view('pendidikan_khusus');
	}




}
