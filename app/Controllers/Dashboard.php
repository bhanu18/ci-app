<?php namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\SalesModel;
use App\Models\CalendarModel;
use Controller\Codeigniter;

class Dashboard extends BaseController{

    protected $user_id;
	protected $user_name;

	public function __construct(){

    $this->session = session();
    $this->session->start();

    $this->user_id = $this->session->get('user_id');
    $this->user_name = $this->session->get('user_email');

    }

    public function index(){

        $userModel = new UserModel();
        $SalesModel = new SalesModel();
        $Productmodel = new ProductModel();
        $calendarModel = new CalendarModel();

        if($this->user_id == '') return $this->response->redirect(site_url("/user"));

        $row = $userModel->VerifyUserRole($this->user_id);
        if($row[0]['role_id'] == '1'){
        $userModel = new UserModel();
        $data['sale'] = $SalesModel->displaySales();
        $data['products'] = $Productmodel->findall();
        $data['calendar'] = $calendarModel->DailySales();
        $data['title'] = 'Dashboard';
        $data['base'] = view('Admin/dashboard',$data);
        return view('Admin/adminTemplate',$data);
        }else{
            $data['base'] = '<div class="alert alert-danger" role="alert">
            Unauthorize access
          </div>';
          return view('Admin/adminTemplate',$data);
        }
    }

    public function check(){
        $userModel = new UserModel();

        $row = $userModel->VerifyUserRole(1);

        print_r($row);
    }
}