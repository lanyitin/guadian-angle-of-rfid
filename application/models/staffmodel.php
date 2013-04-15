<?php
class StaffModel extends CI_Model {
	
	private $data;

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	}

    public function init($staffid)
    {
		parent::__construct();
		$staffQuery = $this->db->get_where("Staff", array("id" => $staffid));
		$this->data = $staffQuery->row();

		$privilege = 0;
		$roles = array();
		$roleQuery = $this->db->get_where("StaffRole", array("id &" => $this->data->role));
		foreach ($roleQuery->result() as $role) {
			$privilege |= $role->privilege;
			array_push($roles, $role);
		}
		$this->data->privilege = $privilege;
		$this->data->roles = $roles;
	}

	public function getData()
	{
		return $this->data;
	}
}
