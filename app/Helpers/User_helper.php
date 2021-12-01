<?php 

	function userAdminCheck($user_role){
		if($user_role != 1 && session()->get("logged_in") == false){
			return view('errors/html/error_404');
		}
	}

?>