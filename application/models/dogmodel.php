<?php
class DogModel extends CI_Model {
	private $id = null;
	private $uhf = null;
	public $name;
	public $birthday;
	public $gender;
	public $breed;
	public $region;
	public $image;
	public $trainer;

	function __construct()
	{
		parent::__construct();
	}

	public function init($params)
	{
		if (is_array($params)) {
			if (isset($params["id"])) {
				$this->id = $params["id"];
			}
			if (isset($params["uhf"])) {
				$this->uhf = $params["uhf"];
			}
			$this->name = $params["name"];
			$this->birthday = $params["birthday"];
			$this->gender = $params["gender"];
			$this->breed = $params["breed"];
			$this->region = $params["region"];
			$this->image = $params["image"];
			$this->trainer = $params["trainer"];
		} else if (is_object($params)){
			if (isset($params->id)) {
				$this->id = $params->id;
			}
			if (isset($params->uhf)) {
				$this->uhf = $params->uhf;
			}
			$this->name = $params->name;
			$this->birthday = $params->birthday;
			$this->gender = $params->gender;
			$this->breed = $params->breed;
			$this->region = $params->region;
			$this->image = $params->image;
			$trainerQuery = $this->db->get_where("StaffDogAssocation", array("dogid" => $this->getUhf()));
			$trainerRow = $trainerQuery->row();
			if (is_object($trainerRow) && isset($trainerRow->staffid)) {
				$this->trainer = $trainerRow->staffid;
			} else {
				$this->trainer = null;
			}
		}
	}

	public function save()
	{
		$this->db->trans_begin();
		if ($this->id === null) {
			$today = date("ymd");
			$sql = sprintf("select max(substr(id, 22, 3)) as num from Dog where substr(id, 16, 6)='%s'", $today);
			$query = $this->db->query($sql);
			$num = "";
			if ($query->num_rows() == 0) {
				$num = "001";
			} else {
				$row = $query->row();
				$num = sprintf("%03d", $row->num + 1);
			}
			$this->uhf = ($this->gender . $this->region . $this->breed . $today . $num);
			$this->db->insert("Dog", array(
				"uhf" => $this->uhf,
				"name" => $this->name,
				"birthday" => $this->birthday,
				"gender" => $this->gender,
				"breed" => $this->breed,
				"region" => $this->region,
				"image" => $this->image
			));
			$this->id = $this->db->insert_id();
		} else {
			$newuhf = ($this->gender . $this->region . $this->breed . substr($this->uhf, 15));
			$this->db->where("uhf", $this->uhf);
			$this->db->update("Dog", array(
				"name" => $this->name,
				"birthday" => $this->birthday,
				"gender" => $this->gender,
				"breed" => $this->breed,
				"region" => $this->region,
				"uhf" => $newuhf,
				"image" => $this->image
			));
		}
		$this->db->where("dogid", $this->id);
		$this->db->delete("StaffDogAssocation");
		$this->db->insert("StaffDogAssocation", array(
			"staffid" => $this->trainer,
			"dogid" => $this->getUhf()
		));
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			print_r($this->db->_error_number);
			print_r($this->db->_error_message);
		}
		else
		{
			$this->db->trans_commit();
		}
	}

	public function getId()
	{
		return $this->id;
	}
	public function getUhf()
	{
		return $this->uhf;
	}
}
