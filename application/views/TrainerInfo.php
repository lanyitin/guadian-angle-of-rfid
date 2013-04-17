<div class="TrainerInfo" onclick="$('#inputTrainer').val(<?php echo $staff->id; ?>); $('.TrainerInfo').css('background-color', ''); $(this).css('background-color', 'blue');">
   <div class="name">姓名:<?php echo $staff->name; ?></div>
   <div class="phone">電話:<?php echo $staff->phone; ?></div>
</div>
