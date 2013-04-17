<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include("application/libraries/LAN_Controller.php");
class Home extends LAN_Controller {

	public function index()
	{
		$this->load->helper("html");
		$this->load->view('Home', array(
			"name" => $this->staff->name,
			"url" => "home"
		));
	}
}
