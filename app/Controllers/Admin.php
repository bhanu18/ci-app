<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use Controller\Codeigniter;

class Admin extends BaseController
{
    protected $session;
    protected $user_id;
	protected $user_name;

	public function __construct(){

    $this->session = \Config\Services::session();
    $this->session->start();

    $this->user_id = $this->session->get('sess_admin_id');
    $this->user_name = $this->session->get('sess_admin_email');

    }

    public function index(){
        
       $data =[];
        if($this->request->getMethod() == 'post'){

            $username = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $admin = new AdminModel();
            $row = $admin->adminLogin($username, $password);

            if(!empty($row)){

            $admin_id = $row['id'];
			$admin_email = $row['email'];
			$admin_password = $row['password'];

            if(md5($password) == $admin_password){

						$sessdata = [
							'sess_admin_id'  	=> $admin_id,
							'sess_admin_email'    => $admin_email,
                            'logged_in' => TRUE
						];
						$this->session->set($sessdata);
						return $this->response->redirect(site_url('dashboard'));
                    }else{
						$data['errors'] = 'Your password wrong. Please try again.';
                        return view('admin/login',$data);
                    }
                }
                else{

					$data['errors'] = 'No user';
                    return view('Admin/login',$data);

				}	
            }
            else{
                return view('Admin/login',$data);
            }
    }
    public function logout(){

        $this->session->destroy();
		return redirect()->to('Admin');

    }

    public function createUser(){
        $data['base'] = view('createuser',$data);
        return view('admin/adminTemplate', $data);
    }
    
    public function addUser(){
        $user = new UserModel();

        $rules =[
            'firstname'=> 'required',
            'lastname'=> 'required',
            'email' => 'is_unique[users.email]',
            'password'=> 'required',
        ];

        if($this->validate($rules)){
        $data = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'email' => $this->request->getVar('email'),
            'password' => md5($this->request->getVar('password')),
            'role_id'=> $this->request->getVar('role'),
            'group_id'=> $this->request->getVar('group'),
        ];

        $user->insert($data);
        return $this->response->redirect(site_url('Dashboard'));
    }else{
        $data['validation'] = $this->validator;
        $data['base'] = view('Admin/dashboard', $data);
        return view('Admin/adminTemplate', $data);
    }
    }

    public function profile(){
        echo view('Admin/profile');
    }

    public function edit($id){

      $user = new UserModel();

       $data['users'] = $user->showSingleUser($id);
       $data['roles'] = $user->showRoles();
       $data['groups'] =$user->showGroup();
       $data['base'] = view('Admin/edit',$data);
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

    public function delete($id){
        $user = new UserModel();
       $user->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('dashboard'));
    }
    public function forgotPassword(){
        helper(['form']);
        echo view('Admin/resetPassword');
        
    }
    public function verifyUser(){

        $user = new UserModel();

        $email = $this->request->getVar('email');

        $row = $user->where('email', $email)->first();

        if($email == $row['email']){
            return $this->response->redirect(site_url('user/ChangePassword/'.$row[0]['id']));
        }else{
            $data['error'] = 'No User found';
            return view('resetPassword',$data);
        }

    }

    public function changePassword($id){

        if($this->request->getMethod() == 'post'){

        $rules = [
            'password' => 'required|min_length[8]|max_length[255]',
            'passConf' => 'matches[password]',
        ];

        if($this->validate($rules)){
            $user = new UserModel();

            //$row = $user->where('id', $id)->first();

            $password = md5($this->request->getVar('password'));

            $data = [
                'password' => $password,
            ];

            $user->save($id,$data);
            return $this->response->redirect(site_url('user'));

        }
    }else{
        return view('recoverPassword',$data);
    }
    }
    
}