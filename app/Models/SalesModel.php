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

    public function monthly_sales(){

        $db = \Config\Database::connect();
        $sql = "SELECT date_format(item_sales.date, '%M') AS Month, sum(item_sales.sale_price) AS Sales from item_sales GROUP BY year(item_sales.date),month(item_sales.date) ORDER BY year(item_sales.date),month(item_sales.date);";
        $result = $db->query($sql)->getResult();
        return $result;
    }

    public function current_month_sales(){
        $db = \Config\Database::connect();
        $sql = "SELECT date_format(item_sales.date, '%M') AS Month, sum(item_sales.sale_price) AS sales from item_sales WHERE MONTH(item_sales.date) = MONTH(now()) GROUP BY year(item_sales.date),month(item_sales.date) ORDER BY year(item_sales.date),month(item_sales.date)";
        $result = $db->query($sql)->getResult();
        return $result;
    }
    public function current_month_pieces(){
        $db = \Config\Database::connect();
        $sql = "SELECT date_format(item_sales.date, '%M') AS Month, sum(item_sales.sale_quantity) AS Piece from item_sales WHERE MONTH(item_sales.date) = MONTH(now()) GROUP BY year(item_sales.date),month(item_sales.date) ORDER BY year(item_sales.date),month(item_sales.date)";
        $result = $db->query($sql)->getResult();
        return $result;
    }

    public function avg_month_pieces(){
        $db = \Config\Database::connect();
        $sql = "SELECT date_format(item_sales.date, '%M') AS Month, AVG(item_sales.sale_quantity) AS avg_piece from item_sales WHERE MONTH(item_sales.date) = MONTH(now()) GROUP BY year(item_sales.date),month(item_sales.date)";
        $result = $db->query($sql)->getResult();
        return $result;
    }
    public function avg_month_sale(){
        $db = \Config\Database::connect();
        $sql = "SELECT date_format(item_sales.date, '%M') AS Month, AVG(item_sales.sale_price) AS avg_month from item_sales WHERE MONTH(item_sales.date) = MONTH(now()) GROUP BY year(item_sales.date),month(item_sales.date)";
        $result = $db->query($sql)->getResult();
        return $result;
    }

    public function trending_product(){
        $db = \Config\Database::connect();
        $sql = "SELECT products.Name AS products, count(products.name) AS Count from item_sales join products on item_sales.prod_id = products.ID GROUP BY products.Name ORDER BY COUNT(products.name) DESC";
        $result = $db->query($sql)->getResult();
        return $result;
    }
}
?>