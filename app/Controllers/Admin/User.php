<?php

namespace App\Controllers\Admin;

use App\Models\AdminModel;
use App\Models\UserModel;
use Controller\Codeigniter;

class User extends BaseController
{
    protected $session;
    protected $user_id;
	protected $user_name;

    protected $admin = true;

	public function __construct(){

    $this->session = \Config\Services::session();
    $this->session->start();

    $this->user_id = $this->session->get('sess_admin_id');
    $this->user_name = $this->session->get('user_name');
    $this->user_email = $this->session->get('sess_admin_email');
    $this->admin = $this->session->get('admin');
    }

    public function index(){
        
       $data = [];

        if($this->request->getMethod() == 'post'){

            $username = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $admin = new AdminModel();
            $row = $admin->adminLogin($username, $password);

            if(!empty($row)){

            $admin_id = $row['id'];
			$admin_email = $row['email'];
            $admin_name = $row['firstname'];
			$admin_password = $row['password'];

            if(md5($password) == $admin_password){

						$sessdata = [
							'sess_admin_id' => $admin_id,
							'sess_admin_email' => $admin_email,
                            'sess_admin_user_name' => $admin_name,
                            'logged_in' => TRUE
						];
						$this->session->set($sessdata);
						return $this->response->redirect(site_url('Admin/dashboard'));
                    }else{
						$data['errors'] = 'Your password wrong. Please try again.';
                        return view('Admin/login',$data);
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

    private function loginCheck(){

        $logged_in = session()->get('logged_in');

        if(!isset($logged_in) || $logged_in != TRUE) {
            return $this->response->redirect(site_url('Admin/user'));
        }
    }


    public function logout(){

        $this->session->destroy();
		return redirect()->to('/Admin');

    }

    public function profile(){
        
        $adminModel = new AdminModel();
        $data['admin'] =  $this->admin;
        $data['profile'] = $adminModel->where('id', $this->user_id)->first();
        $data['base'] = view('Admin/profile');
        return view('Admin/adminTemplate',$data);
    }

    public function edit($id = null){

      $user = new UserModel();
      
      $data['admin'] =  $this->admin;
      $data['users'] = $user->get_single_user($id);
      $data['roles'] = $user->showRoles();
      $data['groups'] =$user->showGroup();
      $data['base'] = view('Admin/edit',$data);

      if($this->request->getMethod() == 'post'){
        
        $id = $this->request->getvar('user_id');
  
        $data = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'email' => $this->request->getVar('email'),
            'role_id'=> $this->request->getVar('role_id'),
            'group_id'=> $this->request->getVar('group_id'),
        ];

        $user->update($id, $data);
        session()->setFlashdata('msg',"User Updated");
        return $this->response->redirect(site_url('admin/view'));
      }else{
        session()->setFlashdata('msg',"User not updated");
        return $this->response->redirect(site_url('admin/user/view'));
      }
      return view('Admin/adminTemplate',$data);

    }
    
    public function update(){
        if($this->request->getMethod() == 'post'){
        
            $id = $this->request->getvar('user_id');
      
            $data = [
                'firstname' => $this->request->getVar('firstname'),
                'lastname' => $this->request->getVar('lastname'),
                'email' => $this->request->getVar('email'),
                'role_id'=> $this->request->getVar('role_id'),
                'group_id'=> $this->request->getVar('group_id'),
            ];
    
            $user->update($id, $data);
            session()->setFlashdata('msg',"User Updated");
            return $this->response->redirect(site_url('admin/view'));
          }else{
            session()->setFlashdata('msg',"User not updated");
            return $this->response->redirect(site_url('admin/user/view'));
          }
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
    
    public function register(){

        $this->loginCheck();
        helper(['form']);
        echo view('register');
    }
    
    public function add(){

        $this->loginCheck();
        // userAdminCheck($this->user_role, $this->user_id);

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
            return redirect()->to('/user/view');
        }
        else{
            $data['validation'] = $this->validator;
            echo view('register',$data);
        }
    }else{
        $data['admin'] =  $this->admin;
        $data['roles'] = $user->showRoles();
        $data['groups'] = $user->showGroup();
        $data['title'] = 'Add User';
        $data['base'] = view('Admin/adduser',$data);
        return view('Admin/adminTemplate',$data);
    }
    }

    public function view(){

        $this->loginCheck();

        $user = new UserModel();
        $admin_users = new AdminModel();

        $data['admin'] =  $this->admin;
        $data['users'] = $user->get_all_user();
        $data['admin_users'] = $admin_users->findall();
        $data['base'] = view('Admin/view-user',$data);
        return view('Admin/adminTemplate',$data);
    }

    public function delete($id){

        $this->loginCheck();
        // userAdminCheck($this->user_role, $this->user_id);

        $user = new UserModel();
        $user->where('user_id',$id)->delete($id);
        return $this->response->redirect(site_url('admin/view'));
    }

    public function addGroup(){

        $this->loginCheck();

        if($this->request->getMethod() == "Post"){
            $db = \Config\Database::connect();
            $builder = $db->table('Groups');
            $data = [
                'Group_name' => $this->request->getVar('Group_name'),
            ];

            $this->session = session();
            $this->session->setFlashdata('msg', 'Group is added');
            $builder->insert($data);
            return redirect()->to('dashboard');

        }else{
            $data['admin'] =  $this->admin;
            $data['base'] = view('Admin/addGroup');
            return view('Admin/adminTemplate',$data);
        }
    }
    
}