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

    }

    public function index(){
        $SalesModel = new SalesModel();
        $data['title'] = 'Sales';
        $data['sale'] = $SalesModel->displaySales();
        $data['base'] = view('viewSales',$data);
        return view('admin/adminTemplate',$data);
   }

   public function create(){

       $Productmodel = new ProductModel(); 
       $data['product'] = $Productmodel->orderby('Id')->findall();
       $data['title'] = 'Add/Edit Sale';
       $data['base'] = view('add-sale', $data);
       return view('Admin/adminTemplate',$data);    
     }

   public function add(){
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

       $data['product'] = $Productmodel->findall();
       $data['base'] = view('add-sale',$data);
       return view('Admin/adminTemplate',$data);
   }

   public function edit($id){

    $SalesModel = new SalesModel();
    $Productmodel = new ProductModel();

    $data['sales']= $SalesModel->edit($id);
    $data['product'] = $Productmodel->findall();
    $data['base']= view('edit-sale', $data);
    return view('Admin/adminTemplate', $data);
   }

   public function update(){ 
       $SalesModel = new SalesModel();
       $Productmodel = new ProductModel();

       $id = $this->request->getVar('sale_id');

       if($this->request->getMethod() == "post"){
       $data = [
           'sale_quantity' => $this->request->getVar('quantity'),
           'sale_price' => $this->request->getVar('price'),
       ];

       $SalesModel->update($id,$data);
       $this->session = session();
       $this->session->setFlashdata('msg', 'Sale updated');
       return $this->response->redirect(site_url('sale'));

    }

   }

   public function delete($id){
       $SalesModel = new SalesModel();
       $SalesModel->deleteSale($id);
       return $this->response->redirect(site_url('sale'));
   }

}

?>