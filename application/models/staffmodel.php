<?php
class StaffModel extends CI_Model {
	
	private $data = array();

	function __construct()
    {
        // Call the Model constructor
		parent::__construct();

	}

    public function init($para_data)
	{
		if (!is_array($para_data)) {
			$staffQuery = $this->db->get_where("Staff", array("id" => $para_data));
			$this->data = $staffQuery->row(0, 'array');

			$privilege = 0;
			$roles = array();
			$roleQuery = $this->db->get_where("StaffRole", array("id &" => $this->data['role']));
			foreach ($roleQuery->result() as $role) {
				$privilege |= $role->privilege;
				array_push($roles, $role);
			}
			$this->data['privilege'] = $privilege;
			$this->data['roles'] = $roles;
		} else {
			foreach ($para_data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	function __get($key) {
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		} else {
			if ($key === "data") {
				return $this->data;
			} else {
				return parent::__get($key);
			}
		}
	}

	function __set($key, $value)
	{
		if ($key === "role" && is_array($value)) {
			$role_hex = 0;
			foreach($value as $hex_code) {
				$role_hex |= $hex_code;
			}
			$this->data["role"]	= $role_hex;
		} else {
			$this->data[$key] = $value;
		}
	}
	public function save()
	{
		if (!array_key_exists("id", $this->data)) {
			$this->db->insert("Staff", array(
				"name" => $this->name,
				"role" => $this->role,
				"phone" => $this->phone,
				"hfcard" => $this->hfcard,
			));
			$this->data["id"] = $this->db->insert_id();
		} else {
			$this->db->where("id", $this->data["id"]);
			$this->db->update("Staff", array(
				"name" => $this->name,
				"role" => $this->role,
				"phone" => $this->phone,
				"hfcard" => $this->hfcard,
			));
		}
	}
}
