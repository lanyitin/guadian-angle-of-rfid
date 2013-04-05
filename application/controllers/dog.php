<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dog extends CI_Controller {

	public function register()
	{
		$this->load->library('session');
		$this->load->helper("html");

		if (!$this->validateRegisterForm()) {
			$breedQuery = $this->db->get("DogBreed");
			$breedResult = $breedQuery->result();

			$regionQuery = $this->db->get("Region");
			$regionResult = $regionQuery->result();

			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("DogRegister", array(
					"dogBreedList" => $breedResult,
					"regionList" => $regionResult,
				), true),
				"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
			));
			return;
		}
		$this->load->model("DogModel", "newDog", true);
		$this->newDog->init($this->input->post());
		$this->newDog->save();
		//redirect("dog/info/" . $this->newDog->id);
	}

	public function info($id = 0)
	{
		if ($id == 0) {
			$query = $this->db->get("Dog");
			$result = $query->result();
			print_r($result);
		
		} else {
			$query = $this->db->get_where("Dog", array("id" => $id));
			if ($query->num_rows() == 0) {
				$this->load->view("Home", array(
					"name" => $this->session->userdata("name"),
					"content" => "Can't find dog associated with id:$id",
					"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
				));
			} else {
				$row = $query->row();
				print_r($row);
			}
		}
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
		return $this->form_validation->run();
	
	}
}
