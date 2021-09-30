<?php 
namespace App\Models;

use CodeIgniter\Model;


class AdminModel extends Model{

    protected $table="adminUsers";

    protected $primaryKey = "id";

    protected $allowedFields = ['firstname', 'lastname', 'email'];

    

    protected $AdminTable = 'adminUsers';

    public function adminLogin($username = '',$passwod=''){
        $db = \Config\Database::connect();

        $sql = "SELECT * FROM ".$this->AdminTable." WHERE email = '".$username."'";
        $result = $db->query($sql)->getRowArray();

        return $result;
    }
    public function verifyUserRole($id){
        $db = \Config\Database::connect();
        $builder = $db->table('adminUsers');
        $builder->select('user_id,firstname, lastname, email' );
        $builder->where('user_id',$id);
        $query = $builder->get()->getResultArray();
        return $query;

    }
}
?>