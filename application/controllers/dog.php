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

			$this->db->where("role &", "1");
			$this->db->or_where("role", "-2147483648");
			$staffQuery = $this->db->get("Staff");
			$staffResult = $staffQuery->result();

			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("DogRegister", array(
					"dogBreedList" => $breedResult,
					"regionList" => $regionResult,
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
			$query = $this->db->get_where("Dog", array("uhf" => $uhf));
			if ($query->num_rows()) {
				$this->Dog->init($query->row());
				$breedQuery = $this->db->get("DogBreed");
				$breedResult = $breedQuery->result();

				$regionQuery = $this->db->get("Region");
				$regionResult = $regionQuery->result();

			   $this->db->where("role &", "1");
			   $this->db->or_where("role", "-2147483648");
			   $staffQuery = $this->db->get("Staff");
			   $staffResult = $staffQuery->result();

				$this->load->view("Home", array(
					"name" => $this->session->userdata("name"),
					"content" => $this->load->view("DogModify", array(
						"dogBreedList" => $breedResult,
						"regionList" => $regionResult,
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
	public function info($uhf = 0)
	{
		$this->load->library('session');
		if ($uhf == 0) {
			$query = $this->db->get("Dog");
			$dogs = array();
			foreach($query->result() as $dogdata) {
			   $this->load->model("DogModel", "Dog", true);
			   $this->Dog->init($dogdata);
			   $dogs[] = &($this->Dog);
			}
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
			} else {
				$row = $query->row();
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
}
