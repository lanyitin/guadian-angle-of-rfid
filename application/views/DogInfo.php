<td><img src="<?php echo $dog->image;?>" width="70"/></td>
<td><?php echo $dog->name; ?></td>
<td><?php echo ($dog->gender == "00") ? "Male" : "Female"; ?></td>
<td><?php 
switch( $dog->breed) {
case "085DE7":
	echo "Golden Retriever";
	break;
case "0EB6A7":
	echo "German Shepherd";
	break;
case "5ABBAD":
	echo "Labrador Retriever";
	break;
}
?></td>
<td><?php echo $dog->birthday; ?></td>
<td><?php 
$trainerQuery = $this->db->get_where("staff", array("hfcard" => $dog->trainer));
$trainerData = $trainerQuery->row();
if (is_object($trainerData)) {
	echo $trainerData->name . "(" . $trainerData->phone . ")";
}
?></td>
<td><?php echo $dog->getUhf(); ?></td>
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
