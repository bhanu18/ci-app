<?php 
namespace App\Models;

use CodeIgniter\Model;


class ProductModel extends Model{

    protected $table= "products";

    protected $primaryKey = "ID";

    protected $allowedFields = ['Name', 'Quantity', 'size_id', 'Cost_Price', 'Price'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getSize(){
        $db = \Config\Database::connect();
        $builder = $db->table('size');
        $builder->select('id, size');
        $query = $builder->get();
        return $result = $query->getResultArray();
    }

    function getProduct(){
        $db = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->select('products.ID AS ID, Name, Quantity, Size, Price');
        $builder->join('size' , 'size.id = products.size_id');
        $query = $builder->get();
        return $result = $query->getResultArray();
        
    }
    function getProductById($id){
        $db = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->select('products.ID AS ID, Name, Quantity, Size, Price');
        $builder->join('size' , 'size.id = products.size_id');
        $builder->where('products.ID',$id);
        $query = $builder->get();
        return $query->getRowArray();
        
    }

    function reminder(){
        $db = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->select('Name, Quantity');
        $builder->where('Quantity', "<=2");
    }
}
?>