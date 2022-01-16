<?php 
use App\Models\UserModel;

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

	function getUserProfile($id){


		$user = new UserModel();

		$image = $user->showProfile($id);

		echo site_url("/uploads/profile/".$image[0]['image']);
	}

?>