<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

    protected $table = "users";

    protected $primaryKey = "user_id";

    protected $useAutoIncrement = true;

    protected $allowedFields = ['firstname', 'lastname', 'email', 'password','role_id', 'group_id', 'token'];

    protected $validationMessages = [
        'email'        => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
        ]
    ];

    public function displayUser(){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('user_id,firstname, lastname, email, role, Group_name' );
        $builder->join('roles','role_id = roles.id');
        $builder->join('groups', 'group_id = groups.id');
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;

    }

    public function verifyUserRole($id){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('user_id,firstname, lastname, email, role_id, group_id' );
        $builder->where('user_id',$id);
        $query = $builder->get()->getResultArray();
        return $query;

    }
    public function showSingleUser($id){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('user_id,firstname, lastname, email, role_id, group_id' );
        $builder->where('user_id',$id);
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }
    public function showRoles(){
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $builder->select('id,role');
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }

    public function showGroup(){
        $db = \Config\Database::connect();
        $builder = $db->table('groups');
        $builder->select('id,Group_name');
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }

    public function verifyEmail($email){
        $builder = $this->db->table('users');
        $builder->select('email',);
        $builder->where('email',$email);
        $result = $builder->get();
        if(count($result->getResultArray()) == 1){
            return true;
        }else{
            return false;
        }
        }
        public function getEmail($email){

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('user_id, email');
        $builder->where('email', $email);
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
        }

        public function Login($username = '',$password=''){
            $db = \Config\Database::connect();
    
            $sql = "SELECT * FROM users WHERE email = '".$username."'";
            $result = $db->query($sql)->getRowArray();
    
            return $result;
        }

        public function showProfile($id){
            $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('user_id,firstname, lastname, email, role, Group_name' );
        $builder->join('roles','role_id = roles.id');
        $builder->join('groups', 'group_id = groups.id');
        $builder->where('user_id',$id);
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
        }

        function get_token($token){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("user_id");
        $builder->where('token', $token);
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;

        }


}

?>