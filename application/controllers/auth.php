<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include("application/libraries/LAN_Controller.php");

class Auth extends LAN_Controller {

	public function login()
	{
		$this->load->helper('url');
		if ($this->session->userdata("id") !== false) { // the user has login
			redirect("/home/");
		}

		if (!$this->validateLoginForm()) {
			//$this->load->view("Home", array(
			//	"content" => $this->load->view('AuthLogin', null, true),
			//	"url" => "auth/login"
			//));
			$this->load->view("index");
			return;
		}

		$authQuery = $this->db->get_where("Auth", array(
			"username" => $this->input->post("username"),
			"password" => $this->input->post("password")
		));

		if ($authQuery->num_rows() == 0) {
			//$this->load->view("Home", array(
			//	"content" => $this->load->view('AuthLogin', null, true),
			//	"url" => "auth/login"
			//));
			$this->load->view("index");
			return;
		}
		$authRow = $authQuery->row();
		$this->staff->init($authRow->staffid);
		$this->session->set_userdata("id", $this->staff->id);
		redirect("/home/");
	}

	public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect("/home/");
	}

	private function validateLoginForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
		return $this->form_validation->run();
	}
}

