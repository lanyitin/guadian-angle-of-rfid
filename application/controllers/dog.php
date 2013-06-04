<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include("application/libraries/LAN_Controller.php");

class Dog extends LAN_Controller {

	public function register()
	{
		$this->load->library('session');
		$this->load->helper("html");

		if (!$this->validateRegisterForm()) {
			$breedQuery = $this->db->get("DogBreed");
			$breedResult = $breedQuery->result();

			$regionQuery = $this->db->get("Region");
			$regionResult = $regionQuery->result();

			$genderQuery = $this->db->get("doggender");
			$genderResult = $genderQuery->result();
			$this->db->where("role &", "1");
			$this->db->or_where("role", "-2147483648");
			$staffQuery = $this->db->get("Staff");
			$staffResult = $staffQuery->result();

			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("DogRegister", array(
					"dogBreedList" => $breedResult,
					"dogRegionList" => $regionResult,
					"dogGenderList" => $genderResult,
					"staffs" => $staffResult,
				), true),
				"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
			));
			return;
		}
		$this->load->model("DogModel", "newDog", true);
		$this->newDog->init($this->input->post());
		$this->newDog->save();
		redirect("dog/info");
	}

	public function modify($uhf) 
	{
		$this->load->model("DogModel", "Dog", true);
		if (!$this->validateModifyForm()) {
			$this->load->library('session');
			$this->db->where("uhf", $uhf);
			$dogs = $this->getDogData();
			if (count($dogs)) {
				$this->Dog->init($dogs[0]);
				$breedQuery = $this->db->get("DogBreed");
				$breedResult = $breedQuery->result();

				$regionQuery = $this->db->get("Region");
				$regionResult = $regionQuery->result();

				$genderQuery = $this->db->get("doggender");
				$genderResult = $genderQuery->result();

				$this->db->where("role &", "1");
				$this->db->or_where("role", "-2147483648");
				$staffQuery = $this->db->get("Staff");
				$staffResult = $staffQuery->result();

				$this->load->view("Home", array(
					"name" => $this->session->userdata("name"),
					"content" => $this->load->view("DogModify", array(
						"dogBreedList" => $breedResult,
						"dogRegionList" => $regionResult,
						"dogGenderList" => $genderResult,
						"staffs" => $staffResult,
						"dog" => $this->Dog
					), true),
					"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
				));
			}
			return;
		}
		$this->Dog->init($this->input->post());
		$this->Dog->save();
		redirect("dog/info");
	}

	private function getDogData()
	{
		$query = $this->db->get("Dog");
		$dogs = array();
		$i = 0;
		foreach($query->result() as $dogdata) {
			$query = $this->db->get_where("StaffDogAssocation", array("dogid" => $dogdata->uhf));
			//echo $this->db->last_query();
			if ($query->num_rows()) {
				$row = $query->row();
				$dogdata->trainer = $row->staffid;
			} else {
				$dogdata->trainer = "";
			}
			$modelName = "Dog" . $i;
			$this->load->model("DogModel", $modelName, true);
			$this->$modelName->init($dogdata);
			$dogs[] = $this->$modelName;
			$i++;
		}
		return $dogs;
	}
	public function info($uhf = 0)
	{
		$this->load->library('session');
		if ($uhf == 0) {
			$dogs = $this->getDogData();
			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("DogInfoList", array("dogs" => $dogs), true),
				"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
			));

		} else {
			$query = $this->db->get_where("Dog", array("uhf" => $uhf));
			if ($query->num_rows() == 0) {
				$this->load->view("Home", array(
					"name" => $this->session->userdata("name"),
					"content" => "Can't find dog associated with UHF:$uhf",
					"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
				));
			}
		}
	}

	public function delete($uhf)
	{
		$query = $this->db->where(array("uhf" => $uhf));
		$query = $this->db->delete("Dog");
		redirect("dog/info");
	}
	private function validateRegisterForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
		$this->form_validation->set_rules('breed', 'breed', 'trim|required|xss_clean');
		$this->form_validation->set_rules('region', 'region', 'trim|required|xss_clean');
		$this->form_validation->set_rules('birthday', 'birthday', 'trim|required');
		$this->form_validation->set_rules('region', 'region', 'trim|required');
		$this->form_validation->set_rules('trainer', 'trainer', 'trim|required');
		return $this->form_validation->run();
	}
	private function validateModifyForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uhf', 'uhf', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
		$this->form_validation->set_rules('breed', 'breed', 'trim|required|xss_clean');
		$this->form_validation->set_rules('region', 'region', 'trim|required|xss_clean');
		$this->form_validation->set_rules('birthday', 'birthday', 'trim|required');
		$this->form_validation->set_rules('region', 'region', 'trim|required');
		$this->form_validation->set_rules('trainer', 'trainer', 'trim|required');
		return $this->form_validation->run();
	}

	public function getByCondiction($begin, $count) {
		function notEmptyDefault($string) {
			return $string !== false && $string !== "ALL" && count(trim($string)) > 0;
		}
		if (notEmptyDefault($this->input->post("breed"))) {
			$this->db->where("breed", $this->input->post("breed"));
		}
		if (notEmptyDefault($this->input->post("gender"))) {
			$this->db->where("gender", $this->input->post("gender"));
		}
		$this->db->limit($count, $begin);
		$dogs = $this->getDogData();
		$data = array();
		for($i = 0; $i < count($dogs); $i++) {
			if (notEmptyDefault($this->input->post("card"))) {
				if (strpos($dogs[$i]->getUhf(), $this->input->post("card")) == false && strpos($dogs[$i]->trainer,$this->input->post("card")) == false) {
					continue;
				}
			}
			$data[] = $this->load->view("DogInfo", array("dog" => $dogs[$i]), true);

		}
		echo json_encode($data);
	}
}
