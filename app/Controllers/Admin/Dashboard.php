<?php 

namespace App\Controllers\Admin;

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
    private function loginCheck(){

        $logged_in = session()->get('logged_in');

        if(!isset($logged_in) || $logged_in != 1) {
            return $this->response->redirect(site_url('Admin/user'));
        }
    }

    public function index(){

        $this->loginCheck();
        
        $SalesModel = new SalesModel();
        $Productmodel = new ProductModel();
        $calendarModel = new CalendarModel();
        
        $data['trend_sale'] = $SalesModel->trending_product();
        $data['products'] = $Productmodel->findall();
        $data['calendar'] = $calendarModel->DailySales();
        $data['monthly_sales'] = $SalesModel->monthly_sales();
        $data['current_month'] = $SalesModel->current_month_sales();
        $data['current_month_pieces'] = $SalesModel->current_month_pieces();
        $data['avg_month_pieces'] = $SalesModel->avg_month_pieces();
        $data['avg_month_sale'] = $SalesModel->avg_month_sale();
        $data['title'] = 'Dashboard';
        $data['base'] = view('Admin/dashboard',$data);
        return view('Admin/adminTemplate',$data);
    }
}