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

		$image_name = "temp-image.png";

		if(isset($image[0]['image'])){
			$image_name = isset($image[0]['image'])? $image[0]['image']: "";
		}
		
		echo site_url("/uploads/profile/".$image_name);
	}

?>