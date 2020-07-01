<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Berita extends REST_Controller {

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get(){
        $data = $this->db->get('berita')->result();
        $this->response($data, 200);
  }

}

?>