<div class="hero-unit">
   <h1>Dog List</h1>
</div>
<?php foreach ($dogs as $key => $dog): ?>
<?php $this->load->view("DogInfo", array("dog" => $dog)); ?>
<?php endforeach ?>
