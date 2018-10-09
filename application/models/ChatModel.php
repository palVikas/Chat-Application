<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class ChatModel extends CI_model
{
	
	public function isvalidate($user,$password){
		$q = $this->db->where(['username'=>$user,'password'=>$password])
				 	  ->get('users');
		if($q->num_rows()){
			return $q->row()->id;
		}else{
			return false;
		}
	}

	public function fetchAllUser($id){
		$q = $this->db->where_not_in('id', $id)
					  ->get('users');
		$data = $q->result();
		return  $this->fetch_all_users_stringBuilder($data);
	} 

	public function fetch_all_users_stringBuilder($data){
		$output	='';
		foreach ($data as $value) {
			$status='';
			$user_last_activity = $this->fetch_users_last_activity($value->id);
			if($user_last_activity){
			 $status = '<span class=" btn btn-success">Online</span>';

			}else{
				 $status = '<span class="btn btn-danger">Offline</span>';
			}

			$output .= '
						 <tr>
						  <td>'.$value->username.'</td>
						  <td>'.$status.'</td>
						  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$value->id.'" data-tousername="'.$value->username.'">Start Chat</button></td>
						 </tr>
						 ';

		}
		return $output;

	}


	public function fetch_users_last_activity($user_id){
		$data = $this->db->select('user_status')
		           		 ->order_by('user_status','DESC')
				 		 ->where('user_id',$user_id)
				 		 ->limit(1)
				 		 ->get('login_details');
		return $data->row()->user_status;
	}

	public function save_login_details($id){
		 $this->db->insert('login_details',['user_id'=>$id,'user_status'=>1]);
		 return $this->db->insert_id();
	}


	public function unset_login_Status($user_id){
		$q = $this->db->order_by('user_status','DESC')
				 ->where('user_id',$user_id)
				 ->limit(1)
				 ->set('user_status',0)
				 ->update('login_details');
		return $q;
	}

	public function insert_users_details($users){
		return $this->db->insert('users',$users);
	}

	public function inset_into_chatMessage($chat_details){
		$this->db->insert('chat_message',$chat_details);
	}

	public function fetch_users_chat_history($from_user_id,$to_user_id){
		$q = $this->db->where('from_user_id',$from_user_id)
					 ->where('to_user_id',$to_user_id)
					 ->or_where('from_user_id',$to_user_id)
					  ->where('to_user_id',$from_user_id)
					 ->order_by('time','ASC')
					 ->get('chat_message');
			$data = $q->result();
		return $this->chat_history_stringBuilder($data,$from_user_id);

		
	}


	public function get_user_name($id){
		$q = $this->db->select('username')
						->where('id',$id)
						->get('users');
		return $q->row()->username;
	}

	public function chat_history_stringBuilder($data,$from_user_id){
		$output = '<ul>';
		foreach ($data as $value) {
			if ($value->from_user_id == $from_user_id) {
				$username = '<i class="text-info">You<i>';
			}else{
				$username ='<b class="text-danger">'.$this->get_user_name($value->from_user_id).'</b>';
			}
			$output .= '
					  <li style="border-bottom:1px">
					   <p class="text-success">'.$username.' - '.$value->chat_message.'
					    <div align="right">
					     - <small><em>'.$value->time.'</em></small>
					    </div>
					   </p>
					  </li>
					  ';
		}
		$output .= '</ul>';
		return $output;

	}

}

 ?>


 