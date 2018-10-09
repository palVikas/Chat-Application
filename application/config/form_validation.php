<?php 

	$config =[
				'login_validation_rule' =>[
					[
						'field'=>'uname',
						'label'=>'User Name',
						'rules'=>'required|alpha|regex_match[/^[a-zA-Z]*$/]'
					],
					[
						'field'=>'password',
						'label'=>'Password',
						'rules'=>'required'
					]
				],
				'register_validation_rule' =>[
					[
						'field'=>'username',
						'label'=>'User Name',
						'rules'=>'required|alpha|regex_match[/^[a-zA-Z]*$/]'
					],
					[
						'field'=>'password',
						'label'=>'Password',
						'rules'=>'required'
					]
				]


	]





 ?>