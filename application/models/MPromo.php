<?php

// extends class Model
class MPromo extends CI_Model{

    protected $table = "promo";

    public function get_list(){
        $query = $this->db->get($this->table)->result();
        return $query;
    }

}