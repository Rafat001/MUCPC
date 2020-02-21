<?php
include_once('simple_html_dom.php');
class Blogs extends CI_Controller
{
				public function __construct()
				{
								date_default_timezone_set("Asia/Dhaka");
								parent::__construct();
								$this->load->model('Blog_model');
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
								if ($this->session->userdata('username') == '') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('title', 'Title', 'required');
								$this->form_validation->set_rules('body', 'Body', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								$data = array(
												"title" => htmlentities($this->input->post('title')),
												"body" => htmlentities($this->input->post('body')),
												"created_by" => $this->username
								);
								if ($this->Blog_model->insert_blog($data) != false) {
												$user = array(
																'success_msg' => "Blog Created Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('profile/' . $this->username . "/blog"));
								} else {
												redirect(base_url());
								}
				}
				public function edit()
				{
								if ($this->session->userdata('username') == '') {
												redirect(base_url());
								}
								if ($this->Blog_model->get_blog_by_id(array(
												"created_by" => $this->username,
												"id" => $this->input->post('blog_id')
								)) == false) {
												redirect(base_url());
								}
								$this->form_validation->set_rules('title', 'Title', 'required');
								$this->form_validation->set_rules('body', 'Body', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('blog/' . $this->input->post('blog_id')));
								}
								$data = array(
												"title" => htmlentities($this->input->post('title')),
												"body" => htmlentities($this->input->post('body')),
												"created_by" => $this->username
								);
								if ($this->Blog_model->update_blog($data, $this->input->post('blog_id')) != false) {
												$user = array(
																'success_msg' => "Blog Updated Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('blog/' . $this->input->post('blog_id')));
								} else {
												redirect(base_url());
								}
				}
				public function delete($blog_id)
				{
								if ($this->session->userdata('username') == '') {
												redirect(base_url());
								}
								if ($this->Blog_model->get_blog_by_id(array(
												"created_by" => $this->username,
												"id" => $blog_id
								)) == false && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$this->Blog_model->delete_blog($blog_id);
								$user = array(
												'success_msg' => "Blog Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('profile/' . $this->username . "/blog"));
				}
				public function delete_by_admin($blog_id)
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->Blog_model->get_blog_by_id(array(
												"id" => $blog_id
								)) == false) {
												redirect(base_url());
								}
								$this->Blog_model->delete_blog($blog_id);
								$user = array(
												'success_msg' => "Blog Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('admin/blog'));
				}
				public function newComment()
				{
								if ($this->session->userdata('username') == '') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('blog_id', 'Blog ID', 'required');
								$this->form_validation->set_rules('body', 'Comment Body', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');

								$data = array(
												"blog_id" => htmlentities($this->input->post('blog_id')),
												"body" => htmlentities($this->input->post('body')),
												"created_by" => $this->username
								);
								if ($this->Blog_model->get_blog_by_id(array(
												"id" => $this->input->post('blog_id')
								)) == false) {
												redirect(base_url());
								}

								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('blog/' . $this->input->post('blog_id')));
								}
								if ($this->Blog_model->insert_comment($data) != false) {
												redirect(base_url('blog/' . $this->input->post('blog_id')));
								} else {
												redirect(base_url());
								}
				}
				public function view($id = '')
				{
								$data        = array(
												'id' => $id
								);
								$this->title = "Blog";
								$this->blog  = $this->Blog_model->get_blog_by_id($data);
								if ($this->blog == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/blog', $data);
								$this->load->view('templates/footer', $data);
				}
}
