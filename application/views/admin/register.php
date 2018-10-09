<?php include ('header.php'); ?>


<div class="container" style="margin-top: 30px">
	<h1> Register Form</h1>
	<?php echo form_open('Login/register') ?>
	<div class="row">
		<div class="col-6">
			  <div class="form-group">
			    <label for="Username">UserName:</label>
			    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter User Name', 'name'=>'username','value'=>set_value('username')]); ?>
			  </div>
	  	</div>
	  	<div class="col-6">
	  		<?php echo form_error('username',"<div class='text-danger'>","</div>"); ?>
	  		
	  	</div>
	  </div>
	  <div class="row">
		<div class="col-6">
			  <div class="form-group">
			    <label for="pwd">Password:</label>
			    <?php echo form_password(['class'=>'form-control','id'=>'pwd','placeholder'=>'Password','type'=>'password','name'=>'password','value'=>set_value('password')]); ?>

			  </div>
	  	</div>
	  	<div class="col-6">
	  		<?php echo form_error('password', "<div class='text-danger'>","</div>"); ?>
	  		
	  	</div>

	  </div>
	  
	 
	  <?php echo form_submit(['type'=>'submit','class'=>'btn btn-primary','value'=>'Register']); ?>
	  <?php echo form_reset(['type'=>'reset','class'=>'btn btn-primary','value'=>'Reset']); ?>


</div>



<?php include ('footer.php'); ?>
