<?php

namespace App\Controllers;

use Controller\Codeigniter;
use App\Models\SalesModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\CartModel;

use CodeIgniter\API\ResponseTrait;

class sale extends BaseController
{

    protected $session;
    protected $user_id;
    protected $user_name;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();

        $this->user_id = $this->session->get('sess_admin_id');
        $this->user_name = $this->session->get('sess_admin_email');
        $this->user_role = $this->session->get('user_role');
    }

    private function loginCheck()
    {

        $logged_in = session()->get('logged_in');

        if (!isset($logged_in) || $logged_in != TRUE) {
            return $this->response->redirect(site_url('/user'));
        }
    }

    public function index()
    {

        $this->loginCheck();

        $SalesModel = new SalesModel();
        $data['title'] = 'Sales';
        $data['sale'] = $SalesModel->displaySales();
        $data['base'] = view('viewSales', $data);
        return view('template', $data);
    }

    public function create()
    {

        $this->loginCheck();

        $Productmodel = new ProductModel();
        $data['title'] = 'Add/Edit Sale';
        $data['product'] = $Productmodel->findAll();
        $data['base'] = view('add-sale', $data);
        return view('template', $data);
    }

    public function add()
    {

        $this->loginCheck();

        $SalesModel = new SalesModel();
        $Productmodel = new ProductModel();

        if ($this->request->getMethod() == 'post') {
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
            $Productmodel->update($this->request->getVar('product'), $data);
            $this->session = session();
            $this->session->setFlashdata('msg', 'Sale Added');
            return redirect()->to('/sale');
        }

        $data['product'] = $Productmodel->findAll();
        $data['base'] = view('add-sale', $data);
        return view('template', $data);
    }

    public function edit($id)
    {

        $this->loginCheck();

        $SalesModel = new SalesModel();
        $Productmodel = new ProductModel();

        $data['sales'] = $SalesModel->edit($id);
        $data['product'] = $Productmodel->findAll();
        $data['base'] = view('edit-sale', $data);
        return view('template', $data);
    }

    public function update()
    {

        $this->loginCheck();

        $SalesModel = new SalesModel();
        $Productmodel = new ProductModel();

        $id = $this->request->getVar('sale-id');

        if ($this->request->getMethod() == "post") {

            $data = [
                'sale_quantity' => $this->request->getVar('quantity'),
                'sale_price' => $this->request->getVar('sale_price'),
            ];

            $current_sale_quantity = $SalesModel->get_sale_quantity($id);

            if ($this->request->getVar('quantity') > $current_sale_quantity[0]['sale_quantity']) {

                $difference =  $this->request->getVar('quantity') - $current_sale_quantity[0]['sale_quantity']; // finding the diff between current sale quantity and updated sale quantity
                //    echo $difference."<br>";
                $quantity = $Productmodel->find($current_sale_quantity[0]['prod_id']);
                $current_product_quantity = $quantity['Quantity'];
                $current_product_quantity += $difference; // minus the diff to current product quantity

                $prod_data = [
                    'Quantity' => $current_product_quantity,
                ];
                $SalesModel->update($id, $data);
                $Productmodel->update($current_sale_quantity[0]['prod_id'], $prod_data);
                $this->session = session();
                $this->session->setFlashdata('msg', 'Sale updated');
                return $this->response->redirect(site_url('sale'));
            } elseif ($this->request->getVar('quantity') < $current_sale_quantity[0]['sale_quantity']) {

                $minus_diff = $current_sale_quantity[0]['sale_quantity'] - $this->request->getVar('quantity'); // finding the diff between current sale quantity and updated sale quantity
                // echo $minus_diff.'<br>';
                $prod_quantity = $Productmodel->find($current_sale_quantity[0]['prod_id']);
                $current_prod_quantity = $prod_quantity['Quantity'];
                $current_prod_quantity -= $minus_diff; // plus the diff to current product quantity

                $product_update_data = [
                    'Quantity' => $current_prod_quantity,
                ];
                $SalesModel->update($id, $data);
                $Productmodel->update($current_sale_quantity[0]['prod_id'], $product_update_data);
                $this->session = session();
                $this->session->setFlashdata('msg', 'Sale updated');
                return $this->response->redirect(site_url('sale'));
            } elseif ($this->request->getVar('quantity') == $current_sale_quantity[0]['sale_quantity']) {

                $SalesModel->update($id, $data);
                $this->session = session();
                $this->session->setFlashdata('msg', 'Sale updated', 300);
                return $this->response->redirect(site_url('sale'));
            } else {
                $this->session = session();
                $this->session->setFlashdata('msg', 'Sale not updated');
                return $this->response->redirect(site_url('sale'));
            }
        }
    }

    public function delete($id)
    {

        $this->loginCheck();

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

    public function add_via_post()
    {

        $sale_model = new SalesModel();

        $data = [
            'prod_id' => $this->request->getVar('product'),
            'sale_quantity' => $this->request->getVar('quantity'),
            'size' => $this->request->getVar('size'),
            'sale_price' => $this->request->getVar('price'),
        ];

        $sale_model->insert($data);

        return http_response_code(200);
    }

    public function insert()
    {

        $orderModel = new OrderModel;
        $cartModel = new CartModel;

        if ($this->request->getMethod() == 'post') {

            $order_data = [
                'customer_id' => $this->request->getVar('customer_id'),
                'total_price' => $this->request->getVar('total_price')
            ];
            foreach ($_POST['product'] as $k => $val) {

                $cart_data = [
                    'product_id' => $_POST['product'][$k],
                    'quantity' => $_POST['quantity'][$k],
                    'price' => $_POST['price'][$k]
                ];

                $cartModel->insert($cart_data);
            }

            $id = $cartModel->getInsertID();

            $order_data['id_cart'] = $id;

            $orderModel->insert($order_data);

           return $this->response->redirect(site_url('sale'));
        }
    }

    public function view($id){

        $orderModel = new OrderModel;

        $data['order'] = $orderModel->find()->where('customer_id', $id);

        $data['base'] = view('edit-sale', $data);
        return view('template', $data);


    }
}
