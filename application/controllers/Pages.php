<?php
set_time_limit(0);
include_once('simple_html_dom.php');
class Pages extends CI_Controller
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
								$this->load->model('Contest_model');
								$this->load->model('Group_model');
								$this->load->model('News_model');
								$this->load->model('Question_model');
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
				public function deleteRank($contest_id)
				{
								if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == '') {
												redirect(base_url());
								}
								$this->Auth_model->delete_rank($contest_id);
								$user = array(
												'success_msg' => "Rank Deleted Successfully!"
								);
								$this->session->set_userdata($user);
								redirect(base_url('participation'));
				}
				public function createRank()
				{
								if ($this->session->userdata('role') == "user" || $this->session->userdata('role') == '') {
												redirect(base_url());
								}
								$this->username = $this->session->userdata('username');
								$data           = array(
												'name' => htmlentities($this->input->post('name')),
												'year' => htmlentities($this->input->post('year')),
												'standings' => htmlentities($this->input->post('standings')),
												'total_team' => htmlentities($this->input->post('total_team')),
												'total_team_from_mu' => htmlentities($this->input->post('total_team_from_mu')),
												'best_rank' => htmlentities($this->input->post('best_rank')),
												'type' => htmlentities($this->input->post('type'))
								);
								$insert         = $this->Auth_model->createRank($data);
								if ($insert) {
												redirect(base_url('participation'));
								} else {
												redirect(base_url());
								}
				}
				public function view($page = 'home')
				{
								if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
												show_404();
								}
								if ($page == "login" || $page == "register" || $page == "recover") {
												if ($this->session->userdata('username') != '') {
																redirect(base_url(''));
												}
								}
								if ($page == "account") {
												if ($this->session->userdata('username') == '') {
																redirect(base_url());
												}
								}
								if ($page == "dashboard") {
												if ($this->session->userdata('username') == '') {
																redirect(base_url());
												}
								}
								if ($page == "training") {
												if ($this->session->userdata('role') != 'coach') {
																redirect(base_url('mentoring'));
												}
								}
								if ($page == "mentoring") {
												if ($this->session->userdata('role') != 'mentor') {
																redirect(base_url('training'));
												}
								}
								if ($page == "admin") {
												if ($this->session->userdata('role') != 'admin') {
																redirect(base_url());
												}
								}
								if ($page == "reset") {
												redirect(base_url());
								}
								$this->title   = ucfirst($page);
								$data['title'] = ucfirst($page);
								$this->load->view('templates/header', $data);
								$this->load->view('pages/' . $page, $data);
								$this->load->view('templates/footer', $data);
				}
				public function admin($locate = 'user')
				{
					if (!file_exists(APPPATH . 'views/pages/admin/' . $locate . '.php')) {
												redirect(base_url('admin'));
								}
								if ($this->session->userdata('role') != 'admin') {
												redirect(base_url());
								}
								//echo $locate;die();
								$this->locate = $locate;
								$this->load->view('templates/header');
								$this->load->view('pages/admin/' . $locate);
								$this->load->view('templates/footer');
				}
				public function news($id = '')
				{
								$data        = array(
												'id' => $id
								);
								$this->title = '';
								$this->news  = $this->Auth_model->get_news_by_id($data);
								if ($this->news == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/news', $data);
								$this->load->view('templates/footer', $data);
				}
				public function blog($id = '')
				{
								$data        = array(
												'id' => $id
								);
								$this->title = '';
								$this->blog  = $this->Blog_model->get_blog_by_id($data);
								if ($this->blog == false) {
												redirect(base_url());
								}
								$data['id'] = $id;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/blog', $data);
								$this->load->view('templates/footer', $data);
				}
				public function profile($username = '', $locate = "")
				{
								$data         = array(
												'username' => $username
								);
								$this->title  = '';
								$this->locate = $locate;
								$this->user   = $this->Auth_model->get_user_by_id($data);
								if ($this->user == false || $username == '') {
												redirect(base_url());
								}
								$data['username'] = $username;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/profile', $data);
								$this->load->view('templates/footer', $data);
				}
}
