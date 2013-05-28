<?php
class LAN_Controller extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Taipei");
		$this->load->library("session");
		//$this->db->query("SET time_zone='Asia/Taipei'");
	}
	public function _remap($method, $params = array())
	{
		$this->load->model("StaffModel", "staff", true);
		if ($this->session->userdata("id") !== false) { // login
			if ($method === "login") {
				redirect("home");
			}
			$this->staff->init($this->session->userdata("id"));
			return call_user_func_array(array($this, $method), $params);
		} else { // not login yet
			if (!in_array($method, array("login", "getByCondiction"))) {
				redirect("auth/login");
			} else {
				return call_user_func_array(array($this, $method), $params);
			}
		}
	}
}
?>
