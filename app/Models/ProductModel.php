<?php 
namespace App\Models;

use CodeIgniter\Model;


class ProductModel extends Model{

    protected $table= "products";

    protected $primaryKey = "ID";

    protected $allowedFields = ['Name', 'Quantity', 'Price'];

    
}
?>