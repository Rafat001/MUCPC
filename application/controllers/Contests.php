<?php
include_once('simple_html_dom.php');
class Contests extends CI_Controller
{
				public function __construct()
				{
								date_default_timezone_set("Asia/Dhaka");
								parent::__construct();
								$this->load->model('Task_model');
								$this->load->model('Auth_model');
								$this->load->model('Contest_model');
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
				public function contestRegister()
				{
								if ($this->session->userdata('role') != 'user') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('contest_id', 'Contest_id', 'required');
								$this->form_validation->set_rules('phone', 'Phone', 'required');
								$this->form_validation->set_rules('batch', 'Batch', 'required');
								$this->form_validation->set_rules('department', 'Department', 'required');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('contests'));
								}
								$username = $this->session->userdata('username');
								$data     = array(
												"contest_id" => htmlentities($this->input->post('contest_id')),
												"username" => $username,
												"phone" => htmlentities($this->input->post('phone')),
												"department" => htmlentities($this->input->post('department')),
												"batch" => htmlentities($this->input->post('batch'))
								);
								if ($this->Contest_model->register_contest($data) != false) {
												$user = array(
																'success_msg' => "Registration Done Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('contest/' . htmlentities($this->input->post('contest_id'))));
								} else {
												redirect(base_url('contests'));
								}
				}
				public function create()
				{
								if ($this->session->userdata('role') != '' && ($this->session->userdata('role') == "user" || $this->session->userdata('role') == "mentor")) {
												redirect(base_url());
								}
								$this->form_validation->set_rules('name', 'Name', 'required');
								$this->form_validation->set_rules('duration', 'Duration', 'required');
								$this->form_validation->set_rules('details', 'Details', '');
								$this->form_validation->set_rules('registration_deadline', 'Registration Deadline', 'required');
								$this->form_validation->set_rules('start_on', 'Start On', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('contests'));
								}
								if ($this->Contest_model->get_contest_by_id(array(
												"id" => $contest_id
								)) != false) {
												redirect(base_url());
								}
								$data = array(
												"name" => htmlentities($this->input->post('name')),
												"created_by" => htmlentities($this->input->post('created_by')),
												"start_on" => htmlentities($this->input->post('start_on')),
												"registration_deadline" => htmlentities($this->input->post('registration_deadline')),
												"details" => htmlentities($this->input->post('details')),
												"duration" => htmlentities($this->input->post('duration'))
								);
								if ($this->Contest_model->insert_contest($data) != false) {
												$user = array(
																'success_msg' => $name . " Created Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('contests'));
								} else {
												redirect(base_url('contests'));
								}
				}
				public function update($contest_id)
				{
								if ($this->session->userdata('role') != '' && ($this->session->userdata('role') == "user" || $this->session->userdata('role') == "mentor")) {
												redirect(base_url());
								}
								$this->form_validation->set_rules('name', 'Name', 'required');
								$this->form_validation->set_rules('duration', 'Duration', 'required');
								$this->form_validation->set_rules('details', 'Details', '');
								$this->form_validation->set_rules('registration_deadline', 'Registration Deadline', 'required');
								$this->form_validation->set_rules('start_on', 'Start On', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->Contest_model->get_contest_by_id(array(
												"id" => $contest_id
								)) == false) {
												redirect(base_url());
								}
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('contests'));
								}
								$data = array(
												"name" => htmlentities($this->input->post('name')),
												"created_by" => htmlentities($this->input->post('created_by')),
												"start_on" => htmlentities($this->input->post('start_on')),
												"registration_deadline" => htmlentities($this->input->post('registration_deadline')),
												"details" => htmlentities($this->input->post('details')),
												"duration" => htmlentities($this->input->post('duration')),
												"standings" => htmlentities($this->input->post('standings')),
												"problems" => htmlentities($this->input->post('problems'))
								);
								if ($this->Contest_model->update($data, $contest_id) != false) {
												$user = array(
																'success_msg' => "Contest Updated Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('contest/' . $contest_id));
								} else {
												redirect(base_url('contests'));
								}
				}
				public function view($id = '')
				{
								$data          = array(
												'id' => $id
								);
								$this->title   = "Contest";
								$this->contest = $this->Contest_model->get_contest_by_id($data);
								if ($this->contest == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/viewContest', $data);
								$this->load->view('templates/footer', $data);
				}
				public function delete($contest_id)
				{
								if ($this->session->userdata('role') != '' && ($this->session->userdata('role') == "user" || $this->session->userdata('role') == "mentor")) {
												redirect(base_url());
								}
								if ($this->Contest_model->get_contest_by_id(array(
												"id" => $contest_id
								)) == false) {
												redirect(base_url());
								}
								$this->Contest_model->delete_contest($contest_id);
								$user = array(
												'success_msg' => "Contest Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('contests'));
				}
}
