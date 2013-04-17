<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include("application/libraries/LAN_Controller.php");

class Staff extends LAN_Controller {

	public function register()
	{
		$this->load->library('session');
		$this->load->helper("html");

		if (!$this->validateRegisterForm()) {
			$roleQuery = $this->db->get("StaffRole");
			$roleResult = $roleQuery->result();

			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("StaffRegister", array(
					"PrivilegeList" => $roleResult,
				), true),
				"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
			));
			return;
		}
		$this->load->model("StaffModel", "newStaff", true);
		$this->newStaff->init($this->input->post());
		$this->newStaff->save();
	}

	public function modify($id) 
	{
		$this->load->model("StaffModel", "EditStaff", true);
		$this->EditStaff->init($id);
		if (!$this->validateRegisterForm()) {
			$roleQuery = $this->db->get("StaffRole");
			$roleResult = $roleQuery->result();

			$this->load->view("Home", array(
				"name" => $this->session->userdata("name"),
				"content" => $this->load->view("StaffModify", array(
					"PrivilegeList" => $roleResult,
					"Staff" => $this->EditStaff
				), true),
				"url" => ($this->uri->segment(1) . "/" . $this->uri->segment(2))
			));
			return;
		}
		$this->EditStaff->init($this->input->post());
		$this->EditStaff->save();
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
		$this->form_validation->set_rules('role', 'role[]', 'required|xss_clean');
		return $this->form_validation->run();
	}
	private function validateModifyForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hfcard', 'hfcard', 'trim|required|xss_clean');
		$this->form_validation->set_rules('role', 'role', 'required|xss_clean');
		return $this->form_validation->run();
	}
}
