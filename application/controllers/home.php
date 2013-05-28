<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include("application/libraries/LAN_Controller.php");
class Home extends LAN_Controller {

	public function index()
	{
		$this->load->helper("html");

		$gender_count = $this->db->query("SELECT gender, count(gender) as count FROM (`dog`) group by gender");
		$breed_count = $this->db->query("SELECT breed, count(breed) as count FROM (`dog`) group by breed");
		$trainer_dog_count = $this->db->query("select staff.name as trainer, count(staffdogassocation.dogid) as count from staff, staffdogassocation where staffdogassocation.staffid=staff.hfcard group by staff.hfcard");

		$this->load->view('Home', array(
			"name" => $this->staff->name,
			"url" => "home",
			"dog_gender_count" => $gender_count->result(),
			"dog_breed_count" => $breed_count->result(),
			"trainer_dog_count" => $trainer_dog_count->result()
		));

	}
}
