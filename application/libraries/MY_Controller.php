<?php
class MY_Controller extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Taipei");
		$this->db->query("SET time_zone='Asia/Taipei'");
	}
	public function _remap($method, $params = array())
	{
		if (!in_array($method, array("get_list","getList")))
		{
			$this->load->library("session");
			if ($this->session->userdata("id") == 0) {
				redirect("user/login");
				die('<meta http-equiv="REFRESH" content="0;url='+site_url("user/login")+'">');
			}
		}
		return call_user_func_array(array($this, $method), $params);
	}
}

?>
