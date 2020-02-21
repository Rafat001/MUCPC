<?php
set_time_limit(0);
include_once('simple_html_dom.php');
class Tasks extends CI_Controller
{
				public function __construct()
				{
								date_default_timezone_set("Asia/Dhaka");
								parent::__construct();
								$this->load->model('Task_model');
								$this->load->model('Team_model');
								$this->load->model('Auth_model');
								$this->load->model('Group_model');
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
				public function suggest($task_id)
				{
								$postData = $this->input->post();
								$data     = $this->Task_model->getUsers($postData, $task_id);
								echo json_encode($data);
				}
				public function suggestTeam($task_id)
				{
								$postData = $this->input->post();
								$data     = $this->Task_model->getTeams($postData, $task_id);
								echo json_encode($data);
				}
				public function suggestGroup($task_id)
				{
								$postData = $this->input->post();
								$data     = $this->Task_model->getGroups($postData, $task_id);
								echo json_encode($data);
				}
				public function create()
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('name', 'Name', 'required');
								$this->form_validation->set_rules('duration', 'Duration', 'required');
								$this->form_validation->set_rules('no_of_problems', 'No. of problems', 'required');
								$this->form_validation->set_rules('type', 'Type', 'required');
								$this->form_validation->set_rules('start_on', 'Start On', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								$num      = $this->input->post('no_of_problems');
								$problems = "";
								for ($i = 1; $i <= $num; $i++) {
												$problems = $problems . '[' . $this->input->post('oj' . $i) . '-' . $this->input->post('problem' . $i) . ']';
								}
								$name           = htmlentities($this->input->post('name'));
								$duration       = htmlentities($this->input->post('duration'));
								$no_of_problems = htmlentities($this->input->post('no_of_problems'));
								$start_on       = $this->input->post('start_on');
								$type           = 0;
								if ($this->input->post('type') == "Public")
												$type = 1;
								$problems_json = '{"status":"OK","result":[';
								$problems_name = $problems;
								$pname         = "";
								$error_msg = "";
								for ($i = 0; $i < strlen($problems_name); $i++) {
												if ($problems_name[$i] == '[') {
																$oj = "";
																$i++;
																while ($problems_name[$i] != '-') {
																				$oj = $oj . $problems_name[$i];
																				$i++;
																}
																$i++;
																$pid = "";
																$idx = "";
																while ($problems_name[$i] >= '0' && $problems_name[$i] <= '9') {
																				$pid = $pid . $problems_name[$i];
																				$i++;
																}
																while ($problems_name[$i] != ']') {
																				$idx = $idx . $problems_name[$i];
																				$i++;
																}
																$pname = "";
																$url   = "";
																if ($oj == "Codeforces") {
																				$html   = file_get_html('https://codeforces.com/problemset/problem/' . $pid . '/' . $idx);
																				$url    = 'https://codeforces.com/problemset/problem/' . $pid . '/' . $idx;
																				$findme = '<div class="title">';
																				$pos    = strpos($html, $findme);
																				if ($pos == false) {
																								$error_msg = $error_msg . $oj . " " . $pid . $idx . " is a invalid problem!<br>"  ;
																								continue;
																				}
																				$pos += strlen($findme);
																				$str = strval($html);
																				while ($str[$pos] != ' ') {
																								$pos++;
																				}
																				$pos++;
																				while ($str[$pos] != '<') {
																								$pname = $pname . $str[$pos];
																								$pos++;
																				}
																				if (trim($pname) == "") {
																								$error_msg = $error_msg . $oj . " " . $pid . $idx . " is a invalid problem!<br>"  ;
																								continue;
																				}
																} else {
																				$html  = file_get_html('https://uhunt.onlinejudge.org/api/p/num/' . $pid);
																				$json  = str_replace(array(
																								"\t",
																								"\n"
																				), "", $html);
																				$data  = json_decode($json);
																				$url   = $data->pid;
																				$pname = $data->title;
																				if ($pname == "") {
																								$error_msg = $error_msg . $oj . " " . $pid . $idx . " is a invalid problem!<br>"  ;
																								continue;
																				}
																}
																$problems_json = $problems_json . '{"oj":"' . $oj . '","pid":"' . $pid . '","idx":"' . $idx . '","name":"' . $pname . '","url":"' . $url . '"}';
																$num--;
																$problems_json = $problems_json . ",";
												}
								}
								if($problems_json[strlen($problems_json) - 1] == ',') {
									$problems_json[strlen($problems_json) - 1] = ']';
									$problems_json = $problems_json . "}";
								}
								else {
									$problems_json = $problems_json . "]}";
								}
								$data          = array(
												"name" => $name,
												"coach" => $this->username,
												"start_on" => $start_on,
												"problems" => $problems_json,
												"duration" => $duration,
												"public" => $type
								);
								if ($this->Task_model->insert_task($data) != false) {

																								if(strlen($error_msg) != "") {

												$user = array(
																'error_msg' => $error_msg
												);
												$this->session->set_userdata($user);
																								}
												$user = array(
																'success_msg' => $name . " Created Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('training'));
								}
				}
				public function update($task_id)
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('name', 'Name', 'required');
								$this->form_validation->set_rules('duration', 'Duration', 'required');
								$this->form_validation->set_rules('type', 'Type', 'required');
								$this->form_validation->set_rules('start_on', 'Start On', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('mentoring'));
								}
								if ($this->Task_model->get_task_by_id(array(
												"coach" => $this->username,
												"id" => $task_id
								)) == false && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$name           = htmlentities($this->input->post('name'));
								$duration       = htmlentities($this->input->post('duration'));
								$no_of_problems = htmlentities($this->input->post('no_of_problems'));
								$start_on       = $this->input->post('start_on');
								$type           = 0;
								if ($this->input->post('type') == "Public")
												$type = 1;
								$data = array(
												"name" => $name,
												"start_on" => $start_on,
												"duration" => $duration,
												"public" => $type
								);
								if ($this->Task_model->update($data, $task_id) != false) {
												$user = array(
																'success_msg' => "Task Updated Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('task/' . $task_id));
								}
				}
				public function delete($task_id)
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor' && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->Task_model->get_task_by_id(array(
												"coach" => $this->username,
												"id" => $task_id
								)) == false && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$this->Task_model->delete_task($task_id);
								$user = array(
												'success_msg' => "Task Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								if ($this->session->userdata('role') == 'admin')
												redirect(base_url('admin/task'));
								else if ($this->session->userdata('role') == 'coach')
												redirect(base_url('training'));
								else
												redirect(base_url('mentoring'));
				}
				public function removeParticipant($task_id, $username)
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor' && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->Task_model->get_task_by_id(array(
												"coach" => $this->username,
												"id" => $task_id
								)) == false && $this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->Task_model->check_participant(array(
												"username" => $username,
												"task_id" => $task_id
								)) == false) {
												redirect(base_url());
								}
								$this->Task_model->delete_task_participant($task_id, $username);
								$user = array(
												'success_msg' => "Participant Removed Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('task/' . $task_id));
				}
				public function view($id = '')
				{
								$data        = array(
												'id' => $id
								);
								$this->title = "Task";
								if ($this->Task_model->check_participant(array(
												"username" => $this->username,
												"task_id" => $id
								)) == false && $this->session->userdata('role') == 'user') {
												redirect(base_url());
								}
								$this->task = $this->Task_model->get_task_by_id($data);
								if ($this->task == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/task', $data);
								$this->load->view('templates/footer', $data);
				}
				public function standings($id = '')
				{
								$data        = array(
												'id' => $id
								);
								$this->title = "Task";
								$this->task  = $this->Task_model->get_task_by_id($data);
								if ($this->task == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/standings', $data);
								$this->load->view('templates/footer', $data);
				}
				public function createAnnouncement()
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('task_id', 'Task ID', 'required');
								$this->form_validation->set_rules('body', 'Body', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('mentoring'));
								}
								$data = array(
												"task_id" => htmlentities($this->input->post('task_id')),
												"body" => htmlentities($this->input->post('body')),
												"created_by" => $this->username
								);
								if ($this->Task_model->get_task_by_id(array(
												"id" => $this->input->post('task_id')
								)) == false) {
												redirect(base_url());
								}
								if ($this->Task_model->insert_announcement($data) != false) {
												$user = array(
																'success_msg' => "Announcement Created Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('task/' . $this->input->post('task_id')));
								} else {
												redirect(base_url());
								}
				}
				public function invite()
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('task_id', 'Task ID', 'required');
								$this->form_validation->set_rules('username', 'Username', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('mentoring'));
								}
								$data = array(
												"task_id" => htmlentities($this->input->post('task_id')),
												"username" => htmlentities($this->input->post('username'))
								);
								if ($this->Auth_model->get_user_by_id(array(
												"username" => $this->input->post('username')
								)) == false) {
												$user = array(
																'warning_msg' => "User Dosen't Exists!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('task/' . $this->input->post('task_id')));
								}
								if ($this->Task_model->get_task_by_id(array(
												"id" => $this->input->post('task_id')
								)) == false) {
												redirect(base_url());
								}
								if ($this->Task_model->check_participant(array(
												"username" => htmlentities($this->input->post('username')),
												"task_id" => htmlentities($this->input->post('task_id'))
								)) != false) {
												$user = array(
																'warning_msg' => "User Already Invited!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('task/' . $this->input->post('task_id')));
								}
								if ($this->Task_model->insert_participant($data) != false) {
												$user = array(
																'success_msg' => "User Invited Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('task/' . $this->input->post('task_id')));
								} else {
												redirect(base_url());
								}
				}
				public function inviteTeam()
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('task_id', 'Task ID', 'required');
								$this->form_validation->set_rules('team_id', 'Team ID', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('mentoring'));
								}
								$data = array(
												"task_id" => htmlentities($this->input->post('task_id')),
												"username" => htmlentities($this->input->post('username'))
								);
								if ($this->Task_model->get_task_by_id(array(
												"id" => $this->input->post('task_id')
								)) == false) {
												redirect(base_url());
								}
								$data = $this->Team_model->get_team_by_id(array(
												"id" => htmlentities($this->input->post('team_id'))
								));
								if ($this->Task_model->check_participant(array(
												"username" => $data->member1,
												"task_id" => htmlentities($this->input->post('task_id'))
								)) == false) {
												$insertData = array(
																"task_id" => htmlentities($this->input->post('task_id')),
																"username" => $data->member1
												);
												$this->Task_model->insert_participant($insertData);
								}
								if ($this->Task_model->check_participant(array(
												"username" => $data->member2,
												"task_id" => htmlentities($this->input->post('task_id'))
								)) == false) {
												$insertData = array(
																"task_id" => htmlentities($this->input->post('task_id')),
																"username" => $data->member2
												);
												$this->Task_model->insert_participant($insertData);
								}
								if ($this->Task_model->check_participant(array(
												"username" => $data->member3,
												"task_id" => htmlentities($this->input->post('task_id'))
								)) == false) {
												$insertData = array(
																"task_id" => htmlentities($this->input->post('task_id')),
																"username" => $data->member3
												);
												$this->Task_model->insert_participant($insertData);
								}
								$user = array(
												'success_msg' => "Users Invited Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('task/' . $this->input->post('task_id')));
				}
				public function inviteGroup()
				{
								if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'mentor') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('task_id', 'Task ID', 'required');
								$this->form_validation->set_rules('group_id', 'Group ID', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								$data = array(
												"task_id" => htmlentities($this->input->post('task_id')),
												"username" => htmlentities($this->input->post('username'))
								);
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('mentoring'));
								}
								if ($this->Task_model->get_task_by_id(array(
												"id" => $this->input->post('task_id')
								)) == false) {
												redirect(base_url());
								}
								$data = $this->Group_model->get_participation_by_id(array(
												"group_id" => htmlentities($this->input->post('group_id'))
								));
								foreach ($data as $taskMember) {
												if ($this->Task_model->check_participant(array(
																"username" => $taskMember->username,
																"task_id" => htmlentities($this->input->post('task_id'))
												)) == false) {
																$insertData = array(
																				"task_id" => htmlentities($this->input->post('task_id')),
																				"username" => $taskMember->username
																);
																$this->Task_model->insert_participant($insertData);
												}
								}
								$user = array(
												'success_msg' => "Users Invited Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('task/' . $this->input->post('task_id')));
				}
				public function register($task_id)
				{
								if ($this->session->userdata('role') != 'user') {
												redirect(base_url());
								}
								$data = array(
												"task_id" => $task_id,
												"username" => $this->username
								);
								if ($this->Task_model->get_task_by_id(array(
												"id" => $task_id
								)) == false || $this->Task_model->check_participant(array(
												"username" => $this->username,
												"task_id" => $task_id
								)) != false) {
												redirect(base_url());
								}
								if ($this->Task_model->insert_participant($data) != false) {
												$user = array(
																'success_msg' => "Registered Successfully!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('dashboard'));
								} else {
												redirect(base_url());
								}
				}
}
