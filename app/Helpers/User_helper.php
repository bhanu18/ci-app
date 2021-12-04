<?php 

	function userAdminCheck($user_role , $user_id){
		if($user_id != ''){
			if($user_role == 1){
				return current_url();		
			}
		}else{
			echo view('errors/html/error_404');
			die;
		}
	}

?>