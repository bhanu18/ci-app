<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\ProductModel;

class Product extends BaseController
{

	protected $user_id;
	protected $user_name;
	protected $user_role;

	public function __construct()
	{

		$this->session = session();
		$this->session->start();

		$this->user_id = $this->session->get('user_id');
		$this->user_name = $this->session->get('user_email');
		$this->user_role = $this->session->get('user_role');
	}
	private function loginCheck()
	{

		$logged_in = session()->get('logged_in');

		if (!isset($logged_in) || $logged_in != TRUE) {
			return $this->response->redirect(site_url('Admin/user'));
		}
	}

	public function index()
	{

		$this->loginCheck();

		$userModel = new UserModel();
		$product = new ProductModel();

		$data['products'] = $product->findall();
		$data['base'] = view('viewProducts', $data);
		return view('Admin/adminTemplate', $data);
	}

	public function view()
	{
		$product = new ProductModel();

		$product_data = $product->findall();

		echo json_encode($product_data);
	}


	public function add()
	{


		$this->loginCheck();

		$product = new ProductModel();

		if ($this->request->getMethod() == 'post') {
			$data = [
				'Name' => $this->request->getVar('name'),
				'Quantity' => $this->request->getVar('Quantity'),
				'Cost_Price' => $this->request->getVar('Cost_Price'),
				'Price' => $this->request->getVar('Price')
			];
			if ($data) {
				//echo 'P in D';
				$product->insert($data);
				$this->session = session();
				$this->session->setFlashdata('msg', 'Product is Added');
				return redirect()->to('Admin/product');
			} else {
				//echo 'P in not D';
				$this->session = session();
				$this->session->setFlashdata('msg', 'Product is not Added');
				$data['base'] = view('addProduct');
				return view('Admin/adminTemplate', $data);
			}
		} else {
			//echo 'Display add';
			$data['sizes'] = $product->getSize();
			$data['base'] = view('addProduct', $data);
			return view('Admin/adminTemplate', $data);
		}
	}

	public function edit($id)
	{

		$this->loginCheck();

		$product = new ProductModel();

		$data['product'] = $product->where("ID", $id)->first();

		// print_r($product->getProductById($id));
		// die;
		// $data['sizes'] = $product->getSize();
		$data['base'] = view('editProduct', $data);
		return view('Admin/adminTemplate', $data);
	}

	public function update()
	{

		$this->loginCheck();

		$product = new ProductModel();

		if ($this->request->getMethod() == 'post') {
			$data = [
				'Name' => $this->request->getVar('Name'),
				'Quantity' => $this->request->getVar('Quantity'),
				'Cost_Price' => $this->request->getVar('Cost_Price'),
				'Price' => $this->request->getVar('Price')
			];
			$id = $this->request->getVar('ID');
			$product->update($id, $data);
			$this->session = session();
			$this->session->setFlashdata('msg', 'Product is Updated');
			return redirect()->to('Admin/product');
		} else {
			$this->session = session();
			$this->session->setFlashdata('msg', 'Product is not Updated');
			return redirect()->to('Admin/product');
		}
	}

	public function delete($id = '')
	{

		$this->loginCheck();

		$product = new ProductModel();

		$product->delete($id);
		return redirect()->to('Admin/product');
	}

	public function reminder()
	{

		$product = new ProductModel();

		$rows = $product->findAll();

		foreach ($rows as $row) {
			if ($row['Quantity'] <= 2) {
				print_r($row['Name'] . $row['Quantity']);
			}
		}
	}
}
