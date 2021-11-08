<?php 

namespace App\Controllers;

use Controller\Codeigniter;
use App\Models\SalesModel;

class sale extends BaseController{

    protected $session;
    protected $user_id;
	protected $user_name;

	public function __construct(){

    $this->session = \Config\Services::session();
    $this->session->start();

    $this->user_id = $this->session->get('sess_admin_id');
    $this->user_name = $this->session->get('sess_admin_email');

    }

    public function index(){
        $SalesModel = new SalesModel();
        $data['title'] = 'Sales';
        $data['sale'] = $SalesModel->displaySales();
        $data['base'] = view('viewSales',$data);
        return view('admin/adminTemplate',$data);
   }

   public function create(){

       $Productmodel = new Productmodel(); 
       $data['product'] = $Productmodel->orderby('Id')->findall();
       $data['title'] = 'Add/Edit Sale';
       $data['base'] = view('add-sale', $data);
       return view('admin/adminTemplate',$data);
       
     }


   public function add(){
       $SalesModel = new SalesModel();
       $data = [
           'prod_id' => $this->request->getVar('product'),
           'sale_quantity' => $this->request->getVar('quantity'),
           'size' => $this->request->getVar('size'),
           'sale_price' => $this->request->getVar('price'),
       ];
       if($SalesModel->insert($data)){
       $Productmodel = new Productmodel();
       $db = \Config\Database::connect();
       $id = $this->request->getVar('product');
       $quantity = $this->request->getVar('quantity');
       $query = $db->query("SELECT * from product WHERE id ='".$id."'"); // get row from product
       $row = $query->getRowArray();
       $row_quan = $row['Quantiy'];
           $row_quan -= $quantity; // minus the sale quantity from the product quantity
           $query = $db->query("UPDATE product SET quantiy = ".$row_quan." WHERE Id = '".$id."'");
           return $this->response->redirect(site_url('/sales'));
       }else{
           $message['error'] = "Cannot enter data";
           return view("add-sale", $message);
       }
   }

   public function edit($id){
       $SalesModel = new SalesModel();
       // $data['isedit'] = $isEdit;
       $data['title']= 'Edit Sale';
       $data['sale']= $SalesModel->edit($id);
       $data['base']= view('edit-sale', $data);
       return view('admin/adminTemplate', $data);
   }


   public function update($id){ 
       $SalesModel = new SalesModel();

       $data = [
           'sale_quantity' => $this->request->getVar('quantity'),
           'sale_price' => $this->request->getVar('price'),
       ];

       $SalesModel->update($id,$data);
       return $this->response->redirect(site_url('sales'));
   }

   public function delete($id){
       $SalesModel = new SalesModel();
       $SalesModel->deleteSale($id);
       return $this->response->redirect(site_url('sales'));
   }

}

?>