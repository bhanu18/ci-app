<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ProductModel;

class Product extends BaseController
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

		$role = $userModel->showSingleUser($this->user_id);
		if($role[0]['role_id'] == 1){
		$data['products'] = $product->findall();
		$data['base'] = view('viewProducts',$data);
		return view('Admin/adminTemplate',$data);
		}else{
			echo '<div class="alert alert-danger"> Unauthorize Access</div>';
		}
	}


	public function add(){
		$product = new ProductModel();

		if($this->request->getMethod() == 'post'){
		$data = [
			'Name' => $this->request->getVar('name'),
			'Quantity' => $this->request->getVar('Quantity'),
			'Price' => $this->request->getVar('Price')
		];
		if($data){
			//echo 'P in D';
			$product->insert($data);
			$this->session = session();
			$this->session->setFlashdata('msg', 'Product is Added');
			return redirect()->to('product');
		}
		else{
			//echo 'P in not D';
			$this->session = session();
			$this->session->setFlashdata('msg', 'Product is not Added');
			$data['base'] = view('addProduct');
			return view('Admin/adminTemplate',$data);
			}
	}else{
		//echo 'Display add';
		$data['base'] = view('addProduct');
		return view('Admin/adminTemplate',$data);
	}
	}

	public function edit($id){
		$product = new ProductModel();

		$data['product'] = $product->where('ID',$id)->first();
		$data['base'] = view('editProduct',$data);
		return view('Admin/admintemplate',$data);
	}

	public function update(){

		$product = new ProductModel();

		if($this->request->getMethod() == 'Post'){
			$data = [
			'name' => $this->request->getVar('Name'),
			'Quantity' => $this->request->getVar('Quantity'),
			'Price' => $this->request->getVar('Price')
			];

			$product->update($id,$data);
			$this->session = session();
            $this->session->setFlashdata('msg', 'Product is Updated');
			return redirect()-to('product');
		}else{
		$this->session = session();
        $this->session->setFlashdata('msg', 'Product is not Updated');
		$data['base'] = view('editProduct');
		return view('Admin/adminTemplate',$data);
		}
	}

	public function delete($id){
		$product = new ProductModel();

		$product->delete($id);
		return redirect()-to('product');
	}
      
	public function check(){

		$userModel = new UserModel();
		$role = $userModel->showSingleUser($this->user_id);

		print_r($role);
	}


}