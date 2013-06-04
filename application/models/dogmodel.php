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
			if (isset($params->trainer)) {
				$this->trainer = $params->trainer;
			} else {
				print_r(debug_backtrace());
			}
		}
	}

	public function save()
	{
		// mysql substr start from 1
		// 01 [1~2] fixed
		// D0410DA [3~9] Region
		// 085DE7 [10~15] breed
		// 1306 [16~19] Year and Month
		// 001 [20~22] serial number
		// 01 [23~24] gender
		$this->db->trans_begin();
		if ($this->id === null) {
			$today = date("ym");
			$sql = sprintf("select max(substr(uhf, 20, 3)) as num from Dog where substr(uhf, 16, 4)='%s'", $today);
			$query = $this->db->query($sql);
			$num = "";
			if ($query->num_rows() == 0) {
				$num = "001";
			} else {
				$row = $query->row();
				$num = sprintf("%03d", $row->num + 1);
			}
			$this->uhf = ("01" . $this->region . $this->breed . $today . $num . $this->gender);
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
			$newuhf = ("01" . $this->region . $this->breed . substr($this->uhf, 15, 7) . $this->gender);
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
			$this->uhf = $newuhf;
		}
		$this->db->where("dogid", $this->uhf);
		$this->db->delete("StaffDogAssocation");
		if ($this->trainer !== null) {
			$data = array(
				"staffid" => $this->trainer,
				"dogid" => $this->getUhf()
			);
			$this->db->insert("StaffDogAssocation",$data);
		}

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
