<?php 

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model{

    protected $table = 'item_sales';
    protected $primaryKey ='sale_id';
    
    protected $allowedFields = ['prod_id','sale_quantity', 'size', 'sale_price'];

    public function displaySales(){
        $db = \Config\Database::connect();
        // $query = $db->query("select sale_id, name ,date, sale_quantity, sale_price from items_sale join product on items_sale.prod_id = product.Id;");
        // return $query->getResultArray();
        $builder = $db->table('item_sales');
        $builder->select('sale_id, name, date, sale_quantity, sale_price');
        $builder->join('products', 'products.ID = item_sales.prod_id');
        $query = $builder->get();
        return $result = $query->getResultArray();
    }

    public function deleteSale($id){
        $db = \Config\Database::connect();
        $builder = $db->table('item_sales');
        $builder->where(['sale_id'=> $id]);
        $builder->delete();
    }

    public function edit($id){
        $db = \Config\Database::connect();
        $builder = $db->table('item_sales');
        $builder->select('sale_id, name, date, sale_quantity,  size, sale_price');
        $builder->join('products', 'products.ID = item_sales.prod_id');
        $builder->where('sale_id', $id);
        $query = $builder->get();
        return $result = $query->getResultArray();
    }
    public function get_sale_quantity($id){
        $db = \Config\Database::connect();
        $builder = $db->table('item_sales');
        $builder->select('prod_id, sale_quantity');
        $builder->where('sale_id', $id);
        $query = $builder->get();
        return $result = $query->getResultArray();
    }
}
?>