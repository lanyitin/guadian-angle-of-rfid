<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$this->load->library('session');
		$this->load->helper('url');

		if ($this->session->userdata("id") !== false) { // the user has login
			redirect("/home/");
		}

		if (!$this->validateLoginForm()) {
			$this->load->view("Home", array(
				"content" => $this->load->view('AuthLogin', null, true),
				"url" => "auth/login"
			));
			return;
		}

		$authQuery = $this->db->get_where("Auth", array(
			"username" => $this->input->post("username"),
			"password" => $this->input->post("password")
		));



		if ($authQuery->num_rows() == 0) {
			$this->load->view("Home", array(
				"content" => $this->load->view('AuthLogin', null, true),
				"url" => "auth/login"
			));
			return;
		}
		$authRow = $authQuery->row();
		$staffQuery = $this->db->get_where("Staff", array("id" => $authRow->staffid));
		if ($staffQuery->num_rows() == 0) {
			$this->load->view("Home", array(
				"content" => $this->load->view('AuthLogin', array("error_msg" => "there is no staff associated to this username/password"), true),
				"url" => "auth/login"
			));
			return;
		}
		$staffRow = $staffQuery->row();
		$this->session->set_userdata($staffRow);
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

