<?php 
namespace App\Models;

use CodeIgniter\Model;


class OrderModel extends Model{

    protected $table= "Order";

    protected $primaryKey = "order_id";

    protected $allowedFields = ['id_cart', 'customer_id', 'total_price'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
?>