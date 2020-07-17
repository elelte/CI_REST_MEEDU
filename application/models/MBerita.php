<?php

// extends class Model
class MBerita extends CI_Model{

    protected $table = "berita";

    public function get_list(){
        $query = $this->db->get($this->table)->result();
        return $query;
    }

}