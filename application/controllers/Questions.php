<?php
include_once('simple_html_dom.php');
class Questions extends CI_Controller
{
				public function __construct()
				{
								date_default_timezone_set("Asia/Dhaka");
								parent::__construct();
								$this->load->model('Question_model');
								$this->load->model('Task_model');
								$this->load->model('Auth_model');
								$this->load->model('User_model');
								$this->load->model('Question_model');
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
				public function delete_by_admin($question_id)
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->Question_model->get_question_by_id(array(
												"id" => $question_id
								)) == false && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$this->Question_model->delete_question($question_id);
								$user = array(
												'success_msg' => "Question Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('admin/question'));
				}
				public function addHelpful() {
					$check_helpful = $this->Question_model->get_helpful(array("answer_id" => $this->input->post('answer_id'), "created_by" => $this->input->post('created_by'), "liked_by" => $this->username));
					if($check_helpful != false) {
						redirect(base_url());
					}
					$this->Question_model->insert_helpful(array("answer_id" => $this->input->post('answer_id'), "created_by" => $this->input->post('created_by'), "liked_by" => $this->username));
					redirect(base_url('question/' . $this->input->post('question_id')));
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
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('question/' . $this->input->post('question_id')));
								}
								if ($this->Question_model->insert_question($data) != false) {
												$user = array(
																'success_msg' => "Question Created Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('discussions'));
								} else {
												redirect(base_url());
								}
				}
				public function edit()
				{
								if ($this->session->userdata('username') == '') {
												redirect(base_url());
								}
								if ($this->Question_model->get_question_by_id(array(
												"created_by" => $this->username,
												"id" => $this->input->post('question_id')
								)) == false) {
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
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('question/' . $this->input->post('question_id')));
								}
								if ($this->Question_model->update_question($data, $this->input->post('question_id')) != false) {
												$user = array(
																'success_msg' => "Question Updated Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('question/' . $this->input->post('question_id')));
								} else {
												redirect(base_url());
								}
				}
				public function delete($question_id)
				{
								if ($this->session->userdata('username') == '') {
												redirect(base_url());
								}
								if ($this->Question_model->get_question_by_id(array(
												"created_by" => $this->username,
												"id" => $question_id
								)) == false && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$this->Question_model->delete_question($question_id);
								$user = array(
												'success_msg' => "Question Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('discussions'));
				}
				public function newAnswer()
				{
								if ($this->session->userdata('username') == '') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('question_id', 'Question ID', 'required');
								$this->form_validation->set_rules('body', 'Answer Body', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								$data = array(
												"question_id" => htmlentities($this->input->post('question_id')),
												"body" => htmlentities($this->input->post('body')),
												"created_by" => $this->username
								);
								if ($this->Question_model->get_question_by_id(array(
												"id" => $this->input->post('question_id')
								)) == false) {
												redirect(base_url());
								}
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('question/' . $this->input->post('question_id')));
								}
								if ($this->Question_model->insert_answer($data) != false) {
												redirect(base_url('question/' . $this->input->post('question_id')));
								} else {
												redirect(base_url());
								}
				}
				public function view($id = '')
				{
								$data        = array(
												'id' => $id
								);
								$this->title = "Question";
								$this->question  = $this->Question_model->get_question_by_id($data);
								if ($this->question == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/question', $data);
								$this->load->view('templates/footer', $data);
				}
				public function view_all($pno = 1)
				{
								$this->pno = $pno;
								$this->title = "Discussions";
								$data['id'] = '';
								$this->load->view('templates/header', $data);
								$this->load->view('pages/discussions', $data);
								$this->load->view('templates/footer', $data);
				}
}
