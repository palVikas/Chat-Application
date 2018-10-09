<?php include ('header.php'); ?>
	<div class="container" style="margin-top: 50px">
		<p align="right"><h2>Hi - <?php echo $this->session->userdata('username'); ?></h2></p>
	</div>
  	

<div class="container" style="margin-top: 30px">
	
	<div class="table">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>User Name</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="user_details">
			</tbody>
		</table>
	</div>

		<div id="user_chatBox_details"></div>
        <!-- <div id="chatBox" style="display:none">
			<div id="user_dialog"  class="user_dialog" title="You have chat with '+to_user_name+'"  role="dialog">
				<div style="height:300px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">
			    </div>
			    <div class="form-group">
			    	<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>
			    </div>
			    <div class="form-group" align="right">
			    	<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button>
			    </div>
			</div>
		</div> -->
		
</div>

<?php include ('footer.php'); ?>


<script>  
$(document).ready(function(){

	fetch_user();

    setInterval(function(){
          fetch_user();
          update_chat_history()
          }, 2000);

 
	 function fetch_user()
	 {
	  $.ajax({
		   url:"fetch_all_users",
		   method:"POST",
		   success:function(data){
		  $('#user_details').html(data);
	   }
	  })
	}

	$(document).on('click','.start_chat',function(){
		var to_user_id = $(this).data('touserid');
		var to_user_name = $(this).data('tousername'); 
		make_chat_dialog_box(to_user_id,to_user_name);
		 $("#user_dialog_"+to_user_id).dialog({
		   autoOpen:false,
		   width:400
		  });
 		 $("#user_dialog_"+to_user_id).dialog('open');

 		 fetch_user_chat_history(to_user_id);
	})

	function make_chat_dialog_box(to_user_id,to_user_name){
		var modal_content = '<div id="user_dialog_'+to_user_id+'"  class="user_dialog" title="You have chat with '+to_user_name+'">';
		  modal_content += '<div style="height:300px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
		  modal_content += '</div>';
		  modal_content += '<div class="form-group">';
		  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
		  modal_content += '</div><div class="form-group" align="right">';
		  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
		  $('#user_chatBox_details').html(modal_content);
		 //  $('.chat_message').emojioneArea({
			// 	pickerPosition:"bottom"
			// })		
			// $('.chat_message').val('');


	}



	$(document).on('click','.send_chat',function(){
		var to_user_id = $(this).attr('id');
		 var chat_message = $('#chat_message_'+to_user_id).val();

		 $.ajax({
		 	url:"inset_chat_msg",
		 	method:"POST",
		 	data:{to_user_id:to_user_id,chat_message:chat_message},
		 	success:function(data){
		 		$('#chat_message_'+to_user_id).val('');

		 	} 

		 })
	})

	function  fetch_user_chat_history(to_user_id){
		$.ajax({
			url:'fetch_chat_history',
			method:"POST",
			data:{to_user_id:to_user_id},
			success:function(data){
				$('#chat_history_'+to_user_id).html(data);
			}
		})
	}

		
	function update_chat_history(){
		$('.chat_history').each(function(){
			var to_user_id = $(this).data('touserid');
			fetch_user_chat_history(to_user_id);
		})
	}			
		



});  
</script>

