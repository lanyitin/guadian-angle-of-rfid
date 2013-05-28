<td><img src="<?php echo $dog->image;?>" width="70"/></td>
<td><?php echo $dog->name; ?></td>
<td><?php echo $dog->gender; ?></td>
<td><?php echo $dog->breed; ?></td>
<td><?php echo $dog->birthday; ?></td>
<td><?php 
$trainerQuery = $this->db->get_where("staff", array("hfcard" => $dog->trainer));
$trainerData = $trainerQuery->row();
if (is_object($trainerData)) {
	echo $trainerData->name;
}
?></td>
<td>
<?php
if ($this->staff->privilege & 2) {
	echo '<div class="btn"><a href="' . site_url( "dog/modify/". $dog->getUhf()) . '">Modify</a></div>';
}
if ($this->staff->privilege & 4) {
	echo '<div class="btn"> <a href="' . site_url("dog/delete/" . $dog->getUhf()) . '">Delete</a> </div>';
}
?>
</td>
