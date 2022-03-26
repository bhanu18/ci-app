<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use Controller\Codeigniter;

// require 'sendgrid-php/sendgrid-php.php';

class User extends BaseController{

    protected $user_id;
	protected $user_name;
    protected $user_role;

	public function __construct(){

    $this->session = session();
    $this->session->start();

    $this->user_id = $this->session->get('user_id');
    $this->user_name = $this->session->get('user_email');
    $this->user_role = $this->session->get('user_role');

    }

    private function loginCheck(){

        $logged_in = session()->get('logged_in');

        if(!isset($logged_in) || $logged_in != TRUE) {
            return $this->response->redirect(site_url('/user'));
        }
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
            $user_role = $row['role_id'];

            if(md5($password) == $user_password){

						$sessdata = [
							'user_id'  	=> $user_id,
                            'user_name' => $user_name,
							'user_email' => $user_email,
                            'user_role' => $user_role,
                            'logged_in' => TRUE
						];
						$this->session->set($sessdata);
						return $this->response->redirect(site_url('dashboard'));

                    }else{
						$data['errors'] = 'Your password wrong. Please try again.';
                        return view('login',$data);
                    }
                }else{

					$data['errors'] = 'No user';
                    return view('login',$data);

				}	
            }

            return view('login');
    }
    public function logout(){

        $this->session->destroy();
		return $this->response->redirect(site_url('User'));

    }

    public function resetPassword(){

        $id = $this->user_id;

        if($this->request->getMethod() == 'Post'){
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

                    echo 'P is C';
                session()->setFlashdata('msg',"password change");
                return redirect()->to('/user/profile');
                }else{

                    echo 'P is N C';
                    $data['errors'] = 'Could not change password';
                    return view('dasboard', $data);
                }
            }else{

                echo 'P is n C due to E';
                $data['validation'] = $this->validator;
                return view('dashboard', $data);
            }
        }else{

            //echo 'P is D';
            return view('Admin/resetPassword');
        }
    }
    public function forgotPassword(){
        helper(['form']);
        echo view('resetPassword');
        
    }
    public function verifyUser(){

        $user = new UserModel();

        $emailID = $this->request->getVar('email');

        $row = $user->get_by_email($emailID);

        $id = $row[0]['user_id'];

        if($user->verifyEmail($emailID) == 1){

            $token = bin2hex(random_bytes(16));

            $data = [
                'token' => $token,
            ];
            $user->update($id, $data);

            $link = '<a href="'.site_url('user/changePassword?token='.$token).'"> link</a>';
            $html = "Dear ".$row[0]['firstname']." ".$row[0]['lastname']."<br><p>This is the ".$link." to change your password.<br><p>Regards</p>";

            $email = \Config\Services::email();
            $email->setFrom('bhanuvidh@windowslive.com', 'Annu');
            $email->setTo($row[0]['email']);
            $email->setSubject('Password Reset for forgot Password');
            $email->setMessage($html);
            
            if($email->send()){
            
            $this->session = session();
            $this->session->setFlashdata('msg', 'Reset password email is sent');
            return $this->response->redirect(site_url('user'));

            }else{
                $this->session = session();
                $this->session->setFlashdata('msg', 'Reset password email is not sent');
                return $this->response->redirect(site_url('user'));
            }
            // return $this->response->redirect(site_url('user/changePassword/'.$token));
        }else{
            $data['errors'] = 'Email not found';
            return view('resetPassword',$data);
        }

    }

    public function changePassword(){

        $token = $this->request->getVar('token');

        $user = new UserModel();

        $id = $user->get_token($token);

        $data['user'] = $user->get_token($token);


        if(!empty($this->request->getVar('password'))){
            $rules = [
                'password' => 'required|min_length[8]|max_length[255]',
                'passConf' => 'matches[password]',
            ];

            if($this->validate($rules)){

                if($token == $id[0]->token){

                    $data = [
                    'password' => md5($this->request->getVar('password')),
                    'token' => null
                     ];
                
                     $user->update($id[0]->user_id ,$data);
                     session()->setFlashdata('msg',"password change");
                     return redirect()->to('/user');
                }else{
                     session()->setFlashdata('msg',"password not changed");
                     return redirect()->to('/user');
                }
    
            }else{
    
                $data['validation'] = $this->validator;
                return view('login', $data);
                
            }
        }
        
    return view('recoverPassword', $data);
    }

    public function profile(){

        $this->loginCheck();

        $id = $this->user_id;
        $user = new UserModel();

        $row = $user->get_single_user($id);


        $data['pro'] = $user->showProfile($id);
        $data['title'] = 'Profile';
        $data['base'] = view('profile',$data);


        if($this->request->getMethod() == 'post'){

            $image = $row[0]['image'];

            if($this->request->getFile('proimage')->isValid()){

                    $imageFile = $this->request->getFile('proimage');
                    $new_name = "image-".$imageFile->getClientExtension();
                    $imageFile->move(ROOTPATH. 'public/uploads/profile', $new_name);
                    $image = $imageFile->getName();

            }

            $upadatedata = [

                "firstname" => $this->request->getVar("firstname"),
                "lastname" => $this->request->getVar("lastname"),
                "image" => $image

            ];

            $user->update($this->request->getVar('user_id'), $upadatedata);
            session()->setFlashdata('msg',"Profile updated");
            return redirect()->to('/user/profile');
        }
        return view('template',$data);
    }
}
?>