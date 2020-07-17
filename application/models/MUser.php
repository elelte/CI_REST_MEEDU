<?php 
 
class MUser extends CI_Model{
 
    protected $table = "endusers";
 
    public function insert_user($data){
        $this->db->insert($this->table, $data);
    }
 
    public function login($email, $pass){
        $query = $this->db
                ->where('email', $email)
                ->where('password', $pass)
                ->get($this->table)->result_array();
        return $query;
    }

    public function detail($email){
        $query = $this->db
                ->where('email', $email)
                ->get($this->table)->result_array();
        return $query;
    }
}