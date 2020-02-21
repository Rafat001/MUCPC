<?php
class Auth extends CI_Controller
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
								$this->username = $this->session->userdata('username');
				}
				public function login()
				{
								if ($this->session->userdata('username') != '') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('username', 'Username', 'trim|required');
								$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('login'));
								} {
												$data  = array(
																'username' => htmlspecialchars($this->input->post('username')),
																'password' => md5($this->input->post('password'))
												);
												$check = $this->Auth_model->auth_check($data);
												if ($check != false) {
																if ($check->verified == 1) {
																				$user = array(
																								'username' => $check->username,
																								'name' => $check->name,
																								'role' => $check->role,
																								'photo' => $check->photo
																				);
																				$this->session->set_userdata($user);
																				redirect(base_url());
																} else {
																				$user = array(
																								'warning_msg' => "Please verify your email first!"
																				);
																				$this->session->set_userdata($user);
																				redirect(base_url('login'));
																}
												}
												$user = array(
																'error_msg' => "Wrong username or password"
												);
												$this->session->set_userdata($user);
												redirect(base_url('login'));
								}
				}

				public function recover()
				{

								if ($this->session->userdata('username') != '') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('username', 'Username', 'trim|required');
								$this->form_validation->set_rules('email', 'Email', 'required');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('recover'));
								} {
												$data  = array(
																'username' => htmlspecialchars($this->input->post('username')),
																'email' => $this->input->post('email')
												);
												$check = $this->Auth_model->auth_check($data);
												if ($check != false) {
																if ($check->verified == 1) {
																				$email            = $this->input->post('email');
																				$username         = $this->input->post('username');
																				$set              = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
																				$code             = substr(str_shuffle($set), 0, 12) . substr(str_shuffle($set), 0, 12);
																				$user['email']    = $email;
																				$user['code']     = $code;
																				$user['active']   = false;
																				$config           = array(
																								'protocol' => 'smtp',
																								'smtp_host' => 'ssl://smtp.googlemail.com',
																								'smtp_port' => 465,
																								'smtp_user' => 'metrouni.cpc@gmail.com',
																								'smtp_pass' => 'wkidpxfdtiewqcjc',
																								'mailtype' => 'html',
																								'charset' => 'iso-8859-1',
																								'wordwrap' => TRUE
																				);
																				$message          = "
																							<html>
																							<head>
																								<title>Account Recovery Code</title>
																							</head>
																							<body>
																								<p>Dear ". $username .", recently we got a password recovery request for your account. If you requested for this, please follow the link to recover your password.</p>
																								<p style='color: red;'>If it is not you, please ignore this message.</p>
																								<h4><a style='text-decoration: none;' href='" . base_url() . "user/recovery/" . $code . "'>Recover My Account</a></h4>
																							</body>
																							</html>
																							";
																				$this->load->library('email', $config);
																				$this->email->set_newline("\r\n");
																				$this->email->from($config['smtp_user']);
																				$this->email->to($email);
																				$this->email->subject('Account Recovery Code');
																				$this->email->message($message);
																				if ($this->email->send()) {
																								$this->session->set_flashdata('message', 'Activation code sent to email');
																				} else {
																								$user = array(
																												'error_msg' => $this->email->print_debugger()
																								);
																								$this->session->set_userdata($user);
																								redirect(base_url('admin'));
																				}

																				$data = array(
																					"username" => $username,
																					"code" => $code
																				);

																				$this->Auth_model->insert_recovery_code($data);

																				$data = array(
																								'success_msg' => "Recovery email has been sent to your email"
																				);
																				$this->session->set_userdata($data);
																				redirect(base_url('login'));
																} else {
																				$user = array(
																								'warning_msg' => "Please verify your email first!"
																				);
																				$this->session->set_userdata($user);
																				redirect(base_url('recover'));
																}
												}
												$user = array(
																'error_msg' => "Wrong username or email"
												);
												$this->session->set_userdata($user);
												redirect(base_url('recover'));
								}
				}
				public function logout()
				{
								$this->session->sess_destroy();
								redirect(base_url('login'));
				}
				public function delete($username)
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								if ($this->Auth_model->get_user_by_id(array(
												"username" => $username
								)) == false) {
												redirect(base_url());
								}
								$this->Auth_model->delete_user($username);
								$user = array(
												'success_msg' => "User Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('admin?locate=user'));
				}
				public function update()
				{
								if ($this->username == '') {
												redirect(base_url());
								}
								$user = $this->Auth_model->get_user_by_id(array(
												"username" => $this->username
								));
								$this->form_validation->set_rules('name', 'Name', 'required');
								$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[6]|max_length[15]');
								$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|min_length[6]|max_length[15]');
								if ($this->session->userdata('role') == "user") {
												$this->form_validation->set_rules('student_id', 'Student ID', 'trim|required');
								}
								$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if (md5($this->input->post('password')) != $user->password) {
												$user = array(
																'error_msg' => "Wrong Current Password"
												);
												$this->session->set_userdata($user);
												redirect(base_url('account'));
								}
								if ($this->input->post('password1') != "" && $this->input->post('password1') != $this->input->post('password2')) {
												$user = array(
																'error_msg' => "Passwords did not match"
												);
												$this->session->set_userdata($user);
												redirect(base_url('account'));
								}
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('account'));
								} {
												$config['upload_path']   = './assets/images/profile';
												$config['allowed_types'] = 'gif|jpg|png';
												$config['max_size']      = 1500;
												$config['max_width']     = 4000;
												$config['max_height']    = 4000;
												$new_name                = $this->username . "_" . time();
												$config['file_name']     = $new_name;
												$this->load->library('upload', $config);
												$photo = $user->photo;
												if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
																if ($this->upload->do_upload('photo')) {
																				if ($photo != "assets/images/default.png") {
																								unlink($photo);
																				}
																				$photo = 'assets/images/profile/' . $this->upload->data('file_name');
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
												if ($this->input->post('password1') != "") {
																if ($this->session->userdata('role') == "user") {
																				$data = array(
																								'name' => htmlspecialchars($this->input->post('name')),
																								'student_id' => htmlspecialchars($this->input->post('student_id')),
																								'codeforces' => htmlspecialchars($this->input->post('codeforces')),
																								'codechef' => htmlspecialchars($this->input->post('codechef')),
																								'uva' => htmlspecialchars($this->input->post('uva')),
																								'spoj' => htmlspecialchars($this->input->post('spoj')),
																								'topcoder' => htmlspecialchars($this->input->post('topcoder')),
																								'toph' => htmlspecialchars($this->input->post('toph')),
																								'lightoj' => htmlspecialchars($this->input->post('lightoj')),
																								'password' => md5($this->input->post('password1')),
																								'photo' => $photo
																				);
																} else {
																				$data = array(
																								'name' => htmlspecialchars($this->input->post('name')),
																								'student_id' => htmlspecialchars($this->input->post('student_id')),
																								'password' => md5($this->input->post('password1')),
																								'photo' => $photo
																				);
																}
												} else {
																if ($this->session->userdata('role') == "user") {
																				$data = array(
																								'name' => htmlspecialchars($this->input->post('name')),
																								'student_id' => htmlspecialchars($this->input->post('student_id')),
																								'codeforces' => htmlspecialchars($this->input->post('codeforces')),
																								'codechef' => htmlspecialchars($this->input->post('codechef')),
																								'uva' => htmlspecialchars($this->input->post('uva')),
																								'spoj' => htmlspecialchars($this->input->post('spoj')),
																								'topcoder' => htmlspecialchars($this->input->post('topcoder')),
																								'toph' => htmlspecialchars($this->input->post('toph')),
																								'lightoj' => htmlspecialchars($this->input->post('lightoj')),
																								'photo' => $photo
																				);
																} else {
																				$data = array(
																								'name' => htmlspecialchars($this->input->post('name')),
																								'student_id' => htmlspecialchars($this->input->post('student_id')),
																								'photo' => $photo
																				);
																}
												}
												if ($this->Auth_model->update_profile($data)) {
																$user = array(
																				'name' => htmlspecialchars($this->input->post('name')),
																				'photo' => $photo,
																				'success_msg' => "Profile Updated"
																);
																$this->session->set_userdata($user);
												} else {
																$user = array(
																				'error_msg' => "Error Occured"
																);
																$this->session->set_userdata($user);
												}
												redirect(base_url('account'));
								}
				}
				public function changeRole($role, $username)
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$data = array(
												'role' => $role
								);
								if ($this->Auth_model->changeRole($data, $username)) {
												$user = array(
																'success_msg' => "Role Changed"
												);
												$this->session->set_userdata($user);
								} else {
												$user = array(
																'error_msg' => "Error Occured"
												);
												$this->session->set_userdata($user);
								}
								redirect(base_url('admin?locate=user'));
				}

				public function changeActive($is_active, $username)
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$data = array(
												'is_active' => $is_active
								);
								if ($this->Auth_model->changeActive($data, $username)) {
												$user = array(
																'success_msg' => "Active Status Changed"
												);
												$this->session->set_userdata($user);
								} else {
												$user = array(
																'error_msg' => "Error Occured"
												);
												$this->session->set_userdata($user);
								}
								redirect(base_url('admin?locate=user'));
				}
				
				public function activate($code)
				{
								if ($this->session->userdata('username') != '') {
												redirect(base_url());
								}
								$user = $this->Auth_model->get_user_by_id(array(
												"verified" => 0,
												"verification_code" => $code
								));
								if ($user == false) {
												$user = array(
																'error_msg' => "Invalid or expired verification code!"
												);
												$this->session->set_userdata($user);
												redirect(base_url('login'));
								} else {
												if ($this->Auth_model->verify_profile(array(
																"verified" => 1
												), $user->username)) {
																$user = array(
																				'success_msg' => "Account verified! Please login!"
																);
																$this->session->set_userdata($user);
																redirect(base_url('login'));
												} else {
																$user = array(
																				'error_msg' => "Error Occured"
																);
																$this->session->set_userdata($user);
																redirect(base_url('login'));
												}
								}
				}

				public function recovery($code)
				{
								if ($this->session->userdata('username') != '') {
												redirect(base_url());
								}
								$code = $this->Auth_model->get_recovery_code_by_id(array(
												"code" => $code
								));
								if ($code == false) {
												$code = array(
																'error_msg' => "Invalid verification code!"
												);
												$this->session->set_userdata($code);
												redirect(base_url('login'));
								}
								else if (time() - strtotime($code->created_on) > 24 * 60 * 60) {
												$code = array(
																'error_msg' => "Expired verification code!"
												);
												$this->session->set_userdata($code);
												redirect(base_url('login'));
								} else {
												$this->code = $code;
												$this->user = $this->Auth_model->get_user_by_id(array("username" => $code->username));
												$this->load->view('templates/header');
												$this->load->view('pages/reset');
												$this->load->view('templates/footer');
												/**/
								}
				}

				public function resetPassword($code)
				{
								if ($this->session->userdata('username') != '') {
												redirect(base_url());
								}
								$code = $this->Auth_model->get_recovery_code_by_id(array(
												"code" => $code
								));
								if ($code == false) {
												$code = array(
																'error_msg' => "Invalid verification code!"
												);
												$this->session->set_userdata($code);
												redirect(base_url('login'));
								}
								else if (time() - strtotime($code->created_on) > 24 * 60 * 60) {
												$code = array(
																'error_msg' => "Expired verification code!"
												);
												$this->session->set_userdata($code);
												redirect(base_url('login'));
								} else {

												$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[6]|max_length[15]');
												$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|min_length[6]|max_length[15]');
												if ($this->form_validation->run() === FALSE) {
																$user = array(
																				'error_msg' => validation_errors()
																);
																$this->session->set_userdata($user);
																redirect(base_url('user/recovery/' . $code->code));
												}
												if ($this->input->post('password1') != $this->input->post('password2')) {
															$user = array(
																			'error_msg' => "Passwords did not match"
															);
															$this->session->set_userdata($user);
															redirect(base_url('user/recovery/' . $code->code));
												}
												$data = array(
																								'password' => md5($this->input->post('password1')),
																				);
												$this->Auth_model->updatePassword($data, $code->username);
												$user = array(
																			'success_msg' => "Passwords changed, please login!"
															);
												$this->Auth_model->deleteCode($code->id);
												$this->session->set_userdata($user);
												redirect(base_url('login'));
								}
				}

				public function register()
				{
								if ($this->session->userdata('username') != '') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('name', 'Name', 'required');
								$this->form_validation->set_rules('username', 'Username', 'trim|required');
								$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
								$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|max_length[15]');
								$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|max_length[15]');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->input->post('password1') != $this->input->post('password2')) {
												$user = array(
																'error_msg' => "Passwords did not match"
												);
												$this->session->set_userdata($user);
												redirect(base_url('register'));
								}
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('register'));
								} {
												$data = array(
																'username' => htmlspecialchars($this->input->post('username'))
												);
												$username = htmlspecialchars($this->input->post('username'));
												if ($this->db->get_where('users', $data)->row() != false) {
																$user = array(
																				'error_msg' => "Username Already Exists!"
																);
																$this->session->set_userdata($user);
																redirect(base_url('register'));
												}
												$data = array(
																'email' => htmlspecialchars($this->input->post('email'))
												);
												if ($this->db->get_where('users', $data)->row() != false) {
																$user = array(
																				'error_msg' => "Email Already Exists!"
																);
																$this->session->set_userdata($user);
																redirect(base_url('register'));
												}
												$username            = $this->input->post('username');
												$email            = $this->input->post('email');
												$password         = $this->input->post('password1');
												$set              = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
												$code             = substr(str_shuffle($set), 0, 12);
												$user['email']    = $email;
												$user['password'] = $password;
												$user['code']     = $code;
												$user['active']   = false;
												$config           = array(
																'protocol' => 'smtp',
																'smtp_host' => 'ssl://smtp.googlemail.com',
																'smtp_port' => 465,
																'smtp_user' => 'metrouni.cpc@gmail.com',
																'smtp_pass' => 'wkidpxfdtiewqcjc',
																'mailtype' => 'html',
																'charset' => 'iso-8859-1',
																'wordwrap' => TRUE
												);
												$message          = "
															<html>
															<head>
																<title>Account Verification Code</title>
															</head>
															<body>
																<h2>Thank you for Registering.</h2>
																<p>Your Account:</p>
																<p>Username: " . $username . "</p>
																<p>Password: " . $password . "</p>
																<p>Please click the link below to activate your account.</p>
																<h4><a href='" . base_url() . "user/activate/" . $code . "'>Activate My Account</a></h4>
															</body>
															</html>
															";
												$this->load->library('email', $config);
												$this->email->set_newline("\r\n");
												$this->email->from($config['smtp_user']);
												$this->email->to($email);
												$this->email->subject('Signup Verification Code');
												$this->email->message($message);
												if ($this->email->send()) {
																$this->session->set_flashdata('message', 'Activation code sent to email');
												} else {
																$user = array(
																				'error_msg' => $this->email->print_debugger()
																);
																$this->session->set_userdata($user);
																redirect(base_url('register'));
												}
												$data = array(
																'name' => htmlspecialchars($this->input->post('name')),
																'email' => htmlspecialchars($this->input->post('email')),
																'username' => htmlspecialchars($this->input->post('username')),
																'student_id' => htmlspecialchars($this->input->post('student_id')),
																'password' => md5(htmlspecialchars($this->input->post('password1'))),
																'verification_code' => $code
												);
												if ($this->Auth_model->insert_user($data)) {
																$user = array(
																				'success_msg' => "Account Created! Verification code has been sent to your email!"
																);
																$this->session->set_userdata($user);
																redirect(base_url('login'));
												} else {
																$user = array(
																				'error_msg' => "Error Occured"
																);
																$this->session->set_userdata($user);
																redirect(base_url('register'));
												}
								}
				}
				public function create()
				{
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								$this->form_validation->set_rules('name', 'Name', 'required');
								$this->form_validation->set_rules('username', 'Username', 'trim|required');
								$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
								$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								$this->form_validation->set_message('required', 'Enter %s');
								if ($this->form_validation->run() === FALSE) {
												$user = array(
																'error_msg' => validation_errors()
												);
												$this->session->set_userdata($user);
												redirect(base_url('admin'));
								} {
												$username = htmlspecialchars($this->input->post('username'));
												$role = htmlspecialchars($this->input->post('role'));
												$data = array(
																'username' => htmlspecialchars($this->input->post('username'))
												);
												if ($this->db->get_where('users', $data)->row() != false) {
																$user = array(
																				'error_msg' => "Username Already Exists!"
																);
																$this->session->set_userdata($user);
																redirect(base_url('admin'));
												}
												$data = array(
																'email' => htmlspecialchars($this->input->post('email'))
												);
												if ($this->db->get_where('users', $data)->row() != false) {
																$user = array(
																				'error_msg' => "Email Already Exists!"
																);
																$this->session->set_userdata($user);
																redirect(base_url('admin'));
												}
												$email            = $this->input->post('email');
												$set              = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
												$password         = substr(str_shuffle($set), 0, 12);
												$user['email']    = $email;
												$user['password'] = $password;
												$user['active']   = false;
												$config           = array(
																'protocol' => 'smtp',
																'smtp_host' => 'ssl://smtp.googlemail.com',
																'smtp_port' => 465,
																'smtp_user' => 'metrouni.cpc@gmail.com',
																'smtp_pass' => 'wkidpxfdtiewqcjc',
																'mailtype' => 'html',
																'charset' => 'iso-8859-1',
																'wordwrap' => TRUE
												);
												$message          = "
															<html>
															<head>
																<title>Account Created</title>
															</head>
															<body>
																<h2>Your account is created on Metropoliatin University Competitive Programming Community.</h2>
																<p>Your Account:</p>
																<p>Username: " . $username . "</p>
																<p>Password: " . $password . "</p>
																<p>Please login to</p>
																<h4><a href='" . base_url() . "'>Metropoliatin University Competitive Programming Community.</a></h4>
															</body>
															</html>
															";
												$this->load->library('email', $config);
												$this->email->set_newline("\r\n");
												$this->email->from($config['smtp_user']);
												$this->email->to($email);
												$this->email->subject('Account Created');
												$this->email->message($message);
												if ($this->email->send()) {
																$this->session->set_flashdata('message', 'Activation code sent to email');
												} else {
																$user = array(
																				'error_msg' => $this->email->print_debugger()
																);
																$this->session->set_userdata($user);
																redirect(base_url('admin'));
												}
												$data = array(
																'name' => htmlspecialchars($this->input->post('name')),
																'email' => htmlspecialchars($this->input->post('email')),
																'username' => htmlspecialchars($this->input->post('username')),
																'student_id' => htmlspecialchars($this->input->post('student_id')),
																'password' => md5($password),
																'role' => $role,
																"verified" => "1"
												);
												if ($this->Auth_model->insert_user($data)) {
																$user = array(
																				'success_msg' => "Account Created!"
																);
																$this->session->set_userdata($user);
																redirect(base_url('admin'));
												} else {
																$user = array(
																				'error_msg' => "Error Occured"
																);
																$this->session->set_userdata($user);
																redirect(base_url('admin'));
												}
								}
				}
}