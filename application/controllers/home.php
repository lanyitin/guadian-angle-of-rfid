<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include("application/libraries/LAN_Controller.php");
class Home extends LAN_Controller {

	public function index()
	{
		$this->load->helper("html");
		$gender_count = $this->db->query("SELECT doggender.title as gender, count(dog.gender) as count FROM `doggender` left join `dog` on dog.gender=doggender.id group by doggender.id");
		$breed_count = $this->db->query("SELECT dogbreed.title as breed, count(dog.breed) as count FROM `dogbreed` left join `dog` on dogbreed.id=dog.breed group by dogbreed.id");
		$trainer_dog_count = $this->db->query("select staff.name as trainer, count(staffdogassocation.dogid) as count from staff left join staffdogassocation on staffdogassocation.staffid=staff.hfcard group by staff.hfcard");

		$this->load->view('Home', array(
			"name" => $this->staff->name,
			"url" => "home",
			"dog_gender_count" => $gender_count->result(),
			"dog_breed_count" => $breed_count->result(),
			"trainer_dog_count" => $trainer_dog_count->result()
		));
	}
}
