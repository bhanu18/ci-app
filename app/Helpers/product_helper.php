<?php 
namespace App\helpers;
use App\Models\ProductModel;

class product_helper 
{
    public function addProduct(){
        $data = [
			'name' => $this->request->getVar('name'),
			'Quantity' => $this->request->getVar('Quantity'),
			'Price' => $this->request->getVar('Price')
		];

		$product->insert($data);
    }
}

?>