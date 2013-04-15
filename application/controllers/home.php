<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->library('session');
		$this->load->helper("html");

		if ($this->session->userdata("id") === false) {
			redirect("/auth/login/");
		}

		$this->load->view('Home', array(
			"name" => $this->session->userdata("name"),
			"url" => "home"
		));
	}
}
