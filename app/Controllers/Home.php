<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\SalesModel;

class Home extends BaseController
{

	protected $user_id;
	protected $user_name;

	public function __construct(){

    $this->session = session();
    $this->session->start();

    $this->user_id = $this->session->get('user_id');
    $this->user_name = $this->session->get('user_email');

    }

	public function index()
	{
        $userModel = new UserModel();
		$product = new ProductModel();
		$sale = new SalesModel();

        if($this->user_id == '') return $this->response->redirect(site_url("/user"));
		$data['products'] = $product->findall();
		$data['sales'] = $sale->displaySales();
		$data['base'] = view('home',$data);
		return view('usertemplate',$data);
	}
}
