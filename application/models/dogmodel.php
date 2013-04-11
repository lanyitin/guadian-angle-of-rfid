<?php
class DogModel extends CI_Model {
	private $id = null;
	public $name;
	public $birthday;
	public $gender;
	public $breed;
	public $region;
	public $image;

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
		}
	}

	public function save()
	{
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
				"id" => $this->id,
				"name" => $this->name,
				"birthday" => $this->birthday,
				"gender" => $this->gender,
				"breed" => $this->breed,
				"region" => $this->region
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
				"uhf" => $newuhf
			));
		}
	}

	public function getId()
	{
		return $this->id;
	}
	public function getUhf()
	{
		return $this->Uhf;
	}
}
