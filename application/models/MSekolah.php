<?php

// extends class Model
class MSekolah extends CI_Model{

    protected $table = "sekolah";

    public function get_list(){
        $query = $this->db->get($this->table)->result();
        return $query;
    }

}