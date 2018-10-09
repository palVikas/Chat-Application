<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_controller
{
	
	function __construct()
	{ 
		parent::__construct();
		$this->load->model('ChatModel','cm');

	}

	public function index(){
		if($this->form_validation->run('login_validation_rule')){
			$username = $this->input->post('uname');
			$password = $this->input->post('password');
			$login_id = $this->cm->isvalidate($username,$password);
			if($login_id){
				if($data=$this->cm->save_login_details($login_id)){
					$this->session->set_userdata(['id'=>$login_id,'username'=>$username,'login_details_id'=>$data]);
					return redirect('Login/welcome');
				}else{
					return redirect('Login');
				}
				
			}else{
				$this->session->set_flashdata('Login_Failed', 'Invalid Username/Password');
					return redirect('Login');
			}

		}else{
			$this->load->view('admin/login');
		}

	}

	public function welcome(){
		if ($this->session->userdata('id'))
			  $this->load->view('admin/dashboard');
		else
			return redirect('Login');
				
	}

	public function logout(){
		if($this->cm->unset_login_Status($this->session->userdata('id'))){
			$this->session->unset_userdata('id');
			return redirect('Login');
		}
	}

	public function fetch_all_users(){
		$id = $this->session->userdata('id');
		echo $this->cm->fetchAllUser($id);
	}


	public function register(){
		if($this->form_validation->run('register_validation_rule')){
			$user_deatails = $this->input->post();
			if($this->cm->insert_users_details($user_deatails)){
				$this->session->set_flashdata('msg', 'You have Registered Successfully! Please Login! with same Username and password');
				  		return redirect('Login');
			}

		}else
		$this->load->view('admin/register');
	}


	public function inset_chat_msg(){
		$id = $this->session->userdata('id');
		$from_user_id =array('from_user_id'=>$id);
		$to_user_id = $this->input->post('to_user_id');
		$chat_details = array_merge($this->input->post(),$from_user_id);
		$this->cm->inset_into_chatMessage($chat_details);
	}

	public function fetch_chat_history(){
		$id = $this->session->userdata('id');
		$to_user_id = $this->input->post('to_user_id');
		echo $this->cm->fetch_users_chat_history($id,$to_user_id);
	}





}








?>