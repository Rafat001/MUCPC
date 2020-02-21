<?php
include_once('simple_html_dom.php');
class News extends CI_Controller
{
				public function __construct()
				{
								date_default_timezone_set("Asia/Dhaka");
								parent::__construct();
								$this->load->model('News_model');
								$this->load->model('Task_model');
								$this->load->model('Auth_model');
								$this->load->model('User_model');
								$this->load->model('Team_model');
								$this->load->library(array(
												'form_validation',
												'session'
								));
								$this->load->helper(array(
												'url',
												'html',
												'form'
								));
								$this->db->query("SET SESSION sql_mode = ''");
								$this->username = $this->session->userdata('username');
				}
				public function create()
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('title', 'Title', 'required');
								$this->form_validation->set_rules('body', 'Body', 'required');
								$this->form_validation->set_rules('summary', 'Summary', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								$config['upload_path']   = './assets/images/news';
								$config['allowed_types'] = 'gif|jpg|png';
								$config['max_size']      = 1500;
								$config['max_width']     = 4000;
								$config['max_height']    = 4000;
								$new_name                = $this->username . "_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);
								$photo = "";
								if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
												if ($this->upload->do_upload('photo')) {
																if ($photo != "assets/images/default.png") {
																				unlink($photo);
																}
																$photo = 'assets/images/news/' . $this->upload->data('file_name');
												} else {
																$error = array(
																				'error' => $this->upload->display_errors()
																);
																$user  = array(
																				'error_msg' => $error['error']
																);
																$this->session->set_userdata($user);
																redirect(base_url('account'));
												}
								}
								$data = array(
												"title" => htmlentities($this->input->post('title')),
												"body" => htmlentities($this->input->post('body')),
												"summary" => htmlentities($this->input->post('summary')),
												"photo" => $photo,
												"created_by" => $this->username
								);
								if ($this->News_model->insert_news($data) != false) {
												$user = array(
																'success_msg' => "News Created Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('admin/news'));
								} else {
												redirect(base_url());
								}
				}
				public function edit()
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->News_model->get_news_by_id(array(
												"created_by" => $this->username,
												"id" => $this->input->post('news_id')
								)) == false) {
												redirect(base_url());
								}
								$config['upload_path']   = './assets/images/news';
								$config['allowed_types'] = 'gif|jpg|png';
								$config['max_size']      = 1500;
								$config['max_width']     = 4000;
								$config['max_height']    = 4000;
								$new_name                = $this->input->post('news_id') . "_" . date("Y_m_d", time()) . "_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);
								$photo = $this->News_model->get_news_by_id(array(
												"created_by" => $this->username,
												"id" => $this->input->post('news_id')))->photo;

								if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {

												if ($this->upload->do_upload('photo')) {
																if ($photo != "assets/images/default.png") {
																				unlink($photo);
																}
																$photo = 'assets/images/news/' . $this->upload->data('file_name');
												} else {
																$error = array(
																				'error' => $this->upload->display_errors()
																);
																$user  = array(
																				'error_msg' => $error['error']
																);
																$this->session->set_userdata($user);
																redirect(base_url('account'));
												}
								}
								$this->form_validation->set_rules('title', 'Title', 'required');
								$this->form_validation->set_rules('summary', 'Summary', 'required');
								$this->form_validation->set_rules('body', 'Body', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								$data = array(
												"title" => htmlentities($this->input->post('title')),
												"body" => htmlentities($this->input->post('body')),
												"photo" => $photo,
												"summary" => htmlentities($this->input->post('summary')),
												"created_by" => $this->username
								);
								if ($this->News_model->update_news($data, $this->input->post('news_id')) != false) {
												$user = array(
																'success_msg' => "News Updated Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('news/' . $this->input->post('news_id')));
								} else {
												redirect(base_url());
								}
				}
				public function delete($news_id)
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->News_model->get_news_by_id(array(
												"created_by" => $this->username,
												"id" => $news_id
								)) == false) {
												redirect(base_url());
								}
								$this->News_model->delete_news($news_id);
								$user = array(
												'success_msg' => "News Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url());
				}
				public function delete_by_admin($news_id)
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->News_model->get_news_by_id(array(
												"id" => $news_id
								)) == false) {
												redirect(base_url());
								}
								$this->News_model->delete_news($news_id);
								$user = array(
												'success_msg' => "News Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('admin/news'));
				}
				public function view($id = '')
				{
								$data        = array(
												'id' => $id
								);
								$this->title = "News";
								$this->news  = $this->News_model->get_news_by_id($data);
								if ($this->news == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/news', $data);
								$this->load->view('templates/footer', $data);
				}
}
