<?php 

namespace App\Controllers;

use Controller\Codeigniter;
use App\Models\SalesModel;
use App\Models\ProductModel;

class sale extends BaseController{

    protected $session;
    protected $user_id;
	protected $user_name;

	public function __construct(){

    $this->session = \Config\Services::session();
    $this->session->start();

    $this->user_id = $this->session->get('sess_admin_id');
    $this->user_name = $this->session->get('sess_admin_email');
    $this->user_role = $this->session->get('user_role');

    }

    public function index(){
        if($this->user_role >= 2) return "Unauthorized Access";
        $SalesModel = new SalesModel();
        $data['title'] = 'Sales';
        $data['sale'] = $SalesModel->displaySales();
        $data['base'] = view('viewSales',$data);
        return view('Admin/adminTemplate',$data);
   }

   public function create(){

    if($this->user_role >= 2) return "Unauthorized Access";
       $Productmodel = new ProductModel(); 
       $data['title'] = 'Add/Edit Sale';
       $data['product'] = $Productmodel->findAll();
       $data['base'] = view('add-sale', $data);
       return view('Admin/adminTemplate',$data);    
     }

   public function add(){
    if($this->user_role >= 2) return "Unauthorized Access";
       $SalesModel = new SalesModel();
       $Productmodel = new ProductModel();

       if($this->request->getMethod() == 'post'){
        $data = [
            'prod_id' => $this->request->getVar('product'),
            'sale_quantity' => $this->request->getVar('quantity'),
            'size' => $this->request->getVar('size'),
            'sale_price' => $this->request->getVar('price'),
        ];

        $SalesModel->insert($data);
        $quantity = $Productmodel->find($this->request->getVar('product'));
        $quan = $quantity['Quantity'];
        $quan -= $this->request->getVar('quantity');
        $data = [
            'Quantity' => $quan,
        ];
        $Productmodel->update($this->request->getVar('product'),$data);
        $this->session = session();
        $this->session->setFlashdata('msg', 'Sale Added');
        return redirect()->to('/sale');
       }

       $data['product'] = $Productmodel->findAll();
       $data['base'] = view('add-sale',$data);
       return view('Admin/adminTemplate',$data);
   }

   public function edit($id){
    if($this->user_role >= 2) return "Unauthorized Access";

    $SalesModel = new SalesModel();
    $Productmodel = new ProductModel();

    $data['sales']= $SalesModel->edit($id);
    $data['product'] = $Productmodel->findAll();
    $data['base']= view('edit-sale', $data);
    return view('Admin/adminTemplate', $data);
   }

   public function update(){ 
    if($this->user_role >= 2) return "Unauthorized Access";
       $SalesModel = new SalesModel();
       $Productmodel = new ProductModel();

       $id = $this->request->getVar('sale-id');

       if($this->request->getMethod() == "post"){

        $data = [
            'sale_quantity' => $this->request->getVar('quantity'),
            'sale_price' => $this->request->getVar('sale_price'),
        ];

       $current_sale_quantity = $SalesModel->get_sale_quantity($id);

       if($this->request->getVar('quantity') > $current_sale_quantity[0]['sale_quantity']){

           $difference =  $this->request->getVar('quantity') - $current_sale_quantity[0]['sale_quantity']; // finding the diff between current sale quantity and updated sale quantity
        //    echo $difference."<br>";
           $quantity = $Productmodel->find($current_sale_quantity[0]['prod_id']);
           $current_product_quantity = $quantity['Quantity']; 
           $current_product_quantity += $difference; // minus the diff to current product quantity
      
           $prod_data = [
            'Quantity' => $current_product_quantity,
           ];
           $SalesModel->update($id,$data);
           $Productmodel->update($current_sale_quantity[0]['prod_id'], $prod_data);
           $this->session = session();
           $this->session->setFlashdata('msg', 'Sale updated');
           return $this->response->redirect(site_url('sale'));
       }
       elseif($this->request->getVar('quantity') < $current_sale_quantity[0]['sale_quantity']){

        $minus_diff = $current_sale_quantity[0]['sale_quantity'] - $this->request->getVar('quantity'); // finding the diff between current sale quantity and updated sale quantity
        // echo $minus_diff.'<br>';
        $prod_quantity = $Productmodel->find($current_sale_quantity[0]['prod_id']);
        $current_prod_quantity = $prod_quantity['Quantity'];
        $current_prod_quantity -= $minus_diff; // plus the diff to current product quantity

        $product_update_data = [
            'Quantity' => $current_prod_quantity,
        ];
        $SalesModel->update($id,$data);
        $Productmodel->update($current_sale_quantity[0]['prod_id'], $product_update_data);
        $this->session = session();
        $this->session->setFlashdata('msg', 'Sale updated');
        return $this->response->redirect(site_url('sale'));

    }
    elseif($this->request->getVar('quantity') == $current_sale_quantity[0]['sale_quantity']){

        $SalesModel->update($id,$data);
        $this->session = session();
        $this->session->setFlashdata('msg', 'Sale updated', 300);
        return $this->response->redirect(site_url('sale'));
    }
       else{
           $this->session = session();
           $this->session->setFlashdata('msg', 'Sale not updated');
           return $this->response->redirect(site_url('sale'));
       }

    }

   }

   public function delete($id){
       $SalesModel = new SalesModel();
       $Productmodel = new ProductModel();

       $current_sale_quantity = $SalesModel->get_sale_quantity($id);
       $quantity = $Productmodel->find($current_sale_quantity[0]['prod_id']);
       $updated_quantity = $quantity['Quantity'];
       $updated_quantity += $current_sale_quantity[0]['sale_quantity']; // add the current sale quantity to product quantity
       $data = [
           "Quantity" => $updated_quantity,
       ];
       $Productmodel->update($current_sale_quantity[0]['prod_id'], $data);
       $SalesModel->deleteSale($id);
       $this->session = session();
       $this->session->setFlashdata('msg', 'Sale deleted');
       return $this->response->redirect(site_url('sale'));
   }
}

?>