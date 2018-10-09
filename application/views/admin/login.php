<?php include ('header.php'); ?>

<div class="container" style="margin-top: 30px">
	<h1> User Login</h1>
	<?php if($error=$this->session->flashdata('Login_Failed')) : ?>
		<div class="row">
			<div class="col-lg-6">
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
			</div>
		</div>
	<?php endif ?>
	<?php if($error=$this->session->flashdata('msg')) : ?>
		<div class="row">
			<div class="col-lg-6">
				<div class="alert alert-success">
					<?php echo $error; ?>
				</div>
			</div>
		</div>
	<?php endif ?>
	<?php echo form_open('Login/index') ?>
	<div class="row">
		<div class="col-6">
			  <div class="form-group">
			    <label for="Username">User-Name:</label>
			    <?php echo form_input(['class'=>'form-control','placeholder'=>'User Name', 'name'=>'uname','value'=>set_value('uname')]); ?>
			  </div>
	  	</div>
	  	<div class="col-6">
	  		<?php echo form_error('uname',"<div class='text-danger'>","</div>"); ?>
	  		
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
	  <?php echo form_submit(['type'=>'submit','class'=>'btn btn-primary','value'=>'Submit']); ?>
	  <?php echo form_reset(['type'=>'reset','class'=>'btn btn-primary','value'=>'Reset']); ?>
	  <?php echo anchor('Login/register/','Sign up?','class="link-class"') ?>


</div>



<?php include ('footer.php'); ?>