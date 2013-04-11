<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function register()
	{
		$this->load->library('session');
		$this->load->helper("html");

		if (!$this->validateRegisterForm()) {
			$privilegeQuery = $this->db->get("Privilege");
			$privilegeResult = $privilegeQuery->result();

			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("StaffRegister", array(
					"PrivilegeList" => $privilegeResult,
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

	public function modify($id) 
	{
		$this->load->model("DogModel", "Dog", true);
		if (!$this->validateModifyForm()) {
			$this->load->library('session');
			$query = $this->db->get_where("Dog", array("id" => $id));
			if ($query->num_rows()) {
				$this->Dog->init($query->row());
				$breedQuery = $this->db->get("DogBreed");
				$breedResult = $breedQuery->result();

				$regionQuery = $this->db->get("Region");
				$regionResult = $regionQuery->result();

				$this->load->view("Home", array(
					"name" => $this->session->userdata("name"),
					"content" => $this->load->view("DogModify", array(
						"dogBreedList" => $breedResult,
						"regionList" => $regionResult,
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
	public function info($id = 0)
	{
		$this->load->library('session');
		if ($id == 0) {
			$this->load->model("DogModel", "Dog", true);
			$content = "";
			$query = $this->db->get("Dog");
			$result = $query->result();
			foreach ($result as $row) {
				$this->Dog->init($row);
				$content .= $this->load->view("DogInfo", array(
					"dog" => $this->Dog
				), true);
			}
			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("DogInfoList", array("HTMLList" => $content), true),
				"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
			));

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

	public function delete($id)
	{
		$query = $this->db->where(array("id" => $id));
		$query = $this->db->delete("Staff");
		redirect("dog/info");
	}
	private function validateRegisterForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hfcard', 'hfcard', 'trim|required|xss_clean');
		$this->form_validation->set_rules('privilege', 'privilege', 'trim|required|xss_clean');
		return $this->form_validation->run();
	}
	private function validateModifyForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hfcard', 'hfcard', 'trim|required|xss_clean');
		$this->form_validation->set_rules('privilege', 'privilege', 'trim|required|xss_clean');
		return $this->form_validation->run();
	}
}
