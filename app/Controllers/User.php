<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use Controller\Codeigniter;

class User extends BaseController{

    protected $user_id;
	protected $user_name;

	public function __construct(){

    $this->session = session();
    $this->session->start();

    $this->user_id = $this->session->get('user_id');
    $this->user_name = $this->session->get('user_email');

    }

    public function index(){

        helper(['form']);
        echo view('login');
    }

    public function login(){
        
        helper(['form']);

        $user = new UserModel();

        if($this->request->getMethod() == 'post'){
            $data = [];

            $username = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $row = $user->Login($username, $password);

            if(!empty($row)){

            $user_id = $row['user_id'];
            $user_name = $row['firstname'];
			$user_email = $row['email'];
			$user_password = $row['password'];

            if(md5($password) == $user_password){

						$sessdata = [
							'user_id'  	=> $user_id,
                            'user_name' => $user_name,
							'user_email'    => $user_email,
                            'logged_in' => TRUE
						];
						$this->session->set($sessdata);
                        if($row['role_id'] == 1){
						return $this->response->redirect(site_url('dashboard'));
                        }else{
                            return $this->response->redirect(site_url('Home'));
                        }
                    }else{
						$data['errors'] = 'Your password wrong. Please try again.';
                        return view('login',$data);
                    }
                }else{

					$data['errors'] = 'No user';
                    return view('login',$data);

				}	
            }
    }
    public function logout(){

        $this->session->destroy();
		return $this->response->redirect(site_url('User'));

    }
    public function forgotPassword(){
        helper(['form']);
        echo view('resetPassword');
        
    }
    public function verifyUser(){

        $user = new UserModel();

        $email = $this->request->getVar('email');

        if($user->verifyEmail($email) == 1){
            $row = $user->getEmail($email);
            return $this->response->redirect(site_url('user/changePassword/'.$row[0]['user_id']));
            // return $this->response->redirect(site_url('user/recoverPassword'));
        }else{
            $data['errors'] = 'Email not found';
            return view('resetPassword',$data);
        }

    }

    public function changePassword($id=''){

        $data = [];
        // helper(['form', 'url']);

        if($id == "") return $this->response->redirect(site_url('user'));
            if($this->request->getMethod() == 'post'){
            $rules = [
            'password' => 'required|min_length[8]|max_length[255]',
            'passConf' => 'matches[password]',
        ];
        if($this->validate($rules)){
            $user = new UserModel();

            $data = [
                'password' => md5($this->request->getVar('password')),
            ];
            if($user->update($id,$data)){
            session()->setFlashdata('msg',"password change");
            return $this->response->redirect(site_url('user'));
            }else{
                $data['errors'] = 'Could not change password';
                return view('login', $data);
            }
        }else{
            $data['validation'] = $this->validator;
            return view('login', $data);
        }
    }else{
        return view('recoverPassword',$data);
    }
    }
 
    public function register(){
        helper(['form']);
        echo view('register');
    }
    public function add(){
        $user = new UserModel();
        $data = [];
        if ($this->request->getMethod() == 'post') {

        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required|min_length[8]|max_length[255]',
            // 'passConf' => 'matches[password]',
        ];

        if($this->validate($rules)){

            $role_id = 2;
            $group_id = 1;

            $data = [ 
                'firstname'=> $this->request->getVar('firstname'),
                'lastname'=> $this->request->getVar('lastname'),
                'email'=> $this->request->getVar('email'),
                'password'=> md5($this->request->getVar('password')),
                'role_id' => $role_id,
                'group_id' => $group_id,
            ];

            $user->insert($data);
            $this->session = session();
            $this->session->setFlashdata('msg', 'User is added');
            return redirect()->to('/dashboard');
        }
        else{
            $data['validation'] = $this->validator;
            echo view('register',$data);
        }
    }else{
        $data['roles'] = $user->showRoles();
        $data['groups'] = $user->showGroup();
        $data['title'] = 'Dashboard';
        $data['base'] = view('admin/adduser',$data);
        return view('admin/adminTemplate',$data);
    }
    }
    // public function check($id = ''){
    //     $user = new UserModel();

    //     $email = md5('arun');
    //     $data = [
    //         'password' => $email,
    //     ];

    //     if($user->update($id,$data)){
    //         echo "Success";
    //     }else{
    //         echo "Failed";
    //     }

    //     //print_r($query);    
    // }
    // public function check2(){

    //     $user = new UserModel();

    //     // $role_id = 1;
    //     // $group_id = 1;

    //     $data = [ 
    //         'firstname'=> 'Dicksey',
    //         'lastname'=> 'Disisent',
    //         'email'=> 'some@one.com',
    //         'password'=> md5("someone"),
    //         'role_id' => 1,
    //         'group_id' => 1,
    //     ];

    //    if($user->insert($data)){
    //        echo "Success";
    //    }
    //    else{
    //        echo 'fail';
    //    }
    // }

    public function profile(){

        $id = $this->user_id;
        $user = new UserModel();

        $row = $user->showSingleUser($id);
        if($row[0]['role_id'] == '2'){
        $data['profile'] = $user->showProfile($id);
        $data['base'] = view('userProfile',$data);
        $data['title'] = 'Profile';
        return view('usertemplate',$data);
        }else{
         $data['profile'] = $user->showProfile($id);
         $data['title'] = 'Profile';
        $data['base'] = view('admin/Profile',$data);
        return view('admin/adminTemplate',$data);
        }
    }

    public function delete($id){
        $user = new UserModel();
       $user->where('user_id',$id)->delete($id);
        return $this->response->redirect(site_url('dashboard'));
    }

    public function edit($id){

        $user = new UserModel();
  
         $data['users'] = $user->showSingleUser($id);
         $data['roles'] = $user->showRoles();
         $data['groups'] = $user->showGroup();
         $data['base'] = view('admin/edit',$data);
         return view('Admin/adminTemplate',$data);
  
      }
  
      public function update(){
  
          $user = new UserModel();
  
          $id = $this->request->getvar('User_id');
  
          $data = [
              'firstname' => $this->request->getVar('firstname'),
              'lastname' => $this->request->getVar('lastname'),
              'email' => $this->request->getVar('email'),
              'role_id'=> $this->request->getVar('role_id'),
              'group_id'=> $this->request->getVar('group_id'),
          ];
  
          $user->update($id, $data);
          return $this->response->redirect(site_url('dashboard'));
      }
}
?>