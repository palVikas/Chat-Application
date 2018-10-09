<!DOCTYPE html>
<html>
<head>
	<title>Chatting Login</title>
	 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
	 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<?php echo link_tag("assets/css/bootstrap.min.css") ?>
		<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		 <a class="navbar-brand" href="#">Chatting Login page</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>


	</nav>


		<?php 
			if ($this->session->userdata('id')) {
				
				?>
			<a href=" <?php echo base_url("Login/logout"); ?>" class="btn btn-info" style="float:right" >Logout</a>
			
		<?php 
		} 
		?>	
	
