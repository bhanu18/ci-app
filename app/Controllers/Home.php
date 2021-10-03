<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ProductModel;

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

        if($this->user_id == '') return $this->response->redirect(site_url("/user"));
		$data['products'] = $product->findall();
		$data['base'] = view('home',$data);
		return view('usertemplate',$data);
	}
}
